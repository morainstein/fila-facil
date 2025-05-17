<x-header titulo='Dashboard'></x-header>
<x-main>

<section class="caixa" id="dashboard">
  <div class="caixa-tittle">
    <h2>DASHBOARD</h2>
    <nav class="functionalities">
      <a class="icons" href="{{ route('clinica.openSession')}}">
        <span> Abrir sessão </span>
        <img src="{{ Vite::asset('resources/assets/sessao-fechada.svg') }}" alt="Abrir sessão">
      </a>

      <a class="icons" href="{{ route('clinica.patientListScreen') }}" target="_blank">
        <span>Tela de listagem de pacientes</span>
        <img src="{{ Vite::asset('resources/assets/patient-list.svg') }}" alt="Tela de listagem de pacientes">
      </a>
      
      <a class="icons" href="{{ route('clinica.nextPaciente') }}">
        <span>Próximo paciente</span>
        <img src="{{ Vite::asset('resources/assets/next-patient.svg') }}" alt="Próximo paciente">
      </a>

      <a class="icons" href="#" target="_blank">
        <span>Gerar QRcode</span>
        <img src="{{ Vite::asset('resources/assets/qrcode.svg') }}" alt="Próximo paciente">
      </a>
    </nav>
    <a href="{{ route('clinica.logout',['clinica'=>1])}}">
      <img src="{{Vite::asset('resources/assets/logout.png')}}" alt="Logout">      
    </a>
  </div>

  @isset($sessionMsg)
    <div class="flash-msg session-msg">
      {{$sessionMsg}}
    </div>
  @endisset

  <div class="dashboard-main">  
    <div class="dashboard-sections">

      <x-unservedPatients :$unservedPatients> </x-unservedPatients>
      
      <x-servedPatients :$servedPatients> </x-servedPatients>

    </div>

    <x-registerPatient></x-registerPatient>
        
  </div>

</section>

</x-main>
<x-footer></x-footer>