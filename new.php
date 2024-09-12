        <?php include '../include/checklogin.php';?>
		<?php include '../include/header.php';?>
		 <?php include '../../include/data_config.php';?>
		 <?php include '../../include/filter.php';?>
		 <?php 
		include '../include/admininfo.php';
		$adminInfo = adminInfo($loginAdmin,$conn);
		//print_r($adminInfo);
		 checkAccess($adminInfo["bank"]);
			 
		?>
	 <title><?php echo $LANG["add_new_bank_account"]?></title>	 
<?php
				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$prc = 1;
	$bankName = xcape($conn, $_POST['bankName']);
	$accountName = xcape($conn, $_POST['accountName']);
	$accountNumber = xcape($conn, $_POST['accountNumber']);
	$accountType = xcape($conn, $_POST['accountType']);
	$id= md5(time()+mt_rand());
     if(empty($bankName)){
		 $bankNameError= '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["bank_name_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 }  if(empty($accountName)){
		 $accountNameError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_name_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 }  if(empty($accountNumber)){
		 $accountNumberError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_number_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 } if(empty($accountType)){
		 $accountTypeError = '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$LANG["account_type_is_empty"].'</strong>
						</div>';
						$prc = 0;
	 }
	$regDate = time(); 


	
	 if($prc ==1){
$sql = "INSERT INTO bank (
		id,
		bank_name, 
		account_name, 
		account_number, 
		account_type, 
		reg_date
		)
VALUES (
		'$id',
		'$bankName', 
		'$accountName',
		'$accountNumber',
		'$accountType',
		'$regDate'
		)";
  
	 if ($conn->query($sql) === TRUE) {
		 $id=$bankName= $accountName=$accountNumber=$accountType=$regDate="";
		 alertSuccess($LANG["new_bank_account_added"]);
	 } else {
	 alertDanger($conn->error);
	}
    }
	}
	$conn->close();
	
	?>
		
		 

		
 

		 
<section class="container">
	
  <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG['create_new_admin']; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel hoverable">
				   
	<div class="row flex-items-sm-center justify-content-center overflow-hidden">

		    <form class="row col s12 py-2" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
						<div id="output" class="col s12"><?php echo $errorMessage;?></div>	
					
						
						<div class="col s12 form-group">
							<h6><?php echo $LANG["add_new_account_details"];?><small> <i class="text-danger"><?php echo $LANG["all_input_are_required"]?></i></small></h6>
							<hr color="#fff"/>
							</div>
							
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG["bank_name"];?></label>
							<input type="text" value='<?php echo $bankName;?>' class="form-control form-control-sm" name="bankName" id="bankName"  required>
						   
						   <?php echo $bankNameError;?>
						
						</div>
			
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG["account_name"];?></label>
					  		<input type="text"   value='<?php echo $accountName;?>' class="form-control form-control-sm" name="accountName" id="accountName" required >
							 <?php echo $accountNameError;?>
						</div>
						
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG["account_number"];?></label>
					  		<input type="text" value='<?php echo $accountNumber;?>'  class="form-control form-control-sm" name="accountNumber" id="accountNumber"  required>
							 <?php echo $accountNumberError;?>
						</div>
						
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG["account_type"];?></label>
					  		<input type="text" placeholder="Example: Savings Account" value='<?php echo $accountType;?>'  class="form-control form-control-sm" name="accountType" id="accountType"  required>
							 <?php echo $accountTypeError;?>
						</div>
						
		
			
			  
							
					<div class="col s12 form-group">
					<input  type="submit" class="btn right" value="<?php echo $LANG["add_bank_account"];?>"  /> 
					</div>
							
				
				
		</form>


</div>
</section>


                    </div>
                  </div>
                </div>
              </div>
        </section>



 <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>">
    <a href="index.php" class="btn-floating btn-large">
      <i class="large material-icons">home</i>
    </a>
  </div>

<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>