<?php
use mvc\MainModel;
/**
* AlunoModel - Modelo de acoes do aluno
*/
class AlunoModel extends MainModel
{
    /**
     * $dadosBrutos
     * 
     * Receberá uma string codificada em base64 com os dados do aluno
     * 
     * @var string
     * @access private
     */
    private $dadosBrutos;

    /**
     * $cod
     * 
     * Receberá o codigo do aluno em questao
     * 
     * @var int
     * @access public
     */
    public $cod;

    /**
     * $nome
     * 
     * Receberá o nome do aluno em questao
     * 
     * @var string
     * @access public
     */
    public $nome;

    /**
     * $turma
     * 
     * Receberá a turma do aluno em questao
     * 
     * @var string
     * @access public
     */
    public $turma;

    /**
     * $error
     * 
     * Receberá possíveis erros ocorridos na execução
     * 
     * @var string
     * @access public
     */
    public $error;


    /**
     * function validarAluno($aluno)
     * 
     * Valida os dados do aluno para checar existencia e validade do QR Code
     * apresentado
     * 
     * @return boolean
     * @access public
     * @param string $aluno Dados do aluno criptografados em base64
     */
    public function validarAluno(string $aluno)
    {
        $this->dadosBrutos = $aluno;
        $dadosAluno = explode('_', base64_decode($aluno));

        // Se o array nao possuir 3 elementos, o codigo é inválido
        if (count($dadosAluno) != 3) {
            return false;
        } else {
            $w = "WHERE ALUNO_COD = '$dadosAluno[0]' AND";
            $w .= " ALUNO_NOME = '$dadosAluno[1]' AND";
            $w .= " ALUNO_TURMA = '$dadosAluno[2]' AND";
            $w .= " ALUNO_ATIVO = TRUE";

            // Checar existencia do aluno
            if (!empty($this->connection->read("Aluno", '*', $w))) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * function mount()
     * 
     * Preencherá os atributos dessa classe com os dados do aluno a ser 
     * gerenciado
     * 
     * @access public
     * @return boolean
     */
    public function mount() : bool
    {
        $dados = explode('_', base64_decode($this->dadosBrutos));
        $this->cod   = $dados[0];
        $this->nome  = $dados[1];
        $this->turma = $dados[2];

        return true;
    }

    /**
     * function almocou()
     * 
     * Verifica se o aluno em questão ja almocou ou não
     * 
     * @param int $codAlmoco Codigo do almoco em questão
     * 
     * @access public
     * @return bool
     */
    public function almocou(int $codAlmoco) : bool
    {
        // Checar se dados do aluno foram ou não montados
        if (empty($this->cod)) {
            (DEBUG) ? 
                exit("Aluno não foi montado") : 
                $this->error = "Um erro interno ocorreu, contate o suporte";
            return false;
        } else {
            $w  = "WHERE ALUNO_COD = '{$this->cod}'";
            $w .= " AND ALMOCO_COD = '$codAlmoco'";

            if (empty($this->connection->read("Almocar", "*", $w))) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * function almocar()
     * 
     * Registra que determinado aluno almocou no dia em questao
     * 
     * @param int $codAlmoco Codigo do almoco em questão
     * 
     * @access public
     * @return bool
     */
    public function almocar($codAlmoco) : bool
    {
        $register = array(
            "ALUNO_COD" => $this->cod,
            "ALMOCO_COD" => $codAlmoco
        );

        if ($this->connection->register("Almocar", $register)) {
            return true;
        } else {
            $this->error = "Ocorreu um erro durante a conexão ao banco de dados";
            return false;
        }
    }

    /**
     * function repetir($codAluno, $codAlmoco)
     * 
     * Função que registra repetição de determinado aluno
     * 
     * @param int $codAluno  Codigo do aluno repetindo
     * @param int $codAlmoco Codigo do almoco em questao
     * 
     * @access public
     * @return bool
     */
    public function repetir(int $codAluno, int $codAlmoco) : bool
    {
        $w =  'WHERE ALUNO_COD = \'' . $codAluno . '\'';
        $w .= ' AND ALMOCO_COD = \'' . $codAlmoco . '\'';

        $f = array('REPETICOES' => '|REPETICOES + 1|');

        if ($this->connection->update("Almocar", $f, $w)) {
            return true;
        } else {
            $this->error = "Um erro ocorreu durante o registro";
            return false;
        }
    }
}
