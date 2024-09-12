	<?php
		$invalidWord = $webConfig["invalidWord"];
		function checkInvalid($str,$invalidWord){
		$invalidWord =  explode(' ',$invalidWord);  
		$invalidWord =  implode(',',$invalidWord);  
		$invalidWord =  explode(',',$invalidWord); 
		$invalidWord =  implode('|',$invalidWord);  
	    if(preg_match("/$invalidWord/",$str)){
			return true;
		}else{
			return false;
		}
		}		
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$do_to = xcape($conn, $_POST['do_to']);
		$doTo = base64_decode($do_to);
		if(empty($do_to)){
		$doTo = '../dashboard/';
		}
		
		
		
		
	$username = xcape($conn, $_POST['username']);
	$name = xcape($conn, $_POST['name']);
	$email = xcape($conn, $_POST['email']);
	$phone = xcape($conn, $_POST['phone']);
        $referBy = xcape($conn, $_POST['referBy']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);	
	$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
	$regDate = time(); 
	$prc = 1;
	$id = md5(mt_rand());
	$api = time()+mt_rand();
	$api = base64_encode($api);
	$api = "ap_".md5($api);
	
	$widget= time()+mt_rand();
	$widget= base64_encode($widget);
	$widget= "wd_".md5($widget);
	$referCode = time()+mt_rand();
	
	
	
	  
   $sql = "SELECT phone,email,user_name FROM users WHERE user_name = '$username' OR email ='$email'  OR phone = '$phone' ";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
      $prc=0;
   // output data of each row
    while($row = $result->fetch_assoc()) {
	 $foundPhone = $row["phone"];
	  $foundEmail = $row["email"];
	  $foundUser = $row["user_name"];
	  
	    if($foundPhone == $phone ){
		$phoneError ='<strong class="red-text right"><small>'.$LANG["a_user_with_this_phone_already_exist"].'</small></strong>';
		}  
		if($foundEmail == $email){
		$emailError ='<strong class="red-text right"><small>'.$LANG["a_user_with_this_email_already_exist"].'</small></strong>';
		}
		if ($foundUser  == $username){
		$userNameError ='<strong class="red-text right"><small>'.$LANG["a_user_with_this_user_name_already_exist"].'</small></strong>';
		}  
	}
}		
		
	
	if($confirmPassword != $password){
	   $confirmPasswordError ='<strong class="red-text right"><small>'.$LANG["error_in_password_confirmation"].'</small></strong>';
	   $prc=0;
	 } if(empty($name)){
	 $nameError ='<strong class="red-text right"><small>'.$LANG["please_provide_your_name"].'</small></strong>';
	 $prc = 0;
	 }if(empty($username)){
	 $userNameError='<strong class="red-text right"><small>'.$LANG["user_name_cant_be_empty"].'</small></strong>';
	 $prc=0;
	 } if(empty($email)){
	 $emailError ='<strong class="red-text right"><small>'.$LANG["email_is_empty"].'</small></strong>';
	 $prc=0;
	 }if(empty($password)){
	 $passwordError ='<strong class="red-text right"><small>'.$LANG["password_is_empty"].'</small></strong>';
	 $prc=0;
	 } if(empty($confirmPassword)){
	 $confirmPasswordError ='<strong class="red-text right"><small>'.$LANG["confirm_password_is_empty"].'</small></strong>';
	 $prc=0;
	 } if (empty($phone)){
	 $phoneError ='<strong class="red-text right"><small>'.$LANG["please_provide_your_phone_number"].'</small></strong>';
	 $prc=0;
	 }
	 if(checkInvalid($email,$invalidWord)){
		 $prc= 0;
		 $emailError ='<strong class="red-text right"><small>'.$LANG["email_contains_unaccepted_character"].'</small></strong>';
	 } 
	 
	 if(checkInvalid($name,$invalidWord)){
		 $prc= 0;
		 $nameError ='<strong class="red-text right"><small>'.$LANG["your_name_contains_unaccepted_character"].'</small></strong>';
	 }

	 if(checkInvalid($username,$invalidWord)){
		 $prc= 0;
		 $userNameError ='<strong class="red-text right"><small>'.$LANG["user_name_contains_unaccepted_character"].'</small></strong>';
	 }
	 
	 if(preg_match('/\W+/',$username)){
		 $prc= 0;
		 $userNameError ='<strong class="red-text right"><small>'.$LANG["unaccepted_character_user"].'</small></strong>';
	 }
	 
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$prc= 0;
		    $emailError ='<strong class="red-text right"><small>'.$LANG["invalid_email"].'</small></strong>';
		}
	
	 if($prc ==1){
	   
	
    
	$sql = "INSERT INTO users (
		id, 
		user_name,
		name,
		email,
		phone, 
		reg_date,
		api,
		widget,
		password,
		last_update,
		refer_by,
		refer_code,
                lang
	)
   VALUES (
	   '$id',
	   '$username',
	   '$name', 
	   '$email',
	   '$phone', 
	   '$regDate',
	   '$api',
	   '$widget',
	   '$hashPassword',
	   '$regDate',
	   '$referBy',
	   '$referCode',
           '{$webConfig["LANG"]}'
	   
   )";

	 if ($conn->query($sql) === TRUE) {
			$sql = "INSERT INTO setting (
		    id
			)
			VALUES (
		   '$id'
			)";
			$conn->query($sql);
			$subject = "{$LANG["welcome_to"]} $webName";
			$message = welcomeMail($name,$webName);
			$mail->send("$email","$message","$subject","$webName","$replyTo");
			
			$_SESSION["login_user"] = $id;
                        $_SESSION["user_password"] = md5($hashPassword);
			
			$username = $name = $email = $phone = $password = $confirmPassword = "";
			
		echo "<script>location.href='$doTo'</script>";
	 } else {
	// echo "Error: <br>" . $conn->error;
	}
    }
	}
	
	?>