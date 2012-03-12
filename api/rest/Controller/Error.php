<?php
class Admin2_Controller_Error
{
    public function error(Exception $exception)
    {
        ob_start();
        var_dump($exception);
        return ob_get_clean();
    }
}