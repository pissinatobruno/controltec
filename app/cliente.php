<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $fillable = ['nome','documento','num_conta'];

    public function funcaotelefone(){
        return $this->hasOne(telefone::class, 'cliente_id', 'id');
    }

    public function funcaoendereco(){
        return $this->hasOne(endereco::class, 'cliente_id', 'id');
    }
}
