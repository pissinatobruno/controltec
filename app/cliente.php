<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
    protected $fillable = ['nome','num_conta'];

    public function telefones(){
        return $this->hasOne(Telefone::class)->withTrashed();
    }

    public function enderecos(){
        return $this->hasOne(Endereco::class)->withTrashed();
    }

    public function pessoa_fisica(){
        return $this->hasOne(pessoa_fisica::class)->withTrashed();
    }

    public function pessoa_juridica(){
        return $this->hasOne(pessoa_juridica::class)->withTrashed();
    }

    public function getDocPessoaAttribute(){

        if(isset($this->pessoa_fisica))
            return $this->pessoa_fisica->documento;
          
        if(isset($this->pessoa_juridica))
            return $this->pessoa_juridica->documento;
      
        return null; 
    }

    public function ordem(){
        return $this->hasMany(os::class);
    }


      
      
}
