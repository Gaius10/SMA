<?php if (!defined('ROOT_PATH')) exit('Erro Interno'); ?>
<section id="filtro" class="modal">
    <h1 class="only-mob">Filtrar aluno(s)</h1>
    <form method="post" action="<?=HOME_URL?>/aluno/cadastrados/1">
        <?php $nome = isset($filters['nome']) ? $filters['nome'] : ""; ?>
        <?php $turma = isset($filters['turma']) ? $filters['turma'] : ""; ?>
        <label>
            <span class="only-mob">Nome</span>
            <input type="text" name="alunoNome" placeholder="Nome" value="<?=$nome?>">
        </label>
        <label>
            <span class="only-mob">Turma</span>
            <input type="text" name="alunoTurma" placeholder="Turma" value="<?=$turma?>">
        </label>
        <div class="buttons">
            <label class="btn">
                <button>
                    <i class="fa fa-search"></i>
                    Filtrar
                </button>
            </label>
            <label class="btn">
                <button onclick="closeModal('filtro')" class="only-mob">
                    <i class="fa fa-arrow-left"></i>
                    Voltar
                </button>
            </label>
        </div>
    </form>
</section>
<script>
    if (screen.width > 1024) {
        document.getElementById('filtro').removeAttribute('class');
    }
</script>
