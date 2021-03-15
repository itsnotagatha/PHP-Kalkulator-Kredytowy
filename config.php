<?php //NIE RUSZAĆ
define('_SERVER_NAME', 'localhost:8080');
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/zadanie_2');
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));

//przekazanie parametru przez zmienna &
function out(&$param){
    if(isset($param)){
        echo $param;
    }
}
?>