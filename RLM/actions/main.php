<?php
  class MainControler {
    var $namespace;
    var $action;

    function __construct($namespace, $action) {
      $this->namespace = $namespace;
      $this->action = $action;
      echo $this->namespace.' '.$this->action;
    }
  }
  try {
    $namespace = trim($_POST['namespace']);
    $action = trim($_POST['action']);
    $main = new MainControler($namespace, $action);
  } catch (Exception $e) {
    echo 'Error : ',  $e->getMessage(), "\n";
  }
?>