<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<div id="almoco">
    <aside id="status_almoco">
        <h1>Informações</h1>
        <ul>
            <li>
                <label>Almoços: </label>
                <span>0000</span>
            </li>
            <li>
                <label>Repetições: </label>
                <span>0000</span>
            </li>
            <li>
                <label>Ocorrências: </label>
                <span>0000</span>
            </li>
        </ul>
    </aside>


    <section id="lista_alunos">
        <h1>Almoços - Hoje <span><?= date('d / m / Y') ?></span></h1>
        <ul>
            <li class="list-title">
                <div class="aluno">
                    <label title="Aluno"><strong>Aluno</strong></label>
                    <label title="Turma"><i class="fa fa-book"></i></label>
                </div>
                
                <div class="dados dados-title">
                    <label title="Repetições"><i class="fa fa-sync-alt"></i></label>
                    <label title="Ocorrências"><i class="fa fa-close"></i></label>
                </div>
            </li>
            <?php include VIEWS_PATH . "/_includes/testes/lista-alunos.php"; ?>
        </ul>
    </section>
</div>


<div id="modals">
    <?php include MODAL_PATH . "/encomenda.modal.php"; ?>
    <?php include MODAL_PATH . "/confirmacao.modal.php"; ?>
    <?php include MODAL_PATH . "/ocorrencia.modal.php"; ?>

    <!-- Modals do menu -->
    <?php include MODAL_PATH . "/iniciar-almoco.modal.php"; ?>
    <?php include MODAL_PATH . "/novo-monitor.modal.php"; ?>
    <?php include MODAL_PATH . "/meus-dados.modal.php"; ?>
</div>
