<?php 
session_start();
include '../include/ini_set.php';
include '../include/header.php';
?>
<?php include '../include/data_config.php';?>

	<?php include '../include/filter.php';?>
	<?php include 'registermail.php';?>
	<?php include '../include/webconfig.php';?>
	<?php 
       $referBy = xcape($conn, $_SESSION["refer"]);
	$webName = $webConfig["webName"];
	$replyTo = $webConfig["replyTo"];
	$webLink  = $_SERVER["SERVER_NAME"];
	if(!empty($webConfig["webLink"])){  
		$webLink = $webConfig["webLink"];
	}
	?>
	<?php 
	include "../sendMail/sendMail.php";
	$mail =  new sendMail($webConfig["licencesToken"]); 
	?>
<?php 

     $do_to = xcape($conn, $_GET['do_to']);
	$doTo = base64_decode($do_to);
	if(empty($do_to)){
	$doTo = '../dashboard/';
	}
	
  include 'rp.php';
?>

 <title><?php echo $LANG["register"];?></title>

		
		
		<section class="container">
		  <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG["user_registration"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 flexbox">
                    <div class="card-panel hoverable">	
			<div class="row flex-items-sm-center justify-content-center">
			 
				<div class="custom-form-control">
				
				
					<form class="" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
							
						
					    
                       	
                       		<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["user_name"]; ?></label>
							<input type="text" value='<?php echo $username;?>' class="form-control form-control-sm" name="username" id="username" required>
							
						    <?php echo $userNameError;?>
						  
						</div>	
						
						<input value="<?php echo $do_to;?>" type="hidden" class="form-control" name="do_to" >
						
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["full_name"]; ?></label>
							<input type="text" value='<?php echo $name;?>' class="form-control form-control-sm" name="name" id="name"  required>
						   
						   <?php echo $nameError;?>
						
						</div>
			
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["phone"]; ?></label>
					  		<input type="tel"   value='<?php echo $phone;?>' class="form-control form-control-sm" name="phone" id="phone" required >
							 <?php echo $phoneError;?>
						</div>
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["email"]; ?></label>
					  		<input type="email" value='<?php echo $email;?>'  class="form-control form-control-sm" name="email" id="email"  required>
							 <?php echo $emailError;?>
						</div>
						
						
						
						<div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["password"]; ?></label>
							<input type="password" value='<?php echo $password;?>' class="form-control form-control-sm" name="password" required>
						     <?php echo $passwordError;?>
						  
						</div>	

                                                <div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["confirm_password"]; ?></label>
							<input type="password" value='<?php echo $confirmPassword;?>' class="form-control form-control-sm" name="confirmPassword" required>
						    <?php echo $confirmPasswordError;?>
						  
						</div>	
                                                
                                                
                                                <div class="col s12 input-field">
							<label for="" class="form-control-label"><?php echo $LANG["referrer_code"]?></label>
							<input type="text" value='<?php echo $referBy;?>' class="form-control form-control-sm" name="referBy" >
						</div>	
						
						  
						<div class="col s12 input-field">
						<a href="login.php"><?php echo $LANG["login"]; ?></a>	<button class="btn btn-md btn-success right"><?php echo $LANG["register"]; ?></button>
						   
						  
						</div>	
						
						
					</div>
						
						
						
						
					</form>
				</div>
			</div>
		</section>
		

       
   </div>
   </div>
     


		<?php include '../include/footer.php';?>