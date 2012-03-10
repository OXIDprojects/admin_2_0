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
    public function run()
    {   
        $subject = $_SERVER['REQUEST_URI'];
        $pattern = '/'. 
                   '(.*)\/rest\/'.
                   'v(?P<version>[0-9])\/'.
                   '(?P<controller>products|categories|orders)'.
                   '\/?(?P<entity>[A-Za-z0-9]*)?'.
                   '(\.(?P<format>xml|json)?)?'.
                   '/';
        preg_match($pattern, $subject, $matches);

        /*
        if ($valid)
        {
            $controller = new $controller_class;
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
        $oController = $this->getController($controller);
        $oController->execute($method, $entity, $_REQUEST);

        ## Init output processor
        $oOutputProcessor = $this->getOutputProcessor();
        $oOutputProcessor->init($oController->getResult());
        $oOutputProcessor->sendHeaders();
        $oOutputProcessor->sendResults();

        die();
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