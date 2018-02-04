<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<section id="confirmacao" title="Confirme com sua senha" class="modal">
    <h1>Confirme com sua senha</h1>
    <form action="" method="post" id="formConfirma">
        <label>
            <input type="password" id="userPass" placeholder="Informe sua senha" required>
            <input type="hidden" id="confirmForm">
            <input type="hidden" id="passElement">
        </label>
        <div class="buttons">
            <label class="btn">
                <button onclick="confirmSubmit(); return false;">
                    <i class="fa fa-check"></i>
                    Confirmar
                </button>
            </label>
            <label class="btn">
                <button onclick="closeModal('confirmacao'); return false;">
                    <i class="fa fa-arrow-left"></i>
                    Cancelar
                </button>
            </label>
        </div>
    </form>
</section>
