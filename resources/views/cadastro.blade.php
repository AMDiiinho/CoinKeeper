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
            margin: 0;
            padding: 5px;
            display: flex;
            align-items: center;
            border: 1px solid #e7e7e7;
            background-color: #f1f1f1;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.25);
    }

        

    .menu-bar li a {
        display: block; 
        border-radius: 5px;
        color: #111111;
        padding: 14px 16px;
        text-decoration: none;
        font-family: 'Roboto', sans-serif;
        transition: all 0.3s ease-in-out
    }

    .menu-bar li a:hover {
        background-color: #45d16a;
        
    }

    .menu-bar .right {
        margin-left: auto;
        padding-right: 3px;
    }
    
    .cadastro-container {
        display: flex;
        justify-content: flex-end;     /* alinha à direita */
        align-items: center;           /* alinha verticalmente */
        min-height: 89vh;             /* ocupa toda a altura da tela */
        margin-top: 30px;
        padding-right: 70px;
        box-sizing: border-box;
}

    .cadastro-form {
        display: flex;
        flex-direction: column;   /* empilha os inputs */
        background-color: #f1f1f1;
        width: 350px;
        height: 630px;
        margin: 10px 40px 10px 10px;
        padding: 20px;
        transform: scale(0.9); /* diminui o tamanho geral */
        transform-origin: top center; /* mantém alinhado ao topo */  
        border-radius: 6px; 
        font-family: 'Roboto', 'Sans-Serif';
        box-shadow: 0 2px 5px rgba(0,0,0,0.25);
    }

    .cadastro-form button {
        margin-top: 12px;
        padding: 9px 20px;
        background-color: white;
        border: 1px solid #797979ff;
        border-radius: 4px;
        color: black;
        cursor: pointer;
        margin-left: 193px;
        transition: all 0.3s ease-in-out;
    }

    .cadastro-form button:hover{
        border: 1px solid #45d16a;  
        background-color: #45d16a;
        color: white;
    }


    input {
        width: 250px;
        margin: 3px 0 0 40px;
        padding: 10px;
        border: 1px solid #797979ff;
        border-radius: 4px;
    }

    .dataNasc{
        font-family: 'Roboto', 'Sans-Serif';
        font-size: 13px;
        color: #797979ff;
    }

    .ddd {
        width: 50px;
    }

    .dddetelefone {
        display: flex;
        flex-direction: row;
        margin-left: 40px; /* mantém alinhado com os outros campos */
        gap: 5px;   
    }

    .dddetelefone input {
        margin-left: 0;
    }

    .dddetelefone .ddd {
        width: 50px;
    }

    .dddetelefone .telefone {
        width: 173px;
    }

    label { 
        margin-left: 40px;
        font-size: 14px;
    }

    .form-titulo {
        font-size: 18px;
        line-height: 1.2;
        margin: 10px;
        font-weight: normal;
    }

    body {
        background-color: #bdc3c7;

    }       

    .erro-campo {
        border: 2px solid #f26d55;
    }

    .erro {
        font-size: 12px;
        color: red;
        margin-left: 40px;
    }

    </style>

</head>

<body>
 
    @include('partials.menuBar')


    <div class="cadastro-container">
        <div class = "cadastro-form">
            <form action="{{ route('dadosCadastro') }}" method="POST">

                @csrf   
                <p class=form-titulo>Preencha o formulário e realize seu cadastro:</p><br>

                
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

            </form>
        </div>
    </div>


</body>

