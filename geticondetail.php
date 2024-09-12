
 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include "../../language/{$webConfig["LANG"]}.php"; ?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 if($adminInfo["icon"] != 1 || $adminInfo["icon"] != '1'){
      echo $LANG["access_denied_permisson"];
exit;
 }
     
?>

<?php 
//print_r($_POST);
$key = xcape($conn,$_POST["key"]);
$sql = "SELECT value,description FROM web_config WHERE array_key='$key' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   $row["description"] = $LANG[$row["description"]];
}
echo json_encode($row);
?>