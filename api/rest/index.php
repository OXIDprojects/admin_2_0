<?php

#require_once('lib/...');
require_once('dispatcher.php');
=======
if ( !function_exists( 'isAdmin' )) {
    function isAdmin()
    {
        return true;
    }
}

// Includes main index.php file
require_once dirname(__FILE__)."/../../index.php";