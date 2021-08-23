<?php

class view{

 function __construct(){
    
 }

  function render($url){
      require 'Views/'.$url.'/index.php';
  }

}
?>