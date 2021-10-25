<?php

class users extends controller{

    function __construct(){
        parent::__construct();
        $this->view->usuarios = [];
    }

    function render(){
        session_start();
        if(isset($_SESSION['usuario']['name'])&&isset($_SESSION['usuario']['rol'])&&$_SESSION['usuario']['rol']==1){
    
            if((time() - $_SESSION['usuario']['time']) > 1800) // 900segundos = 15minutos * 60segundos  
           {  
                header("location:".constant('URL')."/Controllers/logOut.php");  
           } 
           else{
            $_SESSION['usuario']['time'] = time(); 
            if(!isset($_POST["id"])){
                $datos = $this->model->getCurrentUser($_SESSION['usuario']['id']);
                $this->view->usuarioActual = $datos;
                $datos2 = $this->model->getAllUsers();
                $this->view->usuarios = $datos2;
                $this->view->render("Users");
            }
           }
        }
        else if(isset($_SESSION['usuario']['name'])&&isset($_SESSION['usuario']['rol'])&&$_SESSION['usuario']['rol']==2){
            $this->view->render('home');
        }
        else{
            $this->view->render('login');
        }
    }

     function selectedUser(){
         if(isset($_POST["users"])){
            $datos = $this->model->getCurrentUser($_POST["users"]);
             $this->view->usuarioSeleccionado = $datos;
             $this->render("Users");
         }
         else{
            header("location:".constant('URL')."Users");
         }
     }

     function newUser(){
         if(isset($_POST["nameUser"])&&isset($_POST["surnameUser"])&&isset($_POST["passwordUser"])&&isset($_POST["rolUser"])){
             if($this->model->createNewUser($_POST["nameUser"],$_POST["surnameUser"],$_POST["passwordUser"],$_POST["rolUser"])){
                session_start();
                $datos = $this->model->getCurrentUser($_SESSION['usuario']['id']);
                session_abort();
                $this->view->usuarioActual = $datos;     
                $datos2 = $this->model->getAllUsers();
                $this->view->usuarios = $datos2;
                $results = "Success";
                header("location:".constant('URL')."Users?resultado=".$results);
             }
             else{ header("location:".constant('URL')."errorP"); }
        }
     }

     function modifyUser(){
        session_start();
        if(isset($_POST["name"])&&isset($_POST["surname"])&&isset($_POST["password"])&&isset($_POST["rol"])){
          $array = array("Nombre"=>$_POST["name"],"Apellido"=>$_POST["surname"],"Contraseña"=>$_POST["password"],"IdRol"=>$_POST["rol"],"IdUsuario"=>$_POST["id"]);
          $user = $this->model->modifyUser($array);
            if($user){
            $datos2 = $this->model->getAllUsers();
            $this->view->usuarios = $datos2;
            $this->view->usuarioSeleccionado = $user; 
            $results = "Success";
            header("location:".constant('URL')."Users?resultado=".$results);
            $this->view->render("Users");
            }
            else{ header("location:".constant('URL')."errorP"); }
        }
        else{ header("location:".constant('URL')."errorP"); }
     }

     function deleteUser(){
        if(isset($_POST["id"])){
            session_start();
             if($_POST["id"]!=$_SESSION['usuario']['id']){
              if($this->model->deleteUser($_POST["id"])){
                $this->Message('Usuario eliminado con exito',constant("URL")."Users");
                 }
              else{ $this->Message('Ha ocurrido un error al eliminar el usuario, vuelva a intentar mas tarde',constant("URL")."Users"); }
             }
             else{ $this->Message('El usuario esta iniciado sesion, no se puede eliminar'); }
        }
     }

}
?>