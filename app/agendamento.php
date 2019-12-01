<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agendamento extends Model
{
    protected $fillable = ['data_agendamento','periodo', 'os_id'];
}
