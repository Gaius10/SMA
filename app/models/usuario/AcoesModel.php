<?php
use mvc\MainModel;

/**
* AcoesModel - Model com acoes que o usuario realizará no sistema
* @author Caio Corrêa Chaves
*/
class AcoesModel extends MainModel
{
    /**
     * $error
     * 
     * Receberá possíveis erros ocorridos
     * 
     * @var string
     * @access public
     */
    public $error;

    /**
     * function autorizar($dados)
     * 
     * Método que registrará email de um novo monitor no sistema
     * 
     * @throws InvalidArgumentException Se o array $dados for enviado de forma inválida
     * @param array $dados Receberá Email do novo monitor e senha do root   
     * @access public
     * @return boolean
     */
    public function autorizar($dados)
    {
        // Se os dados foram enviados de forma invalida, jogar uma excessão e 
        // encerrar
        if (empty($dados) or 
            !is_array($dados) or
            !isset($dados['email']) or
            !isset($dados['emailConf']) or
            !isset($dados['rootPass'])
        ) {
            throw new InvalidArgumentException("Dados informados de forma invalida");
            return false;
        } else {
                // Confirmar senha do root
            $f = 'MONITOR_SENHA AS pass';
            $w = "WHERE MONITOR_LOGIN = 'admin'";
            $passConfirm = $this->connection->read("Monitor", $f, $w);
            $passConfirm = $passConfirm['pass'];

            if (crypt($dados['rootPass'], $passConfirm) != $passConfirm) {
                $this->error = "Senha inválida.";
                return false;
            } else {
                // CASO A SENHA ESTEJA CORRETA
                // Confirmar email
                if ($dados['email'] != $dados['emailConf']) {
                    $this->error = "Emails diferentes";
                    return false;
                } else {
                    // CASO EMAILS ESTEJAM CORRETOS

                    $w = "WHERE AUTORIZACAO_EMAIL = '$dados[email]'";
                    if (!empty($this->connection->read('Autorizacao', '*', $w))) {
                        $this->error = 'Esse email já foi autorizado.';
                        return false;
                    } else {
                        $register = ["AUTORIZACAO_EMAIL" => $dados['email']];
                        if ($this->connection->register('Autorizacao', $register)) {
                            return true;
                        } else {
                            $this->error = "Um erro ocorreu durante o registro. Contate o suporte.";
                            return false;
                        }
                    }
                }
            }
        }
    }

    /**
     * function alterarDados($dados, $pass)
     * 
     * Método que cadastra alterações em dados de usuários
     * 
     * @param array  $dados Array com dados do usuário(alterados por ele)
     * @param string $pass  Senha informada pelo usuário por segurança
     * 
     * @access public
     * @return boolean
     * 
     * @throws DatabaseExceptions Se houver erros relacionados ao banco de dados
     */
    public function alterarDados(array $dados, string $pass, int $cod)
    {
        // Validar senha
        // Buscar no banco de dados
        $f = "MONITOR_SENHA AS pass";
        $w = "WHERE MONITOR_COD = '{$cod}'";
        $passConf = $this->connection->read("Monitor", $f, $w);
        $passConf = $passConf['pass'];


        // Confirmar
        if (crypt($pass, $passConf) !== $passConf) {
            $this->error = "Senha incorreta";
            return false;
        } else {
            // Validar dados
            $formValidationFile = PACKS_PATH . "/sline/Validation/forms/alterar.json";
            $validar = new sline\Validation\Validator($dados, $formValidationFile);

            if ($validar->validate()) {
                // Se os dados forem validos, cadastrar no banco de dados
                if ($this->connection->update("Monitor", $dados, $w)) {
                    return true;
                } else {
                    throw new DatabaseException("Erro ao inserir dados na base");
                    return false;
                }
            } else {
                $this->error = $validar->error;
                return false;
            }
        }
    }

    /**
     * function alterarRoot($atPass, $nPass, $nPassConf)
     * 
     * Altera senha do monitor root do sistema
     * 
     * @param string $atPass    Senha atual do monitor root
     * @param string $nPass     Nova senha do monitor root
     * @param string $nPAssConf Confirmação da nova senha do monitor root
     * 
     * @return bool
     * @access public
     */
    public function alterarRoot(string $atPass, string $nPass, string $nPassConf) : bool
    {
        // Testar validade da senha atual
        if (!$this->testPass($atPass, $_SESSION['userdata']['MONITOR_SENHA'])) {

            $this->error = 'Senha incorreta!';
            return false;

        } else {

            if ($nPass != $nPassConf) {
                $this->error = 'Confirmação incorreta da nova senha.';
                return false;
            } else {

                $strSalt = "$2a$10$" . randString(22) . "$";
                $monitorCod = $_SESSION['userdata']['MONITOR_COD'];
                $w = 'WHERE MONITOR_COD = \'' . $monitorCod . '\'';

                $dados = array(
                    'MONITOR_SENHA' => crypt($nPass, $strSalt)
                );
                if ($this->connection->update('Monitor', $dados, $w)) {
                    return true;
                } else {
                    $this->error = 'Erro durante o registro';
                    return false;
                }
            }

        }
    }

    /**
     * function logar($login, $pass)
     * 
     * Efetua login e configura dados do usuario
     * 
     * @access public
     * @return string
     */
    public function logar(string $login, string $pass) : string
    {
        $w = "WHERE MONITOR_LOGIN = '{$login}'";
        $userdata = $this->connection->read('Monitor', '*', $w);

        if (empty($userdata)) {
            return 'Usuário não encontrado.';
        }
        if (crypt($pass, $userdata['MONITOR_SENHA']) !== $userdata['MONITOR_SENHA']) {
            return 'Senha incorreta.';
        }

        // Configurar id da sessao e dados do usuário em $_SESSION
        session_regenerate_id();
        $_SESSION['userdata'] = $userdata;
        $_SESSION['userdata']['SESSION_ID'] = session_id();

        $w = "WHERE MONITOR_COD = '{$_SESSION['userdata']['MONITOR_COD']}'";
        $this->connection->update("Monitor", $_SESSION['userdata'], $w);

        return 'OK';
    }
}
