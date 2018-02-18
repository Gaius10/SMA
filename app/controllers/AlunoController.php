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
     * $errors
     * 
     * Receberá possíveis erros durante a execução da aplicação
     * 
     * @access private
     * @var array
     */
    private $errors = array();

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
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }
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
     * @param array $filter Indica se serão aplicados ou nao os filtros na busca 
     *                      de alunos. Deverá conter um elemento do tipo bool
     * 
     * @access public
     * @return void
     */
    public function cadastrados($filter)
    {
        if (!$this->loggedIn) {
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }

            // Verificar se filtros foram solicitados
            if ($filter == true and
                isset($_POST['alunoNome']) and
                isset($_POST['alunoTurma'])
            ) {
                $filters = array(
                    'nome' => $_POST['alunoNome'], 
                    'turma' => $_POST['alunoTurma']
                );
            } else {
                $filters = array();
            }

            /* Carregar alunos cadastrados */
            $this->alunos = ($this->loadModel('almoco/Almoco'))->loadAlunos();

            if (is_array($this->alunos)) {
                $this->model = $this->loadModel('aluno/GerenciarAluno');
                $this->alunos = makeDataArray($this->alunos);
                foreach ($this->alunos as $k => $aluno) {
                    $fName = $aluno['n'] . '_' . $aluno['t'] . '.png';
                    if (!file_exists(QR_PATH  . '/alunos/' . $fName)) {
                        $this->model->makeImg($aluno['q']);
                    }
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
                "modal/confirmacao",
                "modal/filtro"
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
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }

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
            !isset($_POST['pass']) ||
            !$this->loggedIn
        ) {
            $this->logout(true);
        } else {
            // Se uma pagina foi solicitada antes do ato do login
            if (isset($_SESSION['gotoUrl'])) {
                $this->gotoPage($_SESSION['gotoUrl']);
                exit();
            }

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
    
    /* --------------------------------------------------------------------- */
    /* --------------------------------------------------------------------- */
    /* --------------------------------------------------------------------- */
    /* --------------------------------------------------------------------- */
    /* --------------------------------------------------------------------- */
    /* --------------------------------------------------------------------- */
    /**
     * function  almocar($aluno)
     * 
     * Função excecutada quando o monitor ler o QR Code do aluno
     * 
     * @access public
     * @return void
     * @param array $aluno Dados do aluno criptografados em base64
     */
    public function almocar(array $aluno)
    {
        $aluno = $aluno[0];
        // Verificar se usuário está logado
        if (!$this->loggedIn) {
            $this->logout(true);
            exit();
        }
        // Se uma pagina foi solicitada antes do ato do login
        if (isset($_SESSION['gotoUrl'])) {
            $this->gotoPage($_SESSION['gotoUrl']);
            exit();
        }

        // Verificar validade dos dados do aluno
        $this->model = $this->loadModel('aluno/Aluno');
        if (!$this->model->validarAluno($aluno)) {
            // Caso sejam inválidos, o programa nao irá mostrar nada alem do 
            // erro
            $this->errors[] = "Dados do aluno inválidos";
            include VIEWS_PATH . "/aluno-invalido.php";
        } else {
            // Montar dados do aluno no objeto
            if (!$this->model->mount()) {
                $this->errors[] = $this->model->error;
            }

            // Verificar se almoco já foi iniciado
            $almoco = $this->loadModel('almoco/Almoco');
            $iniciado = $almoco->initiated();

            // Receberá valor booleano, indica se o aluno já almocou ou está
            // almocando no momento da leitura do QR Code
            $almocou = null;

            // Obter codigo do almoco em questão
            $codAlmoco = $almoco->getCod();
            
            // ALMOCANDO
            if (!$iniciado) {
                $this->errors[] = "Almoço ainda não iniciado";
            } else {
                // Testar se o aluno já almocou
                $almocou = $this->model->almocou($codAlmoco);
                if ($almocou) {
                    $this->errors[] = "{$this->model->nome} já almoçou";
                } else {
                    // Registrar almoco do aluno
                    if (!$this->model->almocar($codAlmoco)) {
                        $this->errors[] = $this->model->error;
                    }
                }
            }

            /****** Mostrar views necessarias ******/
            $pag = "";
            $this->title = $this->model->nome . " - " . $this->model->turma;

            $styleRequires = array(
                "menu",
                "gerenciar-aluno",
                "modal",
                "footer",
                // modais 
                "modal/encomenda",
                "modal/iniciar-almoco",
                "modal/ocorrencia",
                "modal/confirmacao",
                "modal/meus-dados",
                "modal/novo-monitor"
            );

            include VIEWS_PATH . '/_includes/header.php';
            include VIEWS_PATH . '/_includes/menu.php';
            include VIEWS_PATH . '/gerenciar-aluno.view.php';
            include VIEWS_PATH . '/_includes/footer.php';
        }
    }

    /**
     * function repetir($cods)
     * 
     * Registra repetição de determinado aluno
     * 
     * @param array $cods Codigos do aluno e do almoco em questao
     *  -> Deve possuir o formato: 
     *     $cods = [0 => <cod_aluno>, 1 => <cod_almoco>]
     * 
     * @access public
     * @return void
     */
    public function repetir(array $cods)
    {
        // Checar login
        if (!$this->loggedIn) {
            $this->logout(true);
        } elseif (
            /* Checar se toda a informação necessária foi enviada */
            empty($cods) || 
            empty($cods[0]) ||
            empty($cods[1]) ||
            count($cods) != 2
        ) {
            $red = explode('?', $_SERVER['HTTP_REFERER']);
            $red = $red[0];

            header("Location: " . $red);
        } else {
            $codAluno = $cods[0];
            $codAlmoco = $cods[1];

            $this->model = $this->loadModel('aluno/Aluno');

            $msg = null;
            if ($this->model->repetir($codAluno, $codAlmoco)) {
                $msg = urlencode('Repetição registrada');
            } else {
                $msg = urlencode($this->model->error);
            }

            $red = explode('?', $_SERVER['HTTP_REFERER']);
            $red = $red[0];
            header("Location: " . $red . "/?msg=$msg");
        }
    }
}
