<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class auxiliar extends Model
{

    use SoftDeletes;

    protected $fillable = ['nome'];

    public function ordem(){
        return $this->belongsTo(os::class);
    }

}
