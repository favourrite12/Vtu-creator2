

	<?php include '../include/header.php';?>
	<?php include '../include/data_config.php';?>
	<title><?php $LANG["password_recovery"] ?></title>
		
		<?php
				
					
						 $ut = mysqli_real_escape_string($conn, $_GET['ut']);
						 $vt = mysqli_real_escape_string($conn, $_GET['vt']);
						
						$userToken = base64_decode($ut);
						$dateToken = base64_decode($vt);
						 
						        $sql = "SELECT id,password FROM admin  WHERE email = '$userToken' AND last_update = '$dateToken'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
							   // output data of each row
								   while($row = $result->fetch_assoc()) {
									   $_SESSION['admin'] = $row["id"];
									   $_SESSION["admin_password"] = md5($row["password"]);
										$t = md5($dateToken);
										ob_start();
								echo "<script>location.href='paswdrest.php?token=$t'</script>";
								}
							}else{
                                                            alertDanger($LANG["failed_to_verify_this_link"]);
								echo '<div class="container>"
								      <div class="alert alert-danger alert-dismissible">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  '.$LANG["failed_to_verify_this_link"].'
									</div>
									</div>
									';
							}
							   
						?>	
		
		