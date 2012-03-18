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

    /**
     * @var Admin2_Output_Processor_Interface
     */
    protected $_outputProcessor;

    /**
     * @var Admin2_Controller_Result
     */
    protected $_result;

    public function __construct(
        Admin2_Controller_Request_Abstract $request,
        Admin2_Controller_Result $result
    )
    {
        $this->_request = $request;
        $this->_result = $result;

        $outputProcClass = "Admin2_Output_Processor_" . ucfirst($request->getFormat());
        $this->_outputProcessor = new $outputProcClass();
    }

    /**
     * Starting point for dispatcher execution
     *
     * @return null
     */
    public function run()
    {
        try {
            /**
             * @var Admin2_Controller_Abstract $controller
             */
            $controllerName = $this->_request->getContoller();
            if ($controllerName === null) {
                throw new Admin2_Dispatcher_Exception("There was no controller specified.");
            }

            $class = "Admin2_Controller_" . ucfirst($controllerName);

            if (class_exists($class)) {
                $controller = new $class($this->_request, $this->_result);
            } else {
                throw new Admin2_Controller_Exception("Can't find controller '$controllerName'.");
            }

            $method = $this->_request->getMethod();
            if ($method === null) {
                throw new Admin2_Dispatcher_Exception("There was no request method specified.");
            }

            $realMethod = strtolower($method);
            $controller->$realMethod();

            $processedData = $this->_outputProcessor->process($this->_result);

            $responseCode = $this->_result->getResponseCode();
            if (!empty($responseCode)) {
                header($responseCode);
            }

            foreach ($this->_result->getResponseHeader() as $headerKey => $headerValue) {
                header($headerKey . ': ' . $headerValue);
            }

        } catch (Exception $exception) {
            $errorController = new Admin2_Controller_Error();
            $processedData = $errorController->error($exception);
        }
        echo $processedData;
    }
}
