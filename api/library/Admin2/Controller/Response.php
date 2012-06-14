<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 *  @link      http://admin20.de
 *  @copyright (C) 2012 :: Admin 2.0 Developers
 */

/**
 * Response class
 */
class Admin2_Controller_Response
{
    // Successful
    /**
     * HTTP-status-code 200
     *
     * Request was successful.
     */
    const OK = 200;

    /**
     * HTTP-status-code 201
     *
     * A new resource was created.
     */
    const CREATED = 201;

    /**
     * HTTP-status-code 202
     *
     * The request has been accepted for processing,
     * but the processing has not been completed.
     */
    const ACCEPTED = 202;

    /**
     * HTTP-status-code 203
     *
     * The request has been accepted,
     * but the response may be from another source;
     */
    const NON_AUTHORITATIVE_INFORMATION = 203;

    /**
     * HTTP-status-code 204
     *
     * The request has been accepted, but there's no content.
     */
    const NON_CONTENT = 204;

    /**
     * HTTP-status-code 205
     *
     * The request has been accepted,
     * there's no content and the response require a reset of the view.
     */
    const RESET_CONTENT = 205;

    /**
     * HTTP-status-code 206
     *
     * The request has been accepted,
     * but the response contains partially content of the resource.
     */
    const PARTIAL_CONTENT = 206;

    /**
     * HTTP-status-code 207
     *
     * The request has been accepted.
     * The response can contains multiple status codes in an XML message.
     */
    const MUTLI_STATUS = 207;

    // Redirection
    /**
     * HTTP-status-code 300
     *
     * The response contains a set of representations from the requested resource.
     */
    const MUTLIPLE_CHOICES = 300;

    /**
     * HTTP-status-code 301
     *
     * The requested resource has been assigned to a new URI.
     * The new URI is send in the location header.
     */
    const MOVED_PERMANENTLY = 301;

    /**
     * HTTP-status-code 302
     *
     * The requested resource is moved temporarily to the URI
     * in location header.
     */
    const FOUND = 302;

    /**
     * HTTP-status-code 303
     *
     * The requested resource can be found under a different URI.
     * The URI is given in the location header.
     */
    const SEE_OTHER = 303;

    /**
     * HTTP-status-code 304
     *
     * The requested resource has not been modified, since the last request.
     */
    const NOT_MODIFIED = 304;

    /**
     * HTTP-status-code 305
     *
     * The requested resource have to be accessed through the proxy.
     * The proxy is given in the location header.
     */
    const USE_PROXY = 305;

    /**
     * HTTP-status-code 306
     *
     * This code is not longer in use.
     */
    const RESERVED = 306;

    /**
     * HTTP-status-code 307
     *
     * The requested resource is temporarily redirected to URI,
     * but all future requests should repeat this URI.
     * The temporarily URI is given in the location header.
     */
    const TEMPORALY_REDIRECT = 307;

    // Client Error
    /**
     * HTTP-status-code 400
     *
     * The request has bad syntax
     */
    const BAD_REQUEST = 400;

    /**
     * HTTP-status-code 401
     *
     * The request requires user authentication.
     * The response contains a WWW-Authenticate header field.
     */
    const UNAUTHORIZED = 401;

    /**
     * HTTP-status-code 402
     *
     * This code is reserved for future use.
     * Source:
     * @link http://restpatterns.org/HTTP_Status_Codes/402_-_Payment_Required
     */
    const PAYMENT_REQUIRED = 402;

    /**
     * HTTP-status-code 403
     *
     * The requested was a legal request,
     * but the server refusing to response it.
     */
    const FORBIDDEN = 403;

    /**
     * HTTP-status-code 404
     *
     * The requested resource cannot be found.
     */
    const NOT_FOUND = 404;

    /**
     * HTTP-status-code 405
     *
     * The request was made in the wrong method.
     * The response contains an allow header field, with the allowed methods.
     */
    const METHOD_NOT_ALLOWED = 405;

    /**
     * HTTP-status-code 406
     *
     * The requested resource is not in the required form.
     * The response contains acceptable Content-Type's.
     */
    const NOT_ACCEPTABLE = 406;

    /**
     * HTTP-status-code 407
     *
     *
     */
    const PROXY_AUTHENTICATION = 407;

    /**
     * HTTP-status-code 408
     */
    const REQUEST_TIMEOUT = 408;

    /**
     * HTTP-status-code 409
     */
    const CONFLICT = 409;

    /**
     * HTTP-status-code 410
     */
    const GONE = 410;

    /**
     * HTTP-status-code 411
     */
    const LENGTH_REQUIRED = 411;

    /**
     * HTTP-status-code 412
     */
    const PRECONDITION_FAILED = 412;

    /**
     * HTTP-status-code 413
     */
    const REQUEST_ENTITY_TOO_LARGE = 413;

    /**
     * HTTP-status-code 414
     */
    const REQUEST_URI_TOO_LONG = 414;

    /**
     * HTTP-status-code 415
     */
    const UNSUPPORTED_MEDIA_TYPE = 415;

    /**
     * HTTP-status-code 416
     */
    const REQUESTED_RANGE_NOT_SATISFIABLE = 416;

    /**
     * HTTP-status-code 417
     */
    const EXPECTATION_FAILED = 417;

    /**
     * HTTP-status-code 422
     */
    const UNPROCESSABLE_ENTITY = 422;

    /**
     * HTTP-status-code 423
     */
    const LOCKED = 423;

    /**
     * HTTP-status-code 424
     */
    const FAILED_DEPENDENCY = 424;

    /**
     * HTTP response code
     * @var string
     */
    protected $_responseCode;

    /**
     * Header properties
     * @var array
     */
    protected $_responseHeader = array();

    /**
     * Data to return
     * @var array
     */
    protected $_data;

    /**
     * Set response data
     *
     * @param string $data Response data
     *
     * @return void
     */
    public function setData($data)
    {
        $this->_data = (array) $data;
    }

    /**
     * Get response data
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Set HTTP response code
     *
     * @param string $responseCode HTTP response code
     *
     * @return void
     */
    public function setResponseCode($responseCode)
    {
        $this->_responseCode = (string) $responseCode;
    }

    /**
     * Get HTTP response code
     *
     * @return string
     */
    public function getResponseCode()
    {
        return $this->_responseCode;
    }

    /**
     * Get response header
     *
     * @return array Response header
     */
    public function getResponseHeader()
    {
        return $this->_responseHeader;
    }

    /**
     * Add a property to response header
     *
     * @param string $key     Key to add
     * @param string $value   Value to add
     * @param bool   $replace Whether to replace an existing key
     *
     * @return bool
     */
    public function addResponseHeader($key, $value, $replace = true)
    {
        if (isset($this->_responseHeader[$key]) && !$replace) {
            return false;
        }

        $this->_responseHeader[$key] = (string) $value;
        return true;
    }

    /**
     * Detect if response has data to return
     *
     * @return bool
     */
    public function hasData()
    {
        return ($this->_data !== null) && (count($this->_data) > 0);
    }
}
