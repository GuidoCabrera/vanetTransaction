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

}
?>