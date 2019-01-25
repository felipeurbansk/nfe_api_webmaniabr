<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /** Permite a inserção em massa nos respectivos campos da tabela */
    protected $fillable = ['nome', 'ncm', 'quantidade', 'unidade', 'peso', 'origem', 'subtotal', 'total'];

    /** Relacionamento com a tabela nfe */
    public function nfe(){
        return $this->belongsTo('App\Nfe');
    }
}
