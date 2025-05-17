<?php

namespace App\Http\Controllers;

use App\Helpers\QrCodeFactory;
use App\Models\Clinica;
use App\Models\Paciente;
use App\Models\Sessao;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClinicaController extends Controller
{

    public function __construct()
    {}

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
            $clinicId = Auth::user()->id;
            $clinicName = Auth::user()->nome_empresa;
            session(['clinicId'=>$clinicId,'clinicName'=>$clinicName]);
            return to_route('clinica.dashboard');
        }else{
            // IMPLEMENTAR MENSAGEM DE LOGIN ERRADO
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
        return view('clinica.create');
    }

    public function store(Request $request)
    {
        try{
            $qrCodeFactory = new QrCodeFactory();
            $qrCodeName = $qrCodeFactory->generate($request->nome);
            
            $clinica = new Clinica();
            $clinica->nome_empresa = $request->nome;
            $clinica->email = $request->email;
            $clinica->cnpj = $request->cnpj;
            $clinica->password = Hash::make($request->senha);
            $clinica->save();
        }catch(UniqueConstraintViolationException $e){
            
            /** INSERIR MENSSAGEM DE ERRO NA VIEW */
            return to_route('clinica.create');
                
        }

        return to_route('clinica.login');
    }

    // static public function generateQrcode(QrCodeFactory $qrCode)
    // {

    //     $result = $qrCode->generate("ue");
        
    //     // $result->saveToFile(__DIR__."/../../../resources/qrcodes/teste.png");

    //     // header("Content-Type:". $result->getMimeType());
    //     // echo $result->getString();
    // }

    static public function returnPatientsList(Request $request) : array
    {
        $clinicId = $request->session()->get('clinicId');

        $currentDate = session()->get('currentDate');

        $pacientes = Sessao::join('pacientes','sessoes.id','=','pacientes.sessao_id')
            ->where('clinica_id',$clinicId)
            ->where('data_sessao','>=',$currentDate)
            ->orderBy('pacientes.id','asc')
            ->get();

        $servedPatients = [];
        $unservedPatients = [];

        foreach($pacientes as $paciente){
            if($paciente->atendido == 1){
                $servedPatients[] = $paciente;
            }elseif($paciente->atendido == 0){
                $unservedPatients[] = $paciente;
            }
        }

        return [$servedPatients, $unservedPatients];
    }

    public function patientListScreen(Request $request)
    {
        [$servedPatients, $unservedPatients] = $this->returnPatientsList($request);

        return view('clinica.patientListScreen')
            ->with([
                'servedPatients' => $servedPatients,
                'unservedPatients' => $unservedPatients    
            ]);
    }

    public function dashboard(Request $request)
    {
        [$servedPatients, $unservedPatients] = $this->returnPatientsList($request);
        $sessionMsg = $request->session()->pull('sessionMsg');

        return view('clinica.dashboard')->with([
            'sessionMsg' => $sessionMsg,
            'servedPatients' => $servedPatients,
            'unservedPatients' => $unservedPatients
        ]);
    }

    public function openSession()
    {
        $clinicId = session()->get('clinicId');
        $currentDate = session()->get('currentDate');

        $sql = 'data_sessao > ? AND clinica_id = ?';
        $isThereSession = Sessao::whereRaw($sql,[$currentDate,$clinicId])
            ->exists();

        $sessionMsg = 'A Sessão de hoje já existe';
        if(!$isThereSession){
            $sessao = new Sessao(['clinica_id'=> $clinicId]);
            $sessao->save();
            session(['sessaoId' => $sessao->id],null);
            $sessionMsg = 'Sessão criada';
        }
        
        return to_route('clinica.dashboard')->with('sessionMsg',$sessionMsg);        
    }

    public function storePatient(Request $request)
    {
        $clinicId = session()->get('clinicId');

        $currentDate = session()->get('currentDate');

        $todaysSession = Sessao::
            whereRaw("clinica_id = '$clinicId' and data_sessao >= '$currentDate'")
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

        return to_route('clinica.dashboard');   
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
