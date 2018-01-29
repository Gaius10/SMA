<?php
namespace Exceptions;
/**
 * DatabaseException - Excessão lançada quando há erros relacionados à conexão
 * ou acesso ao banco de dados
 * 
 * @author Caio Corrêa Chaves
 */
class DatabaseException extends \Exception
{
    
    /**
     * function __construct($message, $cod)
     * 
     * @param string $message Menssagem do erro
     * @param int    $cod     Codigo do erro
     * 
     * @return void
     */
    function __construct(string $message,int $cod = 0)
    {
        parent::__construct($message, $cod);
    }

    /**
     * function __toString()
     * 
     * Permite que a instancia desta classe possa ser impressa como uma string
     * 
     * @access public
     * @return string
     */
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
