<?php (!defined('ROOT_PATH')) ? exit("Erro Interno") : ""; ?>
<main class="row">
    <?php include MODAL_PATH . '/confirmacao_com_senha.php'; ?>

    <style type="text/css">
        @media only screen and (min-width: 993px) {
            section, aside {
                margin-bottom: 4em;
                margin-top: 3.5em;
            }
        }
    </style>

    <!-- Cadastrar novo aluno -->
    <section id="cadastrar_aluno" title="Cadastrar novo aluno" class="col s12 l7 right">
        <div class="card white">
            <form method="post" action="<?=HOME_URL?>/Aluno/cadastrar/">
                <div class="card-content">
                    <h5 class="card-title">Cadastrar Aluno</h5>

                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="alunoNome" id="nome" class="validate" required>
                            <label for="nome">Nome do aluno</label>
                        </div>

                        <div class="input-field col s12">
                            <select name="alunoAno" class="validate" required>
                                <option value="" disabled selected>Turma</option>
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
                        </div>
                    </div>
                </div>
                <div class="card-action row">
                    <button class="btn-large red darken-3 col s6 push-s3">Cadastrar</button>
                </div>
            </form>
        </div>
    </section>







    <!-- Dados do ultimo aluno cadastrado -->
    <aside id="ultimo_cadastro" title="Último aluno cadastrado" class="col s12 l5 left">
        <div class="card white">
            <div class="card-content">
                <div class="card-title center">Ultimo Aluno Cadastrado</div>
                <p>
                    <?php if (is_array($this->ultimoAluno)): ?>
                        <figure title="Dados do último aluno cadastrado" class="center-align">
                            <img src="<?= QR_URL . "/ult.png" ?>" class="responsive-img ">
                            <legend><?=$this->ultimoAluno['nome'] . '-' . $this->ultimoAluno['turma']?></legend>
                        </figure>
                    <?php else: ?>
                        <span class="flow-text">Nenhum dado foi encontrado</span>
                    <?php endif ?>
                </p>
            </div>

            <?php if (is_array($this->ultimoAluno)): ?>
            <div class="card-action row">
                <a href="#confirmacaoComSenha" onclick="confirmarComSenha('O aluno será excluído.', 'excluir', 'senha')" class="col s6 push-s3 btn-large red darken-3 modal-trigger">
                    Excluir
                </a>

                <form method="post" id="excluir" action="<?= HOME_URL ?>/aluno/excluir" hidden>
                    <input type="hidden" name="pass" id="senha">
                    <input type="hidden" name="cod" value="<?=$this->ultimoAluno['cod']?>">
                </form>
            </div>
            <?php endif ?>
        </div>
    </aside>
</main>
