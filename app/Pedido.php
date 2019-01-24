<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedido";

    protected $fillable = ['presenca', 'modalidade_frete', 'frete', 'desconto'];

    public function nfe(){
        return $this->belongsTo('App\Nfe');
    }
}
