<?php if (!defined('ROOT_PATH')) exit("Erro Interno"); ?>
<section id="ocorrencia" class="modal">
    <h1>Nova ocorrencia</h1>
    <form action="<?= HOME_URL ?>/user/novaOcorrencia/">
        <label>
            <span>Nome do aluno:</span>
            <input type="hidden" name="codAluno" id="cod_aluno">
            <input type="text" id="nome_aluno">
        </label>
        <label>
            <span>Descrição do ocorrido:</span>
            <textarea name="descOcorrencia" required></textarea>
        </label>
        <label>
            <span>Senha do monitor:</span>
            <input type="password" name="pass" required>
        </label>
        <div class="buttons">
            <button>
                <i class="fa fa-plus"></i>
                Registrar
            </button>
            <button onclick="closeModal('ocorrencia'); return false;">
                <i class="fa fa-arrow-left"></i>
                Cancelar
            </button>
        </div>
    </form>

</section>
