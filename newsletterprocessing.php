<?php include 'include/ini_set.php';?>
<?php include 'include/data_config.php';?>
<?php include 'include/filter.php';?>
<?php include 'include/webconfig.php';?>
<?php include "language/{$webConfig["LANG"]}.php";?>
<?php 
 include "sendMail/sendMail.php";
 $mail =  new sendMail($webConfig["licencesToken"]);
?>
	<?php
                $error = $LANG["unknown_error"];
                $title = $LANG["an_error_occurred"];
                 $output['message'] = $error;
                 $output['status'] = 'error';
                 $output['title'] = $title;
                 $output['button']=$LANG["okay"];
                 $output['close'] = true;
                 $output['icon'] = "error";
                 
		$subject = $webConfig["webName"]. "-{$LANG["newsletter_subscription"]}";
		$webName = $webConfig["webName"];
		$replyTo = $webConfig["replyTo"];
		$webLink  = $_SERVER["SERVER_NAME"];
		if(!empty($webConfig["webLink"])){  
			$webLink = $webConfig["webLink"];
		}
		
				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = xcape($conn, $_POST['email']);
	$regDate = time(); 
	$prc = 1;
	$id = md5(mt_rand());
	
	$lit = '<a href="//'.$webLink.'/newsletterconfirm.php?token='.$id.'">
		<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$LANG["confirm_email"].'</strong></button>
		</a>';	
	
	$message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong>'.$LANG["dear_subscriber"].'</strong> </p>
        <p>'.$LANG["thanks_for_subscribing_to_our_newsletter_at"]." ".$webName.'.</p>
		<p>'.$LANG["kindly_verify_your_email"].'<br/>
		<p><center>'.$lit.' </center></p>
		<p>'.$LANG["kind_regards"].'</p>
		<p>'.$webName.'</p>
		</div>
		</center>
		';

	$sql = "SELECT email FROM news_letter_subscriber WHERE email='$email'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
	   	$prc= 0;
	  $output['icon'] = "info";
           $output["message"]=$LANG["email_already_subscribed_in_our_newsletter"];
           $output['title']=$LANG["not_successful"];
          $mail->send("$email","$message","$subject","$webName","$replyTo");
   }
	
	 
	
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$prc= 0;
			$output["message"]=$LANG["invalid_email"];
	 }
	if(empty($email)){
	$output["message"]=$LANG["email_is_empty"];
	 $prc=0;
	 }
	 if($prc ==1){
	  
	$sql = "INSERT INTO news_letter_subscriber (
		id, 
		email,
		reg_date
	       )
        VALUES (
                '$id', 
                '$email',
                '$regDate'

        )";

	 if ($conn->query($sql) === TRUE) {
		 $mail->send("$email","$message","$subject","$webName","$replyTo");
		 
	        $output['message'] = $LANG['subscribed_successfully'];
    	        $output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["thank_you"];
		$output['icon'] = "success";
		$output['close'] = true;
		$output['button']=$LANG["okay"];
		$output['reset']=false;
		$output['scroll']=true;
	
	
	 } else {        
                $output['message']=$LANG["subscription_failed"];
	        $output['title']=$LANG["not_successful"];
		$output['status']="error";
		$output['button']=$LANG["okay"];
		$output['close'] = true;
		$output['icon'] = "error";
        
	}
    }
}
echo json_encode($output);
$conn->close();	
?>