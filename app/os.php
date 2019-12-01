<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\equipamento;

class os extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['numero_os','data_execucao', 'descricao_servico', 'data_vencimento', 
    'cliente_id', 'status_id', 'servico_id', 'tecnico_id', 'auxiliar_id'];

    public function cliente(){
        return $this->hasOne(cliente::class);
    }

    public function equipamento():BelongsToMany
    {
        return $this->belongsToMany(equipamento::class, 'OrdensEquipamentos');
    }

    public function status(){
        return $this->hasOne(status::class);
    }

    public function servico(){
        return $this->hasOne(servico::class);
    }

    public function tecnico(){
        return $this->hasOne(tecnico::class);
    }

    public function auxiliar(){
        return $this->hasOne(tecnico::class);
    }
}
