<?php

/**
 * Request Dispatcher
 */
class Admin2_Dispatcher {

    public function request($key)
    {
        return oxConfig::getParameter($key);
    }

    /**
     * Dispatcher
     */
    public function __construct()
    {   
        $subject = $_SERVER['REQUEST_URI'];
        $pattern = '/'. 
                   '(.*)\/rest\/'.
                   'v(?P<version>[0-9])\/'.
                   '(?P<controller>products|categories|orders)'.
                   '\/?(?P<entity>[A-Za-z0-9]*)?'.
                   '(\.(?P<format>xml|json)?)?'.
                   '/';
        preg_match($pattern, $subject, $this->matches);

        /*
        if ($valid)
        {
            
            echo '<pre>';
            echo '<strong>Matches</strong><br>';
            print_r($matches);
            echo '<strong>Controller</strong><br>';
            print_r($controller);
            echo '<strong>Request</strong><br>';
            print_r($_REQUEST);
        } */

        $method = $this->getRequestMethod();

        ## Init the controller
        $oController = $this->getController();
        $oController->execute($method, null, $_REQUEST);

        echo '<pre>';
        print_r($oController);

        ## Init output processor
        $oOutputProcessor = $this->getOutputProcessor();
        #$oOutputProcessor->init($oController->getResult());
        #$oOutputProcessor->sendHeaders();
        #$oOutputProcessor->sendResults();

        die();
    }

    /**
     * Returns Controller
     *
     * @return Admin2_Controller;
     */
    protected function getController()
    {
        $class = 'Admin2_Controller_'.$this->matches['controller'];
        return new $class;
    }

    /**
     * Returns Output Processor
     *
     * @return Admin2_OutputProcessor;
     */
    protected function getOutputProcessor()
    {
        ## TODO - implement this function
        return new stdClass;
    }

    /**
     * Returns server request method
     *
     * @return string;
     */
    protected function getRequestMethod()
    {
        //TODO: read forced method param from request
        return $_SERVER["REQUEST_METHOD"];
    }
}