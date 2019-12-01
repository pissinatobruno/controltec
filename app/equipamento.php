<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\os;

class equipamento extends Model
{
    use SoftDeletes;

    protected $fillable = ['descricao'];

    public function ordem(): BelongsToMany
    {
        return $this->belongsToMany(os::class, 'OrdensEquipamentos');
    }
}
