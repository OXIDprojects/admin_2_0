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

define('ROOT_DIR', realpath(dirname(__FILE__)));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author rafael
 */
final class Config
{
    /**
     * Instance
     *
     * @var Config
     */
    private static $_instance = NULL;

    /**
     * Classes directories
     *
     * @var array
     */
    public $classesDir = array(
        '/core/',
        '/controller/',
        '/views/',
        '/views/widgets/'
    );

    /**
     * Constructor
     */
    private function __construct()
    {
    }

    /**
     * Get instance
     *
     * @static
     *
     * @return Config
     */
    public static function getInstance()
    {

        if (NULL === self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Disallow cloning for singleton
     *
     * @return void
     */
    private function __clone()
    {
    }
}
