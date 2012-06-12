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
 * Handle XML output
 */
class Admin2_Output_Processor_Xml implements Admin2_Output_Processor_Interface
{
    public function process(Admin2_Controller_Response $result)
    {
        $result->addResponseHeader('Content-Type', 'text/xml', true);

        $xml = <<<EOXML
<?xml version="1.0" encoding="utf-8"?>
<result>
    %s
</result>
EOXML;

        $xmlSnippet = '';
        foreach ($result->getData() as $key => $value) {
            $xmlSnippet .= "<data name=\"$key\">$value</data>\n";
        }

        $xml = sprintf($xml, $xmlSnippet);

        return $xml;
    }
}
