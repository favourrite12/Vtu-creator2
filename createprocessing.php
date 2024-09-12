	<?php				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            foreach ($adminInfo as $key => $value) {
                if($value == '0' && isset($_POST[$key])){
                    checkAccess(0);
                }
            }  
            
		
		$subject = $webConfig["webName"]. " ". $LANG["login"];
		$webName = $webConfig["webName"];
		$replyTo = $webConfig["replyTo"];
		$webLink  = $_SERVER["SERVER_NAME"];
		if(!empty($webConfig["webLink"])){  
			$webLink = $webConfig["webLink"];
		}
		$lit = '<a href="//'.$webLink.'/admin/">
		<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$LANG["hey"].'</strong></button>
		</a>';
                
       
				
	$username = xcape($conn, $_POST['username']);
	$name = xcape($conn, $_POST['name']);
	$email = xcape($conn, $_POST['email']);
	$phone = xcape($conn, $_POST['phone']);
	$licencesKey = xcape($conn, $_POST['licences_key']);
	$payment = xcape($conn, $_POST['payment']);
	$bank = xcape($conn, $_POST['bank']);
	$userBalance = xcape($conn, $_POST['user_balance']);
	$admin = xcape($conn, $_POST['admin']);
	$visitorNumber = xcape($conn, $_POST['visitor']);
	$registerUser = xcape($conn, $_POST['users']);
	$newsLetter = xcape($conn, $_POST['news_letter']);
	$feedBack = xcape($conn, $_POST['feedback']);
	$sms = xcape($conn, $_POST['sms']);
	$deposit = xcape($conn, $_POST['deposit']);
	$editBalance = xcape($conn, $_POST['add_money']);
	$webConfigAccess = xcape($conn, $_POST['web_config']);
	$icon = xcape($conn, $_POST['icon']);
	$slider = xcape($conn, $_POST['slider']);
	$contact = xcape($conn, $_POST['contact']);
	$send = xcape($conn, $_POST['send']);
	$discount = xcape($conn, $_POST['discount']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$transaction = xcape($conn, $_POST['transaction']);
	$refer = xcape($conn, $_POST['refer']);
	$module = xcape($conn, $_POST['module']);
	$service= xcape($conn, $_POST['service']);	
	$currency = xcape($conn, $_POST['currency']);
	$language = xcape($conn, $_POST['language']);
	$systmUpdate= xcape($conn, $_POST['update_access']);
	$paymentMethod= xcape($conn, $_POST['payment_method']);
        
        
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);	
	$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
	$regDate = time(); 
	$prc = 1;
	$id = md5(mt_rand());
	
	
	$message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$LANG["hey"].' '.$name.',</strong> </p>
        <p> '.$LANG["an_administration_account_was_created_for_you_on"].' '.$webName.'.</p>
		'.$LANG["email"].': '.$email.' <br/>
		'.$LANG["user_name"].': '.$username.'<br/>
		'.$LANG["phone"].': '.$phone.'<br/>
		'.$LANG["password"].': '.$password.'<br/>
		</p>
		<p><center>'.$lit.' </center></p>
		<p>'.$LANG["kind_regards"].'.</p>
		</div>
		</center>
		';
	
	
	
	//print_r($_POST);
	
	
	  
   $sql = "SELECT phone,email,user_name FROM admin WHERE user_name = '$username' OR email ='$email'  OR phone = '$phone' ";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
      $prc=0;
   // output data of each row
    while($row = $result->fetch_assoc()) {
	 $foundPhone = $row["phone"];
	  $foundEmail = $row["email"];
	  $foundUser = $row["user_name"];
	  
	    if($foundPhone == $phone ){
		$phoneError ='<strong class="text-danger right"><small>'.$LANG["an_admin_with_this_phone_number_already_exist"].'</small></strong>';
		}  
		if($foundEmail == $email){
		$emailError ='<strong class="text-danger right"><small>'.$LANG["an_admin_with_email_already_exist"].'</small></strong>';
		}
		if ($foundUser  == $username){
		$userNameError ='<strong class="text-danger right"><small> '.$LANG["an_admin_with_this_user_name_already_exist"].'</small></strong>';
		}  
	}
}		
	
	if($confirmPassword != $password){
	   $confirmPasswordError ='<strong class="text-danger right"><small>'.$LANG["error_in_password_confirmation"].'</small></strong>';
	   $prc=0;
	 } if(empty($name)){
	 $nameError ='<strong class="text-danger right"><small>'.$LANG["name_cannot_be_empty"].'</small></strong>';
	 $prc = 0;
	 }if(empty($username)){
	 $userNameError='<strong class="text-danger right"><small>'.$LANG["user_name_cant_be_empty"].'</small></strong>';
	 $prc=0;
	 } if(empty($email)){
	 $emailError ='<strong class="text-danger right"><small>'.$LANG["email_is_empty"].'</small></strong>';
	 $prc=0;
	 }if(empty($password)){
	 $passwordError ='<strong class="text-danger right"><small>'.$LANG["password_is_empty"].'</small></strong>';
	 $prc=0;
	 } if(empty($confirmPassword)){
	 $confirmPasswordError ='<strong class="text-danger right"><small>'.$LANG["error_in_password_confirmation"].'</small></strong>';
	 $prc=0;
	 } if (empty($phone)){
	 $phoneError ='<strong class="text-danger right"><small>'.$LANG["please_provide_your_phone_number"].'</small></strong>';
	 $prc=0;
	 }
	
	 
	 if(preg_match('/\W+/',$username)){
		 $prc= 0;
		 $userNameError ='<strong class="text-danger right"><small>'.$LANG["unaccepted_character_user"].'</small></strong>';
	 }
	 
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$prc= 0;
		    $emailError ='<strong class="text-danger right"><small>'.$LANG["invalid_email"].'</small></strong>';
		}
	
	 if($prc ==1){
	   
	
    
	$sql = "INSERT INTO admin (
		id,
		user_name,
		name,
		password,	
		email,	
		phone,
		payment,
		bank,
		icon,
		slider,
		add_money,
		visitor,	
		contact,	
		admin,	
		deposit,	
		news_letter,	
		feedback,	
		users,	
		user_balance,		
		licences_key,
		web_config,
		service,
		discount,
		transaction,
		email_access,
		sms,
		module,
		update_access,
		currency,
		language,
		refer,
		payment_method,
                reg_date,
		last_update
		
	)
   VALUES (
	   '$id',
	   '$username',
	   '$name',
	   '$hashPassword', 
	   '$email',
	   '$phone',
	   '$payment',
	   '$bank',
	   '$icon',
	   '$slider',
	   '$editBalance',
	   '$visitorNumber',
	   '$contact',
	   '$admin',
	   '$deposit',
	   '$newsLetter',
	   '$feedBack',
	   '$registerUser',
	   '$userBalance',
	   '$licencesKey',
	   '$webConfigAccess',
	   '$service',
	   '$discount',
	   '$transaction',
	   '$emailAccess',
	   '$sms',
	   '$module',
	   '$systmUpdate',
	   '$currency',
	   '$language',
	   '$refer',
	   '$paymentMethod',
	   '$regDate',
	   '$regDate'
   )";

    if ($conn->query($sql) === TRUE) {
           alertSuccess($LANG["new_add_admin_registered_ successfully"]);
                   if($send==1){
                      $mail->send("$email","$message","$subject","$webName","$replyTo");
                   }
    } else {
    alertDanger($conn->error);
  }

}else{
      alertDanger($LANG["value_rejected"]);
   }
}	
?>