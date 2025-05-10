<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $fillable = ['nome','atendido','sessao_id'];

    public function sessao()
    {
        return $this->belongsTo(Sessao::class,'sessao_id');
    }
}
