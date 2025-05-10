<x-header titulo='Cadastro'></x-header>
<section class="container">
    <h2>Formulário de cadastro de paciente - {{$clinica->nome_empresa}}</h2>
    <form action="{{ route('paciente.store')}}" 
        method="post">
        @csrf
        <label>Insera seu nome: 
            <input class="" 
                type="text" 
                name="nome"
                required
                autofocus
            >
            <input type="submit">
        </label>
    </form>
</section>
