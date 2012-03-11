<?php

define("ADMIN2_ERROR_NOTFOUND", 404);

/**
 * Created by JetBrains PhpStorm.
 * User: Tomas Liubinas
 * Date: 12.3.10
 * Time: 17.46
 *
 * Error information container
 */
class Admin2_Controller_Error
{
    /**
     * Error code
     *
     * @var null
     */
    public $code = null;

    /**
     * HTTP error code. To be returned as HTTP header
     *
     * @var string
     */
    public $httpError = "400";

    /**
     * Error message
     *
     * @var string
     */
    public $message = "";

}
