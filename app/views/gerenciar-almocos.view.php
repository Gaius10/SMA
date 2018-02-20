<?php if (!defined('ROOT_PATH')) exit('Erro Interno'); ?>
<div id="contentGerenciar">

    <aside id="dados_globais">
        <div id="title">
            <h1>Dados globais de</h1>
            <form method="get">
                <select name="global">
                    <option value="all" selected>  Todos Almoços</option>
                    <option value="week">          Ultima semana</option>
                    <option value="mounth">        Ultimo Mês</option>
                </select>
            </form>
        </div>

        <ul id="global_data">
            <li>
                <label>
                    <i class="fa fa-utensils"></i>
                    Almoços:
                </label>
                <span>1000000000000000000</span>
            </li>
            <li class="gray">
                <label>
                    <i class="fa fa-sync-alt"></i>
                    Repetições:
                </label>
                <span>0</span>
            </li>
            <li>
                <label>
                    <i class="fa fa-times-circle"></i>
                    Ocorrências:
                </label>
                <span>100</span>
            </li>
        </ul>
    </aside>

    <section id="gerenciar">
        <div id="title">
            <h1>Dados dos almoços</h1>
            <form method="get">
                <label>
                    Você está vendo:
                    <select name="view">
                        <option value="all" selected>  Todos Almoços</option>
                        <option value="week">          Ultima Semana</option>
                        <option value="mounth">        Ultimo Mês</option>
                    </select>
                </label>
            </form>
        </div>

        <nav id="lista_almocos">
            <ul>
                <strong>
                    <li>
                        <label class="data" title="Data do almoço">Data</label>
                        <label class="card" title="Cardápio do dia">Cardapio</label>
                        <label class="qtdA" title="Almoços"><i class="fa fa-utensils"></i></label>
                        <label class="qtdR" title="Repetições"><i class="fa fa-sync-alt"></i></label>
                        <label class="qtdO" title="Ocorrências"><i class="fa fa-times-circle"></i></label>
                    </li>
                </strong>

                <?php include VIEWS_PATH . '/_includes/testes/lista-almocos.php'; ?>
            </ul>
        </nav>
    </section>
</div>

<div id="modals">
    <?php include MODAL_PATH . '/encomenda.modal.php'; ?>
    <?php include MODAL_PATH . '/confirmacao.modal.php'; ?>
    <?php include MODAL_PATH . '/ocorrencia.modal.php'; ?>

    <!-- Modals do menu -->
    <?php include MODAL_PATH . '/iniciar-almoco.modal.php'; ?>
    <?php include MODAL_PATH . '/novo-monitor.modal.php'; ?>
    <?php include MODAL_PATH . '/meus-dados.modal.php'; ?>

    <?php if (isset($_GET['msg'])) include MODAL_PATH . '/msg.modal.php'; ?>
</div>
