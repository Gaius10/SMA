<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<header class="grid menu">
	<div class="menuIcon">
		<input type="checkbox" id="opnMobileMenu" hidden>

		<label for="opnMobileMenu" id="opnMenu">
			<i class="fa fa-bars fa-4x"></i>
		</label>

		<!-- Menu com opcoes -->
		<div class="menu-content modal">
			<h1>Opções</h1>
			<ul>
				<li onclick="openModal('suporteModal')">
					<i class="fa fa-wrench fa-2x"></i>
					<span>Suporte</span>
				</li>
				<label for="opnMobileMenu">
					<i class="fa fa-arrow-left fa-2x"></i>
					<span>Voltar</span>
				</label>
			</ul>
		</div>
	</div>

	<div class="pageTitle">
		<span>SMA</span>
	</div>
</header>