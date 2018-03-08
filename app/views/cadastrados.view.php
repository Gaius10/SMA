<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<script>
    /**
     * Mostra ocorrencias do aluno
     */
    function verDados(codAluno) {
        var elementId = 'dt' + codAluno;
        var iconId    = 'i' + codAluno;
        var dtId      = 'dt' + codAluno;

        var element = document.getElementById(elementId);
        var icon    = document.getElementById(iconId);
        var dt      = document.getElementById(dtId);

        dt.style.transitionDuration      = '0.5s';
        icon.style.transitionDuration    = '0.5s';
        element.style.transitionDuration = '0.5s';

        if (dt.style.height == '0px') {

            element.style.color = "black";
            icon.style.color = 'red';
            dt.style.height = '7em';
            dt.style.borderWidth = '0.2em';
            dt.style.paddingTop = '0.3em';
        } else {
            element.style.color = 'transparent';
            icon.style.color = 'black';
            dt.style.height = '0';
            dt.style.borderWidth = '0';
            dt.style.paddingTop = '0';
        }
    }
</script>
<div id="contentCadastrados">
    <aside id="dados_aluno">
        <h1>Dados do aluno</h1>
        <img src="<?= IMG_URL ?>/default.png" id="qrAlunoSelecionado">
        <form method="post" id="dadosAluno">
            <label>
                <span>Código:</span>
                <input type="text" name="cod" id="alunoCod" readonly>
            </label>
            <label>
                <span>Nome:</span>
                <input type="text" name="alunoNome" id="alunoNome">
            </label>
            <label>
                <span>Turma:</span>
                <input type="text" name="alunoTurma" id="alunoTurma">
            </label>
            <label hidden>
                <input type="hidden" name="pass" id="monitorPass">
            </label>
            <div class="buttons">
                <label class="btn">
                    <script> var act2 = "<?= HOME_URL ?>/aluno/excluir"</script>
                    <button onclick="gerenciar('dadosAluno', 'monitorPass', act2); return false;">
                        <i class="fa fa-minus-circle"></i>
                        Excluir aluno
                    </button>
                </label>
                <label class="btn">
                    <button onclick="ocorrencia(); return false;">
                        <i class="fa fa-times-circle"></i>
                        Ocorrência
                    </button>
                </label>
                <label class="btn">
                    <button class="only-mob" onclick="closeModal('dados_aluno'); return false;">
                        <i class="fa fa-arrow-left"></i>
                        Voltar
                    </button>
                </label>
            </div>
        </form>
    </aside>

    <section id="lista_alunos">
        <h1>
            Alunos cadastrados
            <i class="fa fa-search only-mob" onclick="openModal('filtro')"></i>
            <?php include MODAL_PATH . '/filtro.modal.php'; ?>
        </h1>
        <ul>
            <li class="nome-aluno">
                <div class="nt">
                    <label><strong>Nome</strong></label>
                    <label><i class="fa fa-book"></i></label>
                </div>
                <label></label>
            </li>
            <style type="text/css">
                input[type=checkbox]:checked ~ .dadosAluno { display: block; }
            </style>
            <?php if ($this->alunos): ?>
                <?php foreach ($this->alunos as $k => $a): ?>


                    <li class="nome-aluno<?= $k % 2 == 1 ? ' gray' : '' ?>">
                        <div class="nt" onclick="dadosAluno('<?=$a['alu_c']?>', '<?= QR_URL ?>')">
                            <label class="nome-aluno" id="al_n<?=$a['alu_c']?>" title="<?=$a['n']?>">
                                <?= $a['n'] ?>
                            </label>
                            <label class="turma-aluno" id="al_t<?=$a['alu_c']?>" title="<?=$a['t']?>">
                                <?= $a['t'] ?>
                            </label>
                        </div>
                        <label onclick="verDados(<?=$a['alu_c']?>)">
                            <?php if ($a['oc']['qtd'] > 0): ?>
                                <i class="fa fa-exclamation-circle" id="i<?=$a['alu_c']?>"></i>
                            <?php endif ?>
                        </label>
                    </li>


                    <?php if ($a['oc']['qtd'] > 0): ?>
                        <div id="dt<?=$a['alu_c']?>" class="dtAluno" style="height: 0px;" >
                            <ul>
                                <?php foreach ($a['oc'] as $k => $oc): ?>
                                    <?php if (is_array($oc)): ?>
                                        
                                        <li<?= $k % 2 == 1 ? 'class="gray"' : '' ?>>
                                            <label><?=$oc['oc']?></label>
                                            <span><?=convertData($oc['dat'])?></span>
                                        </li>
                                        <li></li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>


                <?php endforeach ?>
            <?php else: ?>
                <li>Nenhum aluno cadastrado</li>
            <?php endif ?>
        </ul>
    </section>
</div>
<script>
    if (screen.width < 1024) {
        document.getElementById('dados_aluno').setAttribute('class', 'modal');
    }
</script>
<div id="modals">
    <?php include MODAL_PATH . '/encomenda.modal.php'; ?>
    <?php include MODAL_PATH . '/confirmacao.modal.php'; ?>
    <?php include MODAL_PATH . '/ocorrencia.modal.php'; ?>

    <!-- Modals do menu -->
    <?php include MODAL_PATH . '/iniciar-almoco.modal.php'; ?>
    <?php include MODAL_PATH . '/novo-monitor.modal.php'; ?>
    <?php include MODAL_PATH . '/meus-dados.modal.php'; ?>
    <?php include MODAL_PATH . '/trocar-adm.modal.php'; ?>

    <?php if (isset($_GET['msg'])) include MODAL_PATH . '/msg.modal.php'; ?>
</div>
