<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** Nome da tabela cliente alterada para ficar equivalente ao campo cliente, campo requerido pela API */
    protected $table = "cliente";
    
    /** Permite a inserção em massa nos respectivos campos da tabela */
    protected $fillable = ['nome_completo', 'email', 'cpf', 'endereco', 'complemento', 'numero', 'bairro', 'cidade', 'uf', 'cep'];

    /** Relacionamento com a tabela nfe */
    public function nfe(){
        return $this->belongsTo('App\Nfe');
    }
}
