<?php

require 'config.slim.php';

function getBD(){
    
    try{
        $dbh=new PDO($dsn, $usr, $pwd);
        
    } catch (Exception $ex) {
        return null;
    }
    
    return $dbh;
}