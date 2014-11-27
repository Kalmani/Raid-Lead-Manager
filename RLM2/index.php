<?php
session_start();
require_once("includes/144_Calendrier/calendar.php");
include_once('includes/config.php');
include('includes/class/user.class.php');
$user = new user($guilde_name);
?>