<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 *  @link      http://admin20.de
 *  @copyright (C) 2012 :: Admin 2.0 Developers
 */
/**
 * Error class
 */
class Admin2_Controller_Error
{
    /**
     * Get dump of thrown exception
     *
     * @param Exception $exception Thrown exception
     *
     * @return string
     */
    public function error(Exception $exception)
    {
        ob_start();
        var_dump($exception);
        return ob_get_clean();
    }
}
