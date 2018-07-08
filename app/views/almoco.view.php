<?php if (!defined('ROOT_PATH')) exit(); ?>
<main class="container row">

    <style type="text/css">
        @media only screen and (min-width: 993px) {
            aside#infos { left: -0.5em }
            section#alunos { right: -0.5em }
        }
    </style>

    <aside class="card col s12 l4" id="infos">
        <div class="card-content">
            <h5 class="card-title center">Informações</h5>

            <?php if (!empty($this->alunos)): ?>
            <table>
                <thead>
                    <tr>
                        <td>Data</td>
                        <td><?= convertData($this->infos['dat']) ?></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><p>Cardápio</p></td>
                        <td><p><?=$this->infos['card']?></p></td>
                    </tr>
                    <tr>
                        <td><p>Almoços</p></td>
                        <td><p><?=(int)$this->infos['info']['alm']?></p></td>
                    </tr>
                    <tr>
                        <td><p>Repetições</p></td>
                        <td><p><?=(int)$this->infos['info']['rep']?></p></td>
                    </tr>
                    <tr>
                        <td><p>Ocorrências</p></td>
                        <td><p><?=(int)$this->infos['info']['oc']?></p></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
            <h5 class="flow-text">Almoço não iniciado</h5>
            <?php endif ?>
        </div>
    </aside>



    <section class="card col s12 l8" id="alunos" style="min-height: 450px">
        <div class="card-content">
            <h5 class="card-title center">Alunos que almoçaram</h5>

            <div class="collection">
                <?php if (!empty($this->alunos)): ?>

                <?php foreach ($this->alunos as $k => $a): ?>

                <a href="#!" class="collection-item row">
                    <div class="col s8 l10 black-text">
                        <p class="flow-text truncate tooltipped" data-position="top" data-tooltip="<?=$a['info']['n']?>"><?=$a['info']['n']?></p>
                        <span class="flow-text right">
                            <i class="fas fa-sync-alt blue-text text-darken-4"></i> <?= $a['rep'] ?>
                            <i class="fas fa-times-circle red-text text-darken-4" style="margin-left: 1em"></i> <?= (int) $a['oc']['qtd'] ?>
                        </span>
                    </div>
                    <div class="secondary-content col s4 l2 black-text">
                        <span><?=$a['info']['t']?></span> <br >
                    </div>
                </a>

                <?php endforeach ?>

                <?php else: ?>
                
                <h5 class="flow-text">Nenhum aluno comeu</h5>

                <?php endif ?>
            </div>
        </div>
    </section>
</main>
