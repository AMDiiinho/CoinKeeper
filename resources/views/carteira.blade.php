<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minha Carteira</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/modal_cartao.js'])
    @vite('resources/css/carteira.css')
    @font-face {
        font-family: 'Impact';
        src: url('caminho/para/a/fonte/impact.woff') format('woff');
    }
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">


    @if(session('editar_cartao_id'))
        <meta name="editar-cartao-id" content="{{ session('editar_cartao_id') }}">
    @endif
</head>

<body>
 
    <x-menu-topo topoInfo="Minha Carteira"/>
    
    <x-menu-lateral/>

    <div class="container-principal">
        

        <div class="header-carteira">
            <h1>Meus Cartões</h1>
            <button id="abreModal" class="bt-add-cartao"><i class="fas fa-plus"></i></button>
            
        </div>

        
        <div class="lista-cartoes">

        
            @if ($cartoes->isEmpty())
                <span class="texto-cartoes">Você ainda não possui cartoes. Clique no botão "+" acima para registrar um.</span>
            @else
                <ul class="cartoes-usuario">
                    @foreach($cartoes as $cartao)
                        <li class="card-cartao">

                            <div class="logo-info-cartao">
                                <x-logo-banco :banco="$cartao->banco"/>

                                <div class="info-cartao">
                                    <div class="cartao-nome-tipo">
                                        <strong>{{ $cartao->nome }}</strong>
                                        <span class="tipo-cartao">
                                            ({{ $tipos[$cartao->tipo] ?? 'Carteira' }})
                                        </span>
                                    </div>

                                    @if($cartao->tipo === 'credito')
                                        <div class="cartao-limite">
                                            <i class="fas fa-credit-card"></i>
                                            Limite disponível: <span class="valor-limite">R$ {{ number_format($cartao->limite, 2, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    <div class="cartao-saldo">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Saldo atual: <span class="valor-saldo">R$ {{ number_format($cartao->saldo, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="acoes-cartao">

                                    <button type="button" class="icone-cartao-caneta"
                                        data-id="{{ $cartao->id }}"
                                        data-nome="{{ $cartao->nome }}"
                                        data-banco="{{ $cartao->banco }}"
                                        data-tipo="{{ $cartao->tipo }}"
                                        data-limite="{{ $cartao->limite }}"
                                        data-saldo="{{ $cartao->saldo }}"
                                        data-fechamento="{{ $cartao->dia_fechamento }}"
                                        data-vencimento="{{ $cartao->dia_vencimento }}">
                                        
                                        <i class="fas fa-pen"></i>  
                                    </button>

                                <form action="{{ route('excluiCartao', $cartao -> id) }}" 
                                    class="form-exclui-cartao" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="button" class="icone-cartao-lixeira">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            
        </div> 
        
        @if(session('sucesso'))
            <meta name="alerta-sucesso" content="{{ session('sucesso') }}">
        @endif

    </div>

    <div id="modalCreate" class="modal-container" style="display: none;" data-show-error="{{ $errors->create->any() ? 'true' : 'false' }}">
        <div class="modal-card-cartao">
            <div class="topo-card-cartao">
                <span class="bt-fechar fechar-modal" data-target="#modalCreate">&times;</span>
                <h2>Novo Cartão</h2>
            </div>

            <form action="{{ route('dadosCartao') }}" method="POST" class="form-cartao">
                @csrf
                
                <label>Nome</label>
                <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Apelido do cartão">
                @error('nome', 'create') <div class="erro">{{ $message }}</div> @enderror

                <label>Banco</label>
                <select name="banco" id="createBanco">
                    <option value="">Selecione...</option>
                    @foreach($bancos as $valor => $label)
                        <option value="{{ $valor }}" {{ old('banco') == $valor ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('banco', 'create') <div class="erro">{{ $message }}</div> @enderror

                <div id="divTipoCreate">
                    <label>Tipo</label>
                    <select name="tipo" id="createTipo">
                        <option value="">Selecione...</option>
                        @foreach ($tipos as $tipo => $label)
                            <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('tipo', 'create') <div class="erro">{{ $message }}</div> @enderror
                </div>

                <div id="camposCreditoCreate" style="display: none;">
                    <label>Limite</label>
                    <input type="text" name="limite" value="{{ old('limite') }}">
                    @error('limite', 'create') <small class="erro">{{ $message }}</small> @enderror

                    <label>Fechamento</label>
                    <input type="number" name="dia_fechamento" value="{{ old('dia_fechamento') }}">
                    @error('dia_fechamento', 'create') <small class="erro">{{ $message }}</small> @enderror

                    <label>Vencimento</label>
                    <input type="number" name="dia_vencimento" value="{{ old('dia_vencimento') }}">
                    @error('dia_vencimento', 'create') <small class="erro">{{ $message }}</small> @enderror
                </div>

                <label>Saldo Inicial</label>
                <input type="text" name="saldo" value="{{ old('saldo') }}">
                @error('saldo', 'create') <small class="erro">{{ $message }}</small> @enderror

                <button type="submit">Criar Cartão</button>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="modal-container" style="display: none;" data-show-error="{{ $errors->edit->any() ? 'true' : 'false' }}"
    data-edit-id="{{ session('editar_cartao_id') }}">
        <div class="modal-card-cartao">
            <div class="topo-card-cartao">
                <span class="bt-fechar fechar-modal" data-target="#modalEdit">&times;</span>
                <h2>Editar Cartão</h2>
            </div>

            <form id="formEdit" method="POST" class="form-cartao">
                @csrf
                @method('PATCH')
                
                <label>Nome</label>
                <input type="text" name="nome" id="editNome" value="{{ old('nome') }}">
                @error('nome', 'edit') <div class="erro">{{ $message }}</div> @enderror

                <label>Banco</label>
                <input type="text" id="editBancoVisual" disabled style="background: #eee;">
                
                <label>Tipo</label>
                <input type="text" id="editTipoVisual" disabled style="background: #eee;">

                <div id="camposCreditoEdit" style="display: none;">
                    <label>Limite</label>
                    <input type="text" name="limite" id="editLimite" value="{{ old('limite') }}">
                    @error('limite', 'edit') <small class="erro">{{ $message }}</small> @enderror

                    <label>Dia Fechamento</label>
                    <input type="number" name="dia_fechamento" id="editFechamento" value="{{ old('dia_fechamento') }}">
                    @error('dia_fechamento', 'edit') <small class="erro">{{ $message }}</small> @enderror

                    <label>Dia Vencimento</label>
                    <input type="number" name="dia_vencimento" id="editVencimento" value="{{ old('dia_vencimento') }}">
                    @error('dia_vencimento', 'edit') <small class="erro">{{ $message }}</small> @enderror
                </div>

                <label>Saldo Atual</label>
                <input type="text" id="editSaldoVisual" disabled style="background: #eee;">

                <button type="submit">Atualizar Cartão</button>
            </form>
        </div>
    </div>

    <script>
        @if($errors->create->any())
            modalCreate.style.display = 'block';
            // Disparar change events se necessário para reexibir campos ocultos baseado no old()
            // (Exemplo simplificado, pode precisar refinar para manter selects abertos)
            if("{{ old('banco') }}" !== 'carteira') divTipoCreate.style.display = 'block';
            if("{{ old('tipo') }}" === 'credito') camposCreditoCreate.style.display = 'block';
        @endif

        @if($errors->edit->any())
            modalEdit.style.display = 'block';
            // Precisamos re-popular o action do form caso falhe, 
            // ou usar a sessão 'editar_cartao_id' como você já fazia.
            // Recomendo passar o ID na sessão flash para re-montar a URL
        @endif
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/js/alertas.js')

</body>


