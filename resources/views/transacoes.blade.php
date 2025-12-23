<!DOCTYPE html>
<html lang=pt_BR>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minha Carteira</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/modal_form.js'])
    @vite(['resources/css/transacoes.css'])
    @vite(['resources/css/layout-base.css'])
    @vite(['resources/css/modal.css'])
    @font-face {
        font-family: 'Impact';
        src: url('caminho/para/a/fonte/impact.woff') format('woff');
    }
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <x-menu-topo topoInfo="Transações"/>
    
    <x-menu-lateral/>

    <div class="container-principal">

        <div class="header-transacoes">
            <h1>Todas as transações</h1>
            <button id="criaTransacao" class="bt-add-transacao"><i class="fas fa-plus"></i></button>
        </div>

        <div class="lista-transacoes">

            @if ($transacoes->isEmpty())
                <span class="texto-lista-vazia">Você ainda não registrou nenhuma transação.</span>
            @else

            @endif

        </div>

    </div>

    <x-modal id="modalCreateTransacao" title="Nova Transação">

        <form class="form-transacao" action="transacaoStore" method="POST">

            <x-input  label="Título" name="titulo" placeholder="Informe o título da transação"/>

            <x-select label="Tipo" name="tipo" :options="$tipos"/>
            
            <x-select label="Status" name="status" :options="$status"/>

            <x-select label="Lançamento" name="lancamento" :options="$lancamento"/>

            <x-select label="Período de recorrência" name="recorrencia_periodo" :options="$recorrencia"/>

            <x-input  label="Quantas recorrências?" name="recorrencia_qtd" type="number" placeholder="Informe quantas vezes esse período ocorrerá"/>

            <x-input  label="Valor" name="valor" type="number" placeholder="Informe o valor da transação"/>

            <label for="descricao" class="sua-classe-label">
                Descrição
            </label>

            <textarea name="descricao" rows="4" 
            
            style="width: 360px; 
                   border-radius: 4px; 
                   border: 1px solid black; 
                   margin-bottom: 10px;">


            </textarea>

            <x-input  label="Data" name="data" type="date" placeholder="Informe a data"/>

            <button type="submit">Salvar Transação</button>

        </form>

    </x-modal>
    



</body>