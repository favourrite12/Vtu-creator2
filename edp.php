
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
	
	$country = xcape($conn, $_POST['country']);
	$region = xcape($conn, $_POST['region']);
	$city = xcape($conn, $_POST['city']);
	$street = xcape($conn, $_POST['street']);
	$zipCode = xcape($conn, $_POST['zipCode']);
	$name = xcape($conn, $_POST['name']);
	$phone = xcape($conn, $_POST['phone']);
	$email = xcape($conn, $_POST['email']);
	
	
		$prc = 1;
		
	
	  
   $sql = "SELECT * FROM users WHERE (email ='$email'  OR phone = '$phone') AND id <> '$loginUser'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
      $prc=0;
   // output data of each row
    while($row = $result->fetch_assoc()) {
	 $foundPhone = $row["phone"];
	  $foundEmail = $row["email"];
	  
	    if($foundPhone == $phone ){
		$phoneError ='<strong class="text-danger right"><small>'.$LANG["a_user_with_this_phone_already_exist"].'</small></strong>';
		}  
		if($foundEmail == $email){
		$emailError ='<strong class="text-danger right"><small>'.$LANG["a_user_with_this_email_already_exist"].'</small></strong>';
		}
		if ($foundUser  == $username){
		$userNameError ='<strong class="text-danger right"><small>'.$LANG["a_user_with_this_user_name_already_exist"].'</small></strong>';
		}  
	}
}			
	
	 if(empty($name)){
	 $nameError ='<strong class="text-danger right"><small>'.$LANG["please_provide_your_name"].'</small></strong>';
	 $prc = 0;
	 }
	 if(empty($email)){
	 $emailError ='<strong class="text-danger right"><small>'.$LANG["email_is_empty"].'</small></strong>';
	 $prc=0;
	 } 
	 if (empty($phone)){
	 $phoneError ='<strong class="text-danger right"><small>'.$LANG["please_provide_your_phone_number"].'</small></strong>';
	 $prc=0;
	 }
	 
	 if(checkInvalid($email,$invalidWord)){
		 $prc= 0;
		 $emailError ='<strong class="text-danger right"><small>'.$LANG["email_contains_unaccepted_character"].'</small></strong>';
	 } 
	 
	 if(checkInvalid($name,$invalidWord)){
		 $prc= 0;
		 $nameError ='<strong class="text-danger right"><small>'.$LANG["your_name_contains_unaccepted_character"].'</small></strong>';
	 }

	 
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$prc= 0;
		    $emailError ='<strong class="text-danger right"><small>'.$LANG["invalid_email"].'</small></strong>';
		}
	
	
	$lastUpate = time(); 
	
    
	if($prc == 1){
	$sql = "UPDATE users SET  
	country = '$country',
	region = '$region', 
	city = '$city', 
	name = '$name',
	phone ='$phone', 
	email ='$email', 
	zip_code ='$zipCode', 
	last_update = '$lastUpate',
	street ='$street' 
	
	WHERE id = '$loginUser'" ;  
	
		if ($conn->query($sql) === TRUE) {
				alertSuccess($LANG["changes_saved_successfully"]);
			} else {
				alertDanger($conn->error);
			;
				
			}
		}
}
//echo $sql;
?>