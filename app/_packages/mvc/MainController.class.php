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
	}


	public function loadModel($modelName = null)
	{
		if (!$modelName)
			return;

		$modelPath = ROOT_PATH . "/app/models/" . $modelName . "Model.php";
		// echo $modelPath;

		// echo $modelPath;

		if(file_exists($modelPath))
		{
			require $modelPath;

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

	public function setIp()
    {
    	exec("ifconfig", $info);
	    @$ip = trim($info[18]);
	    @$ip = explode(" ", $ip);
	    @$ip = $ip[1];
	    @$ip = explode(":", $ip);
	    @$ip = @$ip[1];

	    $this->ip = (count(explode('.', $ip)) == 4) ? $ip : "127.0.0.1";
    }
}