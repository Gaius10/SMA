<?php if (!defined('ROOT_PATH')) exit(); ?>
<!-- Modal de ocorrencia -->
<?php include MODAL_PATH . '/nova_ocorrencia.php'; ?>
<!-- Modal de confirmação -->
<?php include MODAL_PATH . '/confirmacao_com_senha.php'; ?>

<style type="text/css">
    @media only screen and (min-width: 993px) {
        #erros { left: -0.5em }
        #dados { left: 0.5em }

        a.btn-large + a.btn-large { 
            margin-left: 0.5em !important;
            margin-bottom: 0.5em;
        }
    }
</style>

<main class="container row">

    <?php if (!empty($this->errors) and is_array($this->errors)): ?>
    <article id="errors" class="card col s12 l4">
        <div class="card-content row">
            <div class="col s12">
                <h5 class="card-title center red-text">Avisos</h5>

                <ul class="center">
                    <?php foreach ($this->errors as $error): ?>
                        <li><?=$error?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </article>
    <?php endif ?>



    <section id="dados" class="card col s12 l8<?=(empty($this->errors)) ? ' push-l2' : '';?>">
        <form method="post" class="col s12">
            <div class="card-content row">
                <h5 class="card-title center">Dados do aluno</h5>

                <div class="input-field col s12">
                    <input type="text" name="cod" value="<?=$aluno['cod']?>" disabled>
                    <label>Código</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="alunoNome" value="<?=$aluno['nome']?>">
                    <label>Nome</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="alunoTurma" value="<?=$aluno['turma']?>">
                    <label>Turma</label>
                </div>


                <form method="post" action="<?= HOME_URL ?>/aluno/excluir" id="formExcluir" hidden>
                    <input type="hidden" name="cod" value="<?=$a['alu_c']?>">
                    <input type="hidden" name="pass" id="passExcluir">
                </form>

                <div class="col s12 l10 push-l1">
                    <div class="row">
                        <a href="#confirmacaoComSenha" class="modal-trigger btn-large col s12 l5 push-l1 red darken-4" onclick="confirmarComSenha('O aluno será excluído.', 'formExcluir', 'passExcluir')">
                            Excluir
                        </a>
                        <a href="#new_oc" class="modal-trigger btn-large col s12 l5 push-l1  red darken-4" onclick="newOc('<?=$aluno['cod']?>', '<?=$aluno['nome']?>')">
                            Ocorrência
                        </a>
                        <button class="btn-large col s12 l10 push-l1 red darken-4" <?=(!$almocou) ? "disabled" : ""?>>
                            Repetir
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

</main>
