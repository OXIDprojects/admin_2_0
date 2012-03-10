<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

function getShopBasePath()
{
    $sDs = DIRECTORY_SEPARATOR;
    return dirname(__FILE__).$sDs.'..'.$sDs.'..'.$sDs;
}

/**
 * Load OXID Core Classes
 */
require getShopBasePath() . 'modules/functions.php';
require_once getShopBasePath() . 'core/oxfunctions.php';
$myConfig = oxConfig::getInstance();
oxUtils::getInstance()->stripGpcMagicQuotes();
$iDebug = $myConfig->getConfigParam('iDebug');
set_exception_handler(array(oxNew('oxexceptionhandler', $iDebug), 'handleUncaughtException'));

foreach (glob('controller/controller_*.php') as $file)
{
    require_once($file);
}

require_once('dispatcher.php');
