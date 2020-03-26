<?
error_reporting(E_ERROR | E_PARSE);
@set_time_limit(0);
@ini_set('memory_limit', '512M');
header('Content-Type: text/html; charset=utf-8');
require 'vendor/autoload.php';

use LParser\Execute;

if ($_GET['site']){

    $parser = new Execute();

    $parser->initParser($_GET['site']);

    if ($_GET['dump']){
        Execute::dump($parser->result);
    }

    Execute::createFile($parser->result, $_GET['site']);
}

