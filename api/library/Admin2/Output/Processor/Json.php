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
    /**
     * Convert data to JSON and set response
     *
     * @param Admin2_Controller_Response $response Response object
     *
     * @return string
     */
    public function process(Admin2_Controller_Response $response)
    {
        $response->addResponseHeader('Content-Type', 'application/json; charset=utf-8', true);

        return json_encode($response->getData());
    }
}
