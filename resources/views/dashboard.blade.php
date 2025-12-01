<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/dashboard.css')
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
                    class="bt-menu-lateral {{ Request::is('dashboard') ? 'active' : '' }}">
                    Dashboard <i class="fas fa-chart-bar icone-dashboard"></i>
                    </a>
                </li>

                <li class="secao">
                    <a href="#" class="bt-menu-lateral">Financeiro<i class="fas fa-chevron-down menu-seta"></i></a>
                    <ul class="submenu">
                        <li><a href="/contas">Contas</a></li>
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

        <div class="card-saldo">
            <h1>Dashboard</h1><h1>Saldo Atual: R$ 0,00</h1>
        </div>

        <div class="cards-e-contas">

            <div class="minhas-contas">
                <span>minhas contas</span>
            </div>

            <div class="grid-cards">


                <div class="card-receita">
                    <div class="card-icone">$</div>
                    <span class="card-tipo">Receitas:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>


                <div class="card-despesa">
                    <div class="card-icone">$</div>
                    <span class="card-tipo">Despesas:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>

                <div class="card-pago">
                    <div class="card-icone">$</div>
                    <span class="card-tipo">Valor pago:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>

                <div class="card-recebido">
                    <div class="card-icone">$</div>
                    <span class="card-tipo">Valor recebido:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>
                
                <div class="card-a-pagar">
                    <div class="card-icone">$</div>
                    <span class="card-tipo">Total à pagar:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>

                <div class="card-a-receber">
                    <div class="card-icone">$</div>
                    <span class="card-tipo">Total à receber:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>

                <div class="card-saldo-projetado">
                    <div class="card-icone">+/-</div>
                    <span class="card-tipo">Saldo projetado:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>

                <div class="card-balanco">
                    <div class="card-icone">+/-</div>
                    <span class="card-tipo">Balanço:<br>
                        <span class="card-valor">R$: 8,52</span>
                    </span>
                </div>

            </div>
        </div>
    
    @vite('resources/js/menu_lateral.js')

</body>


