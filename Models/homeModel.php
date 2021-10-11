<?php

include_once 'usuarios.php';
include_once 'modelFunctions.php';

class homeModel extends model{
   
  function __construct(){
      parent::__construct();
  }
  function getAllUsers(){
    $stmt = new modelFunctions();
    $result = $stmt->getAllUsers();
    if($result!=false){
      return $result;
    }
    else{ return false; }
  }

  function getAllMovements(){
    $stmt = new modelFunctions();
    $result = $stmt->getAllMovements();
      if($result!=false){
        return $result;
      }
      else{ return false; }
  }

  function insertTransaction($data){
          $values = [":fec",":det",":mdp",":ing",":egr",":idU",":idM"];
          $param = [$data["date"],$data["detail"],$data["selectP"],$data["entry"],$data["egress"],$data["id"],$data["selectM"]];
          $stmt = new modelFunctions();
          if($stmt->insert("INSERT INTO TRANSACCION(FECHA,DETALLE,MEDIODEPAGO,INGRESO,EGRESO,IDUSUARIO,IDMOVIMIENTO) VALUES",$values,$param)){
              return true;
          }
        else{ return false; }
  }

  function getNameMovement($id){
    $stmt = new modelFunctions();
    $result = $stmt->getElement("SELECT Nombre FROM movimiento WHERE IdMovimiento = '$id'");
    if($result!=false){
    return $result;
    }
    else{ return false; }    
  }

  function getNameUser($id){
    $stmt = new modelFunctions();
      $result = $stmt->getElement("SELECT Nombre FROM USUARIO WHERE IdUsuario = '$id'");
      if($result!=false){
      return $result; 
      }
      else{ return false; }  
  }

  function getAllTransaction(){
  $result = $this->getTransaction("SELECT * FROM TRANSACCION");
  if($result!=false){
    return $result;
  }
  else{ return false; }
}

function getSearch($date,$idUser){
   if($idUser=="All"){
     $result = $this->getTransaction("SELECT * FROM TRANSACCION WHERE Fecha='$date'");
    return $result;
     }
   else{
    $result = $this->getTransaction("SELECT * FROM TRANSACCION WHERE Fecha='$date' AND IdUsuario='$idUser'");
    return $result;
}
}

function getTransaction($stmt){
  $transac = [];
    try{
    $query = $this->db->connect();
    $stmt = $query->prepare("$stmt");
    $stmt->execute();

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $nameMovement = $this->getNameMovement($result["IdMovimiento"]);
        $nameUser = $this->getNameUser($result["IdUsuario"]);
        if($nameMovement!=false){
        $transaction = ["id"=>$result["IdTransaccion"],"movement"=>$nameMovement["Nombre"],"date"=>$result["Fecha"],"detail"=>$result["Detalle"],"methodP"=>$result["MedioDePago"],"income"=>$result["Ingreso"],"egress"=>$result["Egreso"],"user"=>$result["IdUsuario"],"nameUser"=>$nameUser["Nombre"]];
        array_push($transac,$transaction);
      }
      else{
          printf("Ha ocurrido un error");
          return false;
      }
    }
    return $transac;
  }
  catch(PDOEXCEPTION $e){
      printf("Ha ocurrido un error".$e->getMessage());
      return false;
  }
}

function getTransactionForUser($id){
  $result = $this->getTransaction("SELECT * FROM TRANSACCION WHERE IdUsuario='$id'");
    if($result!=false){
      return $result;
    }
    else{ return false; }
}

function deleteTransac($ids){
    $stmt = new modelFunctions();
    if($stmt->delete("TRANSACCION WHERE IdTransaccion IN($ids)")){
        return true;
    }
    else{ return false; }
}

function getIdMovement($name){
  $stmt = new modelFunctions();
      $result = $stmt->getElement("SELECT IdMovimiento FROM movimiento WHERE Nombre='$name'");
      if($result!=false){
      return $result; 
      }
      else{ return false; } 
}

function modifyTransac($array){
  $atributesHome = ["IdMovimiento","Detalle","MedioDePago","Ingreso","Egreso"];
   try{
      $query = $this->db->connect();
      $idMovement = $this->getIdMovement($array["Movimiento"]);
      $stringId = implode("",$idMovement);
      
       if($idMovement!=false){
        foreach($atributesHome as $element){
          
         if($element!="IdMovimiento"){
        $value = $array[$element];
        $stmt = $query->prepare("UPDATE transaccion SET $element='$value' WHERE IdTransaccion=:id");
        $stmt->bindParam(":id",$array['IdTransaccion'],PDO::PARAM_INT);
        $stmt->execute();
        }
         else{
           $stmt2 = $query->prepare("UPDATE transaccion SET $element='$stringId' WHERE IdTransaccion=:id");
           $stmt2->bindParam(":id",$array['IdTransaccion'],PDO::PARAM_INT);
           $stmt2->execute();
         }
       }
        }
        else{
          return false;
        }
      return true;
   }
   catch(PDO_EXCEPTION $e){
     printf("Ha ocurrido un error: ".$e->getMessage());
   }
}

function verifyExistUser($getId){
      $stmt = new modelFunctions();
      $result = $stmt->verifyExist("SELECT * FROM usuario WHERE IdUsuario='$getId'");
      if($result){ return $result; }
      else{ return false; } 
}

function verifyExistDate($getDate){
  $stmt = new modelFunctions();
      $result = $stmt->verifyExist("SELECT * FROM transaccion WHERE Fecha='$getDate'");
      if($result){ return $result; }
      else{ return false; } 
}

function verifyExistDateWithUser($getDate,$idUser){
  $stmt = new modelFunctions();
      $result = $stmt->verifyExist("SELECT * FROM transaccion WHERE Fecha='$getDate' AND IdUsuario='$idUser'");
      if($result){ return $result; }
      else{ return false; } 
}
}
?>