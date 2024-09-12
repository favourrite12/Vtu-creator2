<?php include '../../include/ini_set.php';?>
<?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>
<?php include '../../include/webconfig.php';?>
<?php include '../../include/filter.php';?>
 <?php 
 include "../../sendMail/sendMail.php";
 $mail =  new sendMail($webConfig["licencesToken"]);
 ?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["admin"]);
     
?>
<?php 
 $id = xcape($conn, $_GET["id"]);
  include 'editprocessing.php';
?>

<?php 	
$result = $conn->query("SELECT * FROM admin WHERE id='$id'");
if($result->num_rows > 0){
   while($row=$result->fetch_assoc()){
    $username = $row['user_name'];
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $licencesKey = $row['licences_key'];
    $payment = $row['payment'];
    $bank = $row['bank'];
    $userBalance = $row['user_balance'];
    $admin = $row['admin'];
    $visitorNumber = $row['visitor'];
    $registerUser = $row['users'];
    $newsLetter = $row['news_letter'];
    $feedBack = $row['feedback'];
    $sms = $row['sms'];
    $deposit = $row['deposit'];
    $editBalance = $row['add_money'];
    $webConfigAccess = $row['web_config'];
    $icon = $row['icon'];
    $slider = $row['slider'];
    $contact = $row['contact'];
    $send = $row['send'];
    $discount = $row['discount'];
    $transaction = $row['transaction'];
    $refer = $row['refer'];
    $module = $row['module'];
    $service= $row['service'];	
    $currency = $row['currency'];
    $language = $row['language'];
    $systmUpdate= $row['update_access'];
    $paymentMethod= $row['payment_method'];
   }
}
?>











 <title><?php echo $LANG["edit_admin_details"];?> - <?php echo $name ?></title>


  <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG['edit_admin_details']; ?> - <?php echo $name ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel hoverable">
		
		
			
					<form  class="row  flex-items-sm-center justify-content-center overflow-hidden py-3" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="adminForm">
						
                                            
                                            <input name="id" value="<?php echo $id; ?>" type="hidden"/>  
                                            
                                            
					<div class="col s12 row">
					
                       		<div class="col s12 input-field">
		
	
							</div>
                       		         <div class="row col-sm-6 ">
                                   	<div class="col s12 input-field">
							<label for="" ><?php echo $LANG["user_name"];?></label>
							<input type="text" value='<?php echo $username;?>' name="user_name" id="username" required>
							
						    
						  
						</div>	
                                             <?php echo $userNameError;?>
						</div>	
						
						
						<div class="row col-sm-6 ">
						<div class="input-field">
							
							<input type="text" value='<?php echo $name;?>' name="name" id="name"  required>
						   <label for="name" ><?php echo $LANG["full_name"];?></label>
						  
						
						</div>
                                                     <?php echo $nameError;?>
						</div>
			                        <div class="row col-sm-6 ">
						<div class="col s12 input-field">
							<label for="" ><?php echo $LANG["phone"];?></label>
					  		<input type="tel"   value='<?php echo $phone;?>' name="phone" id="phone" required >
							
						</div>
                                                     <?php echo $phoneError;?>
						</div>
						
						<div class="row col-sm-6 ">
						<div class="col s12 input-field">
							<label for="" ><?php echo $LANG["email"];?></label>
					  		<input type="email" value='<?php echo $email;?>'  name="email" id="email"  required>
							
						</div>
                                                     <?php echo $emailError;?>
						</div>
						
						
						<div class="row col-sm-6 ">
						<div class="col s12 input-field">
							<label for="" ><?php echo $LANG["password"];?></label>
							<input type="password" value='<?php echo $password;?>' name="password" >
						     <?php echo $passwordError;?>
						  
						</div>	
						</div>	
						
						<div class="row col-sm-6 ">
                                                <div class="col s12 input-field">
							<label for="" ><?php echo $LANG["confirm_password"];?></label>
							<input type="password" value='<?php echo $confirmPassword;?>' name="confirmPassword" >
						   
						  
						</div>
                                                     <?php echo $confirmPasswordError;?>
						</div>
                                               						
						
						
						 <?php if($adminInfo['bank']==1){?>
                                               <div class="col-sm-6">
						<input <?php if($bank==1){echo "checked"; } ?>   name="bank" type="checkbox" value="1" class="" id="bank">
						<label  for="bank"><?php echo $LANG["allow_admin_to_change_bank_detail"];?></label>
						</div>
						
						<?php } ?>
						
						 <?php if($adminInfo['add_money']==1){?>
						<div class="col-sm-6">
						<input <?php if($editBalance==1){echo "checked"; } ?> name="add_money" type="checkbox" value="1" id="money">
						<label  for="money"><?php echo $LANG["allow_admin_to_edit_user_balance"]; ?></label>
						</div>
						
						<?php } ?>
						
						 <?php if($adminInfo['admin']==1){?>
						<div class="col-sm-6">
						<input name="admin" <?php if($admin==1){echo "checked"; } ?> type="checkbox" value="1" id="admin">
						<label  for="admin"><?php echo $LANG["allow_admin_to_create_edit_delete_other_admin"];?></label>
						</div>
						
						<?php } ?>
						
						 <?php if($adminInfo['visitor']==1){?>
						<div class="col-sm-6">
						<input name="visitor" <?php if($visitorNumber==1){echo "checked"; } ?> type="checkbox" value="1" id="visitor">
						<label  for="visitor"><?php echo $LANG["allow_admin_to_view_number_of_visitors"];?></label>
						</div>
						 
						 <?php } ?>
						
						 <?php if($adminInfo['users']==1){?>
						<div class="col-sm-6">
						<input name="users" <?php if($registerUser==1){echo "checked"; } ?> type="checkbox" value="1" id="userAccess">
						<label  for="userAccess"><?php echo $LANG["allow_admin_to_view_number_of_registered_users"];?></label>
						</div>
						
						<?php } ?>
						
						 <?php if($adminInfo['news_letter']==1){?>
						<div class="col-sm-6">
						<input name="news_letter" <?php if($newsLetter==1){echo "checked"; } ?> type="checkbox" value="1" id="news">
						<label  for="news"><?php echo $LANG["allow_admin_to_create_edit_delete_news_letter"];?></label>
						</div>
						
						<?php } ?>
						
						 <?php if($adminInfo['feedback']==1){?>
						<div class="col-sm-6">
						<input name="feedback" <?php if($feedBack==1){echo "checked"; } ?> type="checkbox" value="1" id="feedback">
						<label  for="feedback"><?php echo $LANG["allow_admin_to_read_feedback"];?></label>
						</div>
						<?php } ?>
						
						 <?php if($adminInfo['payment']==1){?>
						<div class="col-sm-6">
						<input name="payment" <?php if($payment==1){echo "checked"; } ?> type="checkbox" value="1" id="paymentAccess">
						<label  for="paymentAccess"><?php echo $LANG["allow_admin_to_access_to_payment"];?></label>
						</div>
						<?php } ?>
						
						 <?php if($adminInfo['deposit']==1){?>
						<div class="col-sm-6">
						<input name="deposit" <?php if($deposit==1){echo "checked"; } ?> type="checkbox" value="1" id="deposit">
						<label  for="deposit"><?php echo $LANG["allow_admin_to_have_access_bank_deposit"];?></label>
						</div>
						
                                                 <?php } ?>
						
						 <?php if($adminInfo['user_balance']==1){?>
						<div class="col-sm-6">
						<input name="user_balance" <?php if($userBalance==1){echo "checked"; } ?> type="checkbox" value="1" id="balance">
						<label  for="balance"><?php echo $LANG["allow_admin_to_see_the_total_balance_of_all_users"];?></label>
						</div>
						
						<?php } ?>
						
						 <?php if($adminInfo['web_config']==1){?>
						<div class="col-sm-6">
						<input name="web_config" <?php if($webConfigAccess==1){echo "checked"; } ?> type="checkbox" value="1" id="config">
						<label  for="config"><?php echo $LANG["allow_admin_to_configure_web"];?></label>
						</div>
                                                
                                                
                                                
						<?php } ?>
						 <?php if($adminInfo['language']==1){?>
						<div class="col-sm-6">
						<input name="language" <?php if($language==1){echo "checked"; } ?> type="checkbox" value="1" id="language">
						<label  for="language"><?php echo $LANG["allow_admin_to_language_settings"];?></label>
						</div>
						<?php } ?>
                                                
                                                
						 <?php if($adminInfo['sms']==1){?>
						<div class="col-sm-6">
						<input name="sms" <?php if($sms==1){echo "checked"; } ?> type="checkbox" value="1" id="smsAccess">
						<label  for="smsAccess"><?php echo $LANG["allow_admin_to_sms_gateway"];?></label>
						</div>
						<?php } ?>
                                                
                                                
						 <?php if($adminInfo['currency']==1){?>
						<div class="col-sm-6">
						<input name="currency" <?php if($currency==1){echo "checked"; } ?> type="checkbox" value="1" id="currencyAccess">
						<label  for="currencyAccess"><?php echo $LANG["allow_admin_to_currency"];?></label>
						</div>
						<?php } ?>
                                                
						<?php if($adminInfo['payment_method']==1){?>
						<div class="col-sm-6">
						<input name="payment_method" <?php if($paymentMethod==1){echo "checked"; } ?> type="checkbox" value="1" id="payment_method">
						<label  for="payment_method"><?php echo $LANG["allow_admin_to_payment_method"];?></label>
						</div>
						<?php } ?>
                                                
						 <?php if($adminInfo['module']==1){?>
						<div class="col-sm-6">
						<input name="module" <?php if($module==1){echo "checked"; } ?> type="checkbox" value="1" id="module">
						<label  for="module"><?php echo $LANG["allow_admin_to_module"];?></label>
						</div>
						<?php } ?>
                                                
                                                
						 <?php if($adminInfo['service']==1){?>
						<div class="col-sm-6">
						<input name="service" <?php if($service==1){echo "checked"; } ?> type="checkbox" value="1" id="services">
						<label  for="services"><?php echo $LANG["allow_admin_access_to_service"];?></label>
						</div>
						<?php } ?>
                                                
						 <?php if($adminInfo['email_access']==1){?>
						<div class="col-sm-6">
						<input name="email_access" <?php if($service==1){echo "checked"; } ?> type="checkbox" value="1" id="email_access">
						<label  for="email_access"><?php echo $LANG["allow_admin_access_to_email_server"];?></label>
						</div>
                                                
						<?php } ?>
						 <?php if($adminInfo['refer']==1){?>
						<div class="col-sm-6">
						<input name="refer" <?php if($refer==1){echo "checked"; } ?> type="checkbox" value="1" id="refer">
						<label  for="refer"><?php echo $LANG["allow_admin_access_to_refer"];?></label>
						</div>
						<?php } ?>
                                                
						
						 <?php if($adminInfo['icon']==1){?>
						<div class="col-sm-6">
						<input name="icon" <?php if($icon==1){echo "checked"; } ?> type="checkbox" value="1" id="icon">
						<label  for="icon"><?php echo $LANG["allow_admin_to_change_web_icons_logo"]; ?></label>
						</div>
							
						<?php } ?>
						
						<?php if($adminInfo['slider']==1){?>	
						<div class="col-sm-6">
						<input name="slider" <?php if($slider==1){echo "checked"; } ?> type="checkbox" value="1" id="image-slider">
						<label  for="image-slider"><?php echo $LANG["allow_admin_to_change_image_slider"]; ?></label>
						</div>

						<?php } ?>
						
						 <?php if($adminInfo['contact']==1){?>		
						<div class="col-sm-6">
						<input name="contact" <?php if($contact==1){echo "checked"; } ?> type="checkbox" value="1" id="contact">
						<label  for="contact"><?php echo $LANG["allow_admin_to_edit_contact_information"]; ?></label>
						</div>	
                                                <?php } ?>
                                            
						 <?php if($adminInfo['update_access']==1){?>		
						<div class="col-sm-6">
						<input name="update_access" <?php if($systmUpdate==1){echo "checked"; } ?> type="checkbox" value="1" id="update_access">
						<label  for="update_access"><?php echo $LANG["allow_admin_to_system_update"]; ?></label>
						</div>	
                                                <?php } ?>
						
						 <?php if($adminInfo['transaction']==1){?>
						<div class="col-sm-6">
						<input name="transaction" <?php if($transaction==1){echo "checked"; } ?> type="checkbox" value="1" id="transaction-history">
						<label  for="transaction-history"><?php echo $LANG["allow_admin_to_view_transaction_history"];?></label>
						</div>
                                                 <?php } ?>
						 <?php if($adminInfo['discount']==1){?>
						<div class="col-sm-6">
						<input name="discount" <?php if($discount==1){echo "checked"; } ?> type="checkbox" value="1" id="discount">
						<label  for="discount"><?php echo $LANG["allow_admin_to_edit_discount_rate"];?></label>
						</div>
						<?php } ?>
								
						<div class="col s12 input-field">
							<button class="btn btn-md btn-success right"><?php echo  $LANG["edit"];?></button>
						   
						  
						</div>	
						
						   
					</div>
						
						    
						
						
					</form>
			
	
		

                    </div>
                  </div>
                </div>
              </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>