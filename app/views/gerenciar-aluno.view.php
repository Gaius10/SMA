<?php if (!defined('ROOT_PATH')) exit(); ?>
<div id="contentGerenciarAluno">

    <?php if (count($this->errors) > 0): ?>
        <article id="errors">
            <h1>Avisos</h1>
            <ul>
                <?php foreach ($this->errors as $k => $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </article>
    <?php endif ?>

    <section id="gerenciar_aluno">
        <h1>Gerenciamento de aluno</h1>
        <img src="">
        <form method="post" id="dadosAluno">
            <label>
                <span>Código: </span>
                <input type="text" name="cod" id="alunoCod" value="<?=$this->model->cod?>" readonly>
                <input type="hidden" name="pass" id="senhaMonitor">
            </label>
            <label>
                <span>Nome: </span>
                <input type="text" name="alunoNome" id="alunoNome" value="<?=$this->model->nome?>">
            </label>
            <label>
                <span>Turma: </span>
                <input type="text" name="alunoTurma" id="alunoTurma" value="<?=$this->model->turma?>">
            </label>
            <div class="buttons">
                <label class="btn">
                    <script>var act2 = "<?=HOME_URL?>/aluno/excluir"</script>
                    <button onclick="gerenciar('dadosAluno', 'senhaMonitor', act2); return false;">
                        <i class="fa fa-minus-circle"></i>
                        Excluir Aluno
                    </button>
                </label>
                <label class="btn">
                    <button onclick="ocorrencia(); return false;">
                        <i class="fa fa-times-circle"></i>
                        Registrar Ocorrência
                    </button>
                </label>
                <label class="btn">
                    <script>
                        var cods = "<?=$this->model->cod?>/<?=$codAlmoco?>";
                        var urlRepetir = "<?=HOME_URL?>/aluno/repetir/" + cods;
                    </script>
                    <button onclick="window.location.href = urlRepetir; return false;"
                        <?=(!$almocou) ? "disabled" : ""?>>
                        <i class="fa fa-sync-alt"></i>
                        Repetir
                    </button>
                </label>
            </div>
        </form>
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
