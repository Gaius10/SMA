<?php
use mvc\MainController;
/**
* UserController - Controlador de acoes do usuário
* @author Caio Corrêa Chaves
*/
class UserController extends MainController
{

	/**
     * function quit()
     * 
	 * Faz logout e redireciona para a pagina inicial do sistema
     * 
	 * @access public
     * @return void
	 */
	public function quit()
	{
		$this->logout(true);
	}


    /**
     * function autorizar()
     * 
     * Método que registra o email de um novo monitor autorizado
     * 
     * @access public
     * @return void
     */
    public function autorizar()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL);
        } else {
            // Organizar dados obtidos de $_POST
            $data = [
                "email"     => $_POST['email'],
                "emailConf" => $_POST['emailConf'],
                "rootPass"  => $_POST['rootPass']
            ];

            //Obter model desejado
            $this->model = $this->loadModel('usuario/Acoes');

            try {
                if ($this->model->autorizar($data)) {
                    $msg = urlencode("Novo monitor autorizado com sucesso.");
                    header("Location: " . HOME_URL . "/?msg=$msg");
                } else {
                    echo $this->model->error;
                }
            } catch (Exception $e) {
                (DEBUG) ? exit($e) : header(HOME_URL . "/?msg=Erro Interno");
            }
        }
    }

    /**
     * function iniciarAlmoco()
     * 
     * Registra almoco do dia atual no banco de dados
     * 
     * @access public
     * @return void
     */
    public function iniciarAlmoco()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL);
        } else {
            $this->model = $this->loadModel('almoco/Almoco');

        // Se o almoco NÃO FOI iniciado, iniciá-lo
            if (!$this->model->initiated()) {
                try {
                    $this->model->start($_POST['cardapio']);
                    $this->msg = urlencode("Almoço iniciado com sucesso.");
                } catch (Exception $e) {
                    if (DEBUG) {
                        exit($e);
                    } else {
                        $this->msg = urlencode("Erro interno, contate o suporte");
                    }
                }

            // Montar url de redirecionamento
                $red = explode('?', $_SERVER['HTTP_REFERER']);
                $red = $red[0];

            // Redirecionar para pagina anterior
                header("Location: {$red}?msg={$this->msg}");
            } else {
            // Se o almoco JÁ FOI iniciado, voltar para index com feedback
                $msg = urlencode("O almoço atual já havia sido iniciado.");
                header("Location: " . HOME_URL . "/?msg=$msg");
            }
        }
    }

    /**
     * function alterarDados()
     * 
     * Altera os dados do usuário
     * 
     * @access public
     * @return void
     */
    public function alterarDados()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL);
        } else {
            // Armazenar dados em array
            $dados = array(
                "MONITOR_NOME"  => $_POST['userNome'],
                "MONITOR_EMAIL" => $_POST['userEmail']
            );
            $pass = $_POST['userPass'];

            // Não permitir alteração dos dados do root
            if ($_POST['userLogin'] == "root") {
                $msg = urlencode("Você não pode alterar dados do root!");

                // Montar url de redirecionamento
                $red = explode('?', $_SERVER['HTTP_REFERER']);
                $red = $red[0];
                // Redirecionar
                header("Location: " . $red . "/?msg=$msg");
            } else {
                try {
                    $this->model = $this->loadModel('usuario/Acoes');
                    if ($this->model->alterarDados(
                        $dados, 
                        $pass, 
                        $this->user['cod'])
                ) {
                        $msg = urlencode("Dados alterados com sucesso");
                    } else {
                        $msg = urlencode($this->model->error);
                    }

                    // Montar url de redirecionamento
                    $red = explode('?', $_SERVER['HTTP_REFERER']);
                    $red = $red[0];
                    // Redirecionar
                    header("Location: {$red}/?msg=$msg");
                } catch (Exception $e) {
                    if (DEBUG) {
                        exit($e);
                    } else {
                        $msg = urlencode("Erro interno, contate o suporte.");

                        // Montar url de redirecionamento
                        $red = explode('?', $_SERVER['HTTP_REFERER']);
                        $red = $red[0];
                        // Redirecionar
                        header("Location: " . $red . "/?$msg");
                    }
                }
            }
        }
    }
}
