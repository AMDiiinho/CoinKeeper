<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minhas contas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/modal_contas.js'])
    @vite('resources/css/contas.css')
    @font-face {
        font-family: 'Impact';
        src: url('caminho/para/a/fonte/impact.woff') format('woff');
    }
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">


</head>

<body>
 
    <header class="topo-menu-lateral"><h1>CoinKeeper</h1><h1>Bem-vindo, {{ Auth::user()->nome }}!</h1></header>
    
    <div class="menu-lateral">   
        <nav>
            <ul>
                <p>Menu Principal</p>

                <li>
                    <a href="/dashboard"
                        class="bt-menu-lateral">
                        Dashboard <i class="fas fa-chart-bar icone-dashboard"></i>
                    </a>
                </li>

                <li class="secao {{ Request::is('contas*') ? 'ativa' : '' }}">
                    <a href="#" class="bt-menu-lateral">Financeiro<i class="fas fa-chevron-down menu-seta"></i></a>
                    <ul class="submenu">
                        <li><a href="/contas" class="{{ Request::is('contas') ? 'active' : '' }}">Contas</a></li>
                        <li><a href="#">Transações</a></li>
                        <li><a href="#">Extrato</a></li>
                        <li><a href="#">Receitas</a></li>
                        <li><a href="#">Despesas</a></li>
                    </ul>
                </li>
                <li class="secao">
                    <a href="#" class="bt-menu-lateral">Sistema<i class="fas fa-chevron-down menu-seta"></i></a>
                    <ul class="submenu">
                        <li><a href="#">Configurações</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
    
    <div class="container-principal">
        

        <div class="header-contas">
            <h1>Minhas Contas</h1>
            <button id="abreModal" class="bt-add-conta"><i class="fas fa-plus"></i></button>
            @livewire('saldo-total-contas')
            
        </div>

        

        <div class="lista-contas">

        
            @if ($contas->isEmpty())
                <span class="texto-contas">Você ainda não possui contas. Clique no botão acima para registrar uma.</span>
            @else
                <ul class="contas-usuario">
                    @foreach($contas as $conta)
                        <div class="card-conta">
                            <div class="info-conta">
                                <strong> {{ $bancos[$conta->banco] ?? $conta->banco }} </strong><br>
                                Saldo: R$ {{ number_format($conta->saldo, 2, ',', '.') }}
                            </div>

                            <form action="{{ route('excluiConta', $conta -> id) }}" class="form-exclui-conta" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="icone-conta-lixeira">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                                    
                        </div>
                    @endforeach
                </ul>
            @endif
            
        </div>
        @if(session('sucesso'))
            <meta name="alerta-sucesso" content="{{ session('sucesso') }}">
        @endif

    </div>

    <div id="modalContainer" class="modal-container">
        
        

        <div class="modal-card-contas">   

            <div class="topo-card-contas">
                <span class="bt-fechar" id="fechar">&times;</span>
                <h2>Nova conta</h2>
            </div> 

            <form action= {{ route ('dadosConta') }} class="form-contas" method="POST">
                @csrf

                <label>Banco</label><br>
                <select placeholder="Selecione a bandeira" name="banco">
                    @foreach($bancos as $valor => $label)
                        <option value="{{ $valor }}" {{ old('banco') == $valor ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach

                </select>
                @error('banco')
                    <div class="erro">{{ $message }}</div>
                @enderror

                <label>Saldo</label><br>
                <input type="text" placeholder="Digite o saldo atual do banco" name="saldo">
                @error('saldo')
                    <small class="erro">{{ $message }}</small>
                @enderror

                <button type="submit">Salvar conta</button>
            </form>
        </div>
    </div>
    
    @vite('resources/js/menu_lateral.js')

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


