<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class telefone extends Model
{
    protected $fillable = ['numero','cliente_id'];
}
