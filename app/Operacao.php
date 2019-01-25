<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
     /** Nome da tabela operacoes alterada para ficar equivalente ao campo operacoes, campo requerido pela API */
    protected $table = "operacoes";
}
