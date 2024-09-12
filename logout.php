<?php
session_start();
?>
<?php include '../include/data_config.php';?>
<?php include '../include/webconfig.php';?>
<?php include '../include/filter.php';?>
  	
  <?php
  
      $webLink  = $_SERVER["SERVER_NAME"];
		if(!empty($webConfig["webLink"])){  
			$webLink = $webConfig["webLink"];
		}
?>
<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 


$cookie_user = "uKey";
$cookie_password = "uToken";
$uOpKey = "uOpKey";

setcookie($cookie_user, "", time() - 3600, "/","$webLink",false);
setcookie($cookie_password, "", time() - 3600, "/","$webLink",false);
setcookie($uOpKey, "", time() - 3600, "/","$webLink",false);

javaScriptRedirect("login.php");
//print_r($_COOKIE);
?>