<?php if (!defined("ROOT_PATH")) exit("Internal error"); ?>
<!-- Menu superior em todas as páginas -->
<header id="menu">
	<input type="checkbox" id="opnMenu" hidden>
	
	<label id="menu_icon" for="opnMenu">
		<i class="fa fa-bars"></i>
	</label>

	<div id="modal_menu">
		<section id="navegacao">
			<h1>Navegar pelo site</h1>
			<ul>
				<li onclick="window.location.href='<?=HOME_URL?>/aluno/cadastrar'">
					<i class="fa fa-child"></i>
					<span>Cadastrar Aluno</span>
				</li>
				<li onclick="window.location.href='<?=HOME_URL?>/almoco/gerenciar'">
					<i class="fa fa-balance-scale"></i>
					<span>Gerenciar Almoços</span>
				</li>
				<li onclick="window.location.href='<?=HOME_URL?>/aluno/cadastrados'">
					<i class="fa fa-address-book"></i>
					<span>Ver alunos cadastrados</span>
				</li>
				<li onclick="window.location.href='<?=HOME_URL?>/almoco/estatisticas'">
					<i class="fa fa-tasks"></i>
					<span>Estatísticas de almoços</span>
				</li>
			</ul>
		</section>
		
		<div id="optIcon">
			<?php $uname = $this->userdata['MONITOR_NOME']; ?>
			<span class="uname" title="<?= $uname ?>"> <?= $uname ?> </span>
			<i class="fa fa-cogs uname" title="Opções"></i>

			<section id="opcoes">
				<h1>Opções</h1>
				<ul>
					<li>
						<i class="fa fa-user"></i>
						<span>Ver Meus Dados</span>
					</li>
					<li>
						<i class="fa fa-plus-circle"></i>
						<span>Iniciar Almoço</span>
					</li>
					<?php if (in_array('root', $this->userdata['USER_PERMISSIONS'])): ?>
					<li>
						<i class="fa fa-user-plus"></i>
						<span>Autorizar Monitor</span>
					</li>
					<?php endif ?>
					<label for="opnMenu">
						<i class="fa fa-arrow-left"></i>
						<span>Fechar</span>
					</label>
					<li onclick="window.location.href = '<?=HOME_URL?>/user/quit'">
						<i class="fa fa-power-off"></i>
						<span>Sair</span>
					</li>
				</ul>
			</section>
		</div>
	</div>

	<div id="pageTitle">
		<h1>SMA</h1>
	</div>
</header>