<?php
use mvc\MainModel;
/**
* Modelo para gerenciamento global de almoços
* 
* @author Caio Corrêa Chaves
*/
class GerenciarAlmocosModel extends MainModel
{
    
    /**
     * $almocos
     * 
     * Dados contidos na view `VIEW_Almoco`
     * 
     * @var array
     * @access private
     */
    private $almocos;

    /**
     * $infos
     * 
     * Informações gerais sobre todos os almoços(soma dos dados)
     * 
     * @var array
     * @access private
     */
    private $infos;

    /**
     * function __construct()
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * function conf($date)
     * 
     * Monta todos os dados dos almocos para ser gerenciado em sma/almoco/gerenciar
     * 
     * @param array $date Array com ano a ter seus almoços consultados
     * 
     * @access public
     * @return void
     */
    public function conf(array $date)
    {
        $date = $date[0] . '-';

        // Filtrar informacoes dos almocos
        $w = "WHERE dat LIKE '$date%'";


        // Buscar dados contidos na view `VIEW_Almoco`
        $this->almocos = $this->connection->read('VIEW_Almoco', '*', $w);
        $this->almocos = $this->formatQueryArray($this->almocos);

        // Organizar almoços por mês
        if (!empty($this->almocos)) {
            $this->organizarAlmocos();
        }

        // Buscar informações globais
        $f = 'SUM(qtd_alm) as alm, SUM(rep) as rep, SUM(qtd_oc) as oc';
        $this->infos = $this->connection->read('VIEW_Almoco', $f, $w);
    }

    /**
     * function organizarAlmocos()
     * 
     * Organiza almocos criando um array dividido por meses
     * 
     * @access private
     * @return void
     */
    private function organizarAlmocos()
    {
        $dados = array();

        foreach ($this->almocos as $key => $almoco) {
            preg_match('/-[0-9]{2}-/', $almoco['dat'], $chave);
            $dados[str_replace('-', '', $chave[0])][] = $almoco;
        }

        $this->almocos = $dados;
    }


    /**
     * function getAlmocos()
     * 
     * Retorna o array $this->almocos
     * 
     * @access public
     * @return array|null
     */
    public function getAlmocos()
    {
        return !empty($this->almocos) ? array_reverse($this->almocos) : null;
    }

    /**
     * function getInfos()
     * 
     * Retorna o array $this->infos
     * 
     * @access public
     * @return array|null
     */
    public function getInfos()
    {
        return !empty($this->infos) ? $this->infos : null;
    }
}
