<?php
use mvc\MainModel;
use sline\Validation\Validator;
/**
 * Classe para gerenciamento e acoes no sistema relacionadas a alunos
 * 
 * @author Caio Corrêa Chaves
 */
class GerenciarAlunoModel extends MainModel
{
    /**
     * $error
     * 
     * Receberá possíveis erros
     * 
     * @access public
     * @var string
     */
    public $error;

    /**
     * function cadastrarAluno($dados)
     * 
     * Funcao que irá cadastrar novo aluno no banco de dados
     * 
     * @access public
     * @param array|string $dados Dados do aluno a ser cadastrado
     * @return boolean
     * 
     * Array dados deve possuir o formato: 
     * $dados = [
     *     "ALUNO_NOME" => <nome_aluno>,
     *     "ALUNO_TURMA" => <turma_aluno>
     * ]
     */
    public function cadastrarAluno(array $dados)
    {
        // Antes de tudo, validar dados
        try {
            $configFile = PACKS_PATH . "/sline/Validation/forms/novo-aluno.json";
            $validar = new Validator($dados, $configFile);

            if (!$validar->validate()) {
                $this->error = $validar->error;
                return false;
            }
        } catch (\Exception $e) {
            echo (DEBUG) ? $e : "<!-- $e -->";
            exit("Houve um erro interno. Por favor, contate o suporte.");
        }

        /* Verificar se aluno ja existe no banco de dados. */
        $w = "WHERE ALUNO_NOME = '{$dados['ALUNO_NOME']}'";
        $w .= " AND ALUNO_TURMA = '{$dados['ALUNO_TURMA']}'";
        $w .= " AND ALUNO_ATIVO = '1'";

        if (!empty($this->connection->read("Aluno", "*", $w))) {
            $this->error = "Erro: Este aluno já foi cadastrado";
            return false;
        }

        /* Cadastrar aluno */
        if ($this->connection->register("Aluno", $dados)) {
            // Após cadastrar aluno, cadastrar string do QR Code
            $lastCod = $this->connection->read("UltimoAluno");
            $lastCod = $lastCod['COD'];

            $f = "ALUNO_COD AS cod, ALUNO_NOME AS nome, ALUNO_TURMA AS turma";
            $w = "WHERE ALUNO_COD = '{$lastCod}'";
            $data = $this->connection->read("Aluno", $f, $w);

            $qrStr = $this->generateQrCodeString($data);
            $qrStr = array('ALUNO_QRCODE' => $qrStr);

            $w = "WHERE ALUNO_COD = '{$lastCod}'";

            if ($this->connection->update("Aluno", $qrStr, $w)) {
                return true;
            } else {
                $this->error = "Um erro ocorreu durante o registro";
                $this->connection->delete("Aluno", $w);
                return false;
            }
        } else {
            $this->error = "Um erro ocorreu durante o registro";
            return false;
        }
    }

    /**
     * function generateQrCodeString($data)
     * 
     * Retorna string para criação do qr code de determinado aluno
     * 
     * @access public
     * @return string
     * @param array $data Dados do aluno em questao
     */
    public function generateQrCodeString($data)
    {
        $str = base64_encode("$data[cod]_$data[nome]_$data[turma]");
        return HOME_URL . "/aluno/almocar/" . $str;
    }

    /**
     * function montarUltimoAluno()
     * 
     * Retorna os dados do ultimo aluno cadastrado
     * 
     * @access public
     * @return array
     */
    public function montarUltimoAluno()
    {
        $cod = $this->connection->read("UltimoAluno");
        $cod = $cod['COD'];

        $f = "ALUNO_NOME AS nome, ALUNO_TURMA as turma, ALUNO_QRCODE as img";
        $w = "WHERE ALUNO_COD = '{$cod}'";

        // Obter dados
        $ultimoAluno = $this->connection->read("Aluno", $f, $w);
        exec('rm ' . QR_PATH . '/ult.png');
        if (is_array($ultimoAluno)) {
            // Criar Imagem do QR Code
            QRcode::png($ultimoAluno['img'], QR_PATH.'/ult.png', QR_ECLEVEL_M, 2, 5);
            $ultimoAluno['cod'] = $cod;

            return $ultimoAluno;
        } else {
            return "Não foi possível obter dados do ultimo aluno cadastrado";
        }
    }

    /**
     * function excluir($codAluno, $pass)
     * 
     * Exclui determinado aluno
     * 
     * @param int    $codAluno Codigo do aluno a ser excluído
     * @param string $pass     Senha do monitor a efetuar a exclusão
     * 
     * @access public
     * @return boolean
     */
    public function excluir(int $codAluno, string $pass)
    {
        $userPass = $_SESSION['userdata']['MONITOR_SENHA'];
        
        if ($this->testPass($pass, $userPass)) {

            $up = array("ALUNO_ATIVO" => 0);
            $w = "WHERE ALUNO_COD = '{$codAluno}'";

            if ($this->connection->update("Aluno", $up, $w) &&
                $this->connection->update("UltimoAluno", ['COD' => 0])
            ) {
                return true;
            } else {
                $this->error = "Ocorreu um erro durante a exclusão";
                return false;
            }
        } else {
            $this->error = "Senha incorreta";
            return false;
        }
    }
}
