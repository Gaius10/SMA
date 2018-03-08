<?php
use mvc\MainController;
/**
 * LoginController - Controller da pagina de login
 * 
 * @author Caio Corrêa Chaves
 */
class LoginController extends MainController
{
    
    /**
     * function index()
     * 
     * Mostrar Formulário de login
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        if ($this->loggedIn) {
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
            } else {
                header("Location: " . HOME_URL . "/almoco");
            }
        } else {
            $this->title = "SMA - Login";

            $styleRequires = [
                'login',
                'menu-propagandas', 
                'footer',
                'modal',
                'modal/cadastre-se',
                'modal/suporte',
                'modal/encomenda',
                'modal/trocar-adm'
            ];

            include VIEWS_PATH . "/_includes/header.php";
            include VIEWS_PATH . "/_includes/menu-propagandas.php";
            include VIEWS_PATH . "/login.view.php";
            include VIEWS_PATH . "/_includes/footer.php";
        }
    }




    /**
     * function cadastro()
     * 
     * Validar cadastro de novo monitor
     * 
     * @access public
     * @return void
     */
    public function cadastro()
    {
        $this->model = $this->loadModel('usuario/Cadastro');

        $dados = [
            "MONITOR_NOME" => $_POST['userNome'],
            "MONITOR_LOGIN" => $_POST['userLogin'],
            "MONITOR_EMAIL" => $_POST['userEmail'],
            "MONITOR_SENHA" => $_POST['userPass'],
            "passConfirm" => $_POST['userPassConfirm']
        ];


        if($this->model->cadastrarMonitor($dados)) {
            /* Em caso de sucesso */
            $msg = "Obrigado por se cadastrar";
        } else {
            /* Em caso de falha */
            $msg = "{$this->model->error}";
        }
        
        header("Location: " . HOME_URL . "/login/?msg=$msg");
    }
}
