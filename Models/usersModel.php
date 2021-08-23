<?php

include_once 'usuarios.php';

class usersModel extends model{

   function __construct(){
       parent::__construct();
   }

  function getCurrentUser($id){
      try{
      $query = $this->db->connect();
      $stmt = $query->prepare("SELECT * FROM usuario WHERE IdUsuario='$id'");
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if($result!==false&&count($result)>0){
            $usuario = new Usuario($result['IdUsuario'],$result['Nombre'],$result['Apellido'],$result['Contraseña'],$result['IdRol']); 
      }
      else{
          $usuario = false;
      }
      return $usuario;
    }
    catch(PDOEXCEPTION $e){
        print_r("Se ha producido un error: ".$e->getMessage());
    }
  }

  function getOthersUsers($id){
      $users = [];
    try{
        $query = $this->db->connect();
        $stmt = $query->prepare("SELECT * FROM usuario WHERE IdUsuario!='$id'");
        $stmt->execute();
  
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user = new Usuario($result['IdUsuario'],$result['Nombre'],$result['Apellido'],$result['Contraseña'],$result['IdRol']);
            array_push($users,$user);
          }
        return $users;
      }
      catch(PDOEXCEPTION $e){
          print_r("Se ha producido un error: ".$e->getMessage());
      }
  }

  function getAllUsers(){
    $users = [];
    try{
        $query = $this->db->connect();
        $stmt = $query->prepare("SELECT * FROM usuario");
        $stmt->execute();
  
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user = new Usuario($result['IdUsuario'],$result['Nombre'],$result['Apellido'],$result['Contraseña'],$result['IdRol']);
            array_push($users,$user);
          }
        return $users;
      }
      catch(PDOEXCEPTION $e){
          print_r("Se ha producido un error: ".$e->getMessage());
      }
  }

  public function createNewUser($nom,$ape,$contra,$rol){
    try{
     $query = $this->db->connect();
     $stmt = $query->prepare('INSERT INTO USUARIO(NOMBRE,APELLIDO,CONTRASEÑA,IDROL) VALUES(:nombre,:apellido,:contra,:rol)');
     $nom = ucfirst($nom);
     $ape = ucfirst($ape);
     $stmt->bindParam(":nombre",$nom);
     $stmt->bindParam(":apellido",$ape);
     $stmt->bindParam(":contra",$contra);
     $stmt->bindParam(":rol",$rol,PDO::PARAM_INT);
     $stmt->execute();
     
     return true;
    }
    catch(PDOEXCEPTION $e){
      print_r("ha ocurrido un error:".$e->getMessage());
      return false;
    }
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
        $stmt2 = $query->prepare("SELECT * FROM USUARIO WHERE idUsuario = :id");
        $stmt2->bindParam(":id",$values["IdUsuario"],PDO::PARAM_INT);
        $stmt2->execute();
        $result = $stmt2->fetch(PDO::FETCH_ASSOC);

        if($result!==false && $result!==null ){
           $user = new Usuario($result["IdUsuario"],$result["Nombre"],$result["Apellido"],$result["Contraseña"],$result["IdRol"]);
        }
            return $user;
    //  return true;
    }
    catch(PDOEXCEPTION $e){
         printf("Ha surgido un error".$e->getMessage());
          return false;
    }
  }

  public function deleteUser($id){
      try{
          $query = $this->db->connect();
          $stmt = $query->prepare("DELETE FROM usuario WHERE IdUsuario = :id");
          $stmt->bindParam(":id",$id);
          $stmt->execute();
          return true;
      }
      catch(PDOEXCEPTION $e){
        printf("Se ha producido un error:".$e->getMessage());
        return false;
      }
  }

}
?>