<?php

class Admin2_Output_Processor_Xml extends Admin2_Output_Processor_Base
{
    public function sendResults()
    {   
        header('Content-Type:text/xml');
        echo '<hello>world</hello>';
    }
}