<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<!--JANELA MODAL ENCOMENDA SISTEMA QR-->
<section class="modal" id="encomendaModal" title="Encomende seu sistema">
    <h1>Preencha os campos abaixo:</h1>
    <form action="<?= HOME_URL ?>/suporte/encomenda">

        <div id="lineOne">
            <label>
                <span>Nome:</span>
                <input type="text" name="cliNome">
            </label>
            <label>
                <span>E-mail:</span>
                <input type="text" name="cliEmail">
            </label>
        </div>

        <label id="msgText">
            <span>Nos descreva sua necessidade:</span>
            <textarea name="cliMessage" rows="6" placeholder="Informações como seu ramo de negócios e o que deseja controlar com QRcode podem nos ajudar a 'materializar sua ideia'..."></textarea>
        </label>
        
        <div id="buttons">
            <label class="btn">
                <button onclick="closeModal('encomendaModal'); return false">
                    <i class="fa fa-arrow-left"></i>
                    Cancelar
                </button>
            </label>
            <label class="btn">
                <button>
                    <i class="fa fa-check"></i>
                    Enviar Pedido
                </button>
            </label>
        </div>
    </form>
</section>
