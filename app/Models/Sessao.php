<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    protected $table = 'sessoes';
    protected $fillable = ['clinica_id'];

    public function clinica()
    {
        return $this->belongsTo(Clinica::class,'clinica_id');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class,'sessao_id','id');
    }
}
