<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<section id="meus_dados" title="Meus dados" class="modal">
    <h1>Meus dados</h1>
    <form method="post" action="<?=HOME_URL?>/user/alterarDados" id="my_data">
        <label>
            <span>Cod: </span>
            <input type="hidden" name="userCod" value="<?=$this->user['cod']?>">
            <input type="text" value="<?=$this->user['cod']?>" readonly>
        </label>
        <label>
            <span>Nome: </span>
            <input type="text" name="userNome" value="<?=$this->user['nome']?>">
        </label>
        <label>
            <span>Email: </span>
            <input type="text" name="userEmail" value="<?=$this->user['email']?>">
        </label>
        <label>
            <span>Login: </span>
            <input type="text" name="userLogin" value="<?=$this->user['login']?>" readonly>
            <input type="hidden" name="userPass" id="pass">
        </label>
        <div class="buttons">
            <label class="btn">
                <button onclick="confirmar('my_data', 'pass'); return false;">
                    <i class="fa fa-check"></i>
                    Alterar dados
                </button>
            </label>
            <label class="btn">
                <button onclick="closeModal('meus_dados'); return false;">
                    <i class="fa fa-arrow-left"></i>
                    Cancelar
                </button>
            </label>
        </div>
    </form>
</section>
