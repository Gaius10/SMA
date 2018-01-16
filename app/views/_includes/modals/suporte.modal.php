<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<!--JANELA MODAL **SUPORTE**-->
<div class="modal" id="suporteModal">
    <h1>Suporte</h1>
    <p>
        Envie aqui sua dúvida ou solicitação de suporte, nossa equipe está 
        pronta para te ajudar:
    </p>
    <form action="<?= HOME_URL ?>/suporte/solicitar">
        <label>
            <span>Nome:</span>
            <input type="text" name="nome" placeholder="Informe seu nome">
        </label>
        <label>
            <span>Email:</span>
            <input type="text" name="email" placeholder="Informe seu email">
        </label>
        <label>
            <span>Mensagem</span>
            <textarea name="suporteMsg"></textarea>
        </label>
        <label>
            <input type="submit" value="Contatar Suporte">
        </label>
    </form>
</div>