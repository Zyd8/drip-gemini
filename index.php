<?php 
session_start();

/*DEBUG ERROR*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*IMPORTING LIBRARIES*/
require('libraries/GLIB_Debug.php');
require('libraries/GLIB_Database.php');
require('libraries/GLIB_DBFunctions.php');
require('libraries/GLIB_Functions.php');

/*IMPORTING FRAMEWORKS*/
require('urls/Paths.php');
require('urls/Routers.php');

/*SESSION DATABASE*/
$_SESSION["dbhost"] = "sql105.infinityfree.com"; //sql105.infinityfree.com || localhost
$_SESSION["dbusername"] = "if0_36607061"; //if0_36607061 || root
$_SESSION["dbpassword"] = "w5cW3iQFeYN"; //w5cW3iQFeYN || ""
$_SESSION["dbname"] = "if0_36607061_users"; //if0_36607061_users || testlib
$_SESSION["dbport"] = "3306"; //3306 || 3306

?>