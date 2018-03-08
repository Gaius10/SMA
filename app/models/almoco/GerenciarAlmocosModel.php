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
     * Monta todos os dados dos almocos para ser gerenciado em sma/almoco/gerenciar
     * 
     * @access public
     * @return void
     */
    function __construct()
    {
        parent::__construct();

        $w = '';
        // Filtrar Almocos
        if (isset($_GET['view'])) {
            switch ($_GET['view']) {
                case 'week':
                    $w = 'WHERE dat > \'';
                    $w .=  date('Y-m-d', time() - (60 * 60 * 24 * 7)) . '\'';
                    break;
                case 'mounth':
                    $w = 'WHERE dat LIKE \'%' . date('-m-') . '%\'';
                    break;
            }
        }

        // Filtrar informacoes dos almocos
        $w2 = '';
        if (isset($_GET['global'])) {
            switch ($_GET['global']) {
                case 'week':
                    $w2 = 'WHERE dat > \'';
                    $w2 .= date('Y-m-d', time() - (60 * 60 * 24 * 7)) . '\'';
                    break;
                case 'mounth':
                    $w = 'WHERE dat LIKE \'%' . date('-m-') . '%\'';
                    break;
            }
        }

        // Buscar dados contidos na view `VIEW_Almoco`
        $this->almocos = $this->connection->read('VIEW_Almoco', '*', $w);
        $this->almocos = $this->formatQueryArray($this->almocos);

        // Buscar informações globais
        $f = 'SUM(qtd_alm) as alm, SUM(rep) as rep, SUM(qtd_oc) as oc';
        $this->infos = $this->connection->read('VIEW_Almoco', $f, $w2);
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
