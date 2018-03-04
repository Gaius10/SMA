<?php if (!defined('ROOT_PATH')) exit('Erro Interno'); ?>
<section id="msg_modal" class="modal" style="display: block;">
    <h1>Mensagem</h1>
    <label><?=$_GET['msg']?></label>
    <button onclick="closeModal('msg_modal'); return false;">
        <i class="fa fa-check"></i>
        Fechar
    </button>
</section>
