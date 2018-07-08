<?php if (!defined('ROOT_PATH')) exit(); ?>
<div class="modal" id="msgModal">
    <div class="modal-content">
        <h4 class="center">Aviso</h4>
        <div class="center"><?=$_GET['msg']?></div>
        <div class="right" style="padding-bottom: 1em"><a href="#" class="btn-flat modal-close">Fechar</a></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#msgModal').modal('open');
    });
</script>
