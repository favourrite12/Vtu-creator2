 <?php include '../include/ini_set.php';?>
 <?php include 'include/checklogin.php';?>
 <?php include '../include/data_config.php';?>
 <?php include '../include/filter.php';?>
 <?php include 'include/header.php';?>
 
 
<title><?php echo $LANG["change_password"]; ?></title>

<?php 
 $sql = "SELECT password FROM admin WHERE id = '$loginAdmin'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$spwd =  $row["password"];
	}
}

	
?>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$opw = mysqli_real_escape_string($conn, $_POST['op']);
	$npw = mysqli_real_escape_string($conn, $_POST['np']);
	$cpw = mysqli_real_escape_string($conn, $_POST['cp']);
	$pwdh = password_hash($npw, PASSWORD_DEFAULT);	
	$last_date = time(); 
   if (password_verify($opw, $spwd) == false) {
         alertDanger($LANG["invalid_old_password"]);
   }else if ($npw != $cpw) {
        alertDanger($LANG["error_in_password_confirmation"]);
   }
	if ((password_verify($opw, $spwd)) && ($npw == $cpw)) {
	$sql = "UPDATE admin SET  password = '$pwdh', last_update ='$last_date' WHERE id = '$loginAdmin'" ;          		
		if ($conn->query($sql) === TRUE) {
				
	if($webConfig["allowCookie"] == 1){							
	 $cookie_user = "aKey";
	 $cookie_password = "aToken";
	 $aOpKey = "aOpKey";
	 $bKey = md5(base64_encode($_SERVER['HTTP_USER_AGENT'].$pwdh));
	 setcookie($aOpKey,$bKey, time() + (86400 * 365), "/",$webLink,false); // 86400 = 1 day
	 setcookie($cookie_user, $row["id"], time() + (86400 * 365), "/",$webLink,false); // 86400 = 1 day
	 setcookie($cookie_password, md5($pwdh), time() + (86400 * 365), "/",$webLink,false); // 86400 = 1 day
	 }

	  $_SESSION["admin_password"] = md5($pwdh);
	  
	  alertSuccess($LANG["password_changed_successfully"]);
				
		} else {
			 alertDanger($conn->error);
	}
  }
}
?>


<section  class="container">
 <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG["change_password"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 flexbox">
                    <div class="card-panel hoverable">	
<div class="row flex-items-sm-center justify-content-center custom-form-control overflow-hidden py-3">
<form class="row col s12" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
 
 											
						<div class=" input-field">
							<label for="" class="form-control-label"><?php echo $LANG["old_password"]; ?></label>
							<input type="password" class="form-control form-control-sm"  name="op" id="op" required >
						</div>
						<div class=" input-field">
							<label for="" class="form-control-label"><?php echo $LANG["password"];?></label>
							<input type="password" class="form-control form-control-sm" name="np" id="np"  required  >
						</div>
						<div class=" input-field">
							<label for="" class="form-control-label"><?php echo $LANG["confirm_password"];?></label>
							<input type="password" class="form-control form-control-sm" name="cp" id="cp"  required  >
						</div>
						
							<div class="input-field">
								
							<button class="btn btn-info btn-md right" ><?php echo $LANG["change_password"];?> <i class="material-icons right">lock</i></button>
						</div>
						
					</form>
</div>
</section>
</div>
</div>
<?php include 'include/footer.php';?>