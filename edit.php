
<?php include '../include/checklogin.php';?>

<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>

<?php include '../../include/filter.php';?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 if($adminInfo["admin"] != 1 || $adminInfo["admin"] != '1'){
 echo '<div class="container"><div class="alert alert-danger">
  <strong>ACCESS DENIED FOR '.strtoupper($adminInfo["name"]).':</strong> You don\'t have  the permission to Edit Admin.
</div></div>';
exit;
 }
     
?>






<?php 
$selectedAdmin = xcape($conn, $_GET['id']);

 $sql = "SELECT * FROM admin WHERE id = '$selectedAdmin'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	$name = $row['name'];
	$email = $row['email'];
	$user = $row['user_name'];
	$phone = $row['phone'];
	$api = $row['api_key'];
	$paymentKey = $row['pay_key'];
	$bank = $row['bank'];
	$userBalance = $row['user_balance'];
	$admin = $row['admin'];
	$visitorNumber = $row['visitor'];
	$registerUser = $row['users_num'];
	$newsLetter = $row['news_letter'];
	$feedBack = $row['feedback'];
	$sale = $row['sales'];
	$deposit = $row['deposit'];
	$editBalance = $row['add_money'];
	$lajelaBalance = $row['lajela_balance'];
	$webConfig = $row['web_config'];
	$icon = $row['icon'];
	$slider = $row['slider'];
	$contact = $row['contact'];
	$blockUser = $row['block_user'];
	$discount = $row['discount'];
	$transaction = $row['transaction'];
	$id = $row['id'];

	}
} else {
    $infoNotFound=true;
}
?>


<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'editprocessing.php';
}
?>

 <title>Edit Admin</title>


  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG['create_new_service']; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">

<section class="container">

	<form class="row  flex-items-sm-center justify-content-center overflow-hidden py-3" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">
			
	<div class="col-sm-10 row">
		<div class="col s12 form-group">
		<?php echo $output; ?>
		</div>
			<div class="col s12 form-group">
			<h6>Edit Admin:</h6>
			<hr color="#fff"/>
			</div>
			<input type="hidden" value="<?php echo $id;?>" name="id"/>
		
		<input value="<?php echo $do_to;?>" type="hidden" class="form-control" name="do_to" >
		
		
		<div class="col s12 form-group">
			<label for="" class="form-control-label">Full Name</label>
			<input type="text" value='<?php echo $name;?>' class="form-control form-control-sm" name="name" id="name"  required>
		   
		   <?php echo $nameError;?>
		
		</div>

		<div class="col s12 form-group">
			<label for="" class="form-control-label">Phone</label>
			<input type="tel"   value='<?php echo $phone;?>' class="form-control form-control-sm" name="phone" id="phone" required >
			 <?php echo $phoneError;?>
		</div>
		
		<div class="col s12 form-group">
			<label for="" class="form-control-label">Email</label>
			<input type="email" value='<?php echo $email;?>'  class="form-control form-control-sm" name="email" id="email"  required>
			 <?php echo $emailError;?>
		</div>
		
		
		<div class="custom-control custom-switch col-sm-6">
		<input <?php if($api==1){echo "checked" ;} ?>  name="api" type="checkbox" value="1" class="custom-control-input" id="api">
		<label class="custom-control-label" for="api">Allow Admin to change API KEY</label>
		</div>							
		
		<div class="custom-control custom-switch col-sm-6">
		<input <?php if($paymentKey==1){echo "checked"; } ?>  name="paymentKey" type="checkbox" value="1" class="custom-control-input" id="payment_key">
		<label class="custom-control-label" for="payment_key">Allow Admin to change Payment Key</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input <?php if($bank==1){echo "checked"; } ?>   name="bank" type="checkbox" value="1" class="custom-control-input" id="bank">
		<label class="custom-control-label" for="bank">Allow Admin to change Bank Detail</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input <?php if($editBalance==1){echo "checked"; } ?> name="editBalance" type="checkbox" value="1" class="custom-control-input" id="money">
		<label class="custom-control-label" for="money">Allow Admin to Edit User Balance</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="admin" <?php if($admin==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="admin">
		<label class="custom-control-label" for="admin">Allow Admin to Create/Edit/Delete Other Admin</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="visitorNumber" <?php if($visitorNumber==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="visitor">
		<label class="custom-control-label" for="visitor">Allow Admin to view number of visitors</label>
		</div>
		  
		<div class="custom-control custom-switch col-sm-6">
		<input name="registerUser" <?php if($registerUser==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="user">
		<label class="custom-control-label" for="user">Allow Admin to view number of registered users</label>
		</div>
		
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="newsLetter" <?php if($newsLetter==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="news">
		<label class="custom-control-label" for="news">Allow Admin to Create/Edit/Delete News Letter</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="feedBack" <?php if($feedBack==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="feedback">
		<label class="custom-control-label" for="feedback">Allow Admin to Read Feedback</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="sale" <?php if($sale==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="sell">
		<label class="custom-control-label" for="sell">Allow admin to See the total Sales</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="deposit" <?php if($deposit==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="deposit">
		<label class="custom-control-label" for="deposit">Allow admin to receive notification of Bank Deposit</label>
		</div>
								
		<div class="custom-control custom-switch col-sm-6">
		<input name="lajelaBalance" <?php if($lajelaBalance==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="lajela_balance">
		<label class="custom-control-label" for="lajela_balance">Allow admin to See Lajela Recharge Balance</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="userBalance" <?php if($userBalance==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="balance">
		<label class="custom-control-label" for="balance">Allow admin to see the total balance of all users</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="webConfig" <?php if($webConfig==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="config">
		<label class="custom-control-label" for="config">Allow admin to Configure Web</label>
		</div>
								
		
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="icon" <?php if($icon==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="icon">
		<label class="custom-control-label" for="icon">Allow admin to Change Web Icons/Logo</label>
		</div>
				
		<div class="custom-control custom-switch col-sm-6">
		<input name="slider" <?php if($slider==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="image-slider">
		<label class="custom-control-label" for="image-slider">Allow admin to change Image Slider</label>
		</div>

				
		<div class="custom-control custom-switch col-sm-6">
		<input name="contact" <?php if($contact==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="contact">
		<label class="custom-control-label" for="contact">Allow admin to Edit Contact Information</label>
		</div>	

		<div class="custom-control custom-switch col-sm-6">
		<input name="transaction" <?php if($transaction==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="transaction-history">
		<label class="custom-control-label" for="transaction-history">Allow Admin to View Transaction History </label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="blockUser" <?php if($blockUser==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="blockUser">
		<label class="custom-control-label" for="blockUser">Allow Admin to Block User</label>
		</div>
		
		<div class="custom-control custom-switch col-sm-6">
		<input name="discount" <?php if($discount==1){echo "checked"; } ?> type="checkbox" value="1" class="custom-control-input" id="discount">
		<label class="custom-control-label" for="discount">Allow Admin to Edit Discount Rate</label>
		</div>
		
		
				
				
		<div class="col s12 form-group">
			<button class="btn btn-md btn-success right">Edit Admin</button>
		   
		  
		</div>	
		
		   
	</div>
		
			
		
		
	</form>
	
</section>
		
                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

	