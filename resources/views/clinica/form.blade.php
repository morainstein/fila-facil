<x-header titulo='Cadastro'></x-header>
<x-main>

  <section class="container">
    <form class="row" action="/clinica/create" method="post">
    @csrf
    
    <label class="form-label">Nome da Clinica:
      <input class="form-control" type="text" name="nome">
    </label>
    
    <label class="form-label">Email da clinica:
      <input class="form-control" type="email" name="email">
    </label>
    
    <label class="form-label">CNPJ:
      <input class="form-control" type="text" name="cnpj">
    </label>
    
    <label class="form-label">Senha:
      <input class="form-control" type="password" name="senha">
    </label>
    <button class="btn btn-primary">Cadastrar</button>
  </form>
</section>

</x-main>
<x-footer></x-footer>