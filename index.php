<?php 
session_start();

/*IMPORTING LIBRARIES*/
require("libraries\GLIB_Debug.php");
require("libraries\GLIB_Database.php");
require("libraries\GLIB_DBFunctions.php");


/*IMPORTING FRAMEWORKS*/
require('urls/Paths.php');
require('urls/Routers.php');

/*SESSION DATABASE*/
$_SESSION["dbhost"] = "localhost";
$_SESSION["dbusername"] = "root";
$_SESSION["dbpassword"] = "";
$_SESSION["dbname"] = "testlib";
$_SESSION["dbport"] = "3306";

?>