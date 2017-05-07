<?php

	namespace X\App\Models;

	use \X\Sys\Model;

	class mSignUp extends Model{
		public function __construct(){
			parent::__construct();

		}

		public function signuser($username, $password, $email){

                    $this->query("SELECT * FROM users WHERE usersname=:username && password=:password");

                    $this->bind(":username",$username);

                    $this->bind(":password",$password);

                    $this->execute();

                    $res_1=$this->rowCount();

                    $this->query("SELECT * FROM users WHERE email=:email");

                    $this->bind(":email",$email);

                    $this->execute();

                    $res_2=$this->rowCount();

                   if($res_1==1 || $res_2==1){

                       return false; //si el resultado es positivo significa que el usuario ya existe

                   }else{

                        $this->query("call sp_new_user(1, :email, :password, :username)");
												//llamamos a la funcion new user de la base de datos para crear el usuario
												
                        $this->bind(":email",$email);

                        $this->bind(":username",$username);

                        $this->bind(":password",$password);

                        $this->execute();

                        return true;

                   }

                }

	}
