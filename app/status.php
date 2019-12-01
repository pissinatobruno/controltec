<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{    
    protected $fillable = ['descricao', 'tipoStatus'];

    public function ordem(){
        return $this->belongsTo(os::class);
    }
}
