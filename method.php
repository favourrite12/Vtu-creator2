 <?php include "../include/ini_set.php" ;?>
<?php
include '../include/header.php';
include '../include/data_config.php';
?>
<?php include '../account/userinfojson.php';?>
<?php include '../include/webconfig.php';?>
<?php include '../include/filter.php';?>



<?php 
	   
	   $sql = "SELECT fee, fee_percentage, id, display_name FROM service WHERE id='$serviceId' OR name = '$serviceId'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
			
			if($serviceValue["fee_percentage"]==1){
				$per = "(".$LANG["in_percentage"].")";
			}
?>

<?php
$userInfo = userInfo($user,$conn);
$userInfo  = json_decode($userInfo,true);
if(empty($userInfo['name'])){
	$userInfo['name'] =  "Unregistered User";
	$userInfo['phone'] =  "$phone";
}
$userInfo['name'] =  ucwords($userInfo['name']);
?>

<?php 
if(!empty($_GET["recharge"])){
	$value = xcape($conn,$_GET["recharge"]);
	$name = "recharge";
         $condition = "use_recharge='1'";
}else if(!empty($_GET["wallet"])){
	$value = xcape($conn,$_GET["wallet"]);
	$name = "wallet";
        $condition = "use_wallet='1'";
}
?>
 
<?php 
  $sql = "SELECT name, id FROM payment_method WHERE $condition ORDER BY name ASC";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
		  while($row = $result->fetch_assoc()){
			
		    $paymentMethod  = "<option $selected value=\"{$row['id']}\">{$row['name']}</option>$gateway";
		  }
		}else{
			$paymentMethod = false;
		}

?>


  <title><?php echo $LANG["choose_payment_method"]; ?></title> 
  <section id="content">
      
        
          <div class="container flexbox">
            <div class="section row ">
              
			  <h4><?php echo $LANG["choose_payment_method"]; ?> </h4>

			  
			  

<div class="divider"></div>

  <!-- Form with placeholder -->
  <div class="row">
      <div class=" col l6 custom-form-control">
	   <div class="card-panel hoverable">


                        <form action="../payment/confirm.php">
                         <input hidden name="<?php echo $name; ?>"  value="<?php echo $value; ?>">
                                <div class="input-field"  >
                                        <select name="method" required>
                                        <option value=""><?php echo $LANG["select_one_option"] ;?></option>

                                        <?php echo $paymentMethod ; ?>


                                        </select>
                                        <label><?php echo $LANG["payment_method"] ;?></label>
                              </div>

 
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['continue']; ?>
                                  <i class="material-icons right">send</i>
                                </button>
                              </div>
                            </div>
                        </form>

			
			 </div>
			</div>
			
		
		
		</div>
		  </div>
		</div>
	  </div>
</section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
