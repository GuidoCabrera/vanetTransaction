<?php 

 class Usuario{
     private $idUsuario;
     private $nombre;
     private $apellido;
     private $contraseña;
     private $idRol;

     function __construct($id,$nom,$ape,$pass,$rol){
         $this->idUsuario = $id;
         $this->nombre = $nom;
         $this->apellido = $ape;
         $this->contraseña = $pass;
         $this->idRol = $rol;
     }

     function getId(){
         echo $this->idUsuario;
     }
     function getId2(){
        return $this->idUsuario;
    }
     function getNombre(){
         echo $this->nombre;
     }
     function getNombre2(){
        return $this->nombre;
    }
     function getApellido(){
         echo $this->apellido;
     }
     function getContraseña(){
         echo $this->contraseña;
     }
     function getRol(){
         echo $this->idRol;
     }
 }

?>