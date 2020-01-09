<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Telefone extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
    protected $fillable = ['telefone', 'telefone2', 'cliente_id'];

    public function cliente(){
        return $this->belongsToMany(cliente::class);
    }
}
