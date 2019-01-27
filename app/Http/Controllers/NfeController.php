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
   /** Credenciais de acesso da API NF-e */
    public function __construct(){
        /** URL Base */
        $this->url = "https://webmaniabr.com/api/1/nfe/";
        /** Header */
        $this->client = new Client(['headers' => 
                [
                    'Content-type' => 'application/json',
                    'X-Consumer-Key' => 'SEU_CONSUMER_KEY',
                    'X-Consumer-Secret' => 'SEU_CONSUMER_SECRET',
                    'X-Access-Token' => 'SEU_ACCESS_TOKEN',
                    'X-Access-Token-Secret' => 'SEU_ACCESS_TOKEN_SECRET'
                ]
        ]);
    }

    /* Chamada da view index */
    public function index()
    {
        return view('index');
    }

    /*  Chamada do formulario de emissão*/
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

    /** Metodo responsavel por salvar as informações da NF-e no banco de dados antes de envia-lo para API */
    public function salvar(NfeRequest $request)
    {        
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
            /** Finaliza a comunicação com banco */
            DB::commit();
        }catch(\Exception $e){
            /** Caso ocorra uma exceção é revertido a operação com o banco e o redireciona para tela anterior */
            DB::rollback();
            return back()->with('error', 'Não foi possível salvar as informações da NF-e no banco de dados.');
        }

        /** Recarrega o objeto nfe com todos os dados já inseridos e converte para o formato json*/
        $nfe = json_encode($nfe->load(['cliente','pedido','produtos']));
        
        /** Chama a função responsavel pela comunicação com a API metodo emissão */
        $this->emitir_nfe($nfe);
    }

    /** Metodo responsavel pela emissão de NF-e */
    public function emitir_nfe($nfe){
        try{
            /** Requisição emissão de NF-e */
            $resposta = $this->client->request('POST', $this->url.'emissao/', [
                'json' => $nfe
            ]);
            /** Retorna a resposta json*/
            $nfe = json_decode($resposta->getBody()->getContents(), true);
            return $nfe;
        }catch(\Exception $e){
            return back()->with('msg_error', 'Não foi possível emitir a NF-e. Favor verificar suas credenciais de acesso ou status do sefaz.');
        }
    }

    /** Chamada do formulario de consulta */
    public function consulta(){
        return view('consulta_nfe');
    }

    /** Metodo responsavel pela consulta de NF-e através de sua chave */
    public function consultar_nfe(Request $request){
        try{
            /** Validação de campo obrigatorio no input chave */
            $this->validate($request, [
                'chave' => 'required'
            ]);
            /** Requisição consulta de NF-e */
            $resposta = $this->client->request('GET', $this->url.'consulta/',[
                'json' => ['chave' => $request->input('chave')]
            ]);
            /** Retorna a resposta json*/
            $nfe = json_decode($resposta->getBody()->getContents(), true);
            return $nfe;
        }catch(\Exception $e){
            return back()->with('msg_error', 'Não foi possível consultar a NF-e. Favor verificar suas credenciais de acesso ou status do sefaz.');
        }
    }

    /** Metodo responsavel pela consulta do status do SEFAZ */
    public function consulta_sefaz(){
        try{
            /** Requisição status sefaz */
            $resposta = $this->client->request('GET', $this->url.'sefaz/');
            /** Retorna a resposta json*/
            $status_sefaz = json_decode($resposta->getBody()->getContents(), true);
            return $status_sefaz;
        }catch(\Exception $e){
            return back()->with('msg_error', 'Não foi possível consultar o status do sefaz. Favor verificar suas credenciais de acesso.');
        }
    }

    /** Chamada da view de validação de certificado */
    public function validacao_cert(){
        return view('validacao_cert');
    }

    /** Metodo responsavel pela validação de certificado */
    public function validar_cert(){
        try{
            /** Requisição cerificado */
            $reposta = $this->client->request('GET', $this->url.'certificado/');
            /** Retorna a resposta json*/
            $cert = json_decode($resposta->getBody()->getContents(), true);
            return view('validacao_cert', compact('cert'));
        }catch(\Exception $e){
            return back()->with('msg_error', 'Não foi possível validar o certificado. Favor verificar suas credenciais de acesso ou status do sefaz.');
        }
    }

    /** Chamada do formulario de cancelamento */
    public function cancelamento_nfe(){
        return view('cancelamento_nfe');
    }

    /** Metodo responsavel pelo cancelamento */
    public function cancelar_nfe(Request $request){
        
        /** Validação do formulario */
        $this->validate($request, [
            'chave' => 'required',
            'motivo' => 'required',
        ]);

        try{
            $nfe['chave'] = $request->input('chave');
            $nfe['motivo'] = $request->input('motivo');
            json_encode($nfe);
            /** Requisição cancelamento */
            $reposta = $this->client->request('PUT', $this->url.'cancelar/',[
                'json' => $nfe
            ]);
            /** Retorna a resposta json*/
            $cancelamento = json_decode($resposta->getBody()->getContents(), true);
            return $cancelamento;
        }catch(\Exception $e){
            return back()->with('msg_error', 'Não foi possível cancelar a NF-e. Favor verificar suas credenciais de acesso ou status do sefaz.');
        }
    }

    /** Chamada do formulario de devolução */
    public function devolver_nfe(){
        return view('devolucao_nfe');
    }

    /** Metodo responsavel pela devolução */
    public function devolucao_nfe(Request $request){

        /** Validação do formulario */
        $this->validate($request, [
            'chave' => 'required',
            'natureza_operacao' => 'required',
            'ambiente' => 'required',
        ]);

        $nfe_dev['chave'] = $request->input('chave');
        $nfe_dev['natureza_operacao'] = $request->input('natureza_operacao');
        $nfe_dev['ambiente'] = $request->input('ambiente');
        json_encode($nfe_dev);
        try{
            /** Requisição de devolucao */
            $reposta = $this->client->request('POST', $this->url.'devolucao/',[
                'json' => $nfe_dev
            ]);
            /** Retorna a resposta json*/
            $devolucao = json_decode($resposta->getBody()->getContents(), true);
            return $devolucao;
        }catch(\Exception $e){
            return back()->with('msg_error', 'Não foi possível realizar a devolução da NF-e. Favor verificar suas credenciais de acesso ou status do sefaz.');
        }
    }
}
