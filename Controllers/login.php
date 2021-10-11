<?php

class login extends controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        session_start(); 
      if(isset($_SESSION['usuario']['name'])){
        header('Location:'.constant('URL').'home');
      }
      else{
        session_destroy();
        $this->view->render('login');
      }
    }

   public function Access(){
        if(isset($_POST['name'])&&isset($_POST['password'])){
            $name = $_POST['name'];
            $pass = $_POST['password'];
            $result = $this->model->getByName($name,$pass);
            if($result){ header("Location:".constant('URL')."Home"); }
            else{
                $this->view->msj = "No hay ningun usuario registrado con estas credenciales";
                $this->render('');
            }
        }
        else{ header("location:".constant('URL')."errorP"); }
    }
}
?>
