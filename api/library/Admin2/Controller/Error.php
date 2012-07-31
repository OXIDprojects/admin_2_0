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
    private $htmlHead = '<html>
        <head><title>Error occurred.</title></head>
        <body><h1>An error has been occurred!</h1>
        <table border="2">';

    private $htmlFoot = '</table></body></html>';
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

            if (isset($exception->xdebug_message)) {
                $message = $exception->xdebug_message;
                $htmlErrors = ini_get('html_errors');
                return ($htmlErrors ? $this->htmlHead : '') . $message . ($htmlErrors ? $this->htmlFoot : '');
            }

            ob_start();
            var_dump($exception);
            return ob_get_clean();
        }
        return $exception->getMessage();
    }
}
