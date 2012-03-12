<?php

class Admin2_Output_Processor_Xml implements Admin2_Output_Processor_Interface
{
    public function process(Admin2_Controller_Result $result)
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