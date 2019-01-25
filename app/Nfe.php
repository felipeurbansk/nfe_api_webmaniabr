<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nfe extends Model
{
    /** Nome da tabela nfe alterada para ficar equivalente ao campo nfe, campo requerido pela API */
    protected $table = "nfe";

    /** Permite a inserção em massa nos respectivos campos da tabela */
    protected $fillable = ['operacao','natureza_operacao','modelo','finalidade', 'ambiente'];

    /** Relacionamento com a tabela cliente */
    public function cliente(){
        return $this->hasMany('App\Cliente');
    }

    /** Relacionamento com a tabela produtos */
    public function produtos(){
        return $this->hasMany('App\Produto');
    }

    /** Relacionamento com a tabela pedido */
    public function pedido(){
        return $this->hasMany('App\Pedido');
    }
}
