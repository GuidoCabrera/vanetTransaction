<?php
require_once '../config/config.php';
  session_start();
  session_destroy();
  header("location:".constant('URL')."login");
?>