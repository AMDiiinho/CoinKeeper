<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esqueci minha senha</title>

</head>
<body>

    <h3>Para redefinir sua senha, informe seu e-mail</h3>

    <form action="/esqueciMinhaSenha" method="POST">

        @csrf
        <label for="email"></label>
        <x-input type="text" name="email" placeholder="Digite um e-mail válido"/>

        <button>Enviar</button>
    </form>

</body>
</html>