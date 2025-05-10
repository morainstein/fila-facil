<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use App\Models\Paciente;
use App\Models\Sessao;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request, Clinica $clinica)
    {
        $currentDate = session()->get('currentDate');
        
        $sessao = Sessao::query()
            ->where('clinica_id','=',$clinica->id)
            ->where('data_sessao','>=',$currentDate)
            ->first();

        $sessaoId = isset($sessao->id) ? $sessao->id : null; 
            
        session(['sessaoId'=>$sessaoId],null);
        
        if($sessaoId !== null){

            return view('paciente.form')->with('clinica',$clinica);
        }

        return 'sessão ainda não abriu :(';

    }

    public function store(Request $request)
    {
        $insert = [
            'nome' => $request->nome,
            'sessao_id' => session()->get('sessaoId'),
        ];
        $paciente = Paciente::insert($insert);

        $clinicaId = session()->get('clinicaId');

        if(isset($clinicaId)){
            return to_route('clinica.dashboard');
        }

        return to_route('paciente.show',['paciente' => $paciente]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $request)
    {
        return 'PÁGINA PRA MOSTRAR A FILA';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
