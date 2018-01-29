<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<!--JANELA MODAL **SUPORTE**-->
<section class="modal" id="suporteModal" title="Suporte - envie sua dúvida">
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
        <label id="msg">
            <span>Mensagem</span>
            <textarea name="suporteMsg"></textarea>
        </label>
        <label class="btn">
            <button>
                <i class="fa fa-check"></i>
                Solicitar Suporte
            </button>
        </label>
        <label class="btn">
            <button onclick="closeModal('suporteModal'); return false;">
                <i class="fa fa-arrow-left fa-lg"></i>
                Voltar
            </button>
        </label>
    </form>
</section>
