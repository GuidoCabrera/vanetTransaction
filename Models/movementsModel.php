<?php

class movementsModel extends Model{
    
    public function __construct(){
         parent::__construct();
    }

    function newMovement($name){
      try{
           $query = $this->db->connect();
           $stmt = $query->prepare("INSERT INTO MOVIMIENTO(NOMBRE) VALUES(:nombre)");
           $stmt->bindParam(":nombre",$name);
           $stmt->execute();
           return true;
      }
      catch(PDOEXCEPTION $e){
          printf("Ha ocurrido un error: ".$e->getMessage());
          return false;
      }
    }

    function getAll(){
        $movements = [];
        try{
            $query = $this->db->connect();
            $stmt = $query->prepare("SELECT * FROM MOVIMIENTO");
            $stmt->execute();

            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                $movement = ["name"=>$result["Nombre"],"id"=>$result["IdMovimiento"]];
                array_push($movements,$movement);
            }
            return $movements;
       }
       catch(PDOEXCEPTION $e){
           printf("Ha ocurrido un error: ".$e->getMessage());
           return false;
       }
    }

    function deleteMovement($id){
        try{
           $query = $this->db->connect();
        $stmt = $query->prepare("DELETE FROM MOVIMIENTO WHERE IdMovimiento = '$id'");
        $stmt->execute();
        return true;
        }
        catch(PDOEXCEPTION $e){
            printf("Ha ocurrido un error: ".$e->getMessage());
            return false;
        }
    }

    function modifyMovement($name,$id){
        try{
         $query = $this->db->connect();
         $stmt = $query->prepare("UPDATE MOVIMIENTO SET Nombre='$name' WHERE idMovimiento = '$id'");
         $stmt->execute();

         return true;
        }
        catch(PDOEXCEPTION $e){
            printf("Ha ocurrido un error: ".$e->getMessage());
            return false;
        }
    }
}
?>