<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<!--JANELA MODAL ENCOMENDA SISTEMA QR-->
<section class="modal" hidden>
    <a class="modal_fechar" id="jmodalEncomendaClose" href="#">
        <i class="fa fa-close close"></i>
    </a>
    <div class="modal_txt">
        <form>
            <h3>Preencha os campos abaixo:</h3>
            <br>

            <span>Nome :</span>
            <input type="text">
            <br>
            <span>E-mail:</span>
            <input type="text">
            <br><br>
            <span>Nos descreva sua necessidade:</span>
            <textarea name="encomenda" rows="6" placeholder="Informações como seu ramo de negócios e o que deseja controlar com QRcode podem nos ajudar a 'materializar sua ideia'. Obrigado."></textarea>
            <input type="button" class="btnmodal" value="enviar">
        </form>
    </div>
</section>