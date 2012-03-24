<?php

header('Content-type: text/html; charset=utf-8');
include 'config.php';

/**
 *Autpoloader for all Classes
 * @param string $class_name
 * @return void 
 */
function __autoload($class_name)
{

    foreach (Config::getInstance()->classesDir as $directory)
    {
        if (file_exists(ROOT_DIR . $directory . $class_name . '.php'))
        {
            require_once (ROOT_DIR . $directory . $class_name . '.php');
            return;
        }
    }
}

error_reporting(E_ALL);

$template = new Admin_Template();
$template->run("/json/page.json");
?>

