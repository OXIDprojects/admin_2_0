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
 * Handel CSV output
 */
class Admin2_Output_Processor_Csv implements Admin2_Output_Processor_Interface
{
    /**
     * Return result set as CSV
     *
     * @param Admin2_Controller_Response $response Result set as array
     *
     * @return string Converted result set as CSV-String with field names in first line
     */
    public function process(Admin2_Controller_Response $response)
    {
        $response->addResponseHeader('Content-Type', 'text/plain', true);
        $data     = $response->getData();
        $keys     = array_keys($data);
        $key      = $keys[0];
        $fields   = array_keys($data[$key]);
        $headLine = implode(',', $fields);
        $ret      = $headLine ."\n";
        foreach ($data as $line) {
            $ret .= '"' . implode('","', str_replace('"', '\"', $line)) . "\"\n";
        }
        return $ret;
    }
}
