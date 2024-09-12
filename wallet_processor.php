<?php

function fundWallet($conn,$id){
 
$sql = "SELECT id,amount,owner,settled,status FROM payment WHERE id ='$id' OR payment_code='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $payment = $result->fetch_assoc();

}  else {
    $errorFound = true;
    $error[]="failed_unable_to_fetch_transaction_data";
}
 if($payment["settled"]==1){
    $errorFound = true;
    $error[]="transaction_could_not_be_initiated_because_it_was_settled_and_completed";
 }elseif($payment["status"]=="success"){
  $balance = $conn->query("SELECT credit FROM users WHERE id='{$payment["owner"]}'")->fetch_assoc()["credit"];
  $balance = $payment["amount"]+$balance; 
  $conn->query("UPDATE users SET credit='$balance' WHERE id='{$payment["owner"]}'");
}else{
    $errorFound = true;
    $error[]="transaction_failed_unable_to_verify_payment";
}

$conn->query("UPDATE payment SET settled='1' WHERE id='{$payment['id']}'");

if($errorFound){

foreach ($error as $msg) {
   $errorMessage =  $GLOBALS["LANG"]["$msg"]."".$errorMessage;
}
alertDanger($errorMessage);
return $error;
}else {
    alertSuccess($GLOBALS["LANG"]["transaction_successful"]); 
    return true;
}

}
?>
