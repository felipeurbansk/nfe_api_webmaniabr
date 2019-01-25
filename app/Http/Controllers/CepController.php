<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Nfe;

class CepController extends Controller
{
    /** Chamada da view consulta_cep */
    public function cep(){
        return view('consulta_cep');
    }

    /** Metodo de comunicação com a API CEP */
    public function consulta($cep){

        /** Atribui o endereço base para a chamada da API */
        $url = "https://webmaniabr.com/api/1/cep/";
        /** Chaves de acesso da API. 
         *  Essa API é disponibilizada gratuitamente no site https://webmaniabr.com/docs/rest-api-cep-ibge/
        */
        $app_key = "seu_app_key";
        $app_secret = "seu_app_secret";
    
        /** Cria um objeto Client da biblioteca Guzzle e define seu cabeçalho como requirido pela API. */
        $client = new Client(['headers' => 
            [
                'Content-type' => 'application/json'
            ]
        ]);

        /** Envia o json usando metodo GET para API cep e armazena o retorno em $resposta */
        $resposta = $client->request('GET', $url.$cep.'/?app_key='.$app_key.'&app_secret='.$app_secret);
    
        /** Retorna o conteudo do json recebido da API */
        return $resposta->getBody()->getContents();
    }
}
