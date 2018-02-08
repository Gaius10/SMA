<?php
/**
 * Created by PhpStorm.
 * User: caio
 * Date: 01/10/17
 * Time: 15:19
 */

namespace mvc;

class Connection
{
    const USERNAME = DB_USERNAME;
    const CHARSET = DB_CHARSET;
    const PASSWORD = DB_PASSWORD;
    const HOSTNAME = DB_HOSTNAME;

    private $dbName;
    private $connection;


    function __construct($dbName)
    {
        $this -> dbName = $dbName;
    }

    private function connect()
    {
        $dbName = $this -> dbName;

        $conn = mysqli_connect(self::HOSTNAME, self::USERNAME, self::PASSWORD, $dbName) or die(mysqli_connect_error());
        //setar default charset
        mysqli_set_charset($conn, self::CHARSET) or die(mysqli_error($conn));

        $this -> connection = $conn;
    }

    private function close()
    {
        mysqli_close($this -> connection) or die(mysqli_error($this -> connection));
    }


    private function escapeString($dados)
    {

        //se a variavel NAO é um array coloque os caracteres de escape nela mesma
        if (!is_array($dados))
            $dados = mysqli_real_escape_string($this -> connection, $dados);
        else
        {
            //se a variavel É um array faça o mesmo procedimento para cada elemento desse array
            foreach ($dados as $key => $value)
                $dados[$key] = mysqli_real_escape_string($this -> connection, $value);
        }

        return $dados;
    }

    private function execute($query)
    {
        //execute a query indicada e armazene na variavel result
        $result = mysqli_query($this -> connection, $query) or die(mysqli_error($this -> connection));


        return $result;
    }












    /**
     * Método responsável pelo registro de dados
     */
    public function register($table, array $dados)
    {
        $this -> connect();

        $dados = $this -> escapeString($dados);

        $fields = implode(',', array_keys($dados));

        $dados  = "'" . implode("', '", $dados) . "'";

        //Montar query na variavel
        $query = "INSERT INTO {$table}({$fields}) VALUES ({$dados}) ";

        $this -> execute($query);

        $this -> close();

        return true;
    }

    /*
     * ler dados
     */
    public function read($tables, $fields = "*", $params = null)
    {
        $this->connect();
        $dados = null;

        $params = ($params) ? " {$params}" : null;
        $query = "SELECT {$fields} FROM {$tables}{$params}";
        
        //echo "<br /><br /><br /> <hr />$query";

        $result = $this->execute($query);

        if (!mysqli_num_rows($result))
        {
            return false;
        }
        else
        {
            while($array = mysqli_fetch_assoc($result))
            {
                $dados[] = $array;
            }
        }

        if (count($dados) == 1)
        {
            $dados = $dados[0];
        }

        $this -> close();
        return $dados;
    }

    /*
     * Alterar dados
     */
    public function update($table, array $values, $where = null)
    {
        $this->connect();

        foreach ($values as $key => $value)
        {
            $values[$key] = "$key = '$value'";
        }

        $values = implode(", ", $values);


        $where = ($where) ? " {$where}" : null;


        $query = "UPDATE {$table} SET {$values}{$where}";

        $result = $this->execute($query);

        $this->close();
        return $result;
    }

    /*
     * Deletar registros
     */
    public function delete($table, $where = null, $limit = 1)
    {
        $this -> connect();

        if (!$where)
        {
            $query = "TRUNCATE {$table}";
        }
        else
        {
            $query = "DELETE FROM {$table} WHERE {$where} LIMIT {$limit}";
        }

        $result = $this -> execute($query);

        $this -> close();
        return $result;
    }










    /**
     * Método que obtem dados de duas tabelas a partir das PKs FKs de uma
     * tabela de relacionamento
     *
     *  FORMATO DO ARRAY $cods
     *      -> $cods["COD_tabela1"] = $valor1; // indice igual no db
     *      -> $cods["COD_tabela2"] = $valor2; // indice igual no db
     *      -> NAO INSERIR DADO DA TABELA DE RELACIONAMENTO
     *
     *  FORMATO DA STRING $tables
     *      ->"<t_relacionamento>, <t_doPrimeiroCod>, <t_doSegundoCod>";
     *
     */
    public function relacionar(array $cods, string $tables)
    {
        ## Validar parametro $cod.
        if (count($cods) <> 2)
        {
            echo (DEBUG) ? 'Muitos ou poucos valores enviados em $cods' : "";
            return false;
        }

        ## Validar parâmetro $tables.
        $tables = array_map('trim', explode(',', $tables));
        if (count($tables) <> 3)
        {
            echo (DEBUG) ? 'Muitos ou poucos valores enviados em $tables' : "";
            return false;
        }

        ## Fazer consultas.
        $returnArray = null; // array de retorno com os dados das tres tabelas.
        $keys = null; // chaves do array $cods.

        foreach ($cods as $key => $value)
            $keys[] = $key;

        $key1 = $keys[0];
        $key2 = $keys[1];

        # Consulta à tabela de relacionamento.
        $where = "WHERE $key1 = '$cods[$key1]' AND ";
        $where .= "$key2 = '$cods[$key2]'";
        $returnArray[] = $this->read("$tables[0]", "*", $where);

        # Consulta à segunda tabela.
        $where = "WHERE $key1 = '$cods[$key1]'";
        $returnArray[] = $this->read("$tables[1]", "*", $where);
        
        # Consulta à terceira tabela.
        $where = "WHERE $key2 = '$cods[$key2]'";
        $returnArray[] = $this->read("$tables[2]", "*", $where);

        return $returnArray;
    }




    ######## Repensar esta função ########
    /**
     * Método que testa a existencia de algo no banco de dados pelo seu codigo.
     *
     * Array cod deve ser assim:
     *      ## $cod = ["NOME_DO_CAMPO_NO_BD" => $valor]; ##
     */
    public function existInDataBase(string $table, array $cod)
    {
        if (count($cod) == 1)
        {
            $key = array_keys($cod);
            $key = $key[0];

            $where = "WHERE $key = '$cod[$key]'";
            $item = $this->read($table, "*", $where);

            if ($item)
                return true;
            else
                return false;
        }
        else
        {
            echo 'array $cod com muitos parametros.';
            return false;
        }
    }
}
