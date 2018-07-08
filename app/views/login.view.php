<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<main style="margin-top: 2em; margin-bottom: 4em;">
    <section id="login_content">
        <form name="formLogin" method="post" class="row">

            <h4 class="center-align">Bem vindo ao SMA</h4>

            <div class="container">
                <div class="col s12 l8 push-l2">
                    <div class="hide-on-mob col s12 l6">
                        <img src="<?= VIEWS_URL ?>/_img/logo_sma.png" style="max-width: 100%">
                    </div>

                    <div class="col s12 l6">
                        <div class="col s12 input-field">
                            <input type="text" name="userdata[username]" id="username" class="validate">
                            <label for="username">Login</label>
                        </div>
                        <div class="col s12 input-field">
                            <input type="password" name="userdata[userpass]" id="userpass" class="validate">
                            <label for="userpass">Senha</label>
                        </div>

                        <?php if ($this->loginError): ?>
                            <div class="container center-align">
                                <label class="brand-logo red-text">
                                    Erro: <?= $this->loginError ?>
                                </label>
                            </div>
                        <?php endif ?>

                        <div class="row">
                            <button class="btn-large col s12 red darken-3"  style="margin-bottom: 0.2em">Entrar</button>
                            <button class="btn-large col s12 red darken-3">Cadastre-se</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
