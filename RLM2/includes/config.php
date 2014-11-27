<?php
$guilde_name = 'Larmes N?buleuses';
$host = 'db410250125.db.1and1.com';
$user = 'dbo410250125';
$pass = '15ahjui87gKH1ys';
$db = 'db410250125';

$GLOBALS['wowarmory']['db']['driver'] = 'mysql'; // Dont change. Only mysql supported so far.
$GLOBALS['wowarmory']['db']['hostname'] = 'db410250125.db.1and1.com'; // Hostname of server. 
$GLOBALS['wowarmory']['db']['dbname'] = 'db410250125'; //Name of your database
$GLOBALS['wowarmory']['db']['username'] = 'dbo410250125'; //Insert your database username
$GLOBALS['wowarmory']['db']['password'] = '15ahjui87gKH1ys'; //Insert your database password
$GLOBALS['wowarmory']['keys']['api'] = '7gmfqdp4kbcemxdjsquqb4sshtuvmm7m';
$GLOBALS['wowarmory']['keys']['share'] = 'dwTMdSHDrY2T6MqUZEhzgjE7kDtGQqUu';
//$GLOBALS['wowarmory']['debug']['global'] = true;
include('includes/wowarmoryapi/BattlenetArmory.class.php');
$armory = new BattlenetArmory('EU','Dalaran'); 
?>