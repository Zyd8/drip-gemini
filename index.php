<?php 
session_start();
require('urls/Paths.php');
require('urls/Routers.php');

$_SESSION["dbhost"] = "localhost";
$_SESSION["dbusername"] = "root";
$_SESSION["dbpassword"] = "";
$_SESSION["dbname"] = "testlib";
$_SESSION["dbport"] = "3306";
?>