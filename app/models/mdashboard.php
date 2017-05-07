<?php

	namespace X\App\Models;

	use \X\Sys\Model;

	class mDashboard extends Model{
		public function __construct(){
			parent::__construct();

		}

	public function getPath(){

		//obtenemos toda la información de las historias para devolverla al controlador

		$sql = "SELECT * FROM stories INNER JOIN users ON stories.users = users.idusers";

		$this->query($sql);
		$res=$this->execute();
		if($res){
			$result=$this->resultset();

		}else {$result=null;}
		return $result;

		}

		function myStories($iduser){

			//obtenemos toda la información de NUESTRAS historias

			$sql = "SELECT * FROM stories INNER JOIN users ON stories.users = users.idusers
							WHERE users.idusers = ".$iduser;

			$this->query($sql);
			$res=$this->execute();
			if($res){
				$result=$this->resultset();

			}else {$result=null;}
			return $result;

		}

	}
