<?php include 'include/checklogin.php';?> 

<?php 
include 'include/header.php';
include '../include/data_config.php';
date_default_timezone_set('Africa/Lagos'); 
?>
<?php include '../include/filter.php';?>
<?php include '../account/userinfojson.php';?>

<?php 
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["users"])
     
?>



<?php 
$name = xcape($conn, $_GET['id']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$user = xcape($conn, $_POST['user']);
	$name = xcape($conn, $_POST['user']);
	$reason = xcape($conn, $_POST['reason']);
	$unBlock = trim(xcape($conn, $_POST['unblock']));
	$status = "block";
	if($unBlock=="1"){
	$status = "active";
	$reason = "";
	}
	$id = mt_rand()+time();
	
		$prc = 1;

	 if(empty($user)){
	 $nameError ='<strong class="text-danger right"><small>'.$LANG['please_provide_name'].'</small></strong>';
	 $prc = 0;
	 }
	
 
	
    
	if($prc == 1){	   
		
			
				 
				$sql = "UPDATE users SET status='$status',block_reason = '$reason' WHERE id='$user'";
               
				if ($conn->query($sql) === TRUE) {
					alertSuccess($LANG["changes_saved_successfully"]);
					 $reason="";	
				} else {
					alertDanger($conn->error);
				}
				
		
    }
}

//echo $sql;
//print_r($_POST);



$name = json_decode(userInfo($name,$conn),true);
$name =  strtolower($name["userName"]);

?>  
<title><?php echo $LANG['block_unblock_user']?></title>

<div class="container">


  <section id="content">
        
        
 
            <div class="section">
              <p class="caption"><?php echo $LANG['block_unblock_user']?></p>
              <div class="divider"></div>
                               <div class="flexbox">
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
		
						<div class="container">
									
									
			
					
					<form class="row flex-items-sm-center justify-content-center border border-success px-3 overflow-hidden py-3 " method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
								
								
					    
                       	
                       <div class="input-field">
							
							<input onchange="getUser()" onkeyup="getUser()" onload="getUser()" type="text" value='<?php echo $name;?>'   id="user" required>
							<label for="user" id="username" ><?php echo $LANG['username_phone_email']?></label>
						      <?php echo $nameError;?>
						  
						</div>	
						
						<input id="userid" value="" type="hidden" class="form-control" name="user" >
						
						
						<div class="input-field">
							<label for="" class="form-control-label"><?php echo $LANG['reason']?></label>
							<textarea class="materialize-textarea"  name="reason" id="reason" ></textarea>
							
						
						</div>
						
						<div class="switch" >
							 <div class="switch">
							<label>
							<?php echo $LANG['unblock_this_user']?>
							    <input id="unblockCheck" name="unblock" type="checkbox"  value="1">
							  <span class="lever"></span>
							</label>
						  </div>
						  </div> 
						
			           
						
						
						
						  
						<div class="input-field col s12">
					<button class="btn btn-md btn-success right"><?php echo $LANG['submit']?></button>
						   
						  
						</div>	
						
						
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
				  document.getElementById('username').innerHTML = "<strong class='text-success'> "+response.name + "</strong>";;
				  document.getElementById('userid').value = response.id;
				  document.getElementById('reason').value = response.blockReason;
				  if(response.status == "block"){
				  document.getElementById('unblockCheck').checked=true;
				  }
				  }
				}
			  };
			  xhttp.open("POST", "include/getusername.php", true);
			  xhttp.send(formData);
			  
			} 
			getUser();
</script>



<?php $conn->close();?>