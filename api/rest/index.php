<?php
error_reporting(E_ALL ^ E_NOTICE); // Oxid-classes throw notices so we block them here
ini_set('display_errors', 1);

/**
 * Returns the filesystem path to the OXID eShop installation.
 *
 * The default path is (relative to this directory) "../../". In case you've installed OXID somewhere in the filesystem,
 * you can set the shop path via environment variable.
 * For Apache in VHost configuratio or .htacces: SetEnv OXID_SHOP_PATH /path/to/oxid/
 *
 * @return string
 */
function getShopBasePath()
{
    $oxidShopPath = getenv('OXID_SHOP_PATH');
    if ($oxidShopPath !== false) {
        return rtrim($oxidShopPath, '/') . '/';
    }

    return dirname(__FILE__) . '/../../';
}

set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            dirname(__FILE__),
            get_include_path(),
        )
    )
);

require 'Autoloader.php';
$loader = Admin2_Autoloader::getInstance();

/**
 * Load OXID Core Classes
 */
require getShopBasePath() . 'modules/functions.php';
require getShopBasePath() . 'core/oxfunctions.php';

//here we go
$request    = new Admin2_Controller_Request_Http();
$result     = new Admin2_Controller_Result();
$dispatcher = new Admin2_Dispatcher($request, $result);
$dispatcher->run();
