<?php
$guilde_name = 'Guild Name';
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_name';

$GLOBALS['wowarmory']['db']['driver'] = 'mysql'; // Dont change. Only mysql supported so far.
$GLOBALS['wowarmory']['db']['hostname'] = $host; // Hostname of server. 
$GLOBALS['wowarmory']['db']['dbname'] = $db; //Name of your database
$GLOBALS['wowarmory']['db']['username'] = $user; //Insert your database username
$GLOBALS['wowarmory']['db']['password'] = $pass; //Insert your database password
$GLOBALS['wowarmory']['keys']['api'] = 'api_key';
$GLOBALS['wowarmory']['keys']['share'] = 'api_share_key';
//$GLOBALS['wowarmory']['debug']['global'] = true;
include('includes/wowarmoryapi/BattlenetArmory.class.php');
$armory = new BattlenetArmory('EU','ServerName'); 
?>