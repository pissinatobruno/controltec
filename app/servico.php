<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    use SoftDeletes;

    protected $fillable = ['descricao', 'valor_clt', 'valor_terc'];

    public function ordem(){
        return $this->belongsTo(os::class);
    }
}
