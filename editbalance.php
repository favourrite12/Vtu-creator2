<?php include 'include/checklogin.php';?> 
<?php 
include 'include/header.php';
include '../include/data_config.php';
date_default_timezone_set('Africa/Lagos'); 
?>
<?php include '../include/filter.php';?>
<?php include '../account/userinfojson.php';?>
<?php include '../include/webconfig.php';?>
<?php 
 include "../sendMail/sendMail.php";
 $mail =  new sendMail($webConfig["licencesToken"]);
?>
<?php 
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["add_money"]);
   
$webName = $webConfig["webName"];
$replyTo = $webConfig["replyTo"];
$address = $webConfig["address"];
$address = trim(preg_replace('/\n+/', '<br/>', $address));
$webLink  = $_SERVER["SERVER_NAME"];
if(!empty($webConfig["webLink"])){  
	$webLink = $webConfig["webLink"];
} 
?>
<?php 
$name = xcape($conn, $_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$status = "credited";
	$subMessage = $LANG["was_credited_to"];
	$user = xcape($conn, $_POST['user']);
	$name = xcape($conn, $_POST['user']);
	$minus = trim(xcape($conn, $_POST['minus']));
	$amount = xcape($conn, $_POST['amount']);
	$amountAdded = $minus.xcape($conn, $_POST['amount']);
	if($minus=="-"){
		$status = "debited";
		$subMessage = $LANG["was_debited _from"];
	}
	$id = mt_rand()+time();
	$regDate = time();
		$prc = 1;

	 if(empty($user)){
	 $nameError ='<strong class="text-danger right"><small>'.$LANG['please_provide_name'].'</small></strong>';
	 $prc = 0;
	 }
	 if(empty($amount)){
	 $amountError ='<strong class="text-danger right"><small>'.$LANG['amount_is_empty'].'</small></strong>';
	 $prc=0;
} 
 $u = userInfo($user,$conn);
 $u = json_decode($u,true);
 $email = $u['email'];

 $current = $u['credit'];
 $credit = ($amountAdded + $u['credit']);
    
	if($prc == 1){	   
	$sql = "INSERT INTO deposit (
	      id, 
		  amount,   
		  owner,
		  status,
		  final_balance,
		  ini_balance,
		  reg_date
		  )
      VALUES (
			'$id',
			'$amount', 
			'$user', 
			'$status',
			'$credit',
			'$current',
			'$regDate'
		)";

			if ($conn->query($sql) === TRUE) {
				//echo "New record created successfully";
			

				 
				 
                 $subject = "{$webConfig["currency"]["code"]}$amount $subMessage {$LANG['your_account_on']} $webName";
		
		$lit = '<a href="https://'.$webLink.'/account/login.php">
		<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>Login</strong></button>
		</a>';	
			$name = $u["name"];
        $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$LANG["hey"].' '.$name.',</strong> </p>
        <p>'.$webConfig["currency"]["code"].$amount.' '.$subMessage.' '.$LANG['your_account_on'].' '.$webName. '</p><p>' .$LANG['kindly_see_the_paymment_details_bellow'].'</p>
		<p>'.$LANG['amount'].': '.$webConfig["currency"]["code"].$amount.'</p>
		<p>'.$LANG['initial_balance'].': '.$webConfig["currency"]["code"].$current.'</p>
		<p>'.$LANG["final_balance"].': '.$webConfig["currency"]["code"].$credit.'</p>
		<p>'.$LANG['transaction_id'].': '.$id.'</p>
		<p>'.$LANG['kind_regards'].'</p>
                <p><center>'.$lit.' </center></p>
		</div>
		</center>
		';
		  
	 $mail->send("$email","$message","$subject","$webName","$replyTo");	 
				 
				$sql = "UPDATE users SET credit='$credit' WHERE id='$user'";
               
				if ($conn->query($sql) === TRUE) {
					openAlert($LANG["record_updated_successfully"],$LANG["success"],"success");
					 $amount="";	
				} else {
					openAlert($conn->error,$LANG["an_error_occurs"],"error");
				}
				
				
				
			} 

	
	}
			

$u =  userInfo($user,$conn);
$u = json_decode($u,true);
$balance = $LANG["balance_changed"]. $current. "- ".$u['credit'];
}

$name = json_decode(userInfo($name,$conn),true);
$name =  strtolower($name["userName"]);

//echo $sql;
?>  
<title><?php echo $LANG["edit_bser_balance"]; ?></title>

  <section class="container" id="content">
        
        
 
            <div class="section">
              <p class="caption"> <?php echo $LANG["edit_bser_balance"]; ?></p>
              <div class="divider"></div>
             
             
                  <div class="flexbox">
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
		
<div class="container">
			<div class="row flex-items-sm-center justify-content-center py-5">
			 
			
			
					<form class="row flex-items-sm-center justify-content-center border border-success px-3 overflow-hidden py-3 " method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
								
							
					    
                       		<div class="col s12 form-group">
							<h6><?php echo $LANG["edit_bser_balance"]; ?>:</h6>
							<hr color="#fff"/>
							</div>
                       		<div class="col s12 form-group">
							<label for="" id="username" class="form-control-label"><?php echo $LANG['username_phone_email']; ?></label>
							<input onchange="getUser()" onkeyup="getUser()" onload="getUser(); alert(1)" type="text" value='<?php echo $name;?>' class="form-control form-control-sm"  id="user" required>
							
						      <?php echo $nameError;?>
						  
						</div>	
						
						<input id="userid" value="" type="hidden" class="form-control" name="user" >
						
						
						<div class="col s12 form-group">
							<label for="" class="form-control-label"><?php echo $LANG['amount']; ?></label>
							<input pattern="[0-9.]+" type="text" value='<?php echo $amount;?>' class="form-control form-control-sm" name="amount" id="amount"  required>
							
						   	<label for="" id="balance" class="form-control-label"><?php echo $balance?></label>
						   <?php echo $amountError;?>
						
						</div>
			         <div class="col s12 col">
					 
						<input name="minus" type="checkbox" id="minus" value="-">
					 <label for="minus"><?php echo $LANG['remove_the_amount_form_user_account'] ?></label>
					</div>
						
						
						
						  
						<div class="col s12 form-group">
					<button class="btn btn-md btn-success right"><?php echo $LANG['edit_balance']; ?></button>
						   
						  
						</div>	
						
				
						
						
						
						
					</form>
				
			</div>
</div>



                     </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
        </section>





<?php include 'include/right-nav.php';?>
<?php include 'include/footer.php';?>
		





<script>

function getUser() {
			var  formData = new FormData();
			 formData.append("user",document.getElementById('user').value);
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				
				  var response = JSON.parse(this.responseText.toString().trim());
			       if(!response.NotFound){
				  document.getElementById('username').innerHTML = response.name;
				  document.getElementById('userid').value = response.id;
				  document.getElementById('balance').innerHTML = response.name + ": <?php echo $LANG["user_balance"];?> = "+ response.credit;
				  }
				}
			  };
			  xhttp.open("POST", "include/getusername.php", true);
			  xhttp.send(formData);
			  
			}
			getUser();
</script>



<?php $conn->close();?>