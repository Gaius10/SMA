<?php

/**
 * Created by PhpStorm.
 * User: caio
 * Date: 03/06/17
 * Time: 18:09
 */

class Autoload
{
    private $archives;

    public function __construct()
    {
        spl_autoload_register([$this,'folders']);
    }

    public function folders($file)
    {
        $file = str_replace('\\','/',$file);

        // echo "<hr /> <br /> <br />" . $file . "<br /> <br/>";

        $this->archives = [
            ROOT_PATH . '/app/_packages/' . $file . '.class.php',
            ROOT_PATH . '/app/models/' . $file . '.php'
        ];
        
        foreach ($this -> archives as $archive)
        {
            // echo $archive . "<br>";
            if (file_exists($archive))
            {
                require_once $archive;
            }
        }
    }
}
new Autoload();
