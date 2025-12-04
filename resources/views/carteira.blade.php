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


</head>

<body>
 
    <header class="topo-menu-lateral"><h1>CoinKeeper</h1>
        <div class="info-topo">
            <h1>Minha Carteira</h1>
        </div>
    </header>
    
    <div class="menu-lateral">   
        <nav>
            <ul>
                <p>Menu Principal</p>

                <li><a href="/dashboard"class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar icone-dashboard"></i>Dashboard</a></li>
                <li><a href="/carteira" class="{{ Request::is('carteira') ? 'active' : '' }}">Minha Carteira</a></li>
                <li><a href="#">Transações</a></li>
                <li><a href="#">Extrato</a></li>
                <li><a href="#">Receitas</a></li>
                <li><a href="#">Despesas</a></li>
                <li><a href="#">Configurações</a></li>
                
            </ul>
        </nav>
    </div>
    
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
                                            {{ $cartao->tipo_label }}
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
                <h2 id="modalTitulo">Novo Cartão</h2>
            </div> 

            <form id="formCartao" action="{{ route ('dadosCartao') }}" class="form-cartao" method="POST">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @csrf

                <input type="hidden" name="_method" id="formMethod" value="POST">

                <label>Nome</label><br>
                <input type="text" id="campoNome" placeholder="Digite um apelido para o cartão" name="nome">
                
                <label>Banco</label><br>
                <select name="banco" id="campoBanco">
                    @foreach($bancos as $valor => $label)
                        <option value="{{ $valor }}" {{ old('banco') == $valor ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach

                </select>
                @error('banco')
                    <div class="erro">{{ $message }}</div>
                @enderror

                <label>Tipo do cartão</label>
                <select name="tipo" id="tipoCartao">
                    @foreach ($tipos as $tipo => $label)
                        
                        <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('tipo')
                    <div class="erro">{{ $message }}</div>
                @enderror
                
                <div id="limiteCartao" style="display:none;">

                    <label>Limite</label><br>
                    <input type="text" id="campoLimite" placeholder="Digite o limite do cartão" name="limite">

                    <label>Fechamento</label><br>
                    <input type="number" id="campoFechamento" placeholder="Informe a data de fechamento da fatura" name="fechamento">

                    <label>Vencimento</label><br>
                    <input type="number" id="campoVencimento" placeholder="Informe a data de vencimento" name="vencimento">

                </div>

                    
                <label>Saldo</label><br>
                <input type="text" id="campoSaldo" placeholder="Informe o saldo do cartão" value="{{ $cartao->saldo ?? '' }}" name="saldo">
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectTipo = document.getElementById('tipoCartao');
            const limiteField = document.getElementById('limiteCartao');

            function toggleLimite() {
                if (selectTipo.value === 'credito') {
                    limiteField.style.display = 'block';
                } else {
                    limiteField.style.display = 'none';
                }
            }

            // Executa ao carregar a página (para manter estado em caso de old input)
            toggleLimite();

            // Executa sempre que o usuário mudar o select
            selectTipo.addEventListener('change', toggleLimite);
        });
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/js/alertas.js')

</body>


