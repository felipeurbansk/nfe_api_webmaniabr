<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'ncm', 'quantidade', 'unidade', 'peso', 'origem', 'subtotal', 'total'];

    public function nfe(){
        return $this->belongsTo('App\Nfe');
    }
}
