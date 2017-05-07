<?php

namespace X\App\Controllers;

   use X\Sys\Controller;


   class Users extends Controller{


   		public function __construct($params){
            parent::__construct($params);
            $this->addData(array(
               'page'=>'Users'));
            $this->model=new \X\App\Models\mUsers();
            $this->view =new \X\App\Views\vUsers($this->dataView);

         }

         function profile(){

           $iduser = $this->params['id'];

           $res=$this->model->myStories($iduser); //obtenemos el arraylist de las historias
           $this->addData($res);

         	 $this->view->__construct($this->dataView,$this->dataTable);
         	 $this->view->show();

         }

         function edit(){

           $iduser=filter_input(INPUT_POST,'userid',FILTER_SANITIZE_STRING);
           $username=filter_input(INPUT_POST,'nameuser',FILTER_SANITIZE_STRING);
           $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
           $old_p=filter_input(INPUT_POST,'old_p',FILTER_SANITIZE_STRING);
           $new_p_1=filter_input(INPUT_POST,'new_p_1',FILTER_SANITIZE_STRING);
           $new_p_2=filter_input(INPUT_POST,'new_p_2',FILTER_SANITIZE_STRING);

           //funciona igual que la funcion para editar el usuario
           //protegermos la inserción ya que puede cambiar la contraseña o no

           if( ($new_p_1 == $new_p_2 && $old_p != null) || ($new_p_1 == null && $new_p_2 == null && $old_p != null) )
           {
             $res=$this->model->editUser($iduser, $username, $email, $old_p, $new_p_1);

           }
           else{
             $res = false;
           }

           if($res){
               $this->ajax(array('msg'=>'Correct','class'=>'alert alert-success', 'redir'=>'/stp/dashboard'));

           }else{
              $this->ajax(array('msg'=>'Error', 'class'=>'alert alert-danger'));
           }


         }

   }
