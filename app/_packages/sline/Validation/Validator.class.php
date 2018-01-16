<?php
use sline\Validation\ValidationFunctions;
use sline\Validation\ValidationException;
namespace sline\Validation;

/**
 * Validation - Classe para validação de dados de formularios
 *
 * @author Caio Corrêa Chaves
 */
class Validator extends ValidatorFunctions
{
	/**
	 * $formData
	 *
	 * Receberá os dados do formulário a ser validado
	 *
	 * @var array|string
	 * @access private
	 */
	private $data;

	/**
	 * $formConf
	 *
	 * Receberá configuração do formulário em formato JSON
	 *
	 * @var array|stdClass Object
	 * @access private
	 */
	private $formConf;


	/**
	 * function __construct($data)
	 * 
	 * @param array|string $data Variável com os dados do formulário
	 * @param string       $file Arquivo JSON com as configuracoes de validacao
	 *
	 * @throws InvalidArgumentException Se algum campo enviado em $data nao foi
	 * 									configurado no arquivo JSON
	 * @throws InvalidArgumentException Se algum campo configurado no arquivo
	 *									JSON não foi enviado
	 * 
	 * @return void
	 */
	function __construct(array $data, string $file)
	{
		// Validar e incluir arquivo de configuração do formulário
		$this->includeFile($file);

		// Validar $data
		foreach ($data as $key => $value)
		{
			if (!isset($this->formConf->$key))
			{
				$error = "Campo '{$key}' não configurado.";
				throw new \InvalidArgumentException($error);			
			}
		}
		foreach (get_object_vars($this->formConf) as $key => $value)
		{
			if (!isset($data[$key]))
			{
				$error = "O campo '{$key}' não está sendo enviado.";
				throw new \InvalidArgumentException($error);
			}
		}
		$this->data = $data;
	}

	/**
	 * function includeFile($file)
	 *
	 * Método que vai obter os dados e validar arquivos de configuração de 
	 * formulários. Também vai armazenar a configuração em $this->formConf
	 * 
	 * @param string $file Arquivo a ser validado e incluído
	 * @access private
	 * @return void
	 * 
	 * @throws InvalidArgumentException Se o arquivo não for .json
	 * @throws InvalidArgumentException Se o arquivo não existir
	 * 
	 * @throws ValidationException 	Se validacoes requisitadas não existirem 
	 * 								nesta classe
	 */
	private function includeFile(string $file)
	{
		// Checar extensão do arquivo
		$format = explode('.', $file);
		if (end($format) != "json")
		{
			$error = "'{$file}' não é um aquivo .json";
			throw new InvalidArgumentException($error);
		}
		// Chegar existência do arquivo
		if (!file_exists($file))
		{
			$error = "O arquivo '{$file}' não existe";
			throw new InvalidArgumentException($error);
		}
		// Obter dados do arquivo
		$confs = json_decode(file_get_contents($file));

		// Validar os dados do objeto
		foreach (get_object_vars($confs) as $attr => $value)
		{
			$confs->$attr->validate = 
				array_map("trim", explode(',', $value->validate));

			foreach ($confs->$attr->validate as $value)
			{
				if (!method_exists($this, $value) and !empty($value))
				{
					$error = "Validação '$value' inexistente nessa classe.";
					throw new ValidationException($error);
				}
			}
		}
		$this->formConf = $confs;
	}

	/**
	 * function validate()
	 *
	 * Valida o formulário usando funcoes implementadas na classe 
	 * ValidatorFunctions.
	 *
	 * @return boolean
	 * @access public
	 */
	public function validate()
	{
		print_r($this->data);
		foreach ($this->data as $key => $field)
		{
			foreach ($this->formConf->$key->validate as $function)
			{
				if (!$this->$function($field, $this->formConf->$key))
				{
					return false;
				}
			}
		}
		return true;
	}
}