<?php if (!defined('ROOT_PATH')) exit(); ?>
<div id="modals">
    <div class="modal modal-fixed-footer" id="meus_dados">
        <form title="Meus Dados" method="post" action="<?=HOME_URL?>/user/alterarDados">
            <div class="modal-content row">

                <div class="input-field col s12 l6">
                    <input disabled type="text" name="userCod" id="cod" value="<?=$this->user['cod']?>">
                    <label for="cod">Meu código</label>
                </div>

                <div class="input-field col s12 l6">
                    <input type="text" name="userNome" id="nome" value="<?=$this->user['nome']?>">
                    <label for="nome">Nome</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="userEmail" id="email" value="<?=$this->user['email']?>">
                    <label for="email">E-mail</label>
                </div>
                
                <div class="input-field col s12">
                    <input type="text" name="userLogin" id="login" value="<?=$this->user['login']?>">
                    <label for="login">Login</label>
                </div>
            </div>
            <div class="modal-footer row">
                <button type="submit" class="btn-large col s6 l3 red right">Alterar</button>
                <a href="#" class="btn-large modal-close col s6 l3 red right">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="modal" id="iniciar_almoco">
        <form title="Iniciar Almoço" method="post" action="<?=HOME_URL?>/user/iniciarAlmoco/">
            <div class="modal-content row">
                <div class="col s12 input-field">
                    <input type="text" name="cardapio" id="card" class="validate" required>
                    <label for="card">Cardápio do dia</label>
                </div>

                <button type="submit" class="btn-large col s12 l3 red right">Iniciar</button>
                <a href="#" class="modal-close btn-large col s12 l3 red right">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="modal" id="autorizar_monitor">
        <form title="Adicionar Monitor" method="post" action="<?=HOME_URL?>/user/autorizar">
            <div class="modal-content row">
                <h4>Adicionar monitor</h4>

                <div class="input-field col s12">
                    <input type="text" id="email" name="email" class="validate" required>
                    <label for="email">Email do novo monitor</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="emailConf" name="emailConf" class="validate" required>
                    <label for="emailConf">Confirme o email</label>
                </div>
                <div class="input-field col s12">
                    <input type="password" id="pass" name="rootPass" class="validate" required>
                    <label for="pass">Senha do administrador</label>
                </div>

                <div class="col s12 l6 right">
                    <div class="row">
                        <button type="submit" class="btn-large col s12 l5 red">Adicionar</button>
                        <a href="#" class="btn-large modal-close col s12 l5 right red">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal" id="mudar_monitor">
        <form title="Alterar Monitor" method="post">
            <div class="modal-content row">
                <h4>Alterar senha do monitor</h4>

                <div class="input-field col s12">
                    <input type="password" id="atual" name="atualPass" class="validate" required>
                    <label for="atual">Senha atual</label>
                </div>

                <div class="input-field col s12">
                    <input type="password" id="nova" name="newPass" class="validate" required>
                    <label for="nova">Nova senha</label>
                </div>

                <div class="input-field col s12">
                    <input type="password" id="conf" name="newPassConfirm" class="validate" required>
                    <label for="conf">Confirmação</label>
                </div>

                <div class="col s12 l6 right">
                    <div class="row">
                        <button type="submit" class="btn-large col s12 l5 red">Alterar</button>
                        <a href="#" class="btn-large modal-close col s12 l5 red right">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
