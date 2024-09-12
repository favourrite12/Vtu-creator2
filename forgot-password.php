<?php session_start(); ?>
	<?php include '../include/header.php';?>
	<?php include '../include/data_config.php';?>
	<?php include '../include/filter.php';?>
	
<?php 

      if(isset($_SESSION['login_user'])){
	 ob_start();
         javaScriptRedirect("../dashboard/");
     }

?>


<?php include '../include/webconfig.php';?>
<?php 

$webName = $webConfig["webName"];
$replyTo = $webConfig["replyTo"];
$webLink  = $_SERVER["SERVER_NAME"];
if(!empty($webConfig["webLink"])){  
	$webLink = $webConfig["webLink"];
}
?>
<?php 
include "../sendMail/sendMail.php";
$mail =  new sendMail($webConfig["licencesToken"]); 
?>
	<title><?php $LANG["password_recovery"] ?></title>
        
        <p class="caption"><?php echo $LANG["password_recovery"]; ?></p>
              <div class="divider"></div>
		<section class="container">
		<?php  $email = $errmsg ='';?>
<?php 		 
	

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $email = mysqli_real_escape_string($conn, $_POST['email']);
		$sql = "SELECT email,user_name,last_update FROM users  WHERE email = '$email' OR phone = '$email' OR user_name = '$email' OR id = '$email' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$hexe = base64_encode($row["email"]);
		$hexp = base64_encode($row["last_update"]);
		
		$to = $row['email'];
		$subject = "{$LANG["request_to_reset_your_password_on"]} $webName";
		
		$lit = '<a href="//'.$webLink.'/account/checkpwdrest.php?ut='.$hexe.'&vt='.$hexp.'">
		<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$LANG["confirm_my_request"].'</strong></button>
		</a>';	
			$name = $row["user_name"];
        $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong>'.$LANG["hey"].' '.$row["user_name"].',</strong> </p>
        '.$LANG["someone_requested_a_new_password_for_your_account_but_we_still_need_a_confirmation_from_you_to_process_this_request_kindly_click_on_the_below_link_to_confirm_this_request"].'
		<p><center>'.$lit.' </center></p>
		<p>'.$LANG["kind_regards"].'</p>
		<p>'.$webName.'.</p>
		</div>
		</center>
		';
		  
		 $mail->send("$to","$message","$subject","$webName","$replyTo");
                 alertSuccess($LANG["we_sent_a_mail_to"].' '.$row["email"]);
				
		echo '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			'.$LANG["we_sent_a_mail_to"].' '.$row["email"].' 
		  </div>';
		
										 
		}
	}else {
            openAlert($LANG["no_record_found"]);
		$errmsg='<strong class="text-danger">'.$LANG["no_record_found"].'</strong>';
                
	}
}
		
?>

	 <section id="content">
        
        
 
            <div class="section container">
              
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 flexbox">
                    <div class="card-panel hoverable">	
		
        <div><?php echo $errmsg;?><br/></div>
		    <form class="custom-form-control" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
		<div class="input-group col-md-12">
		  <input type="text" required autofocus class="form-control" name="email" placeholder="<?php echo $LANG["email_phone_username"]?>">
		   <div class="input-group-append">
		  <button class="btn right" type="submit">
			<i class="material-icons">search</i>
		  </button>
		  </div>
		   </div>
	
  </form> 
		
		
</section>

		


</div>
   </div>
     

<?php include '../include/footer.php';?>

		
		
	