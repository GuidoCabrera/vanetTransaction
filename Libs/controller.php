<?php

class controller{

 function __construct(){
     $this->view = new view();
 }

 function loadModel($name){
      $url = "Models/".$name."Model.php";
      if(file_exists($url)){
        require $url;
        $modelName = $name."Model";
        $this->model = new $modelName();
      }
 }

 function Message($msj,$url=""){
  if($url!=""&&$msj!=""){
     echo "<script type='text/javascript'>  
     alert('".$msj."');
     window.location.href='".$url."';
     </script>";  
  }
  else if($msj!=""){
     echo "<script type='text/javascript'>  
     alert('".$msj."');
     </script>"; 
  }
  else{
     echo "<script type='text/javascript'>  
     window.location.href='".$url."';
     </script>";
  }
}
}
?>