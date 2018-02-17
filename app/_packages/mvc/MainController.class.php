<?php
use mvc\Connection;
use mvc\UserLogin;
namespace mvc;
/**
* MainController - Classe que extende todos os controllers do sistema
*/
class MainController extends UserLogin
{
    public $title;
    public $params;
    public $pag;
    public $ip;
    public $model;

    function __construct($params = array())
    {
        $this->params = $params;
        $this->checkLogin();
        if ($this->userdata) {
            $formato = [
                "MONITOR_COD"   => "cod",
                "MONITOR_NOME"  => "nome",
                "MONITOR_EMAIL" => "email",
                "MONITOR_LOGIN" => "login",
                "MONITOR_SENHA" => "senha"
            ];
            $this->user = $this->simplificaDados($this->userdata, $formato);
        }
    }


    public function loadModel($modelName = null)
    {
        if (!$modelName) {
            return;
        }

        $modelPath = ROOT_PATH . "/app/models/" . $modelName . "Model.php";
        // echo $modelPath;

        // echo $modelPath;

        if(file_exists($modelPath))
        {
            ob_start();
            require_once $modelPath;
            ob_clean();

            $modelName = explode('/', $modelName);
            $modelName = end($modelName);

            $modelName = explode('-', $modelName);
            $modelClassName = null;

            if (count($modelName) > 1)
            {
                foreach ($modelName as $key => $value)
                {
                    $modelName[$key] = ucfirst($value);
                }
                $modelClassName = implode($modelName) . "Model";
            }
            else
            {
                $modelClassName = ucfirst(implode($modelName)) . "Model";
            }
            

            if (class_exists($modelClassName))
            {
                return new $modelClassName($this->params); 
            }
            else
            {
                include ROOT_PATH . "/app/views/not-found.view.php";
                echo (DEBUG) ? " Model Class." : "";

                return false;
            }
        }
        else
        {
            include ROOT_PATH . "/app/views/not-found.view.php";
            echo (DEBUG) ? " Model File." : "";

            return false;
        }
    }
}
