<!DOCTYPE html>
<html lang=pt_BR>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minha Carteira</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/modal_transacoes'])
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

        <form action="{{ route('transacaoStore') }}"  id="formTransacao" class="form-transacao" method="POST">

            @csrf

        <div class="input-container">

            <div class="input-field">
                <label for="titulo">Título</label>
                <x-input name="titulo" placeholder="Informe o título da transação"/>
            </div>

            <div class="input-field">
                <label for="tipo">Tipo</label>
                <x-select name="tipo" :options="$tipos"/>
            </div>

            <div class="input-field-categoria">
                
                <div class="select-categoria">
                    <label for="categoria">Categoria</label>
                    <x-select name="categoria" :options="$categorias"/> 
                </div>

                <div class="bt-categoria">
                    <button id="criaCategoria" class="bt-add-categoria"><i class="fas fa-plus"></i></button>
                </div>
            </div>

            <div class="input-field-subcategoria">
                
                <div class="select-subcategoria">
                    <label for="subcategoria">Sub-categoria</label>
                    <x-select name="subcategoria" :options="$categorias"/> 
                </div>

                <div class="bt-subcategoria">
                    <button id="criaSubCategoria" class="bt-add-subcategoria"><i class="fas fa-plus"></i></button>
                </div>
            </div>

            <div class="input-field">
                <label for="status">Status</label>
                <x-select name="status" :options="$status"/>
            </div>

            <div class="input-field">
                <label for="lancamento">Lançamento</label>
                <x-select name="lancamento" :options="$lancamento"/>
            </div>

            <div class="input-field">
                <label for="cartao">Cartão</label>
                <x-select name="cartao" :options="$cartoes->pluck('nome', 'id')->toArray()"/>
            </div>
            
          

            <div id="recorrenciaContainer" class="input-field" style="display: none;">

                <label for="recorrencia_periodo">Período de recorrência</label>
                <x-select name="recorrencia_periodo" :options="$recorrencia"/>

                <label for="recorrencia_qtd">Quantidade de recorrencias</label>
                <x-input name="recorrencia_qtd" type="number" placeholder="Informe quantas vezes esse período ocorrerá"/>
            </div>
            

            <div class="input-field">
                <label for="valor">Valor</label>
                <x-input name="valor" type="number" placeholder="Informe o valor da transação"/>
            </div>

            <div class="input-field">
                <label for="data">Data</label>
                <x-input name="data" type="date" placeholder="Informe a data"/>
            </div>

            <div class="input-field-full">
                <label for="descricao">Descrição</label><br>
                <textarea name="descricao" rows="4" 
                
                style="width: 100%; 
                    border-radius: 4px; 
                    border: 1px solid black; 
                    margin-bottom: 10px;"
                    >

                </textarea><br>
            </div>
            
        </div>

            <button type="submit">Salvar Transação</button>

        </form>

    </x-modal>
    



</body>