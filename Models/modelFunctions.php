<?php 

include_once 'usuarios.php';

class modelFunctions extends model{

    public function insert($stmt,$values,$param){
         try{
            $aux = implode(",",$values);
            $query = $this->db->connect();        
            $sql = $query->prepare($stmt."(".$aux.")");
            for($i=0;$i<count($param);$i++){
              $sql->bindParam($values[$i],$param[$i]);
            }
            $sql->execute();
            return true;
         }
         catch(PDOEXCEPTION $e){
             print("Connection Failed: ".$e->getMessage());
             return false;
         }
    }

    public function delete($stmt){
        try{
          $query = $this->db->connect();
          $sql = $query->prepare("DELETE FROM ".$stmt);
          $sql->execute();
          return true;
        }
        catch(PDOEXCEPTION $e){
          print("Connection Failed: ".$e->getMessage());
          return false;
      }
      }
  
      public function modify($table,$atrForChange,$newAtr,$nameColId,$id){
          try{
              $query = $this->db->connect();
              $sql = $query->prepare("UPDATE $table SET $atrForChange='$newAtr' WHERE $nameColId='$id'");
              $sql->execute();
     
              return true;
             }
          catch(PDOEXCEPTION $e){
              printf("Connection Failed: ".$e->getMessage());
              return false;
          }
      }

    public function getUsers($table,$condition){
        $users = [];
        try{
           $query = $this->db->connect();
           $sql = $query->prepare("SELECT * FROM $table WHERE $condition");
           $sql->execute();

         while($result = $sql->fetch(PDO::FETCH_ASSOC)){
            $user = new Usuario($result['IdUsuario'],$result['Nombre'],$result['Apellido'],$result['Contraseña'],$result['IdRol']);
            array_push($users,$user);
         }
         if(count($users)==1){
             return $user;
         }
         else if(count($users)>1){
             return $users;
         }
       }

       catch(PDOEXCEPTION $e){
         printf("Connection Failed: ".$e->getMessage());
         return false;
       }
    }

    public function getAllUsers(){
        $users = [];
    try{
        $query = $this->db->connect();
        $sql = $query->prepare("SELECT * FROM usuario");
        $sql->execute();
        while($result = $sql->fetch(PDO::FETCH_ASSOC)){
            $user = new Usuario($result['IdUsuario'],$result['Nombre'],$result['Apellido'],$result['Contraseña'],$result['IdRol']);
            array_push($users,$user);
          }
        return $users;
      }
      catch(PDOEXCEPTION $e){
          print_r("Connection Failed: ".$e->getMessage());
          return false;
      }
    }

    public function getAllMovements()
    {
        try{
          $array = [];
          $query = $this->db->connect();
          $sql = $query->prepare("SELECT * FROM MOVIMIENTO");
          $sql->execute(); 

          while($result = $sql->fetch(PDO::FETCH_ASSOC)){
            $element = ["name"=>$result["Nombre"],"id"=>$result["IdMovimiento"]];
            array_push($array,$element);
          }
          return $array;
       }
       catch(PDOEXCEPTION $e){
          print_r("Connection Failed: ".$e->getMessage());
          return false;
       }
    }

    public function getElement($stmt){
      try{
        $query = $this->db->connect();
        $sql = $query->prepare("$stmt");
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
      }
      catch(PDOEXCEPTION $e){
          print_r("Connection Failed: ".$e->getMessage());
          return false;
      }
    }

    public function verifyExist($stmt){
      try{
        $query = $this->db->connect();
        $stmt = $query->prepare("$stmt");
        $stmt->execute();
   
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result==false||$result==null){
          return false;
        }
        else{ return true; }
      }
      catch(PDO_EXCEPTION $e){
        printf("Connection Failed: ".$e->getMessage());
      }
    }
}
?>