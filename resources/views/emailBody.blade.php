<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirme seu e-mail</title>
</head>
<body>


    <p>Olá {{ $usuario->nome ?? 'Usuário' }},</p>

    <p>Você solicitou a redefinição de senha. Clique no link abaixo para abrir a página segura de redefinição:</p>

    <p>
        <a href="{{ $url }}" target="_blank">Redefinir minha senha</a>
    </p>

    <p>Este link expira em 1 hora.</p>


    

</body>
</html>