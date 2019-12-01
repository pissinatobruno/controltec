<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class telefone extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['telefone', 'telefone2' ,'cliente_id'];
}
