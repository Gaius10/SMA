<?php if (!defined('ROOT_PATH')) exit(); ?>
<div id="new_oc" class="modal modal-fixed-footer">
    <form method="post" action="<?= HOME_URL ?>/aluno/ocorrencia/" title="Registrar nova ocorrência">
        <div class="modal-content row">
            <h5>Nova Ocorrência</h5>

            <input type="hidden" name="codAluno" id="cod_aluno">

            <div class="input-field col s12">
                <input type="text" id="nome_aluno">
                <label id="label" for="nome_aluno">Nome do aluno</label>
            </div>
            <div class="input-field col s12">
                <textarea id="desc" class="materialize-textarea validate" name="descOcorrencia" required></textarea>
                <label for="desc">Descrição do ocorrido</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="pass" id="senha" class="validate" required>
                <label for="senha">Senha do monitor</label>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn-flat">Registrar</button>
        </div>
    </form>
</div>
