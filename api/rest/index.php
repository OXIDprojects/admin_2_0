<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

/**
 * Returns the filesystem path to the OXID eShop installation.
 *
 * The default path is (relative to this directory) "../../". In case you've installed OXID somewhere in the filesystem,
 * you can set the shop path via environment variable.
 * For Apache in .htacces: SetEnv /path/to/oxid/
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

/**
 * Admin2 autoloader function
 */
function admin2Autoloader($className)
{
    $fileName = dirname(__FILE__) . "/"
        . str_replace(array("Admin2_", "_"), array("", "/"), basename($className)) . ".php";

    if (!file_exists($fileName)) {
        throw new Exception("Can't find file '$fileName'");
    }

    require_once $fileName;

    if (!class_exists($className)) {
        throw new Exception("Can't load class '$className'.");
    }
}

require dirname(__FILE__) . "/config.inc.php";

/**
 * Load OXID Core Classes
 */
require getShopBasePath() . 'modules/functions.php';
require_once getShopBasePath() . 'core/oxfunctions.php';
$myConfig = oxConfig::getInstance();
oxUtils::getInstance()->stripGpcMagicQuotes();
$iDebug = $myConfig->getConfigParam('iDebug');
set_exception_handler(array(oxNew('oxexceptionhandler', $iDebug), 'handleUncaughtException'));

spl_autoload_register("admin2Autoloader");

//here we go
$oDispatcher = new Admin2_Dispatcher;
$oDispatcher->run();
