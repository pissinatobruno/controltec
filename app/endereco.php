<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Endereco extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
    protected $fillable = 
    ['cep','logradouro','numero','bairro','cidade',
    'estado','complemento','tp_residencia','pt_referencia', 'cliente_id'];

    public function setCidadeAttribute($value)
    {
        $this->attributes['cidade'] = mb_strtoupper($value);
    }

    public function cliente(){
        return $this->belongsTo(cliente::class);
    }
}
