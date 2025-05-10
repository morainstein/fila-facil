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
    <div class="alert alert-danger">
      {{$sessionMsg}}
    </div>
  @endisset

  <div class="dashboard-main">  
    <div class="dashboard-sections">

      <x-unservedPacientes :$unservedPacientes ></x-unservedPacientes>
      
      <x-servedPacientes :$servedPacientes ></x-servedPacientes>

    </div>

      <form class="dashboard-sections caixa register-patient" 
      action="{{ route('paciente.store')}}" 
      method="post">
        @csrf
        <div>
          <img class="logo" src=" {{ Vite::asset('resources/assets/logo-day.png') }}" alt="">
          <h3>Cadastrar Paciente</h3>
        </div>
        <label>Nome completo
          <input class="inputs" type="text" name="nome" required>
        </label>
        <label>CPF
          <input class="inputs" type="text" name="cpf" placeholder="xxx.xxx.xxx-xx" required>
        </label>
        <label>Prioridade
          <select class="inputs" name="" id="">
            <option value="0" selected>Sem prioridade</option>
            <option value="1">Gestante</option>
            <option value="2">Idoso</option>
          </select>
        </label>
        <input class="buttons" type="submit" value="Cadastrar">
      </form>
        
  </div>

  {{-- <div class="d-flex gap-3">
    <a href="#">
      <button class="btn btn-success">Gerar qr code </button>
    </a>
  </div> --}}

</section>

</x-main>
<x-footer></x-footer>