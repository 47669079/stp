<?php

use Api\Lib\DB;
use Api\Lib\Response;

class UserModel{
    private $db;
    
    public function __construct(){
        
    }
    
    public function getAll(){
        try{
            $stmt = $this->db->prepare("SELECT * FROM users");
            $stmt->execute();
            $this->response->setResponse(true);
            $this->response->result=$stmt->fetchAll();
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setResponse(false,$e->getMessage());
            return $this->response;
        }
      
        
    }
}