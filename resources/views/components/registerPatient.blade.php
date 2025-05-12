<form class="dashboard-sections caixa register-patient" 
action="{{ route('clinica.storePatient')}}" 
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
