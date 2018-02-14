<?php
use mvc\MainController;
/**
 * Classe responsável por controlar a página de gerenciamento de almocos
 * 
 * @author Caio Corrêa Chaves
 */
class AlmocoController extends MainController
{
    /**
     * $periodo
     * 
     * Receberá dado referente ao periodo do qual os almocos serao mostrados
     * 
     * @var string
     * @access private
     */
    private $periodo;

    /**
     * function index()
     * 
     * Função que mostra os dados solicitados
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        ## Ver se usuário está logado
        if (!$this->loggedIn) {
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }

            $this->title = "Bem vindo ao SMA";
            $pag = "";
            $styleRequires = [
                "menu",
                "almoco",
                "modal",
                "footer",
                // modals
                "modal/encomenda",
                "modal/novo-monitor",
                "modal/iniciar-almoco",
                "modal/meus-dados",
                "modal/confirmacao",
                "modal/ocorrencia"
            ];

            include VIEWS_PATH . "/_includes/header.php";
            include VIEWS_PATH . "/_includes/menu.php";
            include VIEWS_PATH . "/almoco.view.php";
            include VIEWS_PATH . "/_includes/footer.php";
        }
    }

    /**
     * function gerenciar()
     * 
     * Função responsavel por mostrar views de gerenciamento de almocos e fazer
     * processamentos necessarios
     * 
     * @access public
     * @return void
     */
    public function gerenciar()
    {
        if (!$this->loggedIn) {
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }

            $pag = "ger_alm";

            $styleRequires = [
                "menu",
                "modal",
                "footer"
            ];

            include VIEWS_PATH . "/_includes/header.php";
            include VIEWS_PATH . "/_includes/menu.php";
            include VIEWS_PATH . "/_includes/footer.php";
        }
    }

    /**
     * function estatisticas()
     * 
     * Função responsavel por mostrar estatisticas dos almocos desejados
     * 
     * @access public
     * @return void
     */
    public function estatisticas()
    {
        if (!$this->loggedIn) {
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }
            
            $pag = "ests";

            $styleRequires = [
                "menu",
                "modal",
                "footer"
            ];

            include VIEWS_PATH . "/_includes/header.php";
            include VIEWS_PATH . "/_includes/menu.php";
            include VIEWS_PATH . "/_includes/footer.php";
        }
    }
}
