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

        $pattern = '/'
            . '(.*)\/rest\/'
            . 'v(?P<version>[0-9])\/'
            . '(?P<controller>products|categories|orders)'
            . '\/?(?P<entity>[A-Za-z0-9]*)?'
            . '(\.(?P<format>xml|json|csv)?)?'
            . '/';
        if (preg_match($pattern, $_SERVER['REQUEST_URI'], $matches)) {
            if (isset($matches['controller']) && !empty($matches['controller'])) {
                $this->_controller = $matches['controller'];
            }

            if (isset($matches['version']) && !empty($matches['version'])) {
                $this->_version = $matches['version'];
            }

            if (isset($matches['entity']) && !empty($matches['entity'])) {
                $this->_entity = $matches['entity'];
            }

            if (isset($matches['format']) && !empty($matches['format'])) {
                $this->_format = $matches['format'];
            }

            if (isset( $_SERVER['REQUEST_METHOD']) && !empty( $_SERVER['REQUEST_METHOD'])) {
                $this->_method = $_SERVER['REQUEST_METHOD'];
            }

            if (isset($_REQUEST) && !empty($_REQUEST)) {
                $this->_params = filter_var_array($_REQUEST);
            }
        }
    }

}
