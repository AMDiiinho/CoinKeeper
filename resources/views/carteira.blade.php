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
                                <form action="{{ route('atualizaCartao', $cartao -> id) }}"
                                    class="form-atualiza-cartao" method="POST">
                                    @csrf
                                    @method('UPDATE')
                                    
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
                                </form>

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

    <div id="modalContainer" class="modal-container">
        <div class="modal-card-cartao">   
            <div class="topo-card-cartao">
                <span class="bt-fechar" id="fechar">&times;</span>
                <h2 id="modalTitulo">{{ session('editar_cartao_id') ? 'Editar Cartão' : 'Novo Cartão' }}</h2>
            </div> 

            <form id="formCartao"
                action="{{ session('editar_cartao_id') ? route('atualizaCartao', session('editar_cartao_id')) : route('dadosCartao') }}"
                class="form-cartao"
                method="POST"
                data-modo="{{ session('editar_cartao_id') ? 'edit' : 'create' }}">

                @csrf
                <input type="hidden" name="_method" id="formMethod" value="{{ session('editar_cartao_id') ? 'PATCH' : 'POST' }}">

                <!-- Nome -->
                <label>Nome</label><br>
                <input type="text" id="campoNome" placeholder="Digite um apelido para o cartão" name="nome">
                @error('nome')
                    <div class="erro">{{ $message }}</div>
                @enderror
                    
                <!-- Banco -->
                <label>Banco</label><br>
                <select name="banco" id="campoBanco">
                    @foreach($bancos as $valor => $label)
                        <option value="{{ $valor }}" {{ old('banco') == $valor ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('banco')
                    <div class="erro">{{ $message }}</div>
                @enderror

                <!-- Tipo -->
                <label>Tipo do cartão</label>
                @if(session('editar_cartao_id'))
                    <select id="tipoCartao" disabled>
                        @foreach ($tipos as $tipo => $label)
                            <option value="{{ $tipo }}" {{ $cartao->tipo == $tipo ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="tipo" value="{{ $cartao->tipo }}">
                @else
                    <select name="tipo" id="tipoCartao">
                        <option value="">-- selecione --</option>
                        @foreach ($tipos as $tipo => $label)
                            <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                @endif
        
                    
                <!-- Campos de crédito -->
                <div id="limiteCartao">
                    <label>Limite</label><br>
                    <input type="text" id="campoLimite" placeholder="Digite o limite do cartão" name="limite">
                    @error('limite')
                        <small class="erro">{{ $message }}</small>
                    @enderror

                    <label>Fechamento</label><br>
                    <input type="number" id="campoFechamento" placeholder="Informe a data de fechamento da fatura" name="fechamento">
                    @error('fechamento')
                        <small class="erro">{{ $message }}</small>
                    @enderror

                    <label>Vencimento</label><br>
                    <input type="number" id="campoVencimento" placeholder="Informe a data de vencimento" name="vencimento">
                    @error('vencimento')
                        <small class="erro">{{ $message }}</small>
                    @enderror
                </div>
                        
                <!-- Saldo -->
                <label>Saldo</label><br>
                <input type="text" id="campoSaldo" placeholder="Informe o saldo do cartão" name="saldo">
                @error('saldo')
                    <small class="erro">{{ $message }}</small>
                @enderror

                <button type="submit">Salvar Cartão</button>
            </form>
        </div>
    </div>


    @if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("modalContainer").style.display = "block";
        });
    </script>
    @endif


    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/js/alertas.js')

</body>


