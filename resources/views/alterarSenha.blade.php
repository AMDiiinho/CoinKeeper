<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redefinição de senha</title>
    @vite('resources/css/alterar-senha.css')

</head>

    
<body>
    
    <div class="senha-container">
        <div class="senha-form">


            <div class="container-header">
                <p class="form-header">Digite sua nova senha!<p>
            </div>
            
            @if(!empty($codigo))
            <form action="{{ route('redefinirSenha', $codigo->codigo) }}" method="POST">

                @csrf

                <div class="form-elements">

                    @if(session('success'))
                        <div class="sucesso">{{ session('success') }}</div>
                        <script>
                            setTimeout(() => {
                                window.location.href = "{{ session('redirect') }}";
                            }, 2500);
                        </script>
                    @endif

                    @error('novaSenha')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                    <label for="novaSenha">Nova senha</label>
                    <x-input type="password" name="novaSenha" placeholder="Digite sua nova senha"/>

                    <label for="novaSenha">Confirme sua senha</label>
                    <x-input type="password" name="novaSenha_confirmation" placeholder="Digite sua nova senha novamente"/>
                    

                    <button>Redefinir</button>
                </div>

                
            </form>
        
            @else

                Código de redefinição de senha expirado ou inválido

            @endif
        </div>
    </div>
    
    
    
</body>
    
</html>