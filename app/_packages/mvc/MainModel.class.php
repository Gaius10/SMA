<?php
use mvc\Connection;
namespace mvc;
/**
* MainModel - modelo principal
*/
class MainModel
{
	public $connection;		// o objeto da nossa conecao com o banco de dados
	public $params; 		// parametros pegos via URL
	public $error = null;	// possiveis erros relativos a qualquer coisa


 	function __construct()
 	{
 		$this->connection = new Connection(DATABASE);
 	}

	/**
	 *	Funcao que move imagem para o diretorio /views/_upload/
	 *
	 *	Apenas aceita imagens nos formatos jpg e png
	 */
	public function uploadImg($file)
	{
		## validar tipo de imagem
		$type = $file['type'];
		$type = explode('/', $type);
		$type = end($type);

		if(!value_exists($type,"png, jpg, jpeg"))
		{
			$this->error = "Formato de imagem invalido ou imagem não enviada.";
			return false;
		}

		## mover arquivo e renomeá-lo
		$imgName = time() . ".$type";
		move_uploaded_file($file['tmp_name'], UPLOAD_PATH . "/$imgName");
		exec("chmod 777 " . UPLOAD_PATH . "/$imgName", $retorno);

		/* DEBUG */
		/*echo UPLOAD_PATH . "<br />";
		print_r($file);*/

		
		return $imgName;
	}

	/**
	* Esta função valida os dados de um array de consulta ao banco de dados
	* fazendo com que cada linha retornada do banco de dados tenha um índice
	* numérico no array mesmo que apenas uma linha seja retornada
	*/
	protected function formatQueryArray($returnArray)
	{
		if (!isset($returnArray[0]) and $returnArray)
		{
			$back = $returnArray;
			$returnArray = null;
			$returnArray[0] = $back;
		}
		return $returnArray;
	}

	/**
	 * function testPass($pass)
	 * 
	 * Testa a senha do usuario de sessao atual
	 * 
	 * @param string $pass     Senha a ser conferida
	 * @param string $userPass Senha original criptografada
	 * 
	 * @return bool
	 * @access public
	 */
	public function testPass(string $pass, string $userPass) : bool
	{
		return (crypt($pass, $userPass) === $userPass) ? true : false;
	}
}
