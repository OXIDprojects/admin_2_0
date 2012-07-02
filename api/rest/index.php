<?php
error_reporting(E_ALL ^ E_NOTICE); // Oxid-classes throw notices so we block them here
ini_set('display_errors', 1);

defined('APPLICATION_PATH') || define('APPLICATION_PATH', dirname(__FILE__));

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

// Now we add the library and OXID path to the include paths.
// Adding the OXID path prevent us to use code like "require getShopBasePath() . 'core/oxfunctions.php';"
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(dirname(__FILE__) . '/../library'),
            getShopBasePath(),
            get_include_path(),
        )
    )
);
         
/**
 * Load OXID core classes.
 */
require 'modules/functions.php';
require 'core/oxfunctions.php';

// Load and initialize our main autoloader.
require 'Admin2/Loader/Autoloader.php';
$loader = Admin2_Loader_Autoloader::getInstance();
$loader->registerNamespace('Admin2');

// Initialize our module loader.
// The module loader loads e.g. the models (currently only the models, but easily extendable).
$moduleLoader = Admin2_Loader_ModuleLoader::getInstance();

// tabsl
// only for testing oauth
require 'api/rest/lib/oAuth2/OAuth2.inc'; 
$oAdm2pAuth = new adm2oauth();
$oAdm2pAuth->checkApiLogin('9826aff0657076aa1774396a865e8d64');


// Here we go.
$request    = new Admin2_Controller_Request_Http();
$result     = new Admin2_Controller_Result();
$dispatcher = new Admin2_Dispatcher($request, $result);
$dispatcher->run();
