<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use App\Models\Paciente;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClinicaController extends Controller
{

    public function formLogin()
    {
        if(Auth::check()){
            return to_route('clinica.dashboard');
        }
        return view('clinica.login');
    }
    
    public function makeLogin(Request $request)
    {              
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->senha])){
            $clinicaId = Auth::user()->id;
            session(['clinicaId'=>$clinicaId]);
            return to_route('clinica.dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('clinica.login');
    }

    public function create()
    {
        return view('clinica.form');
    }

    public function store(Request $request)
    {
        $clinica = new Clinica();
        $clinica->nome_empresa = $request->nome;
        $clinica->email = $request->email;
        $clinica->cnpj = $request->cnpj;
        $clinica->password = Hash::make($request->senha);
        $clinica->save();

        return to_route('clinica.create');
    }

    private function returnPatientsList(Request $request) : array
    {
        $clinicaId = $request->session()->get('clinicaId');

        $currentDate = session()->get('currentDate');

        $pacientes = Sessao::join('pacientes','sessoes.id','=','pacientes.sessao_id')
            ->where('clinica_id',$clinicaId)
            ->where('data_sessao','>=',$currentDate)
            ->orderBy('pacientes.id','asc')
            ->get();

        $servedPacientes = [];
        $unservedPacientes = [];

        foreach($pacientes as $paciente){
            if($paciente->atendido == 1){
                $servedPacientes[] = $paciente;
            }elseif($paciente->atendido == 0){
                $unservedPacientes[] = $paciente;
            }
        }

        return [$servedPacientes, $unservedPacientes];
    }

    public function dashboard(Request $request)
    {
        [$servedPacientes, $unservedPacientes] = $this->returnPatientsList($request);
        $sessionMsg = $request->session()->pull('sessionMsg');

        return view('clinica.dashboard')->with([
            'sessionMsg' => $sessionMsg,
            'servedPacientes' => $servedPacientes,
            'unservedPacientes' => $unservedPacientes
        ]);
    }

    public function openSession()
    {
        $clinicaId = session()->get('clinicaId');
        $currentDate = session()->get('currentDate');

        $sql = 'data_sessao > ? AND clinica_id = ?';
        $isThereSession = Sessao::whereRaw($sql,[$currentDate,$clinicaId])
            ->exists();

        $sessionMsg = 'A Sessão de hoje já existe';
        if(!$isThereSession){
            $sessao = new Sessao(['clinica_id'=> $clinicaId]);
            $sessao->save();
            session(['sessaoId' => $sessao->id],null);
            $sessionMsg = 'Sessão criada';
        }
        
        return to_route('clinica.dashboard')->with('sessionMsg',$sessionMsg);        
    }

    public function patientListScreen(Request $request)
    {
        [$servedPacientes, $unservedPacientes] = $this->returnPatientsList($request);

        return view('clinica.patientListScreen')
            ->with([
                'servedPacientes' => $servedPacientes,
                'unservedPacientes' => $unservedPacientes    
            ]);

    }

    public function nextPaciente()
    {
        $sessaoId = session()->get('sessaoId');

        $paciente = Paciente::where('sessao_id',$sessaoId)
            ->where('atendido',0)
            ->orderBy('id','asc')
            ->first();

        $paciente->atendido = 1;
        $paciente->save();

        return to_route('clinica.dashboard');
    }
}
