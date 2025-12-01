<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minhas contas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <h1>Saldo total: R$ 12,92</h1>
        </div>

        
        <div class="lista-contas">
            <button class="bt-add-conta">+ Adicionar Conta</button>
            <span class="texto-contas">Você ainda não possui contas. Clique no botão abaixo para registrar uma.</span>
        </div>
    </div>
    
    @vite('resources/js/menu_lateral.js')

</body>


