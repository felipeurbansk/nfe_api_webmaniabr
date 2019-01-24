<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    
    protected $fillable = ['nome_completo', 'email', 'cpf', 'endereco', 'complemento', 'numero', 'bairro', 'cidade', 'uf', 'cep'];

    public function nfe(){
        return $this->belongsTo('App\Nfe');
    }
}
