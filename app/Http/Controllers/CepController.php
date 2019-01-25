<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CepController extends Controller
{    

    /** Cria um objeto Client da biblioteca Guzzle e define seu cabeçalho como requirido pela API. */
    public function __construct(){
        $client = new Client(['headers' => 
            [
                'Content-type' => 'application/json'
            ]
        ]);
    }
    /** Chamada da view consulta_cep */
    public function cep(){
        return view('consulta_cep');
    }

    /** Metodo de comunicação com a API CEP */
    public function consultar_cep(Request $request){

        /** Validação de campo obrigatorio no input cep e verifica se está no formato certo */
        $this->validate($request, [
            'cep' => 'required|formato_cep'
        ]);

        /** Atribui o endereço base para a chamada da API */
        $url = "https://webmaniabr.com/api/1/cep/";
        /** Chaves de acesso da API. 
         *  Essa API é disponibilizada gratuitamente no site https://webmaniabr.com/docs/rest-api-cep-ibge/
        */
        $app_key = "seu_app_key";
        $app_secret = "seu_app_secret";

        /** Envia o json usando metodo GET para API cep e armazena o retorno em $resposta */
        $resposta = $client->request('GET', $url.$request->input('cep').'/?app_key='.$app_key.'&app_secret='.$app_secret);
    
        /** Retorna o conteudo do json recebido da API */
        $cep = json_decode($resposta->getBody()->getContents(), true);
        return view('consulta_cep', compact('cep'));
    }
}
