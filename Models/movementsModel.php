<?php
include_once 'modelFunctions.php';

class movementsModel extends Model{

    public function __construct(){
         parent::__construct();
    }

    function newMovement($name){
          $values = [':nombre'];
          $param = [$name];
          $stmt = new modelFunctions();
          if($stmt->insert("INSERT INTO MOVIMIENTO(NOMBRE) VALUES",$values,$param)){
              return true;
          }
          else{ return false; }
    }

    function getAll(){
            $stmt = new modelFunctions();
            $result = $stmt->getAllMovements();
            if($result!=false){
            return $result;
            }
            else{ return false; }
    }

    function deleteMovement($id){
           $stmt = new modelFunctions();
           if($stmt->delete("MOVIMIENTO WHERE IdMovimiento = '$id'")){
               return true;
           }
           else{ return false; }
    }

    function modifyMovement($name,$id){
        $stmt = new modelFunctions();
        if($stmt->modify("MOVIMIENTO","Nombre","$name","IdMovimiento","$id")){
            return true;
        }
        else{ return false; }
    }
}
?>