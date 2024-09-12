<?php 
session_start();
?>
<?php include 'include/getip.php';?>
<?php include 'include/data_config.php';?>
<?php include 'include/filter.php';?>
<?php
$id = mt_rand();
$ref = xcape($conn, $_GET["widget"]);
$location = xcape($conn, $_SERVER['HTTP_REFERER']);
$ip = get_client_ip();
$regDate = time();
$sql = "INSERT INTO ref_click (
        id, 
        widget, 
        loc,
        ip, 
        reg_date
        )
VALUES (
   '$id',
   '$ref',
   '$location',  
   '$ip',
   '$regDate'
)";
$conn->query($sql);
$_SESSION["refer"] = $conn->query("SELECT refer_code FROM users WHERE widget='$ref'")->fetch_assoc()["refer_code"];
javaScriptRedirect("service");
?>
