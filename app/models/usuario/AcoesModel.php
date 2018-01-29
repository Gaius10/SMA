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
        $f = "MONITOR_SENHA AS pass";
        $w = "WHERE MONITOR_LOGIN = 'root'";
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
}
