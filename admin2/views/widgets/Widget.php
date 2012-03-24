<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Astract of Widget
 *
 * @author rafael
 */
abstract class Widget
{

    public $Type;
    public $bHasJs = false; 
    public $jsLibs = array( );
    public $bHasJsDoc = false; 

    
    /**
     * Initializes Widget Objects
     * @param object of StdClass $oData 
     */
    public function __construct($oData)
    {
        $this->Type = get_class($this);

        foreach (get_object_vars($oData) as $key => $field)
        {

            $this->$key = $field;
        }
        if(isset($this->Items))
        {
            foreach ($this->Items as $key =>$widget)
            {
                $this->Items[$key] = new $widget->Type($widget); 
            }
        }
    }

    /**
     * Generates and returns the HTML Output representing this Class
     * @return string
     */
    public abstract function output();
    
    /**
     * Returns JS Script wich should be executet when Document is Ready
     * @return string 
     */
    public function getJsDocReady()
    {
    return ""; 
    }
}

?>
