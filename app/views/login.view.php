<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<section class="login-content">
	<form name="formLogin" method="post" action="">
		
		<h1>Bem vindo ao SMA</h1>

		<div class="img" hidden>
			<img src="<?= VIEWS_URL ?>/_img/logo_sma.png">
		</div>

		
		<label style="grid-area: lineOne">
			<span hidden>Login</span>
			<i class="fa fa-user-circle fa-2x"></i>
			<input type="text" name="userdata[username]" 
				value="<?= @$_POST['userdata']['username'] ?>" placeholder="Login">
		</label>

		<label style="grid-area: lineTwo">
			<span hidden>Senha</span>
			<i class="fa fa-key fa-2x"></i>
			<input type="password" name="userdata[userpass]"
				placeholder="Senha" />
		</label>
		
		<label class="btn" style="grid-area: lineThree">
			<input type="submit" value="Entrar" class="button">
		</label>
		<label class="btn" style="grid-area: lineFour">
			<button id="btnCadastreSe" class="button" 
				onclick="openModal('cadastre_se'); return false;"> Cadastre-se </button>
		</label>

		<!-- Feedback de login -->
		<?php if ($this->loginError): ?>
			<span class="login-error" style="display: block;">
				<i class="fa fa-warning" style="color: red;"></i>
				Erro: <?= $this->loginError ?>
			</span>
		<?php endif; ?>
	</form>
</section>
<section id="modals">
	<?php include MODAL_PATH . '/encomenda.modal.php'; ?>
	<?php include MODAL_PATH . '/sobre-nos.modal.php'; ?>
	<?php include MODAL_PATH . '/suporte.modal.php'; ?>
	<?php include MODAL_PATH . '/cadastre-se.modal.php'; ?>
</section>
