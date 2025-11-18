<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Filtragem de Usuários</title>

    <style>
        .tabela-resultados {
            width: 60%;
            margin: 20px auto;     
            border-collapse: collapse; 
            font-family: Arial, sans-serif;
            text-align: left;
        }

        .tabela-resultados th,
        .tabela-resultados td {
            padding: 10px;       
            border: 1px solid #aaa; 
        }

        .tabela-resultados th {
            background-color: #eee;
            font-weight: bold;
        }
    </style>
</head>

<body>
<h2>Resultados da Filtragem</h2>

<table class="tabela-resultados">
    
    @if($resultados->isEmpty())
        <h3>Nenhum resultado encontrado.</h3>
    @else
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($resultados as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->dataNasc }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <a href="{{ route('editar', $item->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('deletar', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                            Excluir
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
    @endif
</table>
</body>