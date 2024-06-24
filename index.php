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
$_SESSION["dbhost"] = "localhost"; //sql105.infinityfree.com || localhost
$_SESSION["dbusername"] = "root"; //if0_36607061 || root
$_SESSION["dbpassword"] = ""; //w5cW3iQFeYN || ""
$_SESSION["dbname"] = "outdrip_db"; //if0_36607061_users || testlib
$_SESSION["dbport"] = "3306"; //3306 || 3306

$db = new database ();

?>