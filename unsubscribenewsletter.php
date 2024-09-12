
<?php include 'include/data_config.php';?>
<?php include 'include/filter.php';?>
<?php include 'include/header.php';?>

	
	<?php
	  $id = xcape($conn, $_GET['token']);				
	if(isset($_POST["token"])) {
	 $id = xcape($conn, $_POST['token']);
		
   $sql = "DELETE FROM news_letter_subscriber WHERE id='$id'";

	 if ($conn->query($sql) === TRUE) {
		 		 
             alertSuccess($LANG["unsubscribed_successfully_thanks"]);
	
	 } else {
             alertDanger($LANG["operation_failed"]);
	// echo "Error: <br>" . $conn->error;
	}
    }
	
	?>
	<div class="row flex-items-sm-center justify-content-center">
		<div class="col-sm-5 row pt-5">
		<div class="col s12">
		<?php echo $LANG["removing_your_email_from_our_newsletter"];?>
        </div>		
	<form  class="col s12" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
	<input type="hidden" name="token" value="<?php echo $id; ?>" /> 
		<button class="btn btn-md btn-success right"><?php echo $LANG["yes"];?></button>
						   
	</form>
	</div>
	</div>