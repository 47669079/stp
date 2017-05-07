<?php

   namespace X\App\Controllers;

   use X\Sys\Controller; //hay que poner use porque la class home hereda de controller


   class Dashboard extends Controller{


   		public function __construct($params){

   			parent::__construct($params);
                        $this->addData(array('page'=>'Dashboard'));
   			$this->model=new \X\App\Models\mDashboard();
   			$this->view =new \X\App\Views\vDashboard($this->dataView,$this->dataTable);

   		}


      function home(){

        $data=$this->model->getPath(); //obtenemos el path de todas las historias para mostrarlas en el dashboard
        $this->addData($data); //las añadimos a addData

        $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();

      }

      function my(){

        $iduser = $this->params['id'];

        $res=$this->model->myStories($iduser); //obtenemos el path de nuestrar historias
        $this->addData($res);

        $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();

      }

   }
