<?php

class movements extends controller{
  
    function __construct(){
        parent::__construct();
        $this->view->movement = [];
    }

    function render(){
        session_start();
        if(isset($_SESSION['usuario']['name'])&&isset($_SESSION['usuario']['rol'])&&$_SESSION['usuario']['rol']==1){
            // var_dump($_SESSION['user']['time']);
            // var_dump(time());
            if((time() - $_SESSION['usuario']['time']) > 1800) // 900 = 15 * 60  
                {  header("location:".constant('URL')."/Controllers/logOut.php"); } 
            else{
            $_SESSION['usuario']['time'] = time(); 
            $datos = $this->model->getAll();
            $this->view->movement = $datos;
            $this->view->render('movements');
           }
        }
        else if(isset($_SESSION['usuario']['name'])&&isset($_SESSION['usuario']['rol'])&&$_SESSION['usuario']['rol']==2){
            $this->view->render('home');
        }
        else{ $this->view->render('login'); }
    }

    function newMovement(){
        if(isset($_POST["movement"])&&!empty($_POST["movement"])){
            if($this->model->newMovement($_POST["movement"])){
                $results = "Success";
                header("location:".constant('URL')."movements?resultado=".$results);
            }
            else{ header("location:".constant('URL')."errorP"); }
        }
        else{
            $this->view->msj = "No se puede crear un movimiento sin un nombre";
            $this->render("Users");
        }
    }

    function deleteMovement(){
        if(isset($_POST["movement"])){
            if($this->model->deleteMovement($_POST["movement"])){
                $results = "Success";
                header("location:".constant('URL')."movements?resultado=".$results);
            }
            else{ header("location:".constant('URL')."errorP"); }
        }
        else{ header("location:".constant('URL')."errorP"); }
    }

   function ModifyMovement(){
    if(!empty($_POST["inputMovement"])){
        if(isset($_POST["inputMovement"])&&isset($_POST["movement2"])){
            if($this->model->modifyMovement($_POST["inputMovement"],$_POST["movement2"])){
                $results = "Success";
                header("location:".constant('URL')."movements?resultado=".$results);
            }
            else{ header("location:".constant('URL')."errorP"); }
        }
        else{ header("location:".constant('URL')."errorP"); }
    }
    else{
        $this->view->msj = "No se puede realizar una modificacion vacia";
        $this->render("Users");
    }
   }
}
?>