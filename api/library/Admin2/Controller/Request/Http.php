<?php
class Admin2_Controller_Request_Http extends Admin2_Controller_Request_Abstract
{
    /**
     * Extracts data from the HTTP request.
     * Sets request method (get, put, post, delete), version, controller, entity and response format (html, json, csv).
     *
     * @throws \Admin2_Controller_Request_Exception
     *
     * @return void
     */
    public function init()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            throw new Admin2_Controller_Request_Exception("Request URI is not set.");
        }

        $requestUri = $_SERVER['REQUEST_URI'];
        if ($_SERVER['QUERY_STRING'] > '') {
            if (strpos($requestUri, $_SERVER['QUERY_STRING']) !== false) {
                $requestUri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $requestUri);
            }
        }

        $baseDir         = dirname($_SERVER['SCRIPT_NAME']) . '/';
        $cleanRequestUri = str_replace($baseDir, '', $requestUri);
        $urlParts        = explode('/', trim($cleanRequestUri, '/'));
        $count           = count($urlParts);
        $formatPos       = strpos($urlParts[$count - 1], '.');

        if ($formatPos !== false) {
            $this->_format        = substr($urlParts[$count - 1], $formatPos + 1);
            $urlParts[$count - 1] = substr($urlParts[$count - 1], 0, $formatPos);
        }

        $this->_version    = $count > 0 ? substr($urlParts[0], 1) : 1;
        $this->_controller = $count > 1 ? $urlParts[1] : 'Products';
        $this->_entity     = $count > 2 ? $urlParts[2] : '';

        if (!empty($_SERVER['REQUEST_METHOD'])) {
            $this->_method = $_SERVER['REQUEST_METHOD'];
        }

        $request = $_REQUEST;
        if (empty($request) && $this->_method != 'GET') {
            parse_str(file_get_contents('php://input'), $request);
        }

        $this->_params = filter_var_array($request);
    }

}
