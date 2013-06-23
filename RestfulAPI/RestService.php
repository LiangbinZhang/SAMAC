<?php

class RestService {

    protected $supportedMethods = 'GET, POST, OPTIONS';

    public function __construct() {
    }

    public function handleRawRequest($SERVER, $GET, $POST) {
        $url = $this->getFullUrl($SERVER);
        $method = $SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET':
            case 'HEAD':
                $arguments = $GET;
                break;
            case 'POST':
                $arguments = $POST;
                break;
            case 'PUT':
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $arguments);
                break;
            case 'OPTIONS':
                break;
        }
        $accept = isset($SERVER['HTTP_ACCEPT']) ? $SERVER['HTTP_ACCEPT'] : null;
        $this->handleRequest($url, $method, $arguments, $accept);
    }

    protected function getFullUrl($SERVER) {
        $protocol = (isset($SERVER['HTTPS']) && strtolower($SERVER['HTTPS']) == 'on') ? 'https' : 'http';
        $location = $SERVER['REQUEST_URI'];
        if ($SERVER['QUERY_STRING']) {
            $location = substr($location, 0, strrpos($location, $SERVER['QUERY_STRING']) - 1);
        }
        return $protocol . '://' . $SERVER['HTTP_HOST'] . $location;
    }

    public function handleRequest($url, $method, $arguments, $accept) {
        switch ($method) {
            case 'GET':
                $this->performGet($url, $arguments, $accept);
                break;
            case 'HEAD':
                $this->performHead($url, $arguments, $accept);
                break;
            case 'POST':
                $this->performPost($url, $arguments, $accept);
                break;
            case 'PUT':
                $this->performPut($url, $arguments, $accept);
                break;
            case 'DELETE':
                $this->performDelete($url, $arguments, $accept);
                break;
            case 'OPTIONS':
                $this->performOptions($url, $arguments, $accept);
                break;
            default:
                /* 501 (Not Implemented) for any unknown methods */
                header('Allow: ' . $this->supportedMethods, true, 501);
        }
    }

    protected function methodNotAllowedResponse() {
        /* 405 (Method Not Allowed) */
        header('Allow: ' . $this->supportedMethods, true, 405);
    }

    public function performGet($url, $arguments, $accept) {
        $this->methodNotAllowedResponse();
    }

    public function performHead($url, $arguments, $accept) {
        $this->methodNotAllowedResponse();
    }

    public function performPost($url, $arguments, $accept) {
        $this->methodNotAllowedResponse();
    }

    public function performPut($url, $arguments, $accept) {
        $this->methodNotAllowedResponse();
    }

    public function performDelete($url, $arguments, $accept) {
        $this->methodNotAllowedResponse();
    }

    public function performOptions($url, $arguments, $accept) {
        $this->methodNotAllowedResponse();
    }

}

?>
