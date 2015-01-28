<?php
require 'config.php';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
  echo json_encode(array(
    'error' => array(
      'message' => "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error
    )
  ));
}

$res = $mysqli->query("SELECT * FROM larmes_identifiants");
$founded = false;
while ($row = $res->fetch_assoc()) {
  $pseudo = trim($_POST['pseudo']);
  $pass = trim($_POST['pass']);
  if ($row['user_log'] == $pseudo && $row['user_pass'] == $pass) {
    echo json_encode(array(
      'success' => array(
        'message' => 'Identification réussi'
      ),
      'error_case' => array(
        'message' => "Une erreur est survenue lors de l'identification, contacter un administrateur"
      ),
      'user_datas' => $row
    ));
    $founded = true;
  }
}

if ($founded === false) {
  echo json_encode(array(
    'warning' => array(
      'message' => 'Identifiants incorrects'
    )
  ));
}
?>