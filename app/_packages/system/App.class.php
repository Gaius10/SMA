<?php
namespace system;
/**
 * App - Classe responsável por obter os dados da url
 *
 * @author Caio Corrêa Chaves
 * @package system
 */
class App
{
	private $controller;
    private $action;
    private $params = "";
    

    /**
     * Chamar o controller e sua action solicitados via url
     */
    function __construct()
    {
        $this->getUrlData();

        // chamar controller necessario

        // Validar controller
        $control = explode('-', $this->controller);
        $this->controller = null;
        foreach ($control as $key => $value)
            $this->controller .= ucfirst($value);

        $this->controller .= "Controller";


        // Verificar arquivo de controller
        if (!file_exists(CONTROL_PATH . "/{$this->controller}.php"))
        {
            require_once VIEWS_PATH . "/not-found.view.php";
            echo (DEBUG) ? " Controller File." : "";

            return;
        }
        
        // Verificar classe do controller
        require CONTROL_PATH . "/{$this->controller}.php";

        if (!class_exists($this->controller))
        {
            require_once VIEWS_PATH . "/not-found.view.php";
            echo (DEBUG) ? " Controller Class." : "";

            return;
        }

        // Instaciar classe
        $this->controller = new $this->controller($this->params);

        // checar se o metodo existe e chama-lo
        if(method_exists($this->controller, $this->action))
        {
            $this->controller->{$this->action}($this->params);
        }
        else
        {
            include VIEWS_PATH . "/not-found.view.php";
            echo (DEBUG) ? " Controller Method." : "";

            return;
        }
    }
    


    /**
     * Esse método obtém os dados da url e armazena em $this->controller, 
     * $this->action e $this->params.
     */
    private function getUrlData()
    {
        if(isset($_GET['path']))
        {
            $path = $_GET['path'];
            
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);
            
            $path = explode('/', $path);

            // configurar as propriedades
            $this->controller    = chk_array($path, 0);
            $this->action        = chk_array($path, 1);
            if (empty($this->action))
                $this->action = "index";


            // configurar os parametros
            if (chk_array($path, 2)) {
                unset($path[0]);
                unset($path[1]);

                $this->params = array_values($path);
            }

            // DEBUG

            /*echo "Controller: " . $this -> controller . '<br>';
            echo "Action : " . $this -> action . '<br>';
            echo 'Params: <pre>';
            print_r( $this -> params );
            echo '</pre>';*/
        } else {
            $this->controller = "almoco";
            $this->action = "index";
            $this->params = "";
            
            // DEBUG
            
            /*echo "Controller: " . $this -> controller;
            echo "<br />Action:  " . $this -> action;
            echo "<br />Params:  " . $this -> params;*/
        }
    }
}
