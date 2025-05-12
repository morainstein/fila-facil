<x-header titulo='Cadastro'></x-header>
<x-main>

<section class="wait-screen">

  {{-- <div class="caixa"> --}}
    <ol class="caixa">
      <li >
        <span>Nome</span>
        <span>Situação</span>
      </li>
  
      @foreach($unservedPatients as $patient)
      <li >
        <span>{{$patient->nome}}</span>
        <span>Situação</span>
      </li>
      @endforeach
  
    </ol>
  {{-- </div> --}}


  <div class="caixa">
    <ol class="list-patients">
      <li class="patient">
        <span class="patient-name">Nome</span>
        <span class="patient-sit">Situação</span>
      </li>
      @foreach($servedPatients as $patient)
      <li class="patient">
        <span class="patient-name">{{$patient->nome}}</span>
        <span class="patient-sit">Situação</span>
      </li>
      @endforeach
    </ol>
  </div>

</section>

</x-main>
<x-footer></x-footer>
