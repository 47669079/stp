<?php

namespace Api\Lib;

class Response{
    public $result = null;
    private $response;
    
    function setResponse($response, $message){
        $this->response=$response;
    }
}