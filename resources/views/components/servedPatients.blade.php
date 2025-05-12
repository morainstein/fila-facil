
<div class="patients-section">
  <h3>Atendidos:</h3>
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
