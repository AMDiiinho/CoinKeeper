<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redefinição de senha</title>

</head>
<body>

    <h3>Digite sua nova senha!</h3>

    @if(!empty($codigo))
        <form action="{{ route('redefinirSenha', $codigo->codigo) }}" method="POST">

            @csrf
            <label for="novaSenha">Nova senha</label>
            <x-input type="text" name="novaSenha" placeholder="Digite sua nova senha"/>

            <button>Redefinir</button>
        </form>
    @else

        Código de redefinição de senha expirado ou inválido

    @endif

</body>
</html>