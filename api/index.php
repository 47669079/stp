<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config.slim.php'; //Aqui añadiremos la configuración del servicio

//CRUD --> CREATE READ UPDATE DELETE

    $app = new \Slim\App(['settings'=>$config]);
    
    $container = $app->getContainer();
    
    $container['db']=function($c){
        
        //En esta funcion agregamos al contenedor el acceso a BD
        
        $db=$c['settings']['db']; //$db será el array db de settings
        $pdo = new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'],$db['user'],$db['pass']); //hay que hacer un try and catch
        
        //características de PDO
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    };
    
    $app->get('/user', function(Request $req, Response $res){ //READ
        
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result=$stmt->fetchALL(PDO::FETCH_OBJ);
        
        return $this->response->withJson($result);
        
    });
    
    $app->get('/user/{id}', function(Request $req, Response $res, $args){ //READ PERO CON EL ID DEL USUARIO QUE QUEREMOS LEER
        
        $id=(int)$args['id']; //ya tenemos el $id que nos están pasando como argumento
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $this->response->withJson($result);
        
        
        
    });
    
    $app->post('/user/add', function(Request $req){ //CREATE
        
        $data=$req->getParsedBody();
        
        $email = $data['email'];
        $pass = $data['pass'];
        $user = $data['user'];
        
        $stmt = $this->db->prepare("INSERT INTO users"
                . "(idusers, roles, email, password, usersname) VALUES (null, '2', :email, :pass, :user)");
        
        $stmt->bindValue(":email",$email, PDO::PARAM_STR);
        $stmt->bindValue(":pass",$pass, PDO::PARAM_STR);
        $stmt->bindValue(":user",$user, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $id = (int)$this->db->lastInsertId(); //utilizaremos last insert id para saber cual es la última id insertada
        //y así poder realizar la siguiente sentencia
        
        //PARA QUE NOS MUESTRE EL USUARIO QUE ACABAMOS DE CREAR
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers = :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $this->response->withJson($result);
       
    });
    
    $app->put('/user/upd', function(Request $req){ //UPDATE
        
        $data=$req->getParsedBody();
        
        $id=(int)$data['id']; //obtenemos id
        $email=$data['email'];
        $pass=$data['pass'];
        $user=$data['user'];
        
        
        $stmt = $this->db->prepare("UPDATE users SET email = :email, password = :pass, usersname = :user WHERE users.idusers = :id");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        
        //devolveremos el resultado de la actualización del usuario, lo haremos utilizando el id que nos ha insternado el cliente
        
        return $this->response->withJson($result);
        
    });
    
    
    $app->delete('/user/del', function(Request $req){ //DELETE
        
        $data=$req->getParsedBody();
        
        $id=(int)$data['id']; //obtenemos id
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result1 = $stmt->rowCount();
        
        //Hacemos un SELECT * para saber si antes de realizar el delete este usuario existía y capturamos 
        //la sentencia gracias a rowCount, si este nos da 1 significa que el usuario existia
        
        $stmt = $this->db->prepare("DELETE FROM users WHERE"
                . " users.idusers = :id");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result2 = $stmt->rowCount();
        
        //De nuevo hacemos otros SELECT * para saber si hemos logrado borrar el usuario
        //si el resultado es 0 significa que lo hemos hecho bien
        
       if ($result1 == 1 && $result2 == 0) {
        return $this->response->withJson(array('msg'=>'Usuario '.$id.' Borrado'));
        } 
        
        else {
        return $this->response->withJson(array('msg'=>'No se ha borrado ningun usuario'));
        }
        
        //para finalizar haremos un if, si el primer resultado era 1 y el último 0 el borrado se ha realizado 
        //entonces le daremos la información sobre que usuario hemos borrado
        
    });
    
    $app->run();
    
