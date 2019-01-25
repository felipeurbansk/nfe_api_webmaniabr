<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /** Nome da tabela pedido alterada para ficar equivalente ao campo pedido, campo requerido pela API */
    protected $table = "pedido";

    /** Permite a inserção em massa nos respectivos campos da tabela */
    protected $fillable = ['presenca', 'modalidade_frete', 'frete', 'desconto'];

    /**Relacionamento com a tabela nfe */
    public function nfe(){
        return $this->belongsTo('App\Nfe');
    }
}
