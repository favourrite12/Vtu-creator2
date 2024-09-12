<?php include '../../include/ini_set.php';?> 
<?php include '../include/checklogin.php';?>
<?php include '../../include/data_config.php';?>
<?php include '../../account/userinfojson.php';?>
<?php include '../../include/filter.php';?>
<?php include '../../include/webconfig.php';?>
<?php include "../../language/{$webConfig["LANG"]}.php";?>
<?php 

	include '../include/admininfo.php';
	$adminInfo = adminInfo($loginAdmin,$conn);
	//print_r($adminInfo);
	 if($adminInfo["transaction"] != 1 || $adminInfo["transaction"] != '1'){
	 echo $LANG["access_denied_permisson"];
	exit;
	 }
       
?>

<?php 
$webName = $webConfig["webName"];
$replyTo = $webConfig["replyTo"];


$supportEmail = explode(",",$webConfig["supportEmail"])[0];

$address = explode(",",$webConfig["address"])[0];
$phoneNumber = explode(",",$webConfig["phoneNumber"])[0];


$webLink  = $_SERVER["SERVER_NAME"];
if(!empty($webConfig["webLink"])){  
	$webLink = $webConfig["webLink"];
}
$webLogo = "//$webLink/uploads/".$webConfig["webLogo"];
?>
<?php 
include "../../sendMail/sendMail.php";
$mail =  new sendMail($webConfig["licencesToken"]); 
?>
<?php
$id= xcape($conn,$_GET['id']);
$res = preg_replace("/[^0-9]/", "", "$id");
$sql = "SELECT id,amount,service_id,pay_amount,user,reg_date FROM api_transaction WHERE id ='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $amount = $row["amount"];
        $serviceId = $row["service_id"];
        $payAmount = $row["pay_amount"];
        $owner = $row["user"];
        $date = date("d-m-Y @ g:ia ",$row["reg_date"]);
        //echo  $paymentCode;
        $u =  userInfo($owner,$conn);
        $u = json_decode($u,true);

    }
} 
$serviceId;
$sendService = $conn->query("SELECT display_name FROM service WHERE id='$serviceId'")->fetch_assoc()["display_name"];

$sendMail = $u["email"];

?>

<?php
        $lit = '<a href="//'.$webLink.'/apitransaction/view.php?id='.$id.'">
		<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$LANG["view"].'</strong></button>
		</a>';	
		$name = $u["name"];
        $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$LANG["hey"].' '.$name.',</strong> </p>
        <p>'.$LANG["your_transaction_was_reversed_view_the_transaction_details_below"].'</p>'." 
		<p>{$LANG["amount"]}: {$webConfig["currency"]["code"]}$payAmount </p>
		<p>{$LANG["transaction_id"]}: $id.</p>
		<p>{$LANG["service"]}: $sendService.</p>
		<p>{$LANG["date"]}: $date</p>
		<p><center>$lit</center></p>
		<p>{$LANG["kind_regards"]}</p>
		</div>
		</center>
		";

	if(!empty($sendMail)){
		 $subject = ucwords("$webName {$LANG["transaction_reversed"]} $id");
		 $mail->send("$sendMail"," $message","$subject","$webName","$replyTo");
	}
	$buy =  $u["credit"] + $payAmount;
	$sql = "UPDATE users SET credit='$buy' WHERE id='$owner'";
        $conn->query($sql);

        $sql = "UPDATE api_transaction SET status='reversed' WHERE id='$id'";
        $conn->query($sql);
	
        $output['message'] = $LANG['transaction_reversed'];
        $output['id'] = $id;
        $output['status']=$LANG["success"];
        $output['title']=$LANG["success"];
        $output['icon'] = "success";
        $output['close'] = false;
        $output['new'] = true;
        $output['button']=$LANG["continue"];
        $output['link']="";
        echo json_encode($output);
          
?> 