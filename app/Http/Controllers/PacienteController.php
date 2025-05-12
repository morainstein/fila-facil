<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use App\Models\Paciente;
use App\Models\Sessao;
use Illuminate\Database\QueryException;
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

        if($sessaoId === null){
            return 'sessão ainda não abriu :(';
        }
        
        return view('paciente.formPatient')
            ->with(['clinicaId'=>$clinica->id]);

    }

    public function store(Request $request)
    {
        $clinicaId = $request->clinicaId;

        $currentDate = session()->get('currentDate');

        $todaysSession = Sessao::
            whereRaw("clinica_id = '$clinicaId' and data_sessao >= '$currentDate'")
            ->first();

        if(is_null($todaysSession)){
        /* INSERIR MSG DE SESSÃO FECHADA */
            return redirect()->back();
        }

        $insert = [
            'nome' => $request->nome,
            'sessao_id' => $todaysSession->id,
        ];

        $paciente = new Paciente($insert);
        $paciente->save();

        session([
            ["pacienteId"=>$paciente->id],
            ["clinicaId"=>$clinicaId],
        ]);
        return to_route('paciente.show',['paciente' => $paciente->id]);
    }

    public function show(Request $request)
    {
        $pacienteId = session()->get('pacienteId');
        $clinicaId = session()->get('clinicaId');

        [$servedPatients, $unservedPatients] = ClinicaController::returnPatientsList($request);

        return view('paciente.waitScreen')->with([
            'servedPatients' => $servedPatients,
            'unservedPatients' => $unservedPatients
        ]);
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
