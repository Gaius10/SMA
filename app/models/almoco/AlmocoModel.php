<?php
use mvc\MainModel;
/**
* AlmocoModel - Modelo com acoes relacionadas aos almocos
* 
* @author Caio Corrêa Chaves
*/
class AlmocoModel extends MainModel
{
    /**
     * $date
     * 
     * Receberá data do dia atual
     * 
     * @var string
     * @access private
     */
    private $date;

    /**
     * function __contruct()
     * 
     * Armazena data atual em $this->date
     * 
     * @access public
     * @return void
     */
    function __construct()
    {
        parent::__construct();
        $this->date = date("Y-m-d");
    }

    /**
     * function initiated()
     * 
     * Retorna TRUE se o almoco do dia em questão já foi iniciado
     * 
     * @access public
     * @return boolean
     */
    public function initiated()
    {
        // Consultar banco de dados
        $where = "WHERE ALMOCO_DATA = '{$this->date}'";
        $almoco = $this->connection->read("Almoco", "*", $where);

        return (empty($almoco)) ? false : true;
    }

    /**
     * function start($cardapio)
     * 
     * Função que registra inicio de novo almoço
     * 
     * @access public
     * @return void
     * @param string $cardapio Receberá o cardapio do almoco a ser registrado
     * 
     * @throws Exception Se ocorrer algum erro durante o registro do almoço
     */
    public function start(string $cardapio)
    {
        // Registrar cardapio no banco de dados
        $almoco = [
            "ALMOCO_DATA" => $this->date, 
            "ALMOCO_CARDAPIO" => $cardapio
        ];
        if ($this->connection->register("Almoco", $almoco)) {
            return;
        } else {
            throw new Exception("Um erro ocorreu durante o registro");
        }
    }

    /**
     * function getCod()
     * 
     * Retorna o codigo do almoco desejado
     * 
     * @param string|null $date Data do almoço desejado
     * 
     * @access public
     * @return int
     */
    public function getCod(string $date = '') : int
    {
        $date = ($date) ? $date : $this->date;
        $w = "WHERE ALMOCO_DATA = '{$date}'";
        $cod = $this->connection->read("Almoco", "ALMOCO_COD", $w);
        return $cod['ALMOCO_COD'] ? $cod['ALMOCO_COD'] : false;
    }

    /**
     * ********************************************************************** 
     * function load($date)
     * 
     * Carrega os dados do almoco especificado por $date
     * 
     * @param string $date Data do almoco gerenciado
     * 
     * @return array|void
     * @access public
     */
    public function loadInfo(string $date = '')
    {
        $date = $date ? $date : $this->date;

        // Carregar dados do almoco gerenciado
        $f = 'ALMOCO_COD AS cod, ALMOCO_CARDAPIO AS card, ALMOCO_DATA as dat';
        $w = 'WHERE ALMOCO_COD = \'' . $this->getCod($date) . '\'';
        $almoco = $this->connection->read('Almoco', $f, $w);

        // Retorna vazio caso nao haja dados do almoco, ele nao foi iniciado
        if (!$almoco) {
            return;
        }

        // Buscar mais dados:
        // Quantidade de almocos, total de repeticoes e total de ocorrencias
        $f = 'COUNT(*) AS alm, SUM(REPETICOES) AS rep';
        $w = 'WHERE ALMOCO_COD = \'' . $almoco['cod'] . '\'';
        $almoco['info'] = $this->connection->read('Almocar', $f, $w);

        // Ocorrencias
        $f = 'COUNT(*) AS oc';
        $w = 'WHERE OCORRENCIA_DATA = \'' . $date . '\'';
        $oc = $this->connection->read('Ocorrencia', $f, $w);
        $almoco['info']['oc'] = $oc['oc'];

        return $almoco;
    }

    /**
     * function loadAlunos($codAlmoco)
     * 
     * Carrega dados dos alunos que almocaram no dia em questao
     * 
     * @param int $codAlmoco Codigo do almoco em questão
     * 
     * @access public
     * @return array|void
     */
    public function loadAlunos(int $codAlmoco = null)
    {
        // Obter dados do almoco
        if ($codAlmoco != null) {
            $f = 'ALMOCO_COD AS alm_c, Aluno.ALUNO_COD AS alu_c, REPETICOES AS rep';
            $w = 'WHERE ALMOCO_COD = \'' . $codAlmoco . '\'';
            $w .= ' AND Aluno.ALUNO_COD = Almocar.ALUNO_COD';
            $w .= ' ORDER BY ALUNO_NOME';
            $alunos = $this->connection->read('Almocar, Aluno', $f, $w);
        } else {
            $f = 'ALUNO_COD AS alu_c, ALUNO_NOME AS n, ALUNO_TURMA AS t, ALUNO_QRCODE AS q';
            $w = 'WHERE ALUNO_ATIVO = TRUE';
            $w .= ' ORDER BY ALUNO_NOME';
            $alunos = $this->connection->read('Aluno', $f, $w);
        }

        // Se nao existir nenhum aluno, retornar vazio
        if (empty($alunos)) {
            return;
        }

        // Cada aluno tera um índice no array, mesmo que seja só um aluno
        $alunos = makeDataArray($alunos);


        // Obter outros dados
        foreach ($alunos as $key => $aluno) {
            // Obter dados do aluno (Se $codAlmoco foi enviado)
            $w = 'WHERE ALUNO_COD = \'' . $aluno['alu_c'] . '\'';
            if ($codAlmoco) {
                $f = 'ALUNO_NOME AS n, ALUNO_TURMA AS t, ALUNO_QRCODE AS q';
                $alunos[$key]['info'] = $this->connection->read('Aluno', $f, $w);
            }

            // Obter ocorrencias
            $f = 'OCORRENCIA_DATA AS dat, ALUNO_OCORRENCIA AS oc';

            $alunos[$key]['oc'] = $this->connection->read('Ocorrencia', $f, $w);

            if ($alunos[$key]['oc'] != false) {
                $alunos[$key]['oc'] = makeDataArray($alunos[$key]['oc']);
                $alunos[$key]['oc']['qtd'] = count($alunos[$key]['oc']);
            }
        }

        return $alunos;
    }
}
