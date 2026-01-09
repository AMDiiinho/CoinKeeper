<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esqueci minha senha</title>
    @vite('resources/css/esqueci-minha-senha.css')

</head>
<body>

    

    <div class="email-container">
        <div class="email-form">
            <form action="/esqueciMinhaSenha" method="POST">

                @csrf

                <div class="form-elements">

                    <label for="email">Seu e-mail de recuperação</label>
                    <x-input type="text" name="email" placeholder="Digite um e-mail válido"/>

                    <button class="botao-envio">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container-header">
        <p class="form-header">Para redefinir sua senha, informe seu e-mail<p>
    </div>
    
</body>
</html>