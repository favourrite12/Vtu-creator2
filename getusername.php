<?php include 'checklogin.php';?> 
<?php include '../../include/data_config.php';?>
<?php include '../../account/userinfojson.php';?>
<?php include 'admininfo.php';?>
<?php 
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 if($adminInfo["users"] != 1 || $adminInfo["add_money"] != 1){
  echo $LANG["access_denied_permisson"];
exit;
 }
     
?>
<?php 
$user = $_POST["user"];
echo userInfo($user,$conn);
?>