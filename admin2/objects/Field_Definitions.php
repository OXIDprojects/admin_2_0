<?php

class Field_Definitions
{

    static function renderItems($info)
    {
        foreach ($info->Items as $obj)
        {
            Field_Definitions::renderField($obj);
        }
    }
    
    static function renderField($info)
    {
         include "Fields/".$info->Type.".php";
    }
}
?>