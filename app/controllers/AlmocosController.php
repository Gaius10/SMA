<?php
use mvc\MainController;
/**
* Classe responsável por controlar a página de gerenciamento de almocos
*/
class AlmocosController extends MainController
{
	private $periodo;

	function index()
	{
		## Ver se usuário está logado
		if (!$this->loggedIn)
		{
			header("Location: " . HOME_URL . "/login");
		}
		else
		{
			$this->title = "Bem vindo ao SMA";

			include VIEWS_PATH . "/_includes/header.php";
			include VIEWS_PATH . "/_includes/menu.php";
			
			include VIEWS_PATH . "/_includes/footer.php";
		}
	}
}