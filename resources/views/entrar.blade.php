<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/entrar.css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">


</head>

<body>
 
    <ul class="menu-bar">
        <li><a href="/home">Home</a></li>
        <li><a href="/sobre">Sobre Nós</a></li>
        <li><a href="/servicos">Serviços</a></li>
        <li><a href="/contato">Contato</a></li>
        <li class="right"><a href="/entrar">Entrar</a></li>
    </ul>


    <div class="login-container">
        <div class = "login-form">
            <form action="{{ route ('dadosLogin') }}" method="POST">

                @csrf

                @if ($errors->has('login'))
                    <div class="erro">
                        {!! $errors->first('login') !!}
                    </div>
                @endif
                
                <label>E-mail</label><br>
                <input type="text" placeholder="Digite seu e-mail" name="email"></input><br>


                <label>Senha</label><br>
                <input type="password" placeholder="Digite sua senha" name="password"></input><br>


                <button>Entrar</button>

            </form>
            <div class="cadastro-link">
                    <a href="/cadastro">Cadastre-se agora!</a>
            </div>
        </div>
    </div>


</body>

