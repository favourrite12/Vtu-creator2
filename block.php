<?php include '../include/checklogin.php';?> 

<?php 
include '../include/header.php';
include '../../include/data_config.php';
date_default_timezone_set('Africa/Lagos'); 
?>
<?php include '../include/filter.php';?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["admin"]); 
?>



<?php 
$name = xcape($conn, $_GET['id']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$admin = xcape($conn, $_POST['admin']);
	$name = xcape($conn, $_POST['admin']);
	$reason = xcape($conn, $_POST['reason']);
	$unBlock = trim(xcape($conn, $_POST['unblock']));
	$status = "block";
	if($unBlock=="1"){
	$status = "active";
	$reason = "";
	}
	$id = mt_rand()+time();
	
		$prc = 1;

	 if(empty($admin)){
	 $nameError ='<strong class="text-danger right"><small>Please provide  name</small></strong>';
	 $prc = 0;
	 }
	
 
	
    
	if($prc == 1){	   
					 
        $sql = "UPDATE admin SET status='$status',block_reason = '$reason' WHERE id='$admin'";

        if ($conn->query($sql) === TRUE) {
                alertSuccess($LANG["changes_saved_successfully"]);
                 $reason="";	
        } else {
                alertDanger($conn->error);
        }
				
		
    }
}
$name = adminInfo($name,$conn);
$name =  strtolower($name["user_name"]);

//echo $sql;
//print_r($_POST);
?>  
<title><?php echo $LANG["configuration"]; ?> |  <?php echo $LANG["block_unblock_admin"]; ?></title>

  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"]; ?> |  <?php echo $LANG["block_unblock_admin"]; ?></p>
              <div class="divider"></div>
             
                             <div class="flexbox">
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
		
						<div class="container">
									
									



<div class="container">
			<div class="row flex-items-sm-center justify-content-center py-5">
			
				
			
					<form class="row flex-items-sm-center justify-content-center border border-success px-3 overflow-hidden py-3 " method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
								
					    
                       		
                       		<div class="input-field">
							<label for="" id="adminname" class="form-control-label"><?php echo $LANG["username_phone_email"];?> </label>
							<input onkeyup="getAdmin(this.value)" onchange="getAdmin(this.value)" onload="getAdmin(this.value)" type="text" value='<?php echo $name;?>' class="form-control form-control-sm"  id="admin" required>
							
						      <?php echo $nameError;?>
						  
						</div>	
						
						<input id="adminid" value="" type="hidden" class="form-control" name="admin" >
						
						
						<div class="input-field">
							<label for="" class="form-control-label"><?php echo $LANG["reason"]; ?></label>
							<textarea class="materialize-textarea" name="reason" id="reason" ></textarea>
							
						
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
						
						
						  
						<div class="input-field">
					<button class="btn btn-md btn-success right"><?php echo $LANG["submit"]; ?></button>
						   
						  
						</div>	
						
						
				
						
						
						
						
					</form>
				</div>

                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>


</div>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>



<script>

function getAdmin(a) {
	     if(a!=0){
	      a =  a || a.value;
			var  formData = new FormData();
			 formData.append("admin",a);
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  var response = JSON.parse(this.responseText.toString().trim());
			      if(response.name!="undefined"){
				  document.getElementById('adminname').innerHTML = "<strong class='text-success'> "+response.name + "</strong>";;
				  
				  document.getElementById('adminid').value = response.id;
				  document.getElementById('reason').value = response.block_reason;
				  if(response.status == "block"){
				  document.getElementById('unblockCheck').checked=true;
				  }
				  }
				  }
			
			  };
			  xhttp.open("POST", "../include/getadminname.php", true);
			  xhttp.send(formData);
			  
			}
}
getAdmin(document.getElementById("admin").value);
</script>

 

<?php $conn->close();?>