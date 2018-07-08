<?php if (!defined('ROOT_PATH')) exit(); ?>
<main class="row" style="width: 100%;">
    <!-- Modal de ocorrencia -->
    <?php include MODAL_PATH . '/nova_ocorrencia.php'; ?>
    <!-- Modal de confirmação -->
    <?php include MODAL_PATH . '/confirmacao_com_senha.php'; ?>

    <section title="Lista de alunos cadastrados" class="col s12 l8 push-l2">
        <div class="card" style="min-height: 450px">
            <div class="card-content">
                <h5 class="card-title center">Alunos Cadastrados</h5>

                <ul class="collapsible popout">

                    <li>
                        <form method="post">
                            <div class="row">
                                <div class="input-field col s9 l9">
                                    <input type="search" name="aluno">
                                    <label>Aluno</label>
                                </div>
                                <div class="input-field col s3 l3">
                                    <div class="row">
                                        <select name="turma" class="col s8" onchange="this.form.submit()">
                                            <option value="" disabled selected><i class="fas fa-book left"></i></option>
                                            <option value="1A">1A</option>
                                            <option value="2A">2A</option>
                                            <option value="3A">3A</option>
                                            <option value="1B">1B</option>
                                            <option value="2B">2B</option>
                                            <option value="3B">3B</option>
                                            <option value="1C">1C</option>
                                            <option value="2C">2C</option>
                                            <option value="3C">3C</option>
                                            <option value="1D">1D</option>
                                            <option value="2D">2D</option>
                                            <option value="3D">3D</option>
                                            <option value="1E">1E</option>
                                            <option value="2E">2E</option>
                                            <option value="3E">3E</option>
                                            <option value="1F">1F</option>
                                            <option value="2F">2F</option>
                                            <option value="3F">3F</option>
                                        </select>
                                        <button class="btn col s4 red darken-4 hide-on-med-and-down" style="margin-top: 0.5em;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                    

                    <?php if ($this->alunos): ?>
                    <?php foreach ($this->alunos as $k => $a): ?>
                        
                    <li>
                        <div class="collapsible-header row" title="<?=$a['n']?>">
                            <span class="col s9 left-align"><?=$a['n']?></span>
                            <span class="col s3"><?=$a['t']?></span>
                        </div>
                        <div class="collapsible-body row">

                            <img src="<?=QR_URL?>/alunos/<?=$a['n'].'_'.$a['t']?>.png" class="responsive-img col l2">

                            <p class="flow-text">
                                <span class="left col s6 l3">Código: <?=$a['alu_c']?></span>
                                <span class="left col s6 l2" title="Ocorrências"><i class="fas fa-times-circle red-text"></i> <?= $a['oc'] > 0 ? $a['oc']['qtd'] : '0' ?></span>
                            </p>
                            
                            <a href="#new_oc" class="modal-trigger btn-large red darken-3 col s5 l2  left" title="Nova ocorrência" onclick="newOc('<?=$a['alu_c']?>', '<?=$a['n']?>')">
                                <i class="fas fa-user-times"></i>
                            </a>
                            
                            <a href="#confirmacaoComSenha" class="modal-trigger btn-large red darken-3 col s5 l2 right" title="Excluir aluno" onclick="confirmarComSenha('O aluno será excluído.', 'formExcluir', 'passExcluir')">
                                <i class="fas fa-user-minus"></i>
                            </a>
                            <form method="post" action="<?= HOME_URL ?>/aluno/excluir" id="formExcluir" hidden>
                                <input type="hidden" name="cod" value="<?=$a['alu_c']?>">
                                <input type="hidden" name="pass" id="passExcluir">
                            </form>

                            <?php if ($a['oc']): ?>
                            <?php unset($a['oc']['qtd']) ?>

                            <div class="modal" id="oc<?=$k?>">
                                <div class="modal-content">
                                    <h5 class="center">Ocorrências</h5>

                                    <?php foreach ($a['oc'] as $k2 => $oc): ?>

                                    <div class="card">
                                        <div class="card-content" style="padding: 24px;">
                                            <p class="flow-text"><?=$oc['oc']?></p>
                                            <span class="right"><?=convertData($oc['dat'])?></span>
                                        </div>
                                    </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                            <a href="#oc<?=$k?>" class="modal-trigger btn red darken-3 col s8 push-s2 l3" title="Ver ocorrências">Ocorrências</a>

                            <?php endif ?>

                        </div>
                    </li>

                    <?php endforeach ?>
                    <?php else: ?>
                        <h5 class="center">Nenhum aluno cadastrado</h5>
                    <?php endif ?>

                </ul>

            </div>
        </div>
    </section>


</main>
