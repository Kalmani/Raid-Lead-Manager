<?php
require 'config.php';

class Account {
  var $namespace;
  var $action;
  var $params;

  public function __construct($action, $mysqli, $params) {
    $this->action = $action;
    $this->params = $params; 
    $this->mysqli = $mysqli;

    switch ($this->action) {
      case 'login' :
        echo json_encode($this->login());
        break;
    }
  }

  private function login() {
    if ($this->mysqli->connect_errno) {
      return array(
        'error' => array(
          'message' => "Echec lors de la connexion à MySQL : (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error
        )
      );
    }

    $res = $this->mysqli->query("SELECT * FROM larmes_identifiants");
    $founded = false;
    while ($row = $res->fetch_assoc()) {
      $pseudo = trim($_POST['pseudo']);
      $pass = trim($_POST['pass']);
      if ($row['user_log'] == $pseudo && ($row['user_pass'] == $pass || $row['user_pass'] == md5($pass))) {
        if (!$this->isValidMd5($pass))
          $row['need_new_pass'] = true;
        return array(
          'success' => array(
            'message' => 'Identification réussi'
          ),
          'error_case' => array(
            'message' => "Une erreur est survenue lors de l'identification, contacter un administrateur"
          ),
          'user_datas' => $row
        );
      }
    }
    return array(
      'warning' => array(
        'message' => 'Identifiants incorrects'
      )
    );
  }

  private function isValidMd5($md5 ='') {
    return preg_match('/^[a-f0-9]{32}$/', $md5);
  }
}

//echo isValidMd5('5d41402abc4b2a76b9719d911017c592');

$mysqli = new mysqli($host, $user, $pass, $db);
$account = new Account($action, $mysqli, $params);
?>