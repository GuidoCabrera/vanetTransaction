<?php
  session_start();

  // session_unset();

  session_destroy();

  header('Location: http://192.168.2.102/PHP/vanetTransaction/login');
?>