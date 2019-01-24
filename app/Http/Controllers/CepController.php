<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Nfe;

class CepController extends Controller
{
    public function consulta($cep){
        $url = "https://webmaniabr.com/api/1/cep/";
        $app_key = "XGHKZ7OVJdGNt4taheqfd0OAsJfuaHc9";
        $app_secret = "7eJAy357F7rlti5tGNO2Nmeu016F4JyiCWR1IESPla2CdJdq";
    
        $client = new Client(['headers' => 
            [
                'Content-type' => 'application/json'
            ]
        ]);

        $r = $client->request('GET', $url.$cep.'/?app_key='.$app_key.'&app_secret='.$app_secret);
                    
        return $r->getBody()->getContents();

    }
}
