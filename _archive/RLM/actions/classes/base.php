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

$res = $mysqli->query("SELECT * FROM larmes_updates ORDER BY maj_id DESC LIMIT 0, 5");
$return = array();
while ($row = $res->fetch_assoc()) {
  $result = array(
    'id' => $row['maj_id'],
    // fix this in DB install
    'note' => utf8_encode($row['maj_content']),
    // Join table to users
    'author' => $row['user_id'],
    'date' => $row['maj_date']
  );
  $return[] = $result;
}
echo json_encode(array(
  'updates' => $return
));
?>