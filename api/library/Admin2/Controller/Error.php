<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 * @link      http://admin20.de
 * @copyright (C) 2012 :: Admin 2.0 Developers
 */
/**
 * Error class
 */
class Admin2_Controller_Error
{
    /**
     * HTML head for the formatted output.
     *
     * @var string
     */
    private $_htmlHead = '<html>
        <head><title>Error occurred.</title></head>
        <body><h1>An error has been occurred!</h1>
        <table border="2">';

    /**
     * HTML foot for the formatted output.
     *
     * @var string
     */
    private $_htmlFoot = '</table></body></html>';

    /**
     * Get dump of thrown exception
     *
     * @param Exception $exception Thrown exception
     *
     * @return string
     */
    public function error(Exception $exception)
    {
        if (APPLICATION_ENV == 'development') {
            ob_start();
            $htmlErrors = ini_get('html_errors');
            if ($htmlErrors) {
                echo $this->_htmlHead;
            }

            $xdebugMessage = 'xdebug_message';
            if (isset($exception->$xdebugMessage)) {
                echo $exception->$xdebugMessage;
            } else {
                var_dump($exception);
            }

            if ($htmlErrors) {
                echo $this->_htmlFoot;
            }

            return ob_get_clean();
        }
        return $exception->getMessage();
    }
}
