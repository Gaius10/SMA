<?php if (!defined('ROOT_PATH')) exit(); ?>
<div class="modal" id="cadastre_se">
    <div class="modal-content">
        <h4>Cadastre-se</h4>

        <form method="post" action="<?=HOME_URL?>/Login/cadastro" class="row">
            <div class="input-field col s12 l6">
                <input type="text" name="nome" class="validate" required>
                <label>Nome</label>
            </div>
            <div class="input-field col s12 l6">
                <input type="text" name="login" class="validate" required>
                <label>Login</label>
            </div>
            <div class="input-field col s12">
                <input type="email" name="email" class="validate" required>
                <label>E-mail</label>
            </div>
            <div class="input-field col s12 l6">
                <input type="password" name="senha" class="validate" required>
                <label>Senha</label>
            </div>
            <div class="input-field col s12 l6">
                <input type="password" name="senha2" class="validate" required>
                <label>Confirme a senha</label>
            </div>

            <button type="submit" class="btn-large red darken-4 col s10 push-s1 l4 push-l8" id="btnCadastrar">
                Cadastrar
            </button>
        </form>
    </div>
</div>
