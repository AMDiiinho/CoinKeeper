<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">


    <style>
    
    .menu-bar {
        list-style-type: none;
        margin: 5px;
        padding: 5px;
        display: flex;
        align-items: center;
        border: 1px solid #e7e7e7;
        background-color: #f1f1f1;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.25)

    }

    .menu-bar li a {
        display: block;
        border-radius: 5px;
        color: #111111;
        padding: 14px 16px;
        text-decoration: none;
        font-family: 'Roboto', sans-serif;
    }

    .menu-bar li a:hover {
        background-color: #45d16a;
        
    }

    .menu-bar .right {
        margin-left: auto;
        padding-right: 3px;
    }

    .login-container {
        display: flex;
        justify-content: flex-end;     /* alinha à direita */
        align-items: center;           /* alinha verticalmente */
        min-height: 89vh;             /* ocupa toda a altura da tela */ 
        padding-right: 70px;         /* espaçamento da borda direita */
        box-sizing: border-box;
    }

    .login-form {
        display: flex;
        flex-direction: column;   /* empilha os inputs */
        background-color: #f1f1f1;
        width: 350px;
        min-height: 260px;
        padding: 10px;
        padding-top: 35px;
        margin-right: 40px;    
        border-radius: 6px; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.25);
    }

    .login-form button {
        margin-top: 12px;
        padding: 9px 20px;
        background-color: white;
        border: 1px solid #797979ff;
        border-radius: 4px;
        color: black;
        font-weight: bold;
        cursor: pointer;
        margin-left: 230px;
        transition: all 0.3s ease-in-out;
    }

    .login-form button:hover{
        border: 1px solid #45d16a;  
        background-color: #45d16a;
        color: white;
    }


    input {
        width: 250px; 
        margin-left: 40px;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #797979ff;
        border-radius: 4px;
    }
    
    input::placeholder {
        font-family: 'Roboto', 'Sans-Serif';
    }

    label {
        margin-left: 40px;
        font-size: 14px;
    }

    body {
        background-color: #bdc3c7;
        font-family: 'Roboto', sans-serif;
    }   

    .cadastro-link {
        margin-top: 25px;
        margin-bottom: 30px;
        text-align: center;    /* centraliza dentro do card */
    }

    .cadastro-link a {
        font-size: 14px;
        color: #111;
        text-decoration-line: underline;
    }

    .cadastro-link a:hover {
        color: #45d16a;
        font-weight: bold;
    }

    .erro {
        font-size: 13px;
        padding-bottom: 10px;
        padding-left: 40px;
        color: red; 
    }

    .erro-senha {
        font-size: 13px;
        padding-left: 40px;
        color: red; 
    }

    .erro-campo{
        border: 1px solid red;
        background-color: #ffe6e6;
    }

    </style>
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

