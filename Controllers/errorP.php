<?php

class errorP extends controller{

    function __construct(){
        parent::__construct();
    }

     function render(){ $this->view->render('error'); }
}
?>