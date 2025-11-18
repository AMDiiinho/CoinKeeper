<DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Usuários</title>

    <style>
        .tabela-usuarios {
            width: 60%;
            margin: 20px auto;     
            border-collapse: collapse; 
            font-family: Arial, sans-serif;
            text-align: left;
        }

        .tabela-usuarios th,
        .tabela-usuarios td {
            padding: 10px;       
            border: 1px solid #aaa; 
        }

        .tabela-usuarios th {
            background-color: #eee;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Lista de usuários cadastrados</h1>


    <table class="tabela-usuarios">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>E-mail</th>
            <tr>
        </thead>
        <tbody>
            
            @foreach($usuarios as $usuario)
                <tr>
                
                    <td>{{ $usuario->id }} </td> 
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->dataNasc }}</td>
                    <td>{{ $usuario->email }} </td>
                    
                </tr>         
            @endforeach 
        </tbody>
    </table>
</body>
