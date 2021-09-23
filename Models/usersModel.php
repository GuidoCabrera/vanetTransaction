<?php
include_once 'usuarios.php';
include_once 'modelFunctions.php';

class usersModel extends model{

   function __construct(){
       parent::__construct();
   }

    function getCurrentUser($id){
     $stmt = new modelFunctions();
     $result = $stmt->getUsers("usuario","IdUsuario='$id'");
     if($result!=false){
       return $result;
     }
     else{ return false; }
 }

function getOthersUsers($id){
  $stmt = new modelFunctions();
     $result = $stmt->getUsers("usuario","IdUsuario!='$id'");
     if($result!=false){
       return $result;
     }
     else{ return false; }
}

function getAllUsers(){
  $stmt = new modelFunctions();
  $result = $stmt->getAllUsers();
  if($result!=false){
    return $result;
  }
  else{ return false; }
}

  public function createNewUser($nom,$ape,$contra,$rol){
          $values = [":nombre",":apellido",":contra",":rol"];
          $param = [ucfirst($nom),ucfirst($ape),$contra,(int)$rol];
          $stmt = new modelFunctions();
          if($stmt->insert("INSERT INTO USUARIO(NOMBRE,APELLIDO,CONTRASEÑA,IDROL) VALUES",$values,$param)){
              return true;
          }
         else{ return false; }
  }

  public function modifyUser($values){
    $atributes = ["Nombre","Apellido","Contraseña","IdRol"];
    try{
     $query = $this->db->connect();
     foreach($atributes as $element){
       $value = $values[$element];
       $stmt = $query->prepare("UPDATE usuario SET $element='$value' WHERE IdUsuario = :id");
       $stmt->bindParam(":id",$values["IdUsuario"],PDO::PARAM_INT);
       $stmt->execute();
     }
        $stmt = new modelFunctions();
        $result = $stmt->getUsers("usuario","idUsuario=".$values['IdUsuario']);
        return $result;
    }
    catch(PDOEXCEPTION $e){
         printf("Ha surgido un error".$e->getMessage());
          return false;
    }
  }

  public function deleteUser($id){
    $stmt = new modelFunctions();
    if($stmt->delete("usuario WHERE IdUsuario = '$id'")){
        return true;
    }
    else{ return false; }
  }
}
?>