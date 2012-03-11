<?php
class Rest_Client
{
	private $_host = null;
private $_port = null;
private $_user = null;
private $_pass = null;


 public function getData($url, $params = "", $method = "GET")
 {
	$obj = json_decode(file_get_contents($url));
	return $obj;
 }

/**
 * Factory of the class. Lazy connect
 *
 * @param string $host
 * @param integer $port
 * @param string $user
 * @param string $pass
 * @return Http
 */
static public function connect($host, $port, $user=null, $pass=null)
{
    return new self($host, $port, $user, $pass);
}

const POST   = 'POST';
const GET    = 'GET';
const DELETE = 'DELETE';

/**
 * POST request
 *
 * @param string $url
 * @param array $params
 * @return string
 */
public function doPost($url, $params=array())
{
    return $this->_exec(self::POST, $this->_url($url), $params);
}

/**
 * GET Request
 *
 * @param string $url
 * @param array $params
 * @return string
 */
public function doGet($url, $params=array())
{
    return $this->_exec(self::GET, $this->_url($url), $params);
}

/**
 * DELETE Request
 *
 * @param string $url
 * @param array $params
 * @return string
 */
public function doDelete($url, $params=array())
{
    return $this->_exec(self::DELETE, $this->_url($url), $params);
}

private $_headers = array();
/**
 * setHeaders
 *
 * @param array $headers
 * @return Http
 */
public function setHeaders($headers)
{
    $this->_headers = $headers;
    return $this;
}

const HTTP_OK = 200;
const HTTP_CREATED = 201;
const HTTP_ACEPTED = 202;

/**
 * Performing the real request
 *
 * @param string $type
 * @param string $url
 * @param array $params
 * @return string
 */
private function _exec($type, $url, $params = array())
{
    $headers = $this->_headers;
    $s = curl_init();

    if(!is_null($this->_user)){
       curl_setopt($s, CURLOPT_USERPWD, $this->_user.':'.$this->_pass);
    }

    switch ($type) {
        case self::DELETE:
            curl_setopt($s, CURLOPT_URL, $url . '?' . http_build_query($params));
            curl_setopt($s, CURLOPT_CUSTOMREQUEST, self::DELETE);
            break;
        case self::POST:
            curl_setopt($s, CURLOPT_URL, $url);
            curl_setopt($s, CURLOPT_POST, true);
            curl_setopt($s, CURLOPT_POSTFIELDS, $params);
            break;
        case self::GET:
            curl_setopt($s, CURLOPT_URL, $url . '?' . http_build_query($params));
            break;
    }

    curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($s, CURLOPT_HTTPHEADER, $headers);
    $_out = curl_exec($s);
    $status = curl_getinfo($s, CURLINFO_HTTP_CODE);
    curl_close($s);
    switch ($status) {
        case self::HTTP_OK:
        case self::HTTP_CREATED:
        case self::HTTP_ACEPTED:
            $out = $_out;
      break;
        default:
            throw new Http_Exception("http error: {$status}", $status);
    }
    return $out;
}



}
?>