<?php

class Admin2_Output_Processor_Csv extends Admin2_Output_Processor_Base
{
    public function sendResults()
    {   
        header('Content-Type:text/plain');
        echo '"hello";"world"';
    }
}