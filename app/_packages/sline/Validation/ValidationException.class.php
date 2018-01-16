<?php
namespace sline\Validation;
/**
 * InvalidValidateException - Exception para erros de validacao
 *
 * @author Caio Corrêa Chaves
 */
class ValidationException extends \Exception
{
	function __construct($message, $cod = 0)
	{
		parent::__construct($message, $cod);
	}
	public function __toString()
	{
		$return = "<br/> <br />" . get_class($this) . "<br />";
		$return .= "Error message: {$this->getMessage()} <br />";
		$return .= "Error code: {$this->getCode()} <br />";
		$return .= "Error file: {$this->getFile()} <br />";
		$return .= "Error line: {$this->getLine()} <br /> <br />";
		
		return $return;
	}
}