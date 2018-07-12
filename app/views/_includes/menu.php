<?php if (!defined("ROOT_PATH")) exit("Internal error"); ?>
<!-- Menu superior em todas as páginas -->
<header>
    <?php include VIEWS_PATH . '/_includes/modals/menu_modals.php'; ?>

    <ul id="nav-mobile" class="side-nav container">
        <div class="hide-on-med-and-up">
            <li><a class="subheader black-text">Navegar pelo site</a></li>

            <li>
                <a href="<?=HOME_URL?>/aluno/cadastrar">
                    <i class="fas fa-user-plus black-text fa-2x"></i> Cadastrar Aluno
                </a>
            </li>

            <li>
                <a href="<?=HOME_URL?>/almoco/gerenciar">
                    <i class="fas fa-utensils black-text fa-2x"></i> Gerenciar Almoços
                </a>
            </li>

            <li>
                <a href="<?=HOME_URL?>/aluno/cadastrados">
                    <i class="fas fa-users black-text fa-2x"></i> Alunos Cadastrados
                </a>
            </li>

            <li><div class="divider"></div></li>
        </div>

        <li><a class="subheader black-text">Opções</a></li>

        <li>
            <a href="#meus_dados" class="modal-trigger">
                <i class="fas fa-user-cog black-text fa-2x"></i> Meus Dados
            </a>
        </li>

        <li>
            <a href="#iniciar_almoco" class="modal-trigger">
                <i class="fas fa-plus-circle black-text fa-2x"></i> Iniciar Almoço
            </a>
        </li>

        <li>
            <a href="#autorizar_monitor" class="modal-trigger">
                <i class="fas fa-user-tie black-text fa-2x"></i> Autorizar Monitor
            </a>
        </li>

        <li>
            <a href="#mudar_monitor" class="modal-trigger">
                <i class="fas fa-user-edit black-text fa-2x"></i> Mudar Monitor
            </a>
        </li>


        <li><div class="divider"></div></li>
        <li>
            <a href="<?=HOME_URL?>/user/quit">
                <i class="fas fa-power-off black-text fa-2x"></i> Sair
            </a>
        </li>
    </ul>

    <div class="navbar-fixed">
        <nav class="black">
            <div class="nav-wrapper row">
                <div class="col s10 l1">
                    <a href="<?=HOME_URL?>" class="brand-logo flow-text left">SMA</a>
                </div>


                <div class="hide-on-med-and-down container col l9">
                    <ul>
                        <li>
                            <a href="<?=HOME_URL?>/aluno/cadastrar" class="nav-item">
                                <i class="fas fa-user-plus"></i> <span>Cadastrar Aluno</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?=HOME_URL?>/almoco/gerenciar" class="nav-item">
                                <i class="fas fa-utensils"></i> <span>Gerenciar Almoços</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?=HOME_URL?>/aluno/cadastrados" class="nav-item">
                                <i class="fas fa-users"></i> <span>Alunos Cadastrados</span>
                            </a>
                        </li>
                    </ul>
                </div>


                <a href="#" class="right right-align col s2"  id="opnMenu" data-activates="nav-mobile">
                    <span class="hide-on-med-and-down"><?=$this->user['nome']?></span>
                    <i class="fas fa-bars fa-2x right" style="line-height: inherit;"></i>
                </a>
            </div>
        </nav>
    </div>
</header>
