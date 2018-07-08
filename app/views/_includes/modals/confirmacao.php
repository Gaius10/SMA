<?php if (!defined('ROOT_PATH')) exit(); ?>
<div id="confirmacao" class="modal">
    <div class="modal-content">
        <p id="conteudo_confirmacao" class="flow-text"></p>
        <p class="flow-text">Prosseguir?</p>

        <input type="hidden" id="toSubmit">

        <button class="btn-flat" type="submit" onclick="document.getElementById(document.getElementById('toSubmit').value).submit();">
            Sim
        </button>
        <a href="#" class="modal-close btn-flat">Não</a>
    </div>
</div>
