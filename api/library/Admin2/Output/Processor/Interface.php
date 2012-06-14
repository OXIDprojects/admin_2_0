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
 * Interface definition for output processors
 */
interface Admin2_Output_Processor_Interface
{
    /**
     * Convert data to target format and set response
     *
     * @param Admin2_Controller_Response $response Response object
     *
     * @abstract
     *
     * @return string
     */
    public function process(Admin2_Controller_Response $response);
}
