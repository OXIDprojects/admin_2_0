<?php

/**
 * Static class takes care of finding Fields to render 
 */
class Field_Definitions
{

    /**
     * Renders an array of items
     * 
     * @param object $info Containing property $Items as array of of Fields; 
     * 
     */
    static function renderItems($info)
    {
        foreach ($info->Items as $obj)
        {
            Field_Definitions::renderField($obj);
        }
    }

    /**
     * Renders a single Field
     * @param object $info Representing a Field
     */
    static function renderField($info)
    {
        include "Fields/" . $info->Type . ".php";
    }

}

?>