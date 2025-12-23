<div class="menu-lateral">   
    <nav>
        <ul>

            <p>Menu Principal</p>

            <li><a href="/dashboard"class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-bar icone-dashboard"></i>Dashboard </a></li>
            <li><a href="/carteira"class="{{ Request::is('carteira') ? 'active' : '' }}">Minha Carteira</a></li>
            <li><a href="/transacoes"class="{{ Request::is('transacoes') ? 'active' : '' }}">Transações</a></li>
            <li><a href="/extrato"class="{{ Request::is('extrato') ? 'active' : '' }}">Extrato</a></li>
            <li><a href="/receitas"class="{{ Request::is('receitas') ? 'active' : '' }}">Receitas</a></li>
            <li><a href="/despesas"class="{{ Request::is('despesas') ? 'active' : '' }}">Despesas</a></li>
            <li><a href="/configuracoes"class="{{ Request::is('configuracoes') ? 'active' : '' }}">Configurações</a></li>
            
        </ul>
    </nav>
</div>