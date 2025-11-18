<h1>Editar Usuário</h1>

<form action="{{ route('salvarAlteracao', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nome</label><br>
    <input type="text" name="nome" value="{{ old('nome', $usuario->nome) }}"><br><br>

    <label>Data de Nascimento</label><br>
    <input type="date" name="dataNasc" value="{{ old('dataNasc', $usuario->dataNasc) }}"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email', $usuario->email) }}"><br><br>

    <button type="submit">Salvar Alterações</button>
</form>