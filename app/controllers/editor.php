<?php

   namespace X\App\Controllers;

   use X\Sys\Controller; //hay que poner use porque la class home hereda de controller


   class Editor extends Controller{


   		public function __construct($params){

   			parent::__construct($params);
                        $this->addData(array('page'=>'Editor'));
   			$this->model=new \X\App\Models\mEditor();
   			$this->view =new \X\App\Views\vEditor($this->dataView,$this->dataTable);

   		}

      function home(){

      									//$data=$this->model->getPath();
      									//$this->addData($data);

      									$this->view->__construct($this->dataView,$this->dataTable);
      									$this->view->show();

      }

      public function save(){

          $titulo=filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_STRING);

          $historia=filter_input(INPUT_POST,'historia',FILTER_SANITIZE_STRING);

          $res=$this->model->save_history($titulo, $historia); //funcion para guarar las historias

          if($res)
          {
            $this->ajax(array('msg'=>'Correct','class'=>'alert alert-success', 'redir'=>'/stp/dashboard'));
          }
          else
          {
            $this->ajax(array('msg'=>'Error al guardar história','class'=>'alert alert-danger', 'redir'=>'/stp/dashboard'));
          }


      }

    }
