<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origem extends Model
{
    /** Nome da tabela origens alterada para ficar equivalente ao campo origens, campo requerido pela API */
    protected $table = "origens";
}
