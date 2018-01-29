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
}
