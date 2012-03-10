<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

function getShopBasePath()
{
    return ADMIN2_SHOP_PATH;
}

/**
 * Admin2 autoloader function
 */
function admin2Autoloader($sClassName)
{
    $sFileName = dirname(__FILE__) . "/" . str_replace(array("Admin2_","_"), array("", "/"), basename($sClassName)) . ".php";

    if (file_exists($sFileName)) {
        require_once($sFileName);
    } else {
        throw new Exception("Class $sClassName was not found");
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
