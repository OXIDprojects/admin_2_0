<?php
class Admin2_Dispatcher {
    static public function request($key)
    {
        return oxConfig::getParameter($key);
    }

    static public function main()
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

        ## Init controller
        $controller_class = 'admin2_controller_'.$matches['controller'];
        $valid = ( isset($matches['version']) && isset($matches['controller']) && class_exists($controller_class) );
                 
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
        }
        
        ## TODO: init output
        #echo self::request('fields');
    
    }
}
Admin2_Dispatcher::main();