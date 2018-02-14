<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<section id="msg" class="modal" style="display: block;">
    <h1>Mensagem</h1>
    <label><?=$_GET['msg']?></label>
    <button onclick="closeModal('msg')">
        <i class="fa fa-check"></i>
        Fechar
    </button>
</section>
<script>
    if (screen.width < 1024) {
        document.getElementById('msg').style.transform = 'translateX(100%)';
    }
</script>
