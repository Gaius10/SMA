<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<div id="almoco">
    <aside id="status_almoco">
        <h1>Informações</h1>
        <?php if (!empty($this->alunos)): ?>
            <ul>
                <li>
                    <label>Cardapio:</label>
                    <span title="<?=$this->infos['card']?>"><?=$this->infos['card']?></span>
                </li>
                <li>
                    <label>Almoços: </label>
                    <span><?=(int)$this->infos['info']['alm']?></span>
                </li>
                <li>
                    <label>Repetições: </label>
                    <span><?=(int)$this->infos['info']['rep']?></span>
                </li>
                <li>
                    <label>Ocorrências: </label>
                    <span><?=(int)$this->infos['info']['oc']?></span>
                </li>
            </ul>
        <?php endif ?>
    </aside>


    <section id="lista_alunos">
        <h1>Almoços - Hoje <span><?= date('d / m / Y') ?></span></h1>
        <ul>
            <li class="list-title">
                <div class="aluno">
                    <label title="Aluno"><strong>Aluno</strong></label>
                    <label title="Turma"><i class="fa fa-book"></i></label>
                </div>
                
                <div class="dados dados-title">
                    <label title="Repetições"><i class="fa fa-sync-alt"></i></label>
                    <label title="Ocorrências"><i class="fa fa-times-circle"></i></label>
                </div>
            </li>

            <?php if (!empty($this->alunos)): ?>
                <?php foreach ($this->alunos as $k => $a): ?>
                    <li onclick="verDados(<?=$a['alu_c']?>)">
                        <div class="aluno">
                            <label title="<?=$a['info']['n']?>"><?=$a['info']['n']?></label>
                            <label title="<?=$a['info']['t']?>"><?=$a['info']['t']?></label>
                            <label title="Dados" class="only-mob">
                                <i id="c<?=$a['alu_c']?>" class="fa fa-caret-down"></i>
                            </label>
                        </div>

                        <div class="dados" id="dados_aluno<?=$a['alu_c']?>">
                            <label title="Repetições">
                                <span class="only-mob"><i class="fa fa-sync-alt"></i></span>
                                <?=$a['rep']?>
                            </label>
                            <label title="Ocorrências">
                                <span class="only-mob"><i class="fa fa-times-circle"></i></span>
                                <?=(int)$a['oc']['qtd']?>
                            </label>
                            <button class="btnOcorrencia" 
                                onclick="novaOcorrencia(<?=$a['alu_c']?>, '<?=$a['info']['n']?>')">
                                <i class="fa fa-plus" style="color: red;"></i>
                                Ocorrência
                            </button>
                        </div>
                        <script>
                            if (screen.width < 1024) { 
                                document.getElementById('dados_aluno<?=$a['alu_c']?>').style.display = "none"; 
                            }
                        </script>
                    </li>
                <?php endforeach ?>
            <?php else: ?>
                <li>
                    <label>Nenhum aluno almoçou ou o almoço nao foi iniciado</label>
                </li>
            <?php endif ?>
        </ul>
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

    <?php if (isset($_GET['msg'])) include MODAL_PATH . '/msg.modal.php'; ?>
</div>
