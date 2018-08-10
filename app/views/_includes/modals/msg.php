<?php if (!defined('ROOT_PATH')) exit(); ?>
<div class="modal" id="msgModal">
    <div class="modal-content">
        <h4 class="center">Aviso</h4>
        <div class="center" id="contentMsg"></div>
        <div class="right" style="padding-bottom: 1em"><a href="#" class="btn-flat modal-close">Fechar</a></div>
    </div>
</div>

<?php if (!empty($_GET['msg'])): ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#contentMsg').text('<?=$_GET['msg']?>');
        $('#msgModal').modal('open');
    });
</script>
<?php endif ?>
