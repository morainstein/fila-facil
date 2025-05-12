<x-header titulo='Cadastro'></x-header>
<x-main>

<section class="clinica">
    <form class="caixa" style="gap: 5px;" action="/clinica/create" method="post">
        @csrf
        <h2 class="caixa-tittle text-center">CADASTRO</h2>
        <img src="{{ Vite::asset('resources/assets/logo_nome-transparente.png') }}"
        style="width: 50%;">
    
        <label>Nome da empresa:
          <input class="inputs" type="text" name="nome">
        </label>

        <label>Email da empresa:
          <input class="inputs" type="email" name="email">
        </label>

        <label>CNPJ:
          <input class="inputs" type="text" name="cnpj">
        </label>

        <label>Senha:
          <input class="inputs" type="password" name="senha">
        </label>
        <input class="buttons" type="submit" value="CADASTRAR">
    </form>
    <div class="ask-for-register">
        <span>Já possui cadastro?</span>
        <a class="buttons" href="{{ route('clinica.login') }}">Fazer login</a>
    </div>
</section>

</x-main>
<x-footer></x-footer>