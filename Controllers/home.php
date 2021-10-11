<?php

class home extends controller{

    function __construct(){
        parent::__construct();
        $this->view->users = [];
        $this->view->movements = [];
        $this->view->transaction = [];
        $this->view->transacSearch = [];
    }

    function render(){
        session_start();
        if(isset($_SESSION['usuario']['name'])&&isset($_SESSION['usuario']['rol'])){
            // var_dump($_SESSION['user']['time']);
            // var_dump(time());
           if((time() - $_SESSION['usuario']['time']) > 1800) // 900 = 15 * 60  
           { header("location:".constant('URL')."/Controllers/logOut.php"); } 
           else{
            $_SESSION['usuario']['time'] = time(); 
            $datos2 = $this->model->getAllMovements();
            $this->view->movements = $datos2;
            if($_SESSION["usuario"]["rol"]==1){
            $datos = $this->model->getAllUsers();
            $this->view->users = $datos;
            $transaccion = $this->model->getAllTransaction();
            $this->view->transaction = $transaccion;
             }
            else if($_SESSION["usuario"]["rol"]==2){
                 $transaccion = $this->model->getTransactionForUser($_SESSION["usuario"]["id"]);
                 $this->view->transaction = $transaccion;
             }
             $this->view->render('home');
           }
        }
        else{ $this->view->render('login'); }
    }

    function insertTransaction(){
        if(isset($_POST["selectMovement"])&&isset($_POST["entry"])&&isset($_POST["egress"])&&isset($_POST["detail"])&&isset($_POST["selectPayment"])){
            session_start();
            if(isset($_POST["dateFooter"])){
            $value = $this->model->insertTransaction(["id"=>$_SESSION["usuario"]["id"],"date"=>$_POST["dateFooter"],"selectM"=>$_POST["selectMovement"],"entry"=>$_POST["entry"],"egress"=>$_POST["egress"],"detail"=>$_POST["detail"],"selectP"=>$_POST["selectPayment"]]);
            }
            else{
            $today = getdate();
            $date = $today["year"]."-".$today["mon"]."-".$today["mday"];
            $value = $this->model->insertTransaction(["id"=>$_SESSION["usuario"]["id"],"date"=>$date,"selectM"=>$_POST["selectMovement"],"entry"=>$_POST["entry"],"egress"=>$_POST["egress"],"detail"=>$_POST["detail"],"selectP"=>$_POST["selectPayment"]]);
           }
           if($value){
            if($_SESSION["usuario"]["rol"]==1){
            $link = "home/Search?date=".$_POST["dateFooter"]."&users=".$_POST["userFooter"];
            }
            else{
            $link = "home/Search?date=".$_POST["dateFooter"];
            }
            session_abort();
            header("location:".constant('URL').$link);
           }
           else{ header("location:".constant("URL")."ErrorP"); }
        }
        else{ header("location:".constant("URL")."ErrorP"); }
    }

    function Search(){
        session_start();
        $datos = $this->model->getAllUsers();
        $datos2 = $this->model->getAllMovements();
        if(isset($_GET["date"])&&isset($_GET["users"])&&$_SESSION['usuario']['rol']==1){
                $bool1 = $this->model->verifyExistUser($_GET["users"]);
                $bool2 = $this->model->verifyExistDate($_GET["date"]);
              if(($bool1||$_GET["users"]=="All")&&$bool2){
                //Buscando las transacciones mediante los GET
                 $transacSearch = $this->model->getSearch($_GET["date"],$_GET["users"]);
                //Array con todas las transacciones para luego activar en datepicker cada fecha
                 $transaccion = $this->model->getAllTransaction();
                 if($_GET["users"]!="All"){
                 $nameUser = $this->model->getNameUser($_GET["users"]);
                 $this->view->userSelected  = $nameUser;
                 $this->view->idUserSelected = $_GET["users"];
                 }
                 $this->view->users = $datos;
                 $this->view->movements = $datos2;
                 $this->view->transaction = $transaccion;
                 $this->view->transacSearch = $transacSearch;
                 $this->view->dateSelected = $_GET["date"];
                 $this->view->render("home");
                }
             else{ header("location:".constant("URL")."Home"); }
           }
        else if(isset($_GET["date"])&&$_SESSION['usuario']['rol']==2){
                $bool2 = $this->model->verifyExistDateWithUser($_GET["date"],$_SESSION["usuario"]["id"]);
                if($bool2){
                 $transacSearch = $this->model->getSearch($_GET["date"],$_SESSION["usuario"]["id"]);
                 //Array con las transacciones del usuario para luego activarlas en el datepicker
                 $transaccion = $this->model->getTransactionForUser($_SESSION["usuario"]["id"]);
                 $this->view->users = $datos;
                 $this->view->movements = $datos2;
                 $this->view->transaction = $transaccion;
                 $this->view->transacSearch = $transacSearch;
                 $this->view->dateSelected = $_GET["date"];
                 $this->view->render("home");
                }
                else{ header("location:".constant("URL")."Home"); }
           }
        else{ header("location:".constant("URL")."Home"); }     
    }

    function deleteTransac(){
        if(isset($_REQUEST["tuArrJson"])){
            $param = json_decode($_REQUEST['tuArrJson']);
            $param2 = implode(",",$param);
            
            if($this->model->deleteTransac($param2)){   
                echo "<script type='text/javascript'>
                window.location.reload();
              </script>";
              }
              else{ header("location:".constant("URL")."ErrorP"); }
        }
        }

    function modifyTransac(){
        if(isset($_REQUEST["ArrayJson"])){
            $arrayModif = json_decode($_REQUEST['ArrayJson']);       
            $array = array("Movimiento"=>$arrayModif[0],"Detalle"=>$arrayModif[1],"Ingreso"=>$arrayModif[2],"Egreso"=>$arrayModif[3],"MedioDePago"=>$arrayModif[4],"IdTransaccion"=>$arrayModif[5]);
             if($this->model->modifyTransac($array)){
                $this->Message('',constant("URL")."Home");
             }
             else{ $this->Message('',constant("URL")."ErrorP"); }           
        }
    }
}
?>