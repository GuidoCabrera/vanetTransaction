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
          //Funcion que verifica que el nombre y contraseña sean coincidentes
            $result = $this->model->getByName($_POST['name'],$_POST['password']);
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
