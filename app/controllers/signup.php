<?php


namespace X\App\Controllers;
use X\Sys\Controller;
/**
 * Description of login
 *
 * @author linux
 */
class SignUp extends Controller{

    public function __construct($params){
   			parent::__construct($params);
            $this->addData(array(
               'page'=>'SignUp'));
   			$this->model=new \X\App\Models\mSignup();
   			$this->view =new \X\App\Views\vSignup($this->dataView,$this->dataTable);
   		}


      function home(){

      									//$data=$this->model->getPath();
      									//$this->addData($data);

      									$this->view->__construct($this->dataView,$this->dataTable);
      									$this->view->show();

      }

     public function sign(){

        $username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);

        $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);

        $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        $res=$this->model->signuser($username, $password, $email); //funcion para iniciar sesion

        //si $res devuelve true devolveremos un array al ajax para confirmar que esté todo correcto
        if($res){
            $this->ajax(array('msg'=>'Correct','class'=>'alert alert-success', 'redir'=>'/stp/dashboard'));

        }else{
           $this->ajax(array('msg'=>'Usuario o Email registrados', 'class'=>'alert alert-danger'));
        }


    }

}
