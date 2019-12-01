<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class endereco extends Model
{
    use SoftDeletes;
    
    protected $fillable = 
    ['cep','logradouro','numero','bairro','cidade',
    'estado','complemento','tp_residencia','pt_referencia','cliente_id'];
}
