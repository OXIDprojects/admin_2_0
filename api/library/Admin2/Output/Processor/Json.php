<?php

class Admin2_Output_Processor_Json implements Admin2_Output_Processor_Interface
{
    public function process(Admin2_Controller_Result $result)
    {
        $result->addResponseHeader('Content-Type', 'application/json', true);

        return json_encode($result->getData());
    }
}