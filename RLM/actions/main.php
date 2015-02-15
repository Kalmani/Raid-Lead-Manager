<?php
$namespace = trim(strtolower($_POST['namespace']));
$action = trim(strtolower($_POST['action']));
$params = $_POST;
unset($params['namespace']);
unset($params['action']);
$file_path = 'classes/' . $namespace . '.php';
if (file_exists($file_path) && is_readable($file_path)) {
  require $file_path;
} else {
  echo json_encode(array(
    'error' => array(
      'message' => 'Bad namespace ' . $namespace . ', file ' . $namespace . '.php does not exist'
    )
  ));
}
?>