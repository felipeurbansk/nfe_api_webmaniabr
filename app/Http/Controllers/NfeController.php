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
    /** Instancia um objeto Client da biblioteca Guzzle e adiciona o cabeçalho como requirido pela API. */
    public function __construct(){
        $client = new Client(['headers' => 
                [
                    'Content-type' => 'application/json',
                    'X-Consumer-Key' => 'SEU_CONSUMER_KEY',
                    'X-Consumer-Secret' => 'SEU_CONSUMER_SECRET',
                    'X-Access-Token' => 'SEU_ACCESS_TOKEN',
                    'X-Access-Token-Secret' => 'SEU_ACCESS_TOKEN_SECRET'
                ]
        ]);
    }

    /* Chamada da view index pela rota / */
    public function index()
    {
        return view('index');
    }

    /*  Chamada do formulario para emitir NF-e. */
    public function emitir()
    {
        $modalidade_frete = ModalidadeFrete::all();
        $operacao = Operacao::all();
        $origem = Origem::all();
        $presenca = Presenca::all();
        $unidade = Unidade::all();

        /*  É enviado a view emissao_nfe, objetos contendo todos os dados de suas respectivas tabelas.
            Esses dados são usados para preencher options do formulario.
        */
        return view('emissao_nfe', compact('modalidade_frete', 'operacao', 'origem', 'presenca', 'unidade'));
    }

    public function salvar(NfeRequest $request)
    {
        /** Salvar as informações da nota no banco de dados antes de envia-lo para API */
        
        DB::beginTransaction();

        try{
            /** Salvando os dados na tabela nfe */
            $nfe = Nfe::create($request->except('_token'));

            /** Salvando os dados na tabela cliente e a relacionando com a tabela nfe */
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

            /** Salvando os dados na tabela produtos e a relacionando com a tabela nfe */
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

            /** Salvando os dados na tabela pedido e a relacionando com a tabela nfe */
            $pedido = new Pedido();
            $pedido->presenca = $request->input('presenca');
            $pedido->modalidade_frete = $request->input('modalidade_frete');
            $pedido->frete = $request->input('frete');
            $pedido->desconto = $request->input('desconto');
            $nfe->pedido()->save($pedido);
            /** Comitando a transação com banco */
            DB::commit();
        }catch(Exception $e){
            /** Caso ocorra uma exceção é revertido a operação com o banco e o redireciona para tela anterior */
            DB::rollback();
            return back()->with('error', 'Não foi possivel lançar a nota fiscal.');
        }

        /** Recarrega o objeto nfe com todos os dados já inseridos e converte para o formato json*/
        $nfe = json_encode($nfe->load(['cliente','pedido','produtos']));
        
        /** Chama a função responsavel pela comunicação com a API de emissão */
        $this->enviar_dados($nfe);
    }

    public function enviar_dados($nfe){
        /** Atribui o endereço base para a chamada da API */
        $url = "https://webmaniabr.com/api/1/nfe/";
        
        /** Envia o json usando metodo POST para API emissao e armazena o retorno em $resposta */
        $resposta = $client->request('POST', $url.'emissao/', [
            'json' => $nfe
        ]);
        
        /** Retorna o conteudo do json recebido da API */
        return $resposta->getBody()->getContents();
    }

    /** Faz a chamada da view consulta_nfe */
    public function consultar(){
        return view('consulta_nfe');
    }

    /** Metodo responsavel pela consulta de NF-e utilizando sua chave */
    public function consultar_nfe(Request $request){

        /** Validação de campo obrigatorio no input chave */
        $this->validate($request, [
            'chave' => 'required'
        ]);

        /** Atribui o endereço base para a chamada da API */
        $url = "https://webmaniabr.com/api/1/nfe/consulta/";

        /** Envia o json usando metodo GET para API consulta e armazena o retorno em $resposta */
        $resposta = $client->request('GET', $url,[
            'json' => ['chave' => $request->input('chave')]
        ]);

        /** Retorna o conteudo do json recebido da API */
        return $resposta->getBody()->getContents();
    }

}
