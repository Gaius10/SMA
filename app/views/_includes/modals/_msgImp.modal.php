<?php if (!defined('ROOT_PATH')) exit(); ?>
<section id="msg_modal" class="modal" style="display: block;">
    <h1>Mensagem</h1>
    <label>
        Senha alterada com sucesso. 
        Faça login novamente pata continuar
    </label>
    <button onclick="window.location.replace('<?=HOME_URL?>/user/quit'); return false;">
        <i class="fa fa-check"></i>
        Ok
    </button>
</section>
