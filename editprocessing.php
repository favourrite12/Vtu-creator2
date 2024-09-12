	<?php				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            foreach ($adminInfo as $key => $value) {
                if($value == '0' && isset($_POST[$key])){
                    checkAccess(0);
                }
            }  
            
		
            
        
      
	$regDate = time(); 
	$prc = 1;
	
        
        $username = xcape($conn, $_POST['user_name']);
	$name = xcape($conn, $_POST['name']);
	$email = xcape($conn, $_POST['email']);
	$phone = xcape($conn, $_POST['phone']); 
	$id = xcape($conn, $_POST['id']); 
        
	  
   $sql = "SELECT phone,email,user_name FROM admin WHERE id <> '$id' AND (user_name = '$username' OR email ='$email'  OR phone = '$phone') ";
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
	
	if(empty($name)){
	 $nameError ='<strong class="text-danger right"><small>'.$LANG["name_cannot_be_empty"].'</small></strong>';
	 $prc = 0;
	 }if(empty($username)){
	 $userNameError='<strong class="text-danger right"><small>'.$LANG["user_name_cant_be_empty"].'</small></strong>';
	 $prc=0;
	 } if(empty($email)){
	 $emailError ='<strong class="text-danger right"><small>'.$LANG["email_is_empty"].'</small></strong>';
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
             
             foreach ($_POST as $key => $value) {
                if($key!="id" && $key!="password" && $key!="confirmPassword"){
                    $key =  mysqli_real_escape_string($conn,$key);
                    $value = xcape($conn, $value);
                    $conn->query("UPDATE admin SET $key = '$value', last_update='$regDate' WHERE id='$id'");
                }elseif ($key=="password" && !empty ($value)) {
                  if($_POST['confirmPassword']==$_POST['password']){
                      $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                      $conn->query("UPDATE admin SET password = '$hashPassword' WHERE id='$id'");
                  }  else {
                     $confirmPasswordError ='<strong class="text-danger right"><small>'.$LANG["error_in_password_confirmation"].'</small></strong>'; 
                  }
            }
            }
         alertSuccess($LANG["changes_saved_successfully"]);
         }else{
             alertDanger($LANG["value_rejected"]);
         }
         javaScriptPushState("?id=$id");
}	
?>