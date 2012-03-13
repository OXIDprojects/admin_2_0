<?php
class Admin2_Controller_Request_Http extends Admin2_Controller_Request_Abstract
{
    /**
     * Extracts data from the HTTP request.
     *
     * @return null
     */
    public function init()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            throw new Admin2_Controller_Request_Exception("Request URI is not set.");
        }

        $baseDir = dirname($_SERVER['SCRIPT_NAME']) . '/';
        $cleanRequestUri = str_replace($baseDir, '', $_SERVER['REQUEST_URI']);
        $urlParts = explode('/', trim($cleanRequestUri, '/'));
        $count = count($urlParts);
        $formatPos = strpos($urlParts[$count - 1], '.');

        if ($formatPos !== false) {
            $this->_format = substr($urlParts[$count - 1], $formatPos + 1);
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

        if (isset($_REQUEST) && !empty($_REQUEST)) {
            $this->_params = filter_var_array($_REQUEST);
        }

        if (isset( $_SERVER['REQUEST_METHOD']) && !empty( $_SERVER['REQUEST_METHOD'])) {
            $this->_method = $_SERVER['REQUEST_METHOD'];
        }
    }

}
