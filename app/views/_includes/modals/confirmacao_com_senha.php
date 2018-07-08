<?php if (!defined('ROOT_PATH')) exit(); ?>
<script type="text/javascript">
    function process() {
        document.getElementById(document.getElementById('passSubmit').value).value = document.getElementById('senhaConfirmacao').value;
        document.getElementById(document.getElementById('toSubmitComSenha').value).submit();
    }
</script>
<div id="confirmacaoComSenha" class="modal">
    <div class="modal-content row">
        <p id="conteudo_confirmacao_com_senha" class="flow-text"></p>
        <p class="flow-text">Confirme com senha: </p>

        <input type="hidden" id="toSubmitComSenha">
        <input type="hidden" id="passSubmit">

        <div class="input-field col s12">
            <input type="password" id="senhaConfirmacao">
            <label for="senhaConfirmacao">Senha do monitor</label>
        </div>

        <a href="#" class="btn-flat col s8 l4 push-l4 push-s2 center" onclick="process()">
            Confirmar
        </a>
    </div>
</div>

