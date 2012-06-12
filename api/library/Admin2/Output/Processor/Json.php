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
 * Handle JSON output
 */
class Admin2_Output_Processor_Json implements Admin2_Output_Processor_Interface
{
    public function process(Admin2_Controller_Response $result)
    {
        $result->addResponseHeader('Content-Type', 'application/json', true);

        return json_encode($result->getData());
    }
}
