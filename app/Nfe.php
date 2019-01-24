<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nfe extends Model
{
    protected $table = "nfe";

    protected $fillable = ['operacao','natureza_operacao','modelo','finalidade', 'ambiente'];

    public function cliente(){
        return $this->hasMany('App\Cliente');
    }

    public function produtos(){
        return $this->hasMany('App\Produto');
    }

    public function pedido(){
        return $this->hasMany('App\Pedido');
    }
}
