<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    protected $table = 'clinicas';
    protected $hidden = 'password';

    public function sessoes()
    {
        return $this->hasMany(Sessao::class,'clinica_id','id');
    }
}
