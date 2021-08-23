<?php

class loginModel extends model{

    function __construct(){
        parent::__construct();
    }

    function getByName($name,$pass){
        try{
        $query = $this->db->connect();
        $stmt = $query->prepare("SELECT * FROM usuario WHERE Nombre='$name'");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result!==false&&$result['Contraseña']==$pass){
            session_start();
           $_SESSION['usuario'] = array('name'=>$result['Nombre'],'rol'=>$result['IdRol'],'time'=>time(),'id'=>$result['IdUsuario']);
           return true;
        }
        else{
            return false;
        }
    }

       catch(PDOEXCEPTION $e){
        print_r("Connection Failed: ".$e->getMessage());
          return false;
        }
    }

}
?>