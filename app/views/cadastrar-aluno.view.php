<?php (!defined('ROOT_PATH')) ? exit("Erro Interno") : ""; ?>
<div id="conteudo_cadastrar_aluno">
    <aside id="ultimo_cadastro">
        <h1>Ultimo aluno cadastrado</h1>
        <div id="perfil_aluno">
            <?php if (is_array($this->ultimoAluno)): ?>
                <img src="<?= QR_URL . "/ult.png" ?>" id="qrUltimoAluno">

                <label id="nomeUltimoAluno">
                    <strong>Nome:</strong> <?= $this->ultimoAluno['nome'] ?>
                </label>

                <label id="turmaUltimoAluno">
                    <strong>Turma:</strong> <?= $this->ultimoAluno['turma'] ?>
                </label>

                <button id="removerUltimoAluno" 
                    onclick="confirmar('excluiAluno', 'senhaMonitor'); return false;">
                    <i class="fa fa-minus-circle"></i>
                    Remover Aluno
                </button>
                <form id="excluiAluno" method="post" action="<?=HOME_URL?>/aluno/excluir" hidden>
                    <input type="hidden" name="cod" value="<?= $this->ultimoAluno['cod'] ?>">
                    <input type="hidden" name="pass" id="senhaMonitor">
                </form>
            <?php else: ?>
                <span>Não foi possível obter os dados do ultimo aluno cadastrado</span>
            <?php endif ?>
        </div>
    </aside>

    <section id="cadastrar_aluno">
        <h1>Cadastrar Aluno</h1>
        <form method="post" action="<?=HOME_URL?>/Aluno/cadastrar/">
            <label>
                <span>Nome do aluno: </span>
                <input type="text" name="alunoNome">
            </label>
            <label>
                <span>Turma: </span>
                <select name="alunoAno">
                    <option selected>Selecione a turma</option>
                    <optgroup label="Ensino Médio">
                        <option value="1A">1A - Ensino Médio</option>
                        <option value="2A">2A - Ensino Médio</option>
                        <option value="3A">3A - Ensino Médio</option>
                    </optgroup>
                    <optgroup label="Informática">
                        <option value="1B">1B - Informática</option>
                        <option value="2B">2B - Informática</option>
                        <option value="3B">3B - Informática</option>
                    </optgroup>
                    <optgroup label="Química">
                        <option value="1C">1C - Química</option>
                        <option value="2C">2C - Química</option>
                        <option value="3C">3C - Química</option>
                    </optgroup>
                    <optgroup label="Segurança do Trabalho">
                        <option value="1D">1D - Segurança do Trabalho</option>
                        <option value="2D">2D - Segurança do Trabalho</option>
                        <option value="3D">3D - Segurança do Trabalho</option>
                    </optgroup>
                    <optgroup label="Nutrição e Dietética">
                        <option value="1E">1E - Nutrição e Dietética</option>
                        <option value="2E">2E - Nutrição e Dietética</option>
                        <option value="3E">3E - Nutrição e Dietética</option>
                    </optgroup>
                    <optgroup label="Meio Ambiente">
                        <option value="1F">1F - Meio Ambiente</option>
                        <option value="2F">2F - Meio Ambiente</option>
                        <option value="3F">3F - Meio Ambiente</option>
                    </optgroup>
                </select>
            </label>
            <button>
                Cadastrar
            </button>
        </form>
    </section>
</div>
<div id="modals">
    <?php include MODAL_PATH . "/confirmacao.modal.php"; ?>
    <!-- Modals do menu -->
    <?php include MODAL_PATH . "/iniciar-almoco.modal.php"; ?>
    <?php include MODAL_PATH . "/novo-monitor.modal.php"; ?>
    <?php include MODAL_PATH . "/meus-dados.modal.php"; ?>
</div>
