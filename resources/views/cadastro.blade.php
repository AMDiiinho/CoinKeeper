<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite('resources/css/cadastro.css')

</head>

<body>
 
    @include('partials.menuBar')

    <div class='conteudo'>
        <div class="cadastro-container">
            <div class = "cadastro-form">
                <form action="{{ route('dadosCadastro') }}" method="POST">

                    @csrf   
                    <div class="container-header">
                        <p class="form-header">Preencha o formulário e realize seu cadastro:<p>
                    </div>

                    <div class="form-elements">
 
                        <label>Nome Completo:</label><br>
                        <x-input type="text" placeholder="Digite seu nome" name="nome"/><br>

                        <label>Data de Nascimento:</label><br>
                        <x-input class="dataNasc" type="date" name="dataNasc"/><br>

                        <label>Telefone:</label><br>
                        <div class="dddetelefone">
                            <x-input class="ddd" type="text" placeholder="DDD" name="ddd"/>
                            <x-input class="telefone" type="text" placeholder="Digite seu telefone" name="telefone"/>
                        </div><br>

                        <label>E-mail:</label><br>
                        <x-input type="email" placeholder="Digite seu e-mail" name="email"/><br>

                        <label>Senha:</label><br>
                        <x-input type="password" placeholder="Digite sua senha" name="senha"/><br>

                        <label>Confirme sua senha:</label><br>
                        <x-input type="password" placeholder="Confirme sua senha" name="senha_confirmation"/><br>

                        @error('senha')
                            <div class="erro">As senhas não coincidem.</div>
                        @enderror


                        <button>Cadastrar-se</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

