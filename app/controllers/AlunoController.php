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
     * @access private
     */
    private $ultimoAluno;

    /**
     * $alunos
     * 
     * Recebera os dados de todos os alunos cadastrados
     * 
     * @var array
     * @access private
     */
    private $alunos;

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
     * Função que mostrará os alunos cadastrados no sistema
     * 
     * @access public
     * @return void
     */
    public function cadastrados()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL . "/login");
        } else {
            /* Carregar alunos cadastrados */
            $this->model = $this->loadModel('aluno/GerenciarAluno');
            $this->alunos = $this->model->load();

            if (is_array($this->alunos)) {
                $this->alunos = makeDataArray($this->alunos);
                foreach ($this->alunos as $k => $aluno) {
                    $this->model->makeImg($aluno['q']);
                }
            }

            /* Mostrar conteúdo ao usuário */
            $pag = "ver_al";
            $styleRequires = [
                "modal",
                "menu",
                "cadastrados",
                "footer",
                /* modals */
                "modal/meus-dados",
                "modal/iniciar-almoco",
                "modal/novo-monitor",
                "modal/ocorrencia",
                "modal/confirmacao"
            ];

            include VIEWS_PATH . "/_includes/header.php";
            include VIEWS_PATH . "/_includes/menu.php";
            include VIEWS_PATH . "/cadastrados.view.php";
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
        if (!$this->loggedIn || 
            (empty($_POST['cod']) || empty($_POST['pass']))
        ) {
            header("Location: " . HOME_URL . "/login");
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

    /**
     * function ocorrencia()
     * 
     * Registra ocorrencia de determinado aluno
     * 
     * @access public
     * @return void
     */
    public function ocorrencia()
    {
        // Verificar existencia dos dados
        if (!isset($_POST['codAluno']) ||
            !isset($_POST['descOcorrencia']) ||
            !isset($_POST['pass'])
        ) {
            header("Location: " . HOME_URL);
        } else {
            // Montar variavel com os dados
            $dados = array(
                "cod" =>        $_POST['codAluno'],
                "ocorrencia" => str_replace(PHP_EOL, '<br />', $_POST['descOcorrencia']),
                "pass" =>       $_POST['pass']
            );
            
            // Cadastrar no banco de dados
            $this->model = $this->loadModel('aluno/GerenciarAluno');
            $msg = null;

            if ($this->model->ocorrencia($dados)) {
                $msg = urlencode("Sua ocorrencia foi registrada");
            } else {
                $msg = urlencode($this->model->error);
            }
            
            $red = explode('?', $_SERVER['HTTP_REFERER']);
            $red = $red[0];
            header("Location: " . $red . "?msg=$msg");
        }   
    }

    /**
     * function alterarDados()
     * 
     * Funçao responsavel por alterar dados de determinado aluno
     * 
     * @access public
     * @return void
     */
    public function alterarDados()
    {
        // Verificar existencia dos dados
        if (!isset($_POST['cod']) ||
            !isset($_POST['alunoNome']) ||
            !isset($_POST['alunoTurma']) ||
            !isset($_POST['pass']) ||
            !$this->loggedIn
        ) {
            header("Location: " . HOME_URL);
        } else {
            // Organizar dados corretamente
            $dados = array(
                "ALUNO_COD" => $_POST['cod'],
                "ALUNO_NOME" => $_POST['alunoNome'],
                "ALUNO_TURMA" => $_POST['alunoTurma'],
            );
            $pass = $_POST['pass'];

            // Alterar os dados do aluno
            $this->model = $this->loadModel('aluno/GerenciarAluno');

            $msg = null;
            if ($this->model->alterar($dados, $pass)) {
                $msg = urlencode("Dados alterados com sucesso.");
            } else {
                $msg = urlencode($this->model->error);
            }

            $red = explode('?', $_SERVER['HTTP_REFERER']);
            $red = $red[0];

            header("Location: " . $red . "/?msg=$msg");
        }
    }
}
