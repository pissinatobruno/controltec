<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class endereco extends Model
{
    protected $fillable = 
    ['cep','logradouro','numero','bairro','cidade',
    'estado','complemento','tp_residencia','pt_referencia','cliente_id'];
}
