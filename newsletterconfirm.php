<?php include 'ini_set.php';?>
<?php include 'include/data_config.php';?>
<?php include 'include/filter.php';?>
<?php include 'include/header.php';?>
	<?php
	  				
	if(isset($_GET["token"])) {
	$id = xcape($conn, $_GET['token']);
	$prc = 1;
		
   $sql = "SELECT email FROM news_letter_subscriber WHERE id='$id'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
	     while($row = $result->fetch_assoc()) {
	   $email =  $row["email"];
    }
   }
   
	
	if(empty($id)){
            alertDanger($LANG["email_is_empty"]);
	 $prc=0;
	 }
	 if($prc ==1){
	  
	$sql = "UPDATE news_letter_subscriber SET status='confirmed' WHERE id='$id'";

	 if ($conn->query($sql) === TRUE) {
             alertSuccess($LANG["email_confirmed_successfully_thanks"]);	 		 
	;
	
	
	 } else {
             alertDanger($LANG["operation_failed"]);
	
	}
    }
	}
	
	?>