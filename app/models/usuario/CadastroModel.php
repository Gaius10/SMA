<?php
use mvc\MainModel;
use sline\Validation\Validator;
/**
* Model para efetuar cadastro de usuários
*/
class CadastroModel extends MainModel
{
	/**
	 * $error
	 * 
	 * Erros ocorridos durante o cadastro
	 * 
	 * @var string
	 * @access public
	 */
	public $error;

	/**
	 * $data
	 * 
	 * Dados a serem cadastrados
	 * 
	 * @var array
	 * @access private
	 */
	private $data;

	/**
	 * function cadastrarMonitor($dados)
	 *
	 * @param array $dados Dados do formulario a ser validado
	 * @return boolean
	 *
	 * Para ESTE sistema, $dados deve ser um array com o seguinte formato:
	 *
	 * $dados = array(
	 *		"MONITOR_NOME" => $_POST['userNome'],
	 *		"MONITOR_LOGIN" => $_POST['userLogin'],
	 *		"MONITOR_EMAIL" => $_POST['userEmail'],
	 *		"MONITOR_SENHA" => $_POST['userPass'],
	 *		"passConfirm" => $_POST['userPassConfirm']"
	 * );
	 */
	public function cadastrarMonitor(array $dados)
	{
		$this->data = $dados;

		// Validar dados
		if ($this->validarDados()) {
			// Cadastrar dados caso sejam válidos
			try {
				unset($this->data['passConfirm']);
				$strSalt = "$2a$10$" . randString(22) . "$";
				$this->data['MONITOR_SENHA'] = crypt($dados['MONITOR_SENHA'], $strSalt);
				// Configurar ID desta sessao para registrar
				$this->data['SESSION_ID'] = session_id();

				// Registrar
				$this->connection->register("Monitor", $this->data);
				return true;
			} catch (Exception $e) {
				echo (DEBUG) ? $e : "<!-- $e -->";
				echo "<br /><br />";
				exit("Houve um erro interno. Por favor, contate o suporte.");
			}
		} else {
			// Retornar mensagem de erro
			return false;
		}
	}

	/**
	 * function validarDados()
	 *
	 * Valida os dados do formulario solicitado.
	 *
	 * @access private
	 * @return boolean
	 */
	private function validarDados()
	{
		// Configurar array para instaciar classe de validação de dados
		$dataToValidate = array(
			"nome" => $this->data['MONITOR_NOME'],
			"login" => $this->data['MONITOR_LOGIN'],
			"email" => $this->data['MONITOR_EMAIL'],
			"pass" => [
				"pass" => $this->data['MONITOR_SENHA'],
				"confirm" =>  $this->data['passConfirm']
			]
		);

		// Instanciar classe de validação de dados
		try {
			/* Validar formato dos dados enviados */
			$conf = PACKS_PATH . "/sline/Validation/forms/monitor.json";
			$validator = new Validator($dataToValidate, $conf);
			
			if (!$validator->validate()) {
				$this->error = $validator->error;
				return false;
			} else {

				/* Verificar autorização para cadastro */
				$w = "WHERE AUTORIZACAO_EMAIL = '{$this->data['MONITOR_EMAIL']}'";

				if (!empty($this->connection->read("Autorizacao", "*", $w))) {
					return true;
				} else {
					$this->error = "Desculpe, você não está autorizado.";
					return false;
				}
			}
		} catch(Exception $e) {
			echo (DEBUG) ? $e : "<!-- $e -->";
			exit("Houve um erro interno. Por favor, contate o suporte.");
		}
	}
}
