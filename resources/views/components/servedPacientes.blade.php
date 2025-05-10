
<div class="patients-section">
  <h3>Atendidos:</h3>
  <ol class="list-patients">
    <li class="patient">
      <span class="patient-name">Nome</span>
      <span class="patient-sit">Situação</span>
    </li>

    @foreach($servedPacientes as $paciente)
    <li class="patient">
      <span class="patient-name">{{$paciente->nome}}</span>
      <span class="patient-sit">Situação</span>
    </li>
    @endforeach

  </ol>
</div>
