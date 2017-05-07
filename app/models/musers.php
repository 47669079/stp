<?php

	namespace X\App\Models;

	use \X\Sys\Model;

	class mUsers extends Model{
		public function __construct(){
			parent::__construct();

		}

	function myStories($iduser){

			$sql = "SELECT * FROM users
							WHERE idusers = ".$iduser;

			//obtenemos toda la información de los usuarios

			$this->query($sql);
			$res=$this->execute();

			if($res){
				$result=$this->resultset();
			}else {$result=null;}
			return $result;

		}

	function editUser($iduser, $username, $email, $old_p, $new_p_1){

		//si no insertamos nada en la contraseña sale el caracter del if después de pasar
		//por el encriptador de md5 a sí que hice un if con este para proteger por si el cambio
		//de contraseña estaba vacio

		if($new_p_1 == "d41d8cd98f00b204e9800998ecf8427e")
		{
			$sql = ("UPDATE users SET email = '".$email."', usersname = '".$username."' WHERE idusers = ".$iduser." && password = '".$old_p."'");
		}
		else{
			$sql = ("UPDATE users SET email = '".$email."', password = '".$new_p_1."', usersname = '".$username."' WHERE idusers = ".$iduser." && password = '".$old_p."'");
		}

			$this->query($sql);
			$res=$this->execute();

			return $res;

	}

	}
