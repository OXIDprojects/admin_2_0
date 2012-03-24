<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Content
 *
 * @author rafael
 */
class Content extends Widget
{

    public $Items = Array();

    //put your code here


    public function output()
    {
        $output = "";
        foreach($this->Items as $item)
        {
         $output.= $item->output(); 
        }
        return $output;
    }
}

?>
