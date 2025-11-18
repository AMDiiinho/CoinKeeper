<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<style>

    .erroMensagem{
        color: red;
        font-weight: bold;
    }

</style>
</head>

<body>


    <form action="/resultadoFiltragem" method="POST">

            @csrf

            <h2>Procurar usuário</h2>

            @if ($errors->any())
                @foreach ($errors->all() as $erro)
                    <label class="erroMensagem">
                        {{ $erro }} <br>
                    </label>
                @endforeach
            @endif

            <br>


            <label>Nome</label> <br>
            <input type="text" placeholder="Digite o nome do usuário" name="nome"></input> <br><br>

            <label>Data de nascimento</label><br>
            <input type="date" placeholder="Selecione a data de nascimento do usuário" name="dataNasc"></input> <br><br>

            <label>E-mail</label><br>
            <input type="email" placeholder="Digite o email do usuário" name ="email"></input> <br><br>

            <button>Procurar</button>


    </form>
</body> 