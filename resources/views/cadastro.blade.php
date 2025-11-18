<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>

    <style>

        body{
            background-color: #fafce6;
        }     

        label{
            font-size: 14px;
            font-family: Arial, sans-serif;
            margin-left: 490px;
        }

        .titulo{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px 0;
            color: #00539f;
            text-align: center;
        }

        .erroMensagem {
            font-family: Arial, sans-serif;
            color: red;
            font-weight: bold;
        }

        .input {
            width: 180px;
            padding: 5px;
            margin-bottom: 10px;
            margin-left: 490px;
        }

        .botao{
            border-radius: 3px;
            margin-left: 490px;
            background-color: #0040ff;
            color: #ffff;
            padding: 8px;
            font-weight: bold;
            border: none;
        }

    </style>

</head>
<body>
    

    <h1 class="titulo">Preencha o formulário e cadastre-se</h1>
    <form action="/dadosUsuario" method="POST">
        @csrf

        @if($errors->any())
            @foreach ($errors->all() as $erro)
                <label class="erroMensagem">{{ $erro }}</label><br>                
            @endforeach
        @endif
        
        <br>
        
        <label>Nome</label><br>
        <input class="input" type="text" placeholder="Digite seu nome" name="nome"><br>
        
        <label>Data de Nascimento</label><br>
        <input class="input" type="date" name="dataNasc"><br>

        <label>E-mail</label><br>
        <input class="input" type="email" placeholder="Digite seu e-mail" name="email"><br>
        <button class="botao">Cadastrar</button>
    </form>

</body>

