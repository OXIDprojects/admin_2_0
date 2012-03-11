<?php

/**
 * Request Dispatcher
 */
class Admin2_Dispatcher
{
    /**
     * @var Admin2_Controller_Request_Abstract
     */
    protected $_request;


    protected $_outputProcessor;

    public function __construct(
        Admin2_Controller_Request_Abstract $request,
        Admin2_Output_Processor_Base $outputProcessor
    )
    {
        $this->_request = $request;
        $this->_outputProcessor = $outputProcessor;
    }

    public function request($key)
    {
        return oxConfig::getParameter($key);
    }

    /**
     * Starting point for dispatcher execution
     *
     * @return null
     */
    public function run()
    {
        $method = $this->_request->getMethod();

        ## Init the controller
        $controllerName = ucfirst($this->_request->getContoller());
        $class = "Admin2_Controller_$controllerName";

        if (class_exists($class))
        {
            $controller = new $class();
        } else {
            throw new Admin2_Controller_Exception("Can't find controller '$controllerName'.");
        }

        $oController = $this->getController($this->_request->getContoller());
        $oController->execute($method, $this->_request->getEntity(), $_REQUEST);

        ## Init output processor
        $oOutputProcessor = $this->getOutputProcessor();
        $oOutputProcessor->init($oController->getResult());
        $oOutputProcessor->sendHeaders();
        $oOutputProcessor->sendResults();

        die();
    }

    /**
     * Returns Output Processor
     *
     * @return Admin2_OutputProcessor;
     */
    protected function getOutputProcessor()
    {
        $format = (isset($this->matches['format'])) ? $this->matches['format'] : 'Json';
        $class = 'Admin2_Output_Processor_' . ucfirst($format);
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
