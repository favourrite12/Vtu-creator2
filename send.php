<?php include '../../include/ini_set.php';?>
<?php include '../include/checklogin.php';?>
<?php include '../../include/data_config.php';?>
<?php include '../../include/filter.php';?>
<?php include '../../include/webconfig.php';?>
<?php include "../../language/{$webConfig["LANG"]}.php"; ?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 if($adminInfo["news_letter"] != 1 || $adminInfo["news_letter"] != '1'){
  echo $LANG["access_denied_permisson"];
exit;
 }
     
?>





<?php 
 include "../../sendMail/sendMail.php";
 $mail =  new sendMail($webConfig["licencesToken"]);
?>

 <?php
if(isset($_GET["id"])){
   $id = xcape($conn,$_GET["id"]);


   
   $sql = "SELECT subject, content FROM news_letter WHERE id = '$id'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	   $subject =   $row["subject"];
	   $content =   $row["content"];  
	}
}
$regDate = time();

	$webName = $webConfig["webName"];
	$replyTo = $webConfig["replyTo"];
	$address = $webConfig["address"];
	$address = trim(preg_replace('/\n+/', '<br/>', $address));
	$webLink  = $_SERVER["SERVER_NAME"];
	if(!empty($webConfig["webLink"])){  
		$webLink = $webConfig["webLink"];
	}
	
	$num = 0;		
   $sql = "SELECT email,id FROM news_letter_subscriber WHERE status='confirmed'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
	     while($row = $result->fetch_assoc()) {
		$num++;
	   $email =  $row["email"];
	   $token =  $row["id"];

$lit = '<a href="//'.$webLink.'/unsubscribenewsletter.php?token='.$token.'"><strong>'.$LANG["unsubscriber"].'</strong>
	</a>';	

$footer = '<center>
	<div style="margin:0;width:100%;text-align:justify;background:#f2f2f2;padding:4px; border-radius:0">
	<p><center>'.$LANG["you_received_this_email_because_you_subscribed_for_newsletter_on"].' '.$webName.'</center></p>
	<p><center>'.$lit.' </center></p>
	<hr/>
	<p><center><a href="//'.$webLink.'">'.$webName.'</a> </p>
	<p><center>'.$address.' </center></p>
	</div>
	</center>
	';

	$message = htmlspecialchars_decode($content).$footer;

	 $mail->send("$email","$message","$subject","$webName","$replyTo");
	
	 }
   } 
   
     
	$sql = "UPDATE news_letter  SET
		status =  'sent',
		num =  '$num',
		sent_date = '$regDate'
		WHERE id = '$id'
	";

	       $conn->query($sql); 
               $output['message'] = $LANG['mail_sent_successfully'];
    	       $output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['new'] = true;
		$output['button']=$LANG["continue"];
		$output['link']="index.php";
   
} else {
	        $output['message']=$LANG["operation_failed"];
	        $output['title']=$LANG["not_successful"];
		$output['status']="error";
		$output['button']=$LANG["okay"];
		$output['close'] = true;
		$output['icon'] = "error";
}

echo json_encode($output);
$conn->close();
?>



