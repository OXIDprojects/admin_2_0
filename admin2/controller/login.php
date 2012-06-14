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
 * Log in class
 */
class login
{
    // Name of the templatefile
    protected $_templateName = 'login.php';

    /**
     * Prepare content and return the output
     *
     * @return rendered output
     */
    public function render()
    {
        return $this->_templateName;
    }
}
