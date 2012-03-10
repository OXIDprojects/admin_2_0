<?php

class Admin2_Output_Processor_Json extends Admin2_Output_Processor_Base
{
    public function sendResults()
    {   
        header('Content-Type:application/json');
        echo json_encode(array('hello'=>'world'));
    }
}