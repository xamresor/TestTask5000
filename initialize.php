<?php
define('ROOT_DIR', dirname(__FILE__));

require_once ROOT_DIR.'/lib/commonFunctions.php';

function config($key = '') {
    $config = parse_ini_file('config.ini');
    return isset($config[$key]) ? $config[$key] : null;
}

if(session_id() == "") {
    session_start();
}

spl_autoload_register(function ($class) {
    $name = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = ROOT_DIR."/classes/$name.php";
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
});
