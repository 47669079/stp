<?php

	namespace X\App\Models;

	use \X\Sys\Model;
	use \X\Sys\Session;

	class mEditor extends Model{

		public function __construct(){
			parent::__construct();

		}

    function save_history($titulo, $historia){

			/* GUARDAR INFO EN LA BD */

			if( Session::get('user') ){ //gracias a las variables de sesión podemos saber cual es el usuario que está logeado

				$ses = Session::get('user'); //si el usuario ha iniciado sesión llamaremos a la función de la base de date new_story

				$this->query("call sp_new_story(:userid)");
				$this->bind(":userid", $ses["idusers"]);

				$this->execute();

				$this->query("SELECT * FROM stories ORDER BY path DESC LIMIT 1"); //obtenemos el último path de las historias

				$this->execute();
				$story = $this->single();

			}

			else return false;

			/* GUARDAR ARCHIVO */

      $archivo= $story["path"].".txt"; //creamos un archivo txt con el número de path
      $file=fopen("stories/".$archivo,"a");  //creamos el ARCHIVO
      $result1 = fwrite($file,$historia); //lo escribimos

      fclose($file); //lo cerramos


			/* GUARDAR JSON CON HISTORIA, PATH Y TITULO */

			setlocale(LC_ALL,"es_ES"); //esto sirve para especificar que el idioma de este documento es español
			//para que cuando guardemos la fecha de strftime se guarde en español

			$arr_story = array( 'user'=>$ses["idusers"],'titulo'=> $titulo, 'path'=> $story["path"], 'date'=>strftime("%A %d de %B del %Y a las %R"), );
			$array = $this->safe_json_encode($arr_story); //transformamos el array en un json

			//para que no falle la funcion de transformar json he tenido que hacer dos pequeñas funciones más
			//ya que si no a veces causaban errores de parseo por ser un array

			//Creamos el JSON

			//$input = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($arr_story));
			//$json_string = json_encode($input);
			//var_dump(json_last_error());
			//die;

			$archivo = $story["path"].".json"; //guardamos el path del json

			$file=fopen("stories/".$archivo,"a"); //creamos el archivo
			$result = fwrite($file,$array); //lo escribimos

			fclose($file); //lo guardamos

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
			switch (json_last_error()) { //Segun lo que nos devuelva el last_error haremos un switch para saber que hacer según el caso
					case JSON_ERROR_NONE:
							return $encoded;
					case JSON_ERROR_DEPTH:
							return 'Maximum stack depth exceeded';
					case JSON_ERROR_STATE_MISMATCH:
							return 'Underflow or the modes mismatch';
					case JSON_ERROR_CTRL_CHAR:
							return 'Unexpected control character found';
					case JSON_ERROR_SYNTAX:
							return 'Syntax error, malformed JSON';
					case JSON_ERROR_UTF8:
							$clean = $this->utf8ize($value); //si el error es por lenguaje llamaremos a la funcion utf8ize
							return $this->safe_json_encode($clean); //le devulveremos el codigo "arreglado"
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

    }
