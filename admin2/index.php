<?php

/**
 * Returns shop base path.
 *
 * @return string
 */
function getShopBasePath()
{
    return dirname(__FILE__).'/';
}

// configuration for Admin2.0
include 'config.php';


/**
 * Autoloader for all Classes
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

$template = new adminTemplate();
$template->run();
?>

