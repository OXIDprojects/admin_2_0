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

        if ($count > 0) {
            $this->_version = substr($urlParts[0], 1);
        }

        if ($count > 1) {
            $this->_controller = $urlParts[1];
        }

        if ($count > 2) {
            $this->_entity = $urlParts[2];
        }

        if (!empty($_SERVER['REQUEST_METHOD'])) {
            $this->_method = $_SERVER['REQUEST_METHOD'];
        }

        $request = array_merge($_GET, $_POST);
        if (empty($request) && $this->_method != 'GET') {
            parse_str(file_get_contents('php://input'), $request);
        }

        $this->_params = filter_var_array($request);
    }
}
