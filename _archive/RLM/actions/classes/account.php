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
      case 'change_login' :
        echo json_encode($this->change_login());
        break;
      case 'change_email' :
        echo json_encode($this->change_email());
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
        $row['user_perso'] = utf8_encode($row['user_perso']);
        return array(
          'success' => array(
            'message' => 'Identification réussi'
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

  private function change_login() {
    $user = json_decode($_COOKIE['RLM_user'], true);

    $user_log = $this->params['identifiant'];
    $old_password = $this->params['old_password'];
    $new_password = $this->params['new_password'];
    $new_password_conf = $this->params['new_password_conf'];

    if (empty($this->params['identifiant']))
      return array(
        'error' => array(
          'message' => "Merci de saisir un identifiant correct"
        )
      );

    if ($user['user_pass'] !== $old_password
        && $user['user_pass'] !== md5($old_password))
      return array(
        'error' => array(
          'message' => "Mot de passe actuel incorrect"
        )
      );

    if (empty($new_password) && empty($new_password_conf)) {
      $req = "UPDATE larmes_identifiants SET user_log = '".$user_log."' WHERE user_id = ".$user['user_id'];
      $res = $this->mysqli->query($req);
      $user['user_log'] = $user_log;
      $_COOKIE['RLM_user'] = json_encode($user);
      return array(
        'success' => array(
          'message' => 'Identifiant modifié avec succès'
        ),
        'datas' => array(
          'user_log' => $user_log
        )
      );
    }


    if ((!empty($new_password) || !empty($new_password_conf))
        && ($new_password !== $new_password_conf))
      return array(
        'error' => array(
          'message' => "Merci de saisir des mots de passe identiques"
        )
      );

    if ((!empty($new_password) || !empty($new_password_conf))
        && ($new_password === $new_password_conf)) {
      $req = "UPDATE larmes_identifiants SET user_log = '".$user_log."', user_pass = '".md5($new_password)."' WHERE user_id = ".$user['user_id'];
      $res = $this->mysqli->query($req);
      return array(
        'success' => array(
          'message' => 'Identifiant et mot de passe modifiés avec succès'
        ),
        'datas' => array(
          'user_log' => $user_log,
          'user_pass' => md5($new_password)
        )
      );
    }
    return array(
      'error' => array(
        'message' => "Vous êtes tombé sur une exception, merci de contacter un administrateur en précisant votre parcour"
      )
    );
  }

  private function change_email() {
    $user = json_decode($_COOKIE['RLM_user'], true);
    $user_mail = $this->params['email'];
    if (empty($user_mail) || !$this->is_email($user_mail)) {
      return array(
        'error' => array(
          'message' => "Email incorrect"
        )
      );
    } else {
      $req = "UPDATE larmes_identifiants SET user_mail = '".$user_mail."' WHERE user_id = ".$user['user_id'];
      $res = $this->mysqli->query($req);
      $user['user_mail'] = $user_mail;
      $_COOKIE['RLM_user'] = json_encode($user);
      return array(
        'success' => array(
          'message' => 'Adresse email modifiée avec succès'
        ),
        'datas' => array(
          'user_mail' => $user_mail
        )
      );
    }

  }

  private function isValidMd5($md5 ='') {
    return preg_match('/^[a-f0-9]{32}$/', $md5);
  }

  private function is_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }
}

$mysqli = new mysqli($host, $user, $pass, $db);
$account = new Account($action, $mysqli, $params);
?>