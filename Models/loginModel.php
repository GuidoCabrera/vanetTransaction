<?php
include_once 'modelFunctions.php';

class loginModel extends model{

    function __construct(){
        parent::__construct();
    }

    function getByName($name,$pass){
        $stmt = new modelFunctions();
        $result = $stmt->getElement("SELECT * FROM usuario WHERE Nombre='$name'");

        if($result!==false&&$result['Contraseña']==$pass){
            session_start();
           $_SESSION['usuario'] = array('name'=>$result['Nombre'],'rol'=>$result['IdRol'],'time'=>time(),'id'=>$result['IdUsuario']);
           return true;
        }
        else{ return false; }
    }
}
?>