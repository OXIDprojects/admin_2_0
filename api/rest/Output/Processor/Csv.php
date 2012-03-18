<?php

class Admin2_Output_Processor_Csv implements Admin2_Output_Processor_Interface
{
    public function process(Admin2_Controller_Result $result)
    {
        $result->addResponseHeader('Content-Type', 'text/plain', true);

        return implode(',', $result->getData());
    }
}