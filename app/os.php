<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\equipamento;
use OwenIt\Auditing\Contracts\Auditable;

class Os extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
    protected $fillable = ['numero_os','data_execucao', 'descricao_servico', 'data_vencimento', 
    'cliente_id', 'status_id', 'servico_id', 'tecnico_id', 'auxiliar_id'];

    public function cliente(){
        return $this->belongsTo(cliente::class)->withTrashed();
    }

    public function equipamento():BelongsToMany
    {
        return $this->belongsToMany(equipamento::class, 'OrdensEquipamentos')->withTrashed();
    }

    public function status(){
        return $this->belongsTo(status::class);
    }
    public function servico(){
        return $this->belongsTo(servico::class)->withTrashed();
    }

    public function tecnico(){
        return $this->belongsTo(tecnico::class)->withTrashed();
    }

    public function auxiliar(){
        return $this->belongsTo(tecnico::class)->withTrashed();
    }
}
