<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class OmniController extends Controller
{
    public function teste(){
        return 'teste';
    }

    public function seeder(){

        $paciente = new Paciente(['nome'=>'p1','atendido'=>0,'sessao_id'=>'5']);
        $paciente->save();

        $paciente = new Paciente(['nome'=>'p2','atendido'=>1,'sessao_id'=>'5']);
        $paciente->save();

        $paciente = new Paciente(['nome'=>'p3','atendido'=>0,'sessao_id'=>'5']);
        $paciente->save();

        $paciente = new Paciente(['nome'=>'p4','atendido'=>1,'sessao_id'=>'5']);
        $paciente->save();

        $paciente = new Paciente(['nome'=>'p5','atendido'=>1,'sessao_id'=>'5']);
        $paciente->save();


    }
}
