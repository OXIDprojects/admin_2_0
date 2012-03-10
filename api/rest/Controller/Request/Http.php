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
        $subject = $_SERVER['REQUEST_URI'];
        $pattern = '/'
            . '(.*)\/rest\/'
            . 'v(?P<version>[0-9])\/'
            . '(?P<controller>products|categories|orders)'
            . '\/?(?P<entity>[A-Za-z0-9]*)?'
            . '(\.(?P<format>xml|json|csv)?)?'
            . '/';
        if (preg_match($pattern, $subject, $matches)) {
            $this->_controller = $matches['controller'];
            $this->_version = $matches['version'];
            $this->_entity = $matches['entity'];
            $this->_format = $matches['format'];
            $this->_method = $_SERVER['REQUEST_METHOD'];
            $this->_params = filter_var_array($_REQUEST);
        }
    }

}
