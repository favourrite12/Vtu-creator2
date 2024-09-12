<?php include '../include/checklogin.php';?>  
<?php include '../include/data_config.php';?>
<?php include '../include/webconfig.php';?>
<?php include '../include/header.php';?>
<title><?php echo $LANG["change_password"]; ?></title>
<p class="caption"><?php echo $LANG["change_password"]; ?></p>
 <div class="divider"></div>
<section class="container">
<div class="row flex-items-sm-center justify-content-center flexbox">
<div class="col-sm-10 col-lg-4 custom-file-control">
    <div class="card-panel">
<?php 

 $sql = "SELECT last_update FROM users WHERE id = '$loginUser'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$token =  md5($row["last_update"]);
	}
}

	
	?>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$npw = mysqli_real_escape_string($conn, $_POST['np']);
	$cpw = mysqli_real_escape_string($conn, $_POST['cp']);
	$pwdh = password_hash($npw, PASSWORD_DEFAULT);	
	$last_date = time(); 
  if ($npw != $cpw) {
      openAlert($LANG["error_in_password_confirmation"]);
         echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>'.$LANG["error_in_password_confirmation"].'</div>';
   }else{
	$sql = "UPDATE users SET  password = '$pwdh', last_update ='$last_date' WHERE id = '$loginUser'" ;          		
		if ($conn->query($sql) === TRUE) {
                     $_SESSION["user_password"] = md5($pwdh);
                     alertSuccess($LANG["password_changed_successfully"]);
				echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            '.$LANG["password_changed_successfully"].'
                                      </div>';
			} else {
                            alertDanger($LANG["unknown_error"]);
				 echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$LANG["unknown_error"].'</div>';
			}
			}
		}else{
			if($token != $_GET['token']){
				ob_start();
			  echo "<script>location.href='change-password.php'</script>";
			}
		}

	?>

		

				<div>
				</div>
					<form class="row py-3" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
																	
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG["password"];?></label>
							<input type="password" class="form-control form-control-sm" name="np" id="np"  required  >
						</div>
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG["confirm_password"]; ?></label>
							<input type="password" class="form-control form-control-sm" name="cp" id="cp"  required  >
						</div>
						
							<div class="col s12 form-group">
								
							<button class="btn btn-info btn-md right" id="btn-post"><?php echo $LANG["change_password"]; ?><i class="material-icons right">lock</i></button>
						</div>
						
					</form>
				</div>
			</div>
			</div>
		</section>
</div>
</div>

		<?php include '../include/footer.php';?>