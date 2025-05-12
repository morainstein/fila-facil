<x-header titulo='Login'></x-header>
<x-main>
    
<section class="clinica">
    <form class="caixa" action="/clinica/login" method="post">
        @csrf
        <h2 class="caixa-tittle text-center">LOGIN</h2>
        <img src="{{ Vite::asset('resources/assets/logo_nome-transparente.png') }}">
        <label>Email da clinica:
            <input class="inputs" type="email" name="email">
        </label>
        <label>Senha:
            <input class="inputs" type="password" name="senha">
        </label>
        <input class="buttons" type="submit" value="LOGIN">
    </form>
    <div class="ask-for-register">
        <span>Não possui cadastro?</span>
        <a class="buttons" href="{{ route('clinica.create') }}">Se cadastrar</a>
    </div>
</section>

</x-main>
<x-footer></x-footer>