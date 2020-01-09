<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa_juridica extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['documento', 'cliente_id'];

    public function cliente(){
        return $this->belongsTo(cliente::class);
    }
}
