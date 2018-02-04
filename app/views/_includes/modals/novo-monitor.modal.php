<?php if (!defined('ROOT_PATH')) exit("Internal error"); ?>
<section id="form_autorizar" class="modal" title="Novo monitor">
    <h1>Autorizar novo monitor</h1>

    <form action="<?=HOME_URL?>/user/autorizar" method="post">
        <label>
            <span>Insira o email do novo monitor:</span>
            <input type="text" name="email">
        </label>
        <label>
            <span>Confirme o email:</span>
            <input type="text" name="emailConf">
        </label>
        <label>
            <span>Senha do root:</span>
            <input type="password" name="rootPass">
        </label>
        <div class="buttons">
            <label class="btn">
                <button>
                    <i class="fa fa-user-plus"></i>
                    Autorizar
                </button>
            </label>
            <label class="btn">
                <button onclick="closeModal('form_autorizar'); return false;">
                    <i class="fa fa-arrow-left"></i>
                    Voltar
                </button>
            </label>
        </div>
    </form>
</section>
