<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
    <!--LINK ENCOMENDA SISTEMA QR-->
    <footer class="page-footer black center-align" style="padding: 5px 0;">
        <label class="container"><p class="white-text flow-text">Precisa de um sistema de controle? Contate-nos!</p></label>
        

        <section id="encomendaModal" title="Encomende seu sistema">
            <!-- <form class="row container" method="post" style="max-width: 600px;" action="<?= HOME_URL ?>/suporte/encomenda"> -->
            <form class="row container" method="post" style="max-width: 600px;" action="">
                <div class="col s12 l6 input-field">
                    <input type="text" name="cliNome" class="validate footer" id="cliNome">
                    <label for="cliNome" class="footer">Seu nome</label>
                </div>
                <div class="col s12 l6 input-field">
                    <input type="text" name="cliEmail" class="validate footer" id="cliEmail">
                    <label for="cliEmail" class="footer">Seu Email</label>
                </div>

                <div class="col s12 input-field">
                    <textarea id="msg" class="materialize-textarea footer"></textarea>
                    <label for="msg" class="footer">Descreva sua necessidade</label>
                </div>

                <button class="btn-large col s12 l6 push-l3 red darken-3" type="submit">Enviar</button>
            </form>
        </section>
    </footer>


    <script type="text/javascript" src="<?=HOME_URL?>/app/views/_javascript/jquery.js"></script>
    <script type="text/javascript" src="<?=HOME_URL?>/app/views/_materialize/js/materialize.js"></script>
    <script type="text/javascript" src="<?=HOME_URL?>/app/views/_javascript/js_functions.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#opnMenu').sideNav({edge: 'right'});
            $('.modal').modal();
            $('select').material_select();
            $('.collapsible').collapsible();
            $('.tooltipped').tooltip();
            $('.tabs').tabs({swipeable: true, responsiveThreshold: 992});


            // selecionar ano desejado
            $('#selectYear').change(function(){
                window.location.replace('<?=HOME_URL?>/almoco/gerenciar/' + this.value + '/<?=isset($this->date[1])  ? $this->date[1] : ''?>');
            });
        });
    </script>

    <?php 
        if (isset($_GET['msg'])) {
            include VIEWS_PATH . '/_includes/modals/msg.php';
        }
    ?>
</body>
</html>
