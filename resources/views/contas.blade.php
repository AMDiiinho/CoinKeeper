<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minhas contas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @font-face {
        font-family: 'Impact';
        src: url('caminho/para/a/fonte/impact.woff') format('woff');
    }
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <style>

        .menu-lateral {
            height: 100%; /* 100% Full-height */
            width: 310px; /* 0 width - change this with JavaScript */
            position: fixed; /* Stay in place */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background: linear-gradient(to bottom,
                        rgba(27, 53, 99, 1) 0%,
                        rgba(0, 18, 45, 1)) 50%;

            overflow-x: hidden; /* Disable horizontal scroll */
            padding-top: 64px;
            

        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        .topo-menu-lateral{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 64px;
            font-size: 12px;
            padding: 20px;
            background-color: #45d16a;
            box-shadow: 0 4px 2px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-lateral .bt-menu-lateral {
            
            position: relative;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
            margin: 30px 20px 1px 20px;
            border-radius: 2px;
            border-bottom: 1px solid #d1d1d1ff;
            background-color: transparent;

            overflow: hidden;
        }

        /* Gradiente como pseudo-elemento */
        .menu-lateral .bt-menu-lateral::before {
            content: "";
            position: absolute;
            inset: 0; /* ocupa toda a área do botão */
            background: linear-gradient(
                to right,
                rgba(255,255,255,0.25) 0%,
                rgba(255,255,255,0.15) 40%,
                rgba(255,255,255,0.05) 80%,
                rgba(255,255,255,0.0) 100%
            );
            opacity: 0; /* invisível inicialmente */
            transition: opacity 0.2s ease; /* animação rápida e discreta */
            z-index: -1; /* fica atrás do texto */
        }

        /* Hover ativa o fade */
        .menu-lateral .bt-menu-lateral:hover::before,
        .menu-lateral .bt-menu-lateral.active::before {
            opacity: 1;
        }

        .menu-lateral .bt-menu-lateral.active {
            background: linear-gradient(to right,
                                rgba(69, 209, 106, 0.9) 0%,
                                rgba(69, 209, 106, 0.001) 80%
                                );
            font-weight: bold;
        }
                
        .menu-lateral ul {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
        }

        .menu-lateral p {
            padding-left: 20px;
            padding-top: 50px;
            font-size: 26px;
            font-weight: bold;
            color: white;
        }
        
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
            padding-left: 20px;
        }

        .submenu li {
            margin: 10px 40px 0 35px;
            
        }

        .submenu li a{
            position: relative;
            display: block;
            font-size: 20px;
            color: white;
            text-decoration: none;
            border-radius: 2px;
            overflow: hidden;
            padding: 10px;
        }

        .submenu li a.active {
            background: linear-gradient(to right,
                rgba(69, 209, 106, 0.9) 0%,
                rgba(69, 209, 106, 0.001) 80%
            );
            font-weight: bold;
        }


        .submenu li a::before {
            content: "";
            position: absolute;
            inset: 0; /* ocupa toda a área do link */
            background: linear-gradient(
                to right,
                rgba(255,255,255,0.25) 0%,
                rgba(255,255,255,0.15) 40%,
                rgba(255,255,255,0.05) 80%,
                rgba(255,255,255,0.0) 100%
            );
            opacity: 0; /* invisível inicialmente */
            transition: opacity 0.2s ease; /* animação rápida e discreta */
            z-index: -1; /* fica atrás do texto */
        }

        /* Hover ativa o fade */
        .submenu li a:hover::before {
            opacity: 1;
        }

        .secao.ativa .submenu {
            max-height: 500px; /* altura suficiente para mostrar os itens */
        }

        .menu-seta {
            float: right;
            transition: transform 0.3s ease;
        }

        .icone-dashboard {
            float: right;
        }

        .secao.ativa .menu-seta {
            transform: rotate(180deg); /* gira para cima quando abre */
        }


        .container-principal {
            height: 866px;
            background-color: #f8f8f8ff;
            margin: 64px 15px 0 325px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 6px 3px rgba(0, 0, 0, 0.2)
        }

        .fa-angle-left{
            font-size: 30px;
            margin-top: 15px;
            padding: 8px 0px 8px 8px;
        }

        body {
            font-family: "Roboto", "Sans-Serif";
        }

        .cards-e-contas {
            display: flex;
            width: 100%;
        }

        .header-contas{
            display: flex;  
            width: 100%;
            height: 80px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            background-color: white;
            padding: 0 25px 0px;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 4px 3px rgba(0, 0, 0, 0.2)
            
        }

        .lista-contas {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100% ;
            height: 200px;
            border-radius: 4px;
            background-color: white;
            margin-top: 10px;
            box-shadow: 0px 4px 3px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(0, 0, 0, 0.2);
            
        }

        .bt-add-conta {
            position: absolute;
            font-size: 16px;
            font-weight: bold;
            background-color: #023997ff;
            color: white;
            border-radius: 5px;
            top: 10px;
            right: 10px;
            padding: 10px;
            width: 340px;
            border: none;

            transition: 0.3s ease;
        }

        .bt-add-conta:hover{
            background-color: #005effff;
        }

    </style>

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


