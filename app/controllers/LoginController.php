<?php
use mvc\MainController;
/**
* LoginController - Controller da pagina de login
*/
class LoginController extends MainController
{
	
	/**
	 * Mostrar Formulário de login
	 */
	function index()
	{
		if ($this->loggedIn)
		{
			header("Location: " . HOME_URL . "/HOME_URL");
		}
		else
		{
			$this->title = "SMA - Login";

			$styleRequires = [
				"login",
				"menu-propagandas", 
				"modal",
				"modal/cadastre-se",
				"modal/suporte",
				"modal/sobre-nos", 
				"footer"];

			include VIEWS_PATH . "/_includes/header.php";
			include VIEWS_PATH . "/_includes/menu-propagandas.php";
			include VIEWS_PATH . "/login.view.php";
			include VIEWS_PATH . "/_includes/footer.php";
		}
	}




	/**
	 * Validar cadastro de novo monitor
	 */
	public function cadastro()
	{
		$this->model = $this->loadModel('usuario/Cadastro');

		$dados = [
			"MONITOR_NOME" => $_POST['userNome'],
			"MONITOR_LOGIN" => $_POST['userLogin'],
			"MONITOR_EMAIL" => $_POST['userEmail'],
			"MONITOR_SENHA" => $_POST['userPass'],
			"passConfirm" => $_POST['userPassConfirm']
		];


		if($this->model->cadastrarMonitor($dados))
		{
			/* Em caso de sucesso */
			$msg = "Obrigado por se cadastrar";
			header("Location: " . HOME_URL . "/almocos/?msg=$msg");
		}
		else
		{
			/* Em caso de falha */
			$msg = "{$this->model->error}";
			header("Location: " . HOME_URL . "/login?msg=$msg");
		}
	}
}