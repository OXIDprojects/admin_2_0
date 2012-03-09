<?php

if ( !function_exists( 'isAdmin' )) {

    /**
     * Returns true.
     *
     * @return bool
     */
    function isAdmin()
    {
        return true;
    }
}

// Includes main index.php file
require_once dirname(__FILE__)."/../../index.php";
