<?php
use mvc\Connection;
namespace mvc;
/**
* UserLogin - Classe para gerenciamento dos dados de login dos usuarios
*/
class UserLogin
{
	public $loggedIn;
	public $loginError;
	public $userdata;
	public $user;

	/**
	* Checa se o usuário fez ou não login
	*/
	protected function checkLogin()
	{
		$userdata = null;
		$post = null;

		/* Obter dados do usuário */

		// Pela $_SESSION (Se o usuário já estiver logado)
		if (isset($_SESSION['userdata']) and
			is_array($_SESSION['userdata']) and
			!empty($_SESSION['userdata']) and
			!isset($_POST['userdata'])
		) {
			$userdata = $_SESSION['userdata'];
			$post = false;
		}

		// Por $_POST (Se o usuário estiver logando)
		if (isset($_POST['userdata']) and
			is_array($_POST['userdata']) and
			!empty($_POST['userdata'])
		) {
			$userdata = $_POST['userdata'];
		$post = true;
		}

		/* Logout se os dados do usuário não forem encontrados */
		if (empty($userdata) or !is_array($userdata))
		{
			$this->loginError = null;
			$this->logout();
			return;
		}

		/* Verificar se existe um usuário e senha */
		$login = ($post) ? $userdata['username'] : $userdata['MONITOR_LOGIN'];
		$pass  = ($post) ? $userdata['userpass'] : $userdata['MONITOR_SENHA'];
		if (is_null($login) or is_null($pass))
		{
			$this->loginError = null;
			$this->logout();
			return;
		}

		#### Verificar existência do usuário na base de dados
		$connection = new Connection(DATABASE);

		$w = "WHERE MONITOR_LOGIN = '{$login}'";
		$user = $connection->read("Monitor", "*", $w);

		if (!$user) {
			$this->loginError = "Usuário não encontrado.";
			$this->logout();
			return;
		}


		##### Conferir senha
		if (crypt($pass, $user['MONITOR_SENHA']) === $user['MONITOR_SENHA'] or
			$pass === $user['MONITOR_SENHA']
		) {
			// Em caso de já estar logado, verificar id da sessao
			if (session_id() != $user['SESSION_ID'] and !$post) {
				$this->loginError = "ID de sessão incorreto.";
				$this->logout();
				return;
			}

			// Em caso de estar logando, configurar id da sessao e dados do
			// usuário em $_SESSION
			if ($post) {
				session_regenerate_id();
				$_SESSION['userdata'] = $user;
				$_SESSION['userdata']['SESSION_ID'] = session_id();

				$w = "WHERE MONITOR_COD = '{$_SESSION['userdata']['MONITOR_COD']}'";
				$connection->update("Monitor", $_SESSION['userdata'], $w);
			}

			// Habilitar login
			$permissions = unserialize($user['USER_PERMISSIONS']);
			$_SESSION['userdata']['USER_PERMISSIONS'] = $permissions;

			$this->loggedIn = true;
			$this->userdata = $_SESSION['userdata'];

			if (isset($_SESSION['gotoUrl'])) {
				$url = urldecode($_SESSION['gotoUrl']);
				unset($_SESSION['gotoUrl']);
				$this->gotoPage(HOME_URL.$url);
			}
			return;
		} else {
			$this->loginError = "Senha incorreta.";
			$this->logout();
			return;
		}
	} // function $this->checkLogin()


	/**
	* Função que faz logout
	*/
	final protected function logout($redirect = false)
	{
		$this->loggedIn = false;
		$_SESSION['userdata'] = array();
		unset($_SESSION['userdata']);
		session_regenerate_id();

		if ($redirect)
			$this->gotoLogin();
	}


	/**
	* Método que redireciona o navegador para a página de login
	*/
	final protected function gotoLogin()
	{
		if (defined("HOME_URL"))
		{
			$loginUrl = HOME_URL . "/login";
			$_SESSION['gotoUrl'] = urlencode($_SERVER['REQUEST_URI']);

			header("Location: {$loginUrl}");
		}
		return;
	}

	/**
	* Método que redireciona o navegador para uma página específica
	*/
	final protected function gotoPage($pageUrl = null)
	{
		if (isset($_GET['path']) and !empty($_GET['path']) and !$pageUrl)
			$pageUrl = urldecode($_GET['path']);

		if ($pageUrl)
		{
			$pageUrl = str_replace("sma/sma", 'sma', $pageUrl);
			header("Location: {$pageUrl}");
			exit();
		}
	}


	/**
	* Checa se o usuario tem permissao para acessar determinada página
	*/
	final protected function checkPermissions(
		$required = 'any',
		$owned = array('any')
	) {
		if (!is_array($owned))
			return;

		return in_array($required, $owned);
	}

	/**
	* function simplificaDados($old, $new)
	* 
	* Função feita para simplificar o array de dados obtidos do banco de dados
	* afim de tornar os índices menores e simples, melhorando a legibilidade
	* do código.
	* 
	* @param array $old Dados obtidos do banco de dados
	* @param array $new Array que indica como será simplificado o $old
	* 
	* $new Deverá seguir o padrão = 
	* $new = array (
	*     "<indice_em_old>" => "<novo_indice_correspondente>",
	*     .
	*     .
	*     .
	* );
	* 
	* @return array
	* @access public
	* @throws InvalidArgumentException Se o índice em $new referente a $old não existe
	*/
	public function simplificaDados(array $old, array $new)
	{
		$return = null;
		foreach ($new as $key => $value) {

			if (isset($old[$key])) {
				$return[$value] = $old[$key];
			} else {
				$error = '[[ Formato do array $new inválido. ]]';
				throw new InvalidArgumentException($error);
			}
		}
		return $return;
	}
}
