<x-header titulo='Dashboard'></x-header>
<x-main>

<section class="show-patients" id="dashboard">

  <div class="caixa patients-unserved">
    <div class="showed-patients" id="patients-tittle">
      <span>Ord</span>
      <span>PRÓXIMO:</span>
      <span>PRIORIDADE:</span>
    </div>
    @php $i = 1; @endphp
    @foreach($unservedPacientes as $paciente)
    <div class="showed-patients">
      <span>{{ $i++ }}</span>
      <span>{{$paciente->nome}}</span>
      <span>idoso</span>
    </div>
    @endforeach
  </div>

  <div class="caixa patients-served">
    <div id="patients-tittle">Atendidos</div>
    @foreach($servedPacientes as $paciente)
    <div class="showed-patients">
      <span>{{$paciente->nome}}</span>
    </div>
    @endforeach
  </div>

</section>

</x-main>
<x-footer></x-footer>