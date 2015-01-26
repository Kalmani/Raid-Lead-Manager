<?php
  require 'config.php';
  // check login here / create class
  echo json_encode(array(
    'warning' => array(
      'message' => 'Identifiants incorrects'
    )
  ));
?>