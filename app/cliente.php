<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class cliente extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['nome','num_conta'];

    public function telefones(){
        return $this->hasOne(telefone::class);
    }

    public function enderecos(){
        return $this->hasOne(endereco::class);
    }

    public function pessoa_fisica(){
        return $this->hasOne(pessoa_fisica::class);
    }

    public function pessoa_juridica(){
        return $this->hasOne(pessoa_juridica::class);
    }

    public function getDocPessoaAttribute(){

        if(isset($this->pessoa_fisica))
            return $this->pessoa_fisica->documento;
          
        if(isset($this->pessoa_juridica))
            return $this->pessoa_juridica->documento;
      
        return null; 
    }

    public function ordem(){
        return $this->belongsTo(os::class);
    }


      
      
}
