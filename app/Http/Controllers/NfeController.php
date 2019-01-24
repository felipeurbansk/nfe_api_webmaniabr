<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NfeRequest;
use GuzzleHttp\Client;
use DB;
/* Modelos */
use App\Cliente;
use App\ModalidadeFrete;
use App\Nfe;
use App\Operacao;
use App\Origem;
use App\Pedido;
use App\Presenca;
use App\Produto;
use App\Unidade;


class NfeController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function emitir()
    {
        $modalidade_frete = ModalidadeFrete::all();
        $operacao = Operacao::all();
        $origem = Origem::all();
        $presenca = Presenca::all();
        $unidade = Unidade::all();

        return view('emissao_nfe', compact('modalidade_frete', 'operacao', 'origem', 'presenca', 'unidade'));
    }

    public function salvar(NfeRequest $request)
    {
        /* Salvar as informações da nota no banco de dados antes de envia-lo para API*/
        DB::beginTransaction();

        try{
            /* Nota Fiscal */
            $nfe = Nfe::create($request->except('_token'));

            /* Cliente */
            $cliente = new Cliente();
            $cliente->nome_completo = $request->input('nome_completo');
            $cliente->email = $request->input('email');
            $cliente->cpf = $request->input('cpf');
            $cliente->endereco = $request->input('endereco');
            $cliente->complemento = $request->input('complemento');
            $cliente->numero = $request->input('numero');
            $cliente->bairro = $request->input('bairro');
            $cliente->cidade = $request->input('cidade');
            $cliente->uf = $request->input('uf');
            $cliente->cep = $request->input('cep');
            $nfe->cliente()->save($cliente);

            /* Produtos */
            $produto = new Produto();
            $produto->nome = $request->input('nome_produto');
            $produto->ncm = $request->input('ncm');
            $produto->quantidade = $request->input('quantidade');
            $produto->unidade = $request->input('unidade');
            $produto->peso = $request->input('peso');
            $produto->origem = $request->input('origem');
            $produto->subtotal = $request->input('subtotal');
            $produto->total = $request->input('total');
            $nfe->produtos()->save($produto);

            /* Pedido */
            $pedido = new Pedido();
            $pedido->presenca = $request->input('presenca');
            $pedido->modalidade_frete = $request->input('modalidade_frete');
            $pedido->frete = $request->input('frete');
            $pedido->desconto = $request->input('desconto');
            $nfe->pedido()->save($pedido);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error', 'Não foi possivel lançar a nota fiscal.');
        }

        /* Recarrega o objeto $nfe com os dados inseridos e atualizados ja em formato json*/
        $nfe = json_encode($nfe->load(['cliente','pedido','produtos']));
        
        $this->enviar_dados($nfe);
    }

    public function enviar_dados($nfe){
        $url = "https://webmaniabr.com/api/1/nfe/";

        $client = new Client(['headers' => 
            [
                'Content-type' => 'application/json',
                'X-Consumer-Key' => 'SEU_CONSUMER_KEY',
                'X-Consumer-Secret' => 'SEU_CONSUMER_SECRET',
                'X-Access-Token' => 'SEU_ACCESS_TOKEN',
                'X-Access-Token-Secret' => 'SEU_ACCESS_TOKEN_SECRET'
            ]
        ]);

        $resposta = $client->request('POST', $url.'emissao/', [
            'json' => $nfe
        ]);

        return $r->getBody()->getContents();
    }

    public function consultar(){
        return view('consulta_nfe');
    }

    public function consultar_nfe(Request $request){

        $this->validate($request, [
            'chave' => 'required'
        ]);

        $url = "https://webmaniabr.com/api/1/nfe/consulta/";

        $client = new Client(['headers' => 
            [
                'Content-type' => 'application/json',
                'X-Consumer-Key' => 'SEU_CONSUMER_KEY',
                'X-Consumer-Secret' => 'SEU_CONSUMER_SECRET',
                'X-Access-Token' => 'SEU_ACCESS_TOKEN',
                'X-Access-Token-Secret' => 'SEU_ACCESS_TOKEN_SECRET'
            ]
        ]);

        $resposta = $client->request('GET', $url,[
            'json' => ['chave' => $request->input('chave')]
        ]);

        return $r->getBody()->getContents();
    }

}
