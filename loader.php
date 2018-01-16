<?php

use system\App;

if (!ROOT_PATH)
    exit("Erro interno.");

session_start();

if(DEBUG === true)
{
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
else
{
    error_reporting(0);
    ini_set("display_errors", 0);
}

require_once ROOT_PATH . "/libs/functions/global-functions.php";
require_once "Autoload.php";

$system = new App();
