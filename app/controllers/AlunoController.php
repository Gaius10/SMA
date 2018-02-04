<?php
use mvc\MainController;
/**
 * AlunoController Controlador de acoes relacionadas ao aluno
 * @author Caio Corrêa Chaves
 */
class AlunoController extends MainController
{
    /**
     * $ultimoAluno
     * 
     * Receberá os dados do ultimo aluno cadastrado
     * 
     * @var array
     * @access public
     */
    private $ultimoAluno;

    /**
     * function cadastrar($aluno)
     * 
     * Funçao que cadastra novo aluno ou mostra formulario de cadastro
     * 
     * @access public
     * @param array|null $aluno Dados do aluno a ser cadastrado
     * @return void
     */
    public function cadastrar()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL . "/login");
        } else {
            // Cadastrar novo aluno
            if (isset($_POST['alunoNome']) and isset($_POST['alunoAno'])) {
                $dados = [
                    "ALUNO_NOME" => $_POST['alunoNome'],
                    "ALUNO_TURMA" => $_POST['alunoAno']
                ];
                
                $this->model = $this->loadModel('aluno/GerenciarAluno');

                if (!$this->model->cadastrarAluno($dados)) {
                    $msg = $this->model->error;
                    header('Location: '.HOME_URL."/aluno/cadastrar/?msg=$msg");
                }
            }

            // Obter dados do ultimo aluno cadastrado
            $this->model = $this->loadModel('aluno/GerenciarAluno');
            $this->ultimoAluno = $this->model->montarUltimoAluno();

            // Mostrar página
            $this->title = "SMA - Cadastrar Aluno";
            $pag = "new_aluno";
            $styleRequires = [
                "menu",
                "cadastrar-aluno",
                "modal",
                "footer",
                /*modais*/
                "modal/meus-dados",
                "modal/iniciar-almoco",
                "modal/novo-monitor",
                "modal/confirmacao"
            ];

            include VIEWS_PATH . "/_includes/header.php";
            include VIEWS_PATH . "/_includes/menu.php";
            include VIEWS_PATH . "/cadastrar-aluno.view.php";
            include VIEWS_PATH . "/_includes/footer.php";
        }
    }

    /**
     * function cadastrados()
     * 
     * Função que mostrará os alunos cadastrados
     * 
     * @access public
     * @return void
     */
    public function cadastrados()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL . "/login");
        } else {
            $pag = "ver_al";
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
     * function excluir()
     * 
     * Exclui determinado aluno determinado via POST
     * 
     * @access public
     * @return void
     */
    public function excluir()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL . "/login");
        } else if (empty($_POST['cod']) || empty($_POST['pass'])) {
            header("Location: " . HOME_URL);
        } else {

            $this->model = $this->loadModel('aluno/GerenciarAluno');
            if ($this->model->excluir($_POST['cod'], $_POST['pass'])) {
                $msg = urlencode("Aluno excluído");
            } else {
                $msg = urlencode($this->model->error);
            }
            $red = explode('?', $_SERVER['HTTP_REFERER']);
            $red = $red[0];
            header("Location: " . $red . "?msg=$msg");
        }
    }
}
