<?php include '../include/ini_set.php'; ?> 
 <?php 
     session_start();
   include '../include/data_config.php';?>
<?php include '../include/filter.php';?>
<?php include '../include/webconfig.php';?>
<?php include_once  "../language/{$webConfig["LANG"]}.php";  ?>	
<?php
  $webLink = $webConfig["webLink"];
    $doTo = xcape($conn, $_GET['do_to']);
     if(!empty($_GET["do_to"])){
        $_SESSION["do_to"]=$_GET["do_to"];
     }elseif(empty ($_GET["do_to"]) && !empty ($_SESSION["do_to"])){
       $doTo = $_SESSION["do_to"];
     }
      $doTo = base64_decode($doTo);
      if(empty($doTo)){
      $doTo = '../admin';
      }
      if(!empty($_COOKIE['aKey'])) {
                $email = mysqli_real_escape_string($conn, "{$_COOKIE['aKey']}");
                $password = $_COOKIE['aToken'];
                      $sql = "SELECT user_name,email,password,id,status,block_reason FROM admin  WHERE id = '$email' ";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                if(md5(base64_encode($_SERVER['HTTP_USER_AGENT'].$row["password"])) == $_COOKIE['aOpKey']){
                      if($row["status"]=="block"){
                      include_once  '../include/header.php';
                      $errorMessage='<div class="alert alert-danger"> <strong>'. $row["name"] .','.$LANG["your_account_is_currently_blocked_please_contact_admin"].'</strong> <br/>'.$row["block_reason"].'</div>';
                       openAlert($row["block_reason"], $row["user_name"]." ".$LANG["your_account_is_currently_blocked_please_contact_admin"], "error");
                      }else if ($password == md5($row["password"])) {
                      if($webConfig["allowCookie"] == 1){
                              $cookie_user = "aKey";
                              $cookie_password = "aToken";
                              $aOpKey = "aOpKey";
                               $bKey = md5(base64_encode($_SERVER['HTTP_USER_AGENT'].$row["password"]));
                               setcookie($cookie_user, $email, time() + (86400 * 365), "/",$webLink); // 86400 = 1 day
                               setcookie($cookie_password, $password, time() + (86400 * 365), "/",$webLink); // 86400 = 1 day
                               setcookie($aOpKey, $bKey, time() + (86400 * 365), "/",$webLink); // 86400 = 1 day
                      }
                        $_SESSION["admin"] = $row["id"];
                        $_SESSION["admin_password"] = $password;

              echo "<script> location.href='$doTo' </script>";
           exit;
                      }
                }
               }

        }
      }
     ?>
      <?php
       $email="";	
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $email = xcape($conn, $_POST['email']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);
       $autoLogin = xcape($conn, $_POST['autoLogin']);
       $go = 1;
       $doTo = xcape($conn, $_POST['do_to']);
       $doTo = base64_decode($doTo);
       if(empty($doTo)){
       $doTo = '../admin/';
       }
       if(empty($password) && empty($email)){
           include_once  '../include/header.php';
           alertDanger($LANG["login_details_are_empty"]);
               $go = 0;
       }
       if($go==1){
       $sql = "SELECT  user_name,email,password,id,status,block_reason FROM admin  WHERE email = '$email' OR phone = '$email' OR user_name = '$email' OR id = '$email' ";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
       if($row["status"]=="block"){
        include_once  '../include/header.php';
          $errorMessage='<div class="alert alert-danger"> <strong>'. $row["name"] .','.$LANG["your_account_is_currently_blocked_please_contact_admin"].'</strong> <br/>'.$row["block_reason"].'</div>';
          openAlert($row["block_reason"], $row["user_name"]." ".$LANG["your_account_is_currently_blocked_please_contact_admin"], "error");
        }else if (password_verify($password, $row["password"])) {
       if($webConfig["allowCookie"] == 1){	
       if($autoLogin=="1"){
           $cookie_user = "aKey";
           $cookie_password = "aToken";
           $aOpKey = "aOpKey";
           $bKey = md5(base64_encode($_SERVER['HTTP_USER_AGENT'].$row["password"]));
           setcookie($aOpKey,$bKey, time() + (86400 * 365), "/",$webLink); // 86400 = 1 day
           setcookie($cookie_user, $row["id"], time() + (86400 * 365), "/",$webLink); // 86400 = 1 day
           setcookie($cookie_password, md5($row["password"]), time() + (86400 * 365), "/",$webLink); // 86400 = 1 day
        }
        }

         $_SESSION["admin"] = $row["id"];
         $_SESSION["admin_password"] = md5($row["password"]);

        echo "<script> location.href='$doTo' </script>";


        }else{ 
            include_once  '../include/header.php';
            alertDanger($LANG["invalid_password"]);
        }
}								 
       } else {
           include_once  '../include/header.php';
           alertDanger($LANG["admin_not_found"]);
       }
       }
        }
       ?>					
	<?php include_once  '../include/header.php';?>				
	<title><?php echo $LANG["admin_login"]; ?> | <?php echo $webConfig["webName"]?></title> 	
         <section id="content">
        <div id="scroll"></div>
        
          <div class="container">
	
			  
            <div class="section flexbox">
             
            
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
                        <strong><?php echo $LANG['admin_login']; ?> </p></strong>
                      <div class="row">
			<form method="post" id="login" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
		      <div class='text-center alert-danger p-0'>  <?php echo $errorMessage;?></div>
		  <div class="input-field "> 
			  <i class="material-icons prefix">account_circle</i>
                          <input required="required" id="email" value='<?php echo $email;?>' type="text" class="form-control" name="email" placeholder="<?php echo $LANG["email_phone_username"];?>">
                  </div>
                 <div class="input-field">
			  <i class="material-icons prefix">lock</i>
                          <input required="required" id="password" type="password" class="form-control" name="password" placeholder="<?php echo $LANG["password"];?>">
			
		  </div>
		  
	   <?php if($webConfig["allowCookie"] == 1){
		 ?>
                   <div class="col s12">
                     
		    <input checked type="checkbox" name="autoLogin"  value="1" id="autoLogin"/>
			<label class="" for="autoLogin"><?php echo $LANG["automatic_login"];?></label>
                        <span class="lever"></span>
		    </div>
		 <?php }?>
		<div class="col s12 ">	
			<input value="<?php echo $LANG["login"];?>" type="submit" class="btn  right" >
			</div>
			<div class="col s12 " style="clear:both !important">
				
				 <a class="right" href="forgot-password.php"><?php echo $LANG["forgot_password"];?></a>
				
				   
                                 <input value="<?php echo base64_encode($doTo);?>" type="hidden" class="form-control" name="do_to" >
	        </div>
			
			
			</form>
		</div>
		
		
                      </section>
                    </div>
                  </div>
                </div>
              </div>
     <?php include '../include/footer.php';?>	