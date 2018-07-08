<?php if (!defined('ROOT_PATH')) exit(); ?>
<main class="container row">

    <style type="text/css">
        @media only screen and (min-width: 993px) {
            #estats {
                left: -1em;
            }
        }
    </style>

    <section class="card col s12 l4" title="Estatísticas" id="estats">
        <div class="card-content row">
            <h5 class="card-title center">Estatísticas do mês atual</h5>

            <table class="col s8 push-s2">
                <tbody>
                    <tr>
                        <td>Almoços</td>
                        <td class="right-align"><?=(int)$this->infos['alm']?></td>
                    </tr>
                    <tr>
                        <td>Repetições</td>
                        <td class="right-align"><?=(int)$this->infos['rep']?></td>
                    </tr>
                    <tr>
                        <td>Ocorrências</td>
                        <td class="right-align"><?=(int)$this->infos['oc']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="card col s12 l8 right" title="Almoços">
        <div class="card-content row">

            <h5 class="card-title col l6">Almoços Registrados</h5>

            <div class="input-field col s4 push-s4 push-l1" style="margin-top: 0;">
                <select class="validate" id="selectYear">
                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                    <option value="<?=$i?>" <?php $i == $this->date[0] ? 'selected' : '' ?>><?=$i?></option>
                    <?php endfor ?>
                </select>
            </div>

            <div class="col s12 l12">
                <ul class="tabs">
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '01') ? 'active' : ''?>" href="#mes1"> Janeiro</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '02') ? 'active' : ''?>" href="#mes2"> Fevereiro</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '03') ? 'active' : ''?>" href="#mes3"> Março</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '04') ? 'active' : ''?>" href="#mes4"> Abril</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '05') ? 'active' : ''?>" href="#mes5"> Maio</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '06') ? 'active' : ''?>" href="#mes6"> Junho</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '07') ? 'active' : ''?>" href="#mes7"> Julho</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '08') ? 'active' : ''?>" href="#mes8"> Agosto</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '09') ? 'active' : ''?>" href="#mes9"> Setembro</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '10') ? 'active' : ''?>" href="#mes10">Outubro</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '11') ? 'active' : ''?>" href="#mes11">Novembro</a></li>
                    <li class="tab"><a class="waves waves-effect waves-red red-text text-darken-3 <?=(date('m') == '12') ? 'active' : ''?>" href="#mes12">Dezembro</a></li>
                    <li class="indicator black"></li>
                </ul>

                <section id="almocos" class="row" style="min-height: 300px;">
                    <?php for ($i = 1; $i <= 12; $i++): ?>

                    <div id="mes<?=$i?>" class="collection col s12">
                        <?php if (empty($this->almocos['0' . $i])): ?>
                        <h5 class="flow-text">Não houve almoços nesse mês</h5>

                        <?php else: ?>
                        <?php foreach ($this->almocos['0' . $i] as $key => $alm): ?>

                        <a class="collection-item left-align row" href="<?=HOME_URL?>/almoco/gerenciar/<?=str_replace('-', '/', $alm['dat'])?>">
                            <div class="col s8 l9">
                                <p class="black-text title truncate tooltipped flow-text" data-position="left" data-tooltip="Cardápio"><?=$alm['card']?></p>
                                <span class="black-text tooltipped right" data-position="left" data-tooltip="data"><?=convertData($alm['dat'])?></span>
                            </div>
                            <div class="secondary-content col s4 l3">
                                <p class="row">
                                    <span class="blue-text left col s6 truncate tooltipped flow-text" data-position="top" data-tooltip="Almoços"><?=$alm['qtd_alm']?></span>
                                    <span class="red-text right col s6 truncate tooltipped flow-text" data-position="top" data-tooltip="Ocorrências"><?=$alm['qtd_oc']?></span>
                                </p>
                            </div>
                        </a>

                        <?php endforeach ?>
                        <?php endif ?>
                    </div>

                    <?php endfor ?>
                </section>
            </div>
        </div>
    </section>
</main>
