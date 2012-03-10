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
                   '(\.(?P<format>xml|json|csv)?)?'.
                   '/';
        preg_match($pattern, $subject, $this->matches);

        $method = $this->getRequestMethod();

        ## Init the controller
        $oController = $this->getController($this->matches["controller"]);
        $oController->execute($method, null, $_REQUEST);

        ## Init output processor
        $oOutputProcessor = $this->getOutputProcessor();
        #$oOutputProcessor->init($oController->getResult());
        #$oOutputProcessor->sendHeaders();
        $oOutputProcessor->sendResults();

        die();
    }

    /**
     * Returns Controller
     *
     * @param string $sController Controller name
     *
     * @return Admin2_Controller_Base;
     */
    protected function getController($sController)
    {
        $class = 'Admin2_Controller_'.ucfirst($sController);

        if (class_exists($class))
        {
            $oController = new $class;
        } else {
            $oController = new Admin2_Controller_Base();
        }

        return new $oController;
    }

    /**
     * Returns Output Processor
     *
     * @return Admin2_OutputProcessor;
     */
    protected function getOutputProcessor()
    {
        $format = (isset($this->matches['format'])) ? $this->matches['format'] : 'Json';
        $class = 'Admin2_Output_Processor_'.ucfirst($format);
        return new $class;
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