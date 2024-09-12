<?php 
session_start();
include "include/filter.php";
$ref = $_GET["r"];
$ref = preg_replace("/[^0-9.]/", "", $ref);
$_SESSION["refer"] = $ref;  
javaScriptRedirect("account/register.php");
