<?php session_start();?>
<?php include "include/ini_set.php"?>
<?php include "include/data_config.php"?>
<?php include "include/webconfig.php"?>
<?php
 $user = $_SESSION["login_user"];
$admin = $_SESSION["admin"];
include "language/{$webConfig["LANG"]}.php";
$lang = mysqli_real_escape_string($conn, $_REQUEST["id"]);
if(!empty($lang) && file_exists("language/$lang.php")){
    include 'language/'.$lang.".php";
    setcookie("LANG", $lang, time() + (86400 * 365), "/",$webConfig["webLink"]); // 86400 = 1 day
    $_SESSION["LANG"]=$lang;
    if(!empty($user)){
    $conn->query("UPDATE users SET lang='$lang' WHERE id='$user'");
    }if(!empty($admin)){
         $conn->query("UPDATE admin SET lang='$lang' WHERE id='$admin'");
    }
 
    $output['status']="success";
    $output['title']=$LANG["success"];
    $output['icon'] = "success";
    $output['close'] = false;
    $output['new'] = true;
    $output['button']=$LANG["continue"];
    $output['link']="";
}  else {
     $output['message']=$LANG["language_not_found"];
     $output['title']=$LANG["not_successful"];
     $output['status']="error";
     $output['button']=$LANG["okay"];
     $output['close'] = true;
     $output['icon'] = "error";
}
echo json_encode($output);
?>

