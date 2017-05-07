<?php

	namespace X\App\Models;

	use \X\Sys\Model;
	use \X\Sys\Session;

	class mStory extends Model{

		public function __construct(){
			parent::__construct();

		}

		public function infostory($iduser, $idstory){

			$sql = "SELECT * FROM stories INNER JOIN users ON stories.users = users.idusers INNER JOIN tags_has_stories ON stories.idstories = tags_has_stories.stories INNER JOIN tags ON tags_has_stories.tags = tags.idtags
							WHERE idstories = ".$idstory." AND idusers = ".$iduser;

							//hacemos una sentencia con inner join de los tags para también adquirir información de los tags de nuestra historia

			$this->query($sql);
			$res=$this->execute();

			if($res){

				$result=$this->resultset();

				if(!$result){
					//si la sentencia da 0 haremos otra sin los tags para así tener la información únicamente de la historia
					$sql = "SELECT * FROM stories INNER JOIN users ON stories.users = users.idusers
									WHERE idstories = ".$idstory." AND idusers = ".$iduser;

					$this->query($sql);
					$res=$this->execute();

					$result=$this->resultset();
				}

			}else {$result=null;}
			return $result;

		}

		function editStory($titulo, $historia, $user, $story){

			//Esta funcion es igual que la de insertar la historia, la única diferencia es que en el
			//momento de abrir el archivo con fopen lo haremos en modo escritura

				/* SOBREESCRIBIR ARCHIVO */

	      $archivo= $story.".txt";
	      $file=fopen("stories/".$archivo,"w");
	      $result1 = fwrite($file,$historia);

	      fclose($file);


				/* GUARDAR JSON CON HISTORIA, PATH Y TITULO */
				setlocale(LC_ALL,"es_ES");

				$arr_story = array( 'user'=>$user,'titulo'=> $titulo, 'path'=> $story, 'date'=>strftime("%A %d de %B del %Y a las %R"), );
				$array = $this->safe_json_encode($arr_story);

				//Creamos el JSON

				//$input = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($arr_story));
				//$json_string = json_encode($input);
				//var_dump(json_last_error());
				//die;

				$archivo = $story.".json";

				$file=fopen("stories/".$archivo,"w");
				$result = fwrite($file,$array);

				fclose($file);

				if( $result )
				{
					 return true;
				}
				else return false;

		}

		function safe_json_encode($value){
			if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
					$encoded = json_encode($value, JSON_PRETTY_PRINT);
			} else {
					$encoded = json_encode($value);
			}
			switch (json_last_error()) {
					case JSON_ERROR_NONE:
							return $encoded;
					case JSON_ERROR_DEPTH:
							return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
					case JSON_ERROR_STATE_MISMATCH:
							return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
					case JSON_ERROR_CTRL_CHAR:
							return 'Unexpected control character found';
					case JSON_ERROR_SYNTAX:
							return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
					case JSON_ERROR_UTF8:
							$clean = $this->utf8ize($value);
							return $this->safe_json_encode($clean);
					default:
							return 'Unknown error'; // or trigger_error() or throw new Exception()

			}
	}

	function utf8ize($mixed) {
			if (is_array($mixed)) {
					foreach ($mixed as $key => $value) {
							$mixed[$key] = $this->utf8ize($value);
					}
			} else if (is_string ($mixed)) {
					return utf8_encode($mixed);
			}
			return $mixed;
	}

	function voteStory($votar, $id_user, $id_story){

		//utilizaremos la fnción new valoration para agregar una valoración a la historia

		$this->query("call sp_new_valoration(:userid, :id_story, :votar)");

		$this->bind(":votar", $votar);
		$this->bind(":id_story", $id_story);
		$this->bind(":userid", $id_user);

		$res = $this->execute();

		return $res;
	}

	function newTag($tag, $id_user, $id_story){

		//funciona igual que la valoración, pero con tags

		$this->query("call sp_new_tag(:tag, :id_story, :userid)");

		$this->bind(":tag", $tag);
		$this->bind(":id_story", $id_story);
		$this->bind(":userid", $id_user);

		$res = $this->execute();

		return $res;
	}

	}
