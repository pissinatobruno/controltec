<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tecnico extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'tp_registro'];

    public function ordem(){
        return $this->hasmany(os::class);
    }

    public function getMaskTecnicoAttribute(){   
        if( $this->tp_registro == true )
        { 
            return "Terceiro"; 
        }
        else
        { 
            return "CLT";
        }    
    }
}
