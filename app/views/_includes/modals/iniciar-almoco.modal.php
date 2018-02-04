<?php if (!defined('ROOT_PATH')) exit("Internal Error"); ?>
<section id="iniciar_almoco" class="modal" title="Iniciar almoço">
    <h1>Iniciar almoço</h1>
    <form method="post" action="<?=HOME_URL?>/user/iniciarAlmoco/">
        <label>
            <span>Digite o cardapio de hoje</span>
            <input type="text" name="cardapio" required>
        </label>

        <div class="buttons">
            <label class="btn">
                <button>
                    <i class="fa fa-plus-circle"></i>
                    Iniciar
                </button>
            </label>
            <label class="btn">
                <button onclick="closeModal('iniciar_almoco'); return false;">
                    <i class="fa fa-arrow-left"></i>
                    Cancelar
                </button>
            </label>
        </div>
    </form>
</section>
