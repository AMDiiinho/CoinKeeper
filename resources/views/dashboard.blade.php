<!DOCTYPE html>
<html lang=pt_BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>

        .menu-lateral {
            height: 100%; /* 100% Full-height */
            width: 310px; /* 0 width - change this with JavaScript */
            position: fixed; /* Stay in place */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background-color: #1b3563; /* Black*/
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
            font-size: 20px;
            padding: 20px;
            background-color: #45d16a;
            box-shadow: 0 4px 2px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: flex;
            align-items: center;
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
        .menu-lateral .bt-menu-lateral:hover::before {
            opacity: 1;
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
            transition: max-height 0.3s ease;
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

        .secao.ativa .menu-seta {
            transform: rotate(180deg); /* gira para cima quando abre */
        }


        .container-principal {
            height: 866px;
            background-color: #edededff;
            margin: 80px 15px 0 325px;
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
            font-family: "Roboto", "Sans-Serif"
        }

        .cards-e-contas {
            display: flex;
            width: 100%;
        }

        .card-saldo{
            width: 100%;
            height: 80px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            background-color: white;
            padding: 20px 25px 0px;
            align-items: center;
            box-shadow: 0px 4px 3px rgba(0, 0, 0, 0.2)
            
        }

        .grid-cards {
            display: grid;
            grid-template-columns: auto auto;
            width: 60%;
            height: 360px;
            column-gap: 10px;
            row-gap: 10px;
            padding-top: 18px;

        }

        .card-receita,
        .card-despesa,
        .card-a-pagar,
        .card-a-receber,
        .card-pago,
        .card-recebido,
        .card-saldo-projetado,
        .card-balanco {
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: 0px 4px 3px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        .minhas-contas{
            margin-top: 18px;
            margin-left: 10px;
            align-self: left;
            height: 340px;
            width: 40%;
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: 0px 4px 3px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }
    </style>

</head>

<body>
 
    <header><h1 class="topo-menu-lateral">Bem-vindo, {{ Auth::user()->nome }}!</h1></header>
    
    <div class="menu-lateral">   
        <nav>
            <ul>
                <p>Menu Principal</p>


                <li class="secao">
                    <a href="#" class="bt-menu-lateral">Financeiro<i class="fas fa-chevron-down menu-seta"></i></a>
                    <ul class="submenu">
                        <li><a href="#">Contas</a></li>
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
            <h1>Saldo Atual: R$ 0,00</h1>
        </div>

        <div class="cards-e-contas">
            <div class="grid-cards">
                <div class="card-receita">
                    receitas
                </div>
                <div class="card-despesa">
                    despesas
                </div>

                <div class="card-pago">
                    pago
                </div>

                <div class="card-recebido">
                    recebido
                </div>
                
                <div class="card-a-pagar">
                    a pagar
                </div>

                <div class="card-a-receber">
                    a receber
                </div>

                <div class="card-saldo-projetado">
                    saldo projetado
                </div>

                <div class="card-balanco">
                    balanço
                </div>

            </div>

            <div class="minhas-contas">
                minhas contas
            </div>
        </div>

    </div>
    
    <script>
        document.querySelectorAll('.secao > .bt-menu-lateral').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault(); // evita navegação
                link.parentElement.classList.toggle('ativa');
            });
        });
    </script>
</body>


