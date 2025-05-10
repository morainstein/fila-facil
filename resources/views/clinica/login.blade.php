<x-header titulo='Login'></x-header>
<x-main>
    
<section id="login-clinica">
    <form class="caixa" action="/clinica/login" method="post">
        <h2 class="caixa-tittle text-center">LOGIN DA CLINCA</h2>
    @csrf
        <img src="{{ Vite::asset('resources/assets/logo_nome-transparente.png') }}">
        <label>Email da clinica:
            <input class="inputs" type="email" name="email">
        </label>
        <label>Senha:
            <input class="inputs" type="password" name="senha">
        </label>
        <input class="buttons" type="submit" value="LOGIN">
    </form>

</section>

</x-main>
<x-footer></x-footer>