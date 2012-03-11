<?php

class Admin2_Controller_Products extends Admin2_Controller_Abstract
{
    public function getResults() {
        //.. do some stuff..
        $results = new Admin2_Model_Results;
        return $results;
    }
}
