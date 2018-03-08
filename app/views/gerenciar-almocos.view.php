<?php if (!defined('ROOT_PATH')) exit('Erro Interno'); ?>
<div id="contentGerenciar">

    <aside id="dados_globais">
        <div id="title">
            <h1>Dados globais de</h1>
            <form method="get">
                <select name="global"  onchange="this.form.submit()">
                    <option value="all" <?= $ver2 == 'all' ? 'selected' : '' ?>>
                        Todos Almoços
                    </option>
                    <option value="week" <?= $ver2 == 'week' ? 'selected' : '' ?>>
                        Ultima semana
                    </option>
                    <option value="mounth" <?= $ver2 == 'mounth' ? 'selected' : '' ?>>
                        Ultimo Mês
                    </option>
                </select>
            </form>
        </div>

        <ul id="global_data">
            <?php if ($this->infos): ?>
                <li>
                    <label>
                        <i class="fa fa-utensils"></i>
                        Almoços:
                    </label>
                    <span><?= (int) $this->infos['alm'] ?></span>
                </li>
                <li class="gray">
                    <label>
                        <i class="fa fa-sync-alt"></i>
                        Repetições:
                    </label>
                    <span><?= (int) $this->infos['rep'] ?></span>
                </li>
                <li>
                    <label>
                        <i class="fa fa-times-circle"></i>
                        Ocorrências:
                    </label>
                    <span><?= (int) $this->infos['oc'] ?></span>
                </li>
            <?php endif ?>
        </ul>
    </aside>

    <section id="gerenciar">
        <div id="title">
            <h1>Dados dos almoços</h1>
            <form method="get">
                <label>
                    Você está vendo:
                    <select name="view" onchange="this.form.submit()">
                        <option value="all" <?= $ver ?>>  
                            Todos Almoços
                        </option>
                        <option value="week" <?= $ver == 'week' ? 'selected' : '' ?>>
                            Ultima Semana
                        </option>
                        <option value="mounth" <?= $ver == 'mounth' ? 'selected' : '' ?>>
                            Ultimo Mês
                        </option>
                    </select>
                </label>
            </form>
        </div>

        <nav id="lista_almocos">
            <ul>
                <strong>
                    <li>
                        <label class="data" title="Data do almoço">Data</label>
                        <label class="card" title="Cardápio do dia">Cardapio</label>
                        <label class="qtdA" title="Almoços"><i class="fa fa-utensils"></i></label>
                        <label class="qtdR" title="Repetições"><i class="fa fa-sync-alt"></i></label>
                        <label class="qtdO" title="Ocorrências"><i class="fa fa-times-circle"></i></label>
                    </li>
                </strong>

                <?php if (!empty($this->almocos)): ?>
                    <?php foreach ($this->almocos as $k => $a): ?>
                        <li <?= $k % 2 == 1 ? ' class="gray"' : '' ?>
                            onclick="window.location.href = '<?=HOME_URL?>/almoco/gerenciar/<?=$a['dat']?>'">
                            <label class="data"><?=convertData($a['dat'])?></label>
                            <label class="card"><?= $a['card'] ?></label>
                            <label class="qtdA" title="Almoços"><?= (int) $a['qtd_alm'] ?></label>
                            <label class="qtdR" title="Repetições"><?= (int) $a['rep'] ?></label>
                            <label class="qtdO" title="Ocorrências"><?= (int) $a['qtd_oc'] ?></label>
                        </li>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
    </nav>
</section>
</div>

<div id="modals">
    <?php include MODAL_PATH . '/encomenda.modal.php'; ?>
    <?php include MODAL_PATH . '/confirmacao.modal.php'; ?>
    <?php include MODAL_PATH . '/ocorrencia.modal.php'; ?>

    <!-- Modals do menu -->
    <?php include MODAL_PATH . '/iniciar-almoco.modal.php'; ?>
    <?php include MODAL_PATH . '/novo-monitor.modal.php'; ?>
    <?php include MODAL_PATH . '/meus-dados.modal.php'; ?>
    <?php include MODAL_PATH . '/trocar-adm.modal.php'; ?>

    <?php if (isset($_GET['msg'])) include MODAL_PATH . '/msg.modal.php'; ?>
</div>
