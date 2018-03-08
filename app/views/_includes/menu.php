<?php if (!defined("ROOT_PATH")) exit("Internal error"); ?>
<!-- Menu superior em todas as páginas -->
<header id="menu">
	<input type="checkbox" id="opnMenu" hidden>
	
	<label id="menu_icon" for="opnMenu">
		<i class="fa fa-bars"></i>
	</label>

	<div id="modal_menu" class="modal">
		<section id="navegacao">
			<h1>Navegar pelo site</h1>
			<ul>
				<li onclick="window.location.href='<?=HOME_URL?>/aluno/cadastrar'" <?= sel($pag, 'new_aluno') ?>>
					<i class="fa fa-child"></i>
					<span>Cadastrar Aluno</span>
				</li>
				<li onclick="window.location.href='<?=HOME_URL?>/almoco/gerenciar'" <?= sel($pag, 'ger_alm') ?>>
					<i class="fa fa-balance-scale"></i>
					<span>Gerenciar Almoços</span>
				</li>
				<li onclick="window.location.href='<?=HOME_URL?>/aluno/cadastrados'" <?= sel($pag, 'ver_al') ?>>
					<i class="fa fa-address-book"></i>
					<span>Ver alunos cadastrados</span>
				</li>
			</ul>
		</section>
		
		<div id="optIcon">
			<?php $uname = $this->userdata['MONITOR_NOME']; ?>
			<a href="<?=HOME_URL?>">
				<span class="uname" title="<?= $uname ?>"> <?= $uname ?> </span>
				<i class="fa fa-cogs uname" title="Opções"></i>
			</a>

			<section id="opcoes">
				<h1>Opções</h1>
				<ul>
					<li onclick="openModal('meus_dados')" title="Ver Meus Dados">
						<i class="fa fa-user"></i>
						<span>Ver Meus Dados</span>
					</li>
					<li onclick="openModal('iniciar_almoco')" title="Iniciar Almoço">
						<i class="fa fa-plus-circle"></i>
						<span>Iniciar Almoço</span>
					</li>
					<?php if (in_array('root', $this->userdata['USER_PERMISSIONS'])): ?>
						<li onclick="openModal('form_autorizar')" title="Autorizar Monitor">
							<i class="fa fa-user-plus"></i>
							<span>Autorizar Monitor</span>
						</li>
						<li onclick="openModal('trocar_adm')" title="Mudar senha do administrador">
							<i class="fa fa-key"></i>
							<span>Mudar Administrador</span>
						</li>
					<?php endif ?>
					<label for="opnMenu">
						<i class="fa fa-arrow-left"></i>
						<span>Fechar</span>
					</label>
					<li onclick="window.location.href = '<?=HOME_URL?>/user/quit'" title="Sair">
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
