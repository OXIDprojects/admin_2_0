<?php
class admin2 {
    static public function request($key)
    {
        return oxConfig::getParameter($key);
    }

    static public function main()
    {
    
        $subject = $_SERVER['REQUEST_URI'];
        $pattern = '/.*\/rest\/(?P<version>.*)\/(?P<class>.*)[\.](?P<format>.*)\?.*/';
        preg_match($pattern, $subject, $matches,0);
        
        echo '<pre>';
        print_r($matches);
        
        
        /*$url = explode('/rest/', $_SERVER['REQUEST_URI'],2);
        if (count($url)==2)
        {
            echo $url[1];
        }
        */
        
        echo self::request('fields');
    
    }
}
admin2::main();
?>