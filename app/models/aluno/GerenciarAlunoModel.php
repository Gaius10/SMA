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

        // Se o aluno sendo cadastrado ja existiu e foi excluído, apenas 
        // torna-lo novamente ativo
        $w = "WHERE ALUNO_NOME = '{$dados['ALUNO_NOME']}'";
        $w .= " AND ALUNO_TURMA = '{$dados['ALUNO_TURMA']}'";
        $w .= " AND ALUNO_ATIVO = '0'";
        $aluno = $this->connection->read('Aluno', '*', $w);
        $cod = $aluno['ALUNO_COD'];
        if (!empty($aluno)) {
            if ($this->connection->update("Aluno", ['ALUNO_ATIVO' => 1], $w)) {
                if ($this->connection->update('UltimoAluno', ['COD' => $cod])) {
                    return true;
                } else {
                    // Em caso de erro, nao ativar aluno
                    $w = "WHERE ALUNO_COD = '{$cod}'";
                    $this->update('Aluno', ['ALUNO_ATIVO' => 0], $w);

                    $this->error = "Um erro ocorreu durante o registro";
                    return false;
                }
            } else {
                $this->error = "Um erro ocorreu durante o registro";
                return false;
            }
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
     * @return array|void
     */
    public function montarUltimoAluno()
    {
        $cod = $this->connection->read("UltimoAluno");
        $cod = $cod['COD'];

        $f = "ALUNO_NOME AS nome, ALUNO_TURMA as turma, ALUNO_QRCODE as img";
        $w = "WHERE ALUNO_COD = '{$cod}' AND ALUNO_ATIVO = '1'";

        // Obter dados
        $ultimoAluno = $this->connection->read("Aluno", $f, $w);
        exec('rm ' . QR_PATH . '/ult.png');
        if (is_array($ultimoAluno)) {
            // Criar Imagem do QR Code
            QRcode::png($ultimoAluno['img'], QR_PATH.'/ult.png', QR_ECLEVEL_M, 2, 5);
            $ultimoAluno['cod'] = $cod;

            return $ultimoAluno;
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

    /**
     * function load($cod)
     * 
     * Carrega os dados do(s) aluno(s) desejado(s)
     * 
     * @param int $cod Codigo do aluno desejado, NULL para buscar por todos cadastrados
     * 
     * @access public
     * @return array
     */
    public function load(int $cod = null)
    {
        $f = "ALUNO_COD AS c, ALUNO_NOME AS n, ALUNO_TURMA AS t, ALUNO_QRCODE AS q";
        $w = "WHERE ALUNO_ATIVO = '1'";
        $w .= ($cod) ? " AND ALUNO_COD = '{$cod}'" : "";

        return $this->connection->read("Aluno", $f, $w);
    }

    /**
     * function ocorrencia($dados)
     * 
     * Registra ocorrencia para determinado aluno
     * 
     * @param array $dados Dados necessarios para o registro
     *     -> Codigo do aluno, descrição do ocorrido e senha do monitor
     * 
     * @return boolean
     * @access public
     */
    public function ocorrencia(array $dados)
    {
        // Verificar senha do monitor
        $passConfirm = $_SESSION['userdata']['MONITOR_SENHA'];
        if ($this->testPass($dados['pass'], $passConfirm)) {
            
            // Confirmar existencia do aluno]
            $w = "WHERE ALUNO_COD = '{$dados['cod']}' AND ALUNO_ATIVO = '1'";
            if (!empty($this->connection->read('Aluno', '*', $w))) {

                // Registrar ocorrencia
                $ocorrencia = addslashes(trim($dados['ocorrencia']));

                $data = array(
                    'ALUNO_COD' => $dados['cod'],
                    'ALUNO_OCORRENCIA' => $ocorrencia,
                    'OCORRENCIA_DATA' => date("Y-m-d")
                );

                if ($this->connection->register("Ocorrencia", $data)) {
                    return true;
                } else {
                    $this->error = "Um erro ocorreu durante o registro";
                    return false;
                }

            } else {
                $this->error = "Aluno não cadastrado";
                return false;
            }
            

        } else {
            $this->error = "Senha do monitor incorreta";
            return false;
        }
    }

    /**
     * function makeImg($imgCode)
     * 
     * Gera imagem QR Code do aluno desejado
     * 
     * @param string $imgCode Codigo contido na imagem
     * 
     * @return void
     * @access public
     */
    public function makeImg(string $imgCode)
    {
        // O nome do arquivo será o "nome_turma" do aluno
        // Gerar nome do arquivo

        $nomeCodificado = explode('/', $imgCode);
        $nomeArquivo = base64_decode(end($nomeCodificado));
        $nomeArquivo = explode("_", $nomeArquivo);
        unset($nomeArquivo[0]);
        $nomeArquivo = implode('_', $nomeArquivo) . ".png";

        QRcode::png($imgCode, QR_PATH . '/alunos/' . $nomeArquivo, QR_ECLEVEL_M, 2, 5);
    }
}
