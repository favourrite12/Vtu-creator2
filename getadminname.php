<?php include 'checklogin.php';?> 
<?php include '../../include/data_config.php';?>
<?php include '../../include/filter.php';?>
<?php include 'admininfo.php';?>
<?php 
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 if($adminInfo["admin"] != 1 || $adminInfo["admin"] != '1'){
 echo $LANG["access_denied_permisson"];
exit;
 }
     
?>
<?php 
$admin = xcape($conn,$_POST["admin"]);
echo json_encode(adminInfo($admin,$conn));
?>