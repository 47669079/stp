<?php

namespace X\App\Controllers;

   use X\Sys\Controller;


   class Story extends Controller{


   		public function __construct($params){
            parent::__construct($params);
            $this->addData(array(
               'page'=>'Story'));
            $this->model=new \X\App\Models\mStory();
            $this->view =new \X\App\Views\vStory($this->dataView);

         }

         function home(){

         									//$data=$this->model->getPath();
         									//$this->addData($data);

         			$this->view->__construct($this->dataView,$this->dataTable);
         			$this->view->show();

         }

         function get(){

           $iduser = $this->params['user'];
           $idstory =$this->params['idstory'];

           $res=$this->model->infostory($iduser, $idstory); //obtenemos la info de la historia para el json

           $this->addData($res);
           $this->home();

         }

         function edit(){

           //esta funcion es muy parecida al get solo que después de cojer los datos
           //para el array data llama a otra vista, que es la de edición

           $iduser = $this->params['user'];
           $idstory =$this->params['idstory'];

           $res=$this->model->infostory($iduser, $idstory);
           $this->addData($res);

           $this->view =new \X\App\Views\vEdit($this->dataView);
           $this->view->__construct($this->dataView,$this->dataTable);
           $this->view->show();

         }

        function editor(){

          $titulo=filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_STRING);
          $historia=filter_input(INPUT_POST,'historia',FILTER_SANITIZE_STRING);
          $user=filter_input(INPUT_POST,'user',FILTER_SANITIZE_STRING);
          $story=filter_input(INPUT_POST,'story',FILTER_SANITIZE_STRING);

          //recogemos la información que hemos insertado en el editor

          $res=$this->model->editStory($titulo, $historia, $user, $story);

          if($res)
          {
            $this->ajax(array('msg'=>'Correct','class'=>'alert alert-success', 'redir'=>'/stp/dashboard'));
          }
          else
          {
            $this->ajax(array('msg'=>'Error al guardar história','class'=>'alert alert-danger', 'redir'=>'/stp/dashboard'));
          }


        }

        function votar(){

          $votar=filter_input(INPUT_POST,'votar',FILTER_SANITIZE_NUMBER_INT);
          $id_user=filter_input(INPUT_POST,'id_user',FILTER_SANITIZE_NUMBER_INT);
          $id_story=filter_input(INPUT_POST,'id_story',FILTER_SANITIZE_NUMBER_INT);

          $res=$this->model->voteStory($votar, $id_user, $id_story); //funcion para votar

          if($res)
          {
            $this->ajax(array('msg'=>'Correct'));
          }
          else
          {
            $this->ajax(array('msg'=>'Error'));
          }

        }

        function tag(){

          $tag=filter_input(INPUT_POST,'tag',FILTER_SANITIZE_STRING);
          $id_user=filter_input(INPUT_POST,'id_user',FILTER_SANITIZE_NUMBER_INT);
          $id_story=filter_input(INPUT_POST,'id_story',FILTER_SANITIZE_NUMBER_INT);

          $res=$this->model->newTag($tag, $id_user, $id_story); //Funcion para insertar el tag

          if($res)
          {
            $this->ajax(array('msg'=>'Correct'));
          }
          else
          {
            $this->ajax(array('msg'=>'Error'));
          }

        }

   }
