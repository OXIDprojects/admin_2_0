<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 * @link      http://admin20.de
 * @copyright (C) 2012 :: Admin 2.0 Developers
 */
/**
 * Request Dispatcher
 */
class Admin2_Dispatcher
{
    /**
     * Request object.
     *
     * @var Admin2_Controller_Request_Abstract
     */
    protected $_request;

    /**
     * Instance of an class to format the output.
     *
     * @var Admin2_Output_Processor_Interface
     */
    protected $_outputProcessor;

    /**
     * The result of the controller action.
     *
     * @var Admin2_Controller_Response
     */
    protected $_response;

    /**
     * Directory where the controller are located.
     *
     * @var string
     */
    protected $_controllerDir;

    /**
     * Constructor
     *
     * @param Admin2_Controller_Request_Abstract $request  Request object
     * @param Admin2_Controller_Response         $response Response object
     * @param array                              $config   Configuration array
     *
     * @return Admin2_Dispatcher
     */
    public function __construct(
        Admin2_Controller_Request_Abstract $request,
        Admin2_Controller_Response $response,
        $config = array()
    )
    {
        $this->_request         = $request;
        $this->_response        = $response;
        $outputProcClass        = 'Admin2_Output_Processor_' . ucfirst($request->getFormat());
        $this->_outputProcessor = new $outputProcClass();

        $this->_controllerDir = APPLICATION_PATH . '/controllers';
        if (isset($config['controllerDir'])) {
            $this->_controllerDir = rtrim($config['controllerDir'], '/');
        }
    }

    /**
     * Checks the request signature.
     *
     * @param Admin2_Signature_SignatureAbstract $signatureClass Class for signature check.
     * @param Admin2_Signature_HashInterface     $hashClass      Class for hash calculation.
     *
     * @throws Admin2_Dispatcher_Exception
     *
     * @return bool
     */
    public function checkSignature(
        Admin2_Signature_SignatureAbstract $signatureClass,
        Admin2_Signature_HashInterface $hashClass
    )
    {
        $params = $this->_request->getParams();
        if (!isset($params['signature'])) {
            header('HTTP/1.0 403 Forbidden');
            return false;
        }

        if (!isset($params['key'])) {
            header('HTTP/1.0 403 Forbidden');
            return false;
        }

        $user = oxDb::getDb(true)->GetRow(
            'SELECT `OXID`, `apisecret` FROM `oxuser` WHERE `apikey` = ?',
            array($params['key'])
        );

        $signatureClass->setSalt($user['apisecret']);

        $requestSignature = $params['signature'];
        unset($params['signature']);
        $signatureClass->setData($params);
        $calculatedSignature = $signatureClass->createSignature($hashClass);
        if ($requestSignature != $calculatedSignature) {
            if (APPLICATION_ENV == 'development') {
                echo "<!--\nReq-Sig:  $requestSignature\nCalc-Sig: $calculatedSignature\n-->\n";
            }
            header('HTTP/1.0 403 Forbidden');
            return false;
        }

        $_SESSION['usr'] = $user['OXID'];

        return true;
    }

    /**
     * Starting point for dispatcher execution
     *
     * @param Admin2_Signature_SignatureAbstract $signatureClass Class for signature check.
     * @param Admin2_Signature_HashInterface     $hashClass      Class for hash calculation.
     *
     * @throws Admin2_Dispatcher_Exception
     *
     * @return void
     */
    public function run(
        Admin2_Signature_SignatureAbstract $signatureClass,
        Admin2_Signature_HashInterface $hashClass
    )
    {
        try {
            if (!$this->checkSignature($signatureClass, $hashClass)) {
                return;
            }

            $controllerName = $this->_request->getContoller();
            if ($controllerName === null) {
                throw new Admin2_Dispatcher_Exception("There was no controller specified.");
            }

            $spacedClass = str_replace('_', ' ', $controllerName);
            $class       = str_replace(' ', '_', ucwords($spacedClass)) . 'Controller';

            $controllerFile = $this->_controllerDir . '/' . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

            if (!file_exists($controllerFile)) {
                require_once 'Admin2/Dispatcher/Exception.php';
                throw new Admin2_Dispatcher_Exception(
                    "PHP file which contains the controller '$class', doesn't exists."
                );
            }

            include_once $controllerFile;

            if (!class_exists($class)) {
                require_once 'Admin2/Dispatcher/Exception.php';
                throw new Admin2_Dispatcher_Exception("Can't find controller '$class'.");
            }

            $controller = new $class($this->_request, $this->_response);
            if (!$controller instanceof Admin2_Controller_Abstract) {
                require_once 'Admin2/Dispatcher/Exception.php';
                throw new Admin2_Dispatcher_Exception(
                    "The controller '$class' doesn't extend the class 'Admin2_Controller_Abstract'."
                );
            }

            $method = $this->_request->getMethod();

            if ($method === null) {
                require_once 'Admin2/Dispatcher/Exception.php';
                throw new Admin2_Dispatcher_Exception("There was no request method specified.");
            }

            $realMethod = strtolower($method);
            $entity     = $this->_request->getEntity();
            if (empty($entity)) {
                $realMethod = 'getList';
            }

            if (!method_exists($controller, $realMethod)) {
                require_once 'Admin2/Dispatcher/Exception.php';
                throw new Admin2_Dispatcher_Exception(
                    "The controller '$class' doesn't provide the method '$realMethod'."
                );
            }

            $controller->$realMethod();

            $processedData = '';
            if ($this->_response->hasData()) {
                $processedData = $this->_outputProcessor->process($this->_response);
                $responseCode  = $this->_response->getResponseCode();
                if (!empty($responseCode)) {
                    header($responseCode);
                }
            } else {
                header('HTTP/1.0 204 No Content', true);
            }

            foreach ($this->_response->getResponseHeader() as $headerKey => $headerValue) {
                header($headerKey . ': ' . $headerValue);
            }
        } catch (Exception $exception) {
            $errorController = new Admin2_Controller_Error();
            $processedData   = $errorController->error($exception);
        }

        echo $processedData;
    }
}
