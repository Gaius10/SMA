<?php
use mvc\MainController;
/**
* UserController - Controlador de acoes do usuário
* @author Caio Corrêa Chaves
*/
class UserController extends MainController
{

	/**
	 * Faz logout e redireciona para a pagina inicial do sistema
	 * @access public
	 */
	public function quit()
	{
		$this->logout(true);
	}
}