<?php

include_once 'usuarios.php';

class homeModel extends model{
   
  function __construct(){
      parent::__construct();
  }
  function getAllUsers(){
      $users = [];
      try{
      $query = $this->db->connect();
      $stmt = $query->prepare("SELECT * FROM usuario");
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
       $user = new Usuario($result["IdUsuario"],$result["Nombre"],$result["Apellido"],$result["Contraseña"],$result["IdRol"]);
       array_push($users,$user);
      }
      return $users;
      }
      catch(PDOEXCEPTION $e){
          printf("Ha ocurrido un error: ".$e->getMessage());
          return false;
      }
  }

  function getAllMovements(){
      $movements = [];
      try{
       $query = $this->db->connect();
       $stmt = $query->prepare("SELECT * FROM movimiento");
       $stmt->execute();

       while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $movement = ["id"=>$result["IdMovimiento"],"nombre"=>$result["Nombre"]];
            array_push($movements,$movement);
       }
       return $movements;
      }
      catch(PDOEXCEPTION $e){
          printf("Ha ocurrido un error: ".$e->getMessage());
          return false;
      }
  }

  function insertTransaction($data){
        //  echo $data["id"]."-".$date."-".$data["entry"]."-".$data["selectM"]."-".$data["egress"]."-".$data["selectP"]."-".$data["detail"];
        try{
           $query = $this->db->connect();
           $stmt = $query->prepare("INSERT INTO TRANSACCION(FECHA,DETALLE,MEDIODEPAGO,INGRESO,EGRESO,IDUSUARIO,IDMOVIMIENTO) VALUES(:fec,:det,:mdp,:ing,:egr,:idU,:idM)");
           $stmt->bindParam(":fec",$data["date"]);
           $stmt->bindParam(":det",$data["detail"]);
           $stmt->bindParam(":mdp",$data["selectP"]);
           $stmt->bindParam(":ing",$data["entry"]);
           $stmt->bindParam(":egr",$data["egress"]);
           $stmt->bindParam(":idU",$data["id"]);
           $stmt->bindParam(":idM",$data["selectM"]);
           $stmt->execute();
           return true;
        }
        catch(PDOEXCEPTION $e){
            printf("Ha ocurrido un error:".$e->getMessage());
            return false;
        }
  }

  function getNameMovement($id){
      try{
    $query = $this->db->connect();
    $stmt2 = $query->prepare("SELECT Nombre FROM movimiento WHERE IdMovimiento = '$id'");
    $stmt2->execute();

    $result = $stmt2->fetch(PDO::FETCH_ASSOC);
    if($result!=false){
    return $result;
    }
    else{
      return false;
    }
    }
    catch(PDOEXCEPTION $e){
        printf("Ha ocurrido un error: ".$e->getMessage());
        return false;
    }
  }

  function getAllTransaction(){
    $transac = [];
    try{
    $query = $this->db->connect();
    $stmt = $query->prepare("SELECT * FROM TRANSACCION");
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

function getSearch($date,$idUser){
  $transac = [];
   try{
     $query = $this->db->connect();
     if($idUser=="All"){
     $stmt = $query->prepare("SELECT * FROM TRANSACCION WHERE Fecha=:fecha");
     $stmt->bindParam(":fecha",$date);
     $stmt->execute();

     while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

    else{
       $stmt = $query->prepare("SELECT * FROM TRANSACCION WHERE Fecha=:fecha AND IdUsuario=:id");
       $stmt->bindParam(":fecha",$date);
       $stmt->bindParam(":id",$idUser);
       $stmt->execute();
    
       while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
   }
   catch(PDOEXCEPTION $e){
     printf("Ha ocurrido un error: ".$e->getMessage());
     return false;
   }
}

function getNameUser($id){
  try{
        $query = $this->db->connect();
        $stmt = $query->prepare("SELECT Nombre FROM USUARIO WHERE IdUsuario = '$id'");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result!=false){
          return $result;
        }
        else{
          return false;
        }
  }
  catch(PDOEXCEPTION $e){
    printf("Ha ocurrido un error: ".$e->getMessage());
    return false;
  }
}

function getTransactionForUser($id){
   $transac = [];
  try{
       $query = $this->db->connect();
       $stmt = $query->prepare("SELECT * FROM TRANSACCION WHERE IdUsuario = '$id' ");
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
     printf("Ha ocurrido un error: ".$e->getMessage());
     return false;
  }
}

function deleteTransac($ids){
  try{
     $query = $this->db->connect();
     $stmt = $query->prepare("DELETE FROM TRANSACCION WHERE IdTransaccion IN($ids)");
     $stmt->execute();
     return true;
  }
  catch(PDOEXCEPTION $e){
    printf("Ha ocurrido un error: ".$e->getMessage());
    return false;
  }
}

function getIdMovement($name){
  try{
  $query = $this->db->connect();
  $stmt2 = $query->prepare("SELECT IdMovimiento FROM movimiento WHERE Nombre='$name'");
  $stmt2->execute();

  $result = $stmt2->fetch(PDO::FETCH_ASSOC);
  return $result;
  }
  catch(PDOEXCEPTION $e){
      printf("Ha ocurrido un error: ".$e->getMessage());
      return false;
  }
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
          echo "<script type='text/javascript'>
                  window.location.href='http://192.168.2.102/PHP/vanetTransaction/Users';
                </script>";
        }
      return true;
   }
   catch(PDO_EXCEPTION $e){
     printf("Ha ocurrido un error: ".$e->getMessage());
   }
}

function verifyExistUser($getId){
   try{
      $query = $this->db->connect();
      $stmt = $query->prepare("SELECT * FROM usuario WHERE IdUsuario='$getId'");
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result==false||$result==null){
        return false;
      }
      else{
        return true;
      }
   }
   catch(PDO_EXCEPTION $e){
     printf("Ha ocurrido un error: ".$e->getMessage());
   }
}

function verifyExistDate($getDate){
  try{
     $query = $this->db->connect();
     $stmt = $query->prepare("SELECT * FROM transaccion WHERE Fecha='$getDate'");
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     if($result==false||$result==null){
       return false;
     }
     else{
       return true;
     }
  }
  catch(PDO_EXCEPTION $e){
    printf("Ha ocurrido un error: ".$e->getMessage());
  }
}

function verifyExistDateWithUser($getDate,$idUser){
  try{
     $query = $this->db->connect();
     $stmt = $query->prepare("SELECT * FROM transaccion WHERE Fecha='$getDate' AND IdUsuario='$idUser'");
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     if($result==false||$result==null){
       return false;
     }
     else{
       return true;
     }
  }
  catch(PDO_EXCEPTION $e){
    printf("Ha ocurrido un error: ".$e->getMessage());
  }
}

}

?>
