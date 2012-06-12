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
 final class Config {

   // Anlegen der Instanz
   private static $instance = NULL;

    public $classesDir = array(
        '/core/',
        '/controller/',
        '/views/',
        '/views/widgets/'
    );



   // Konstruktor private, damit die Klasse nur aus sich selbst heraus instanziiert werden kann.
   private function __construct() {}

   // Diese statische Methode gibt die Instanz zurueck.
   public static function getInstance() {

       if (NULL === self::$instance) {
           self::$instance = new self;
       }
       return self::$instance;
   }
   // Klonen per 'clone()' von außen verbieten.
   private function __clone() {}
 }
