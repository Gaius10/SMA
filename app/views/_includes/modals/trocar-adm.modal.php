<?php if (!defined('ROOT_PATH')) exit(); ?>
<section id="trocar_adm" class="modal">
    <h1>Alterar senha do monitor</h1>
    <form method="post" action="<?=HOME_URL?>/user/trocarAdmin">
        <label>
            <span>Senha atual</span>
            <input type="password" name="atualPass">
        </label>
        <label>
            <span>Nova senha</span>
            <input type="password" name="newPass">
        </label>
        <label>
            <span>Nova senha</span>
            <input type="password" name="newPassConfirm" placeholder="Confirmação">
        </label>

        <div class="buttons">
            <label class="btn">
                <button>
                    <i class="fa fa-arrow-alt-circle-right"></i>
                    Alterar senha
                </button>
            </label>
            <label class="btn">
                <button onclick="closeModal('trocar_adm'); return false;">
                    <i class="fa fa-arrow-alt-circle-left"></i>
                    Cancelar
                </button>
            </label>
        </div>
    </form>
</section>
