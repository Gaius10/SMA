<?php
namespace sline\Validation;
/**
 * ValidationFunctions - Classe com as funcoes de validacao para a classe 
 * Validator
 *
 * @author Caio Corrêa Chaves
 * @version 1.0
 */
class ValidatorFunctions
{
    /**
     * $error
     * 
     * @var string
     * @access public
     * 
     * Receberá erros de validacao caso existam dados inválidos
     */
    public $error;


    /**
     * function required($field)
     *
     * @access protected
     * @param string|array    $value    Valor a ser checado
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     *
     * Retorna FALSE se a string passada for vazia ou nula
     */
    protected function required($value, $field)
    {
        $desc = $field->description;
        $this->error = "O preenchimento do campo '{$desc}' é obrigatório";
        if (is_array($value)) {
            return (empty($value['pass'])) ? false : true;
        } else {
            return (empty($value)) ? false : true;
        }
    }

    /**
     * function fullName($field)
     *
     * @access protected
     * @param string          $value    Valor a ser checado
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     *
     * Retorna FALSE se a string passada não for considerada um nome completo
     * A string é considerada nome completo se possuir ao menos duas palavras
     */
    protected function fullName(string $value, $field)
    {
        $desc = $field->description;
        $this->error = "O campo '$desc' deve conter um nome completo";
        return (count(explode(' ', $value)) < 2) ? false : true;
    }

    /**
     * function name($field)
     *
     * @access protected
     * @param string          $value    Valor a ser checado
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     *
     * Retorna FALSE se a string passada não for somente alfabética
     */
    protected function string($value, $field)
    {
        $desc = $field->description;
        $this->error = "O campo '$desc' deve ser totalmente alfabético";
        return !!preg_match('|^[\pL\s]+$|u', $value);
    }

    /**
     * function noSpaces
     * 
     * @access protected
     * @param string          $value    Valor a ser checado
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     * 
     * Retorna FALSE se o valor passado conter espacos
     */
    protected function noSpaces(string $value, $field)
    {
        $desc = $field->description;
        $this->error = "O campo '$desc' não deve conter espaços";
        return (count(explode(' ', $value)) > 1) ? false : true;
    }

    /**
     * function email
     * 
     * @access protected
     * @param string          $email    Email a ser validado
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     * 
     * Retorna FALSE se o valor passado não seguir o formato do seguinte 
     * exemplo de email: exemplo@exemplo.com
     */
    protected function email(string $email, $field)
    {
        $this->error = "O email enviado é inválido";
        $v = explode('@', strtolower($email));

        if (count($v) != 2 ||
            count(explode('.', end($v))) < 2
        ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * function password()
     * 
     * @access protected
     * @param array           $pass     Senha e confirmacao a serem checadas
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     * @throws InvalidArgumentException Se $field nao possuir um campo de
     *                                  confirmação de senha - confirm
     * @throws ValidationException      Se o campo minLength no arquivo JSON
     *                                  não possuir um valor do tipo inteiro
     * 
     * O array $pass deve ter o seguinte formato:
     * $pass = array(
     *      "pass" => <senha>,
     *      "confirm" => <confirmacao>
     * );
     * 
     * Retorna FALSE se:
     *  -> As senhas não forem iguais
     *  -> A senha for menor do que o requerido
     */
    protected function password(array $pass, $field)
    {
        if (!isset($pass['confirm'])) {
            $error = "Para a validação de senha, deve existir uma confirmação";
            throw new \InvalidArgumentException($error);
        } else {
            // Confirmacao de senha
            if ($pass['pass'] != $pass['confirm']) {
                $this->error = "As senhas não conferem";
                return false;
            }
            // Confirmação de tamanho
            if (isset($field->minLength)) {
                if (!is_int($field->minLength)) {
                    $error = "'minLength' deve conter um valor inteiro";
                    throw new ValidationException($error);
                } else {
                    $this->error = "A senha deve conter no mínimo 
                    {$field->minLength} caracteres";

                    if (strlen($pass['pass']) < $field->minLength) {
                        return false;
                    } else {
                        return true;
                    } 
                }
            }
            return true;
        }
    }

    /**
     * function len()
     * 
     * @access protected
     * @param array           $value    Dado a ser checado
     * @param stdClass Object $field    Dados para validação do campo enviados 
     *                                  via JSON
     * @return boolean
     * @throws ValidationException      Se o campo len no arquivo JSON
     *                                  não possuir um valor do tipo inteiro
     * @throws ValidationException      Se nao foi informado um campo len no
     *                                  arquivo JSON
     */
    protected function len(string $value, $field)
    {
        $desc = $field->description;
        $this->error = "O campo '{$desc}' possui tamanho inválido";

        if (!isset($field->len)) {
            $error = "Tamanho do campo não informado no arquivo JSON";
            throw new ValidationException($error);
        } else if (!is_int($field->len)) {
            $error = "O tamanho do campo deve ser um número inteiro";
            throw new ValidationException($error);
        } else {
            return (strlen($value) != $field->len) ? false : true;
        }
    }
}
