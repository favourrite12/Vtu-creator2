<?php include "../include/ini_set.php" ;?>
<?php include "../include/header.php" ;?>
<?php include "../include/data_config.php" ;?>
<?php include "../include/filter.php" ;?>

<?php
if(!is_array("$LANG")){
  include "../language/{$webConfig["LANG"]}.php";
}
?>


	
<?php 
$id =  "1835258938";
$sql = "SELECT * FROM recharge WHERE id = '$id' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
   $transactionValue = mysqli_fetch_assoc($result);
}else{
	$transactionValue["notFound"] = true;
}
$transactionValue["type"] = "wallet";
	//print_r($transactionValue);
?>


 <?php 
	   $id = $transactionValue["service_id"];
	   
	   $sql = "SELECT name, fee, fee_capped, fee_percentage, id, display_name FROM service WHERE id='$id' OR name='$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
			
			$id = $serviceValue["id"];
?>

 <?php 
	   $method = xcape($conn, $_GET["method"]);
	   
	   $sql = "SELECT * FROM payment_method WHERE id='$method'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$paymentMethod = $result->fetch_assoc();
		}else{
			$paymentMethod["notFound"] = true;
		}
		print_r($paymentMethod);
			
			
?> 

<?php 
	   $currency = $paymentMethod["currency"];
	   
	   $sql = "SELECT * FROM currency WHERE id='$currency'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$currency = $result->fetch_assoc();
		}else{
			$currency["notFound"] = true;
		}
	//	print_r($currency);
		
?>


 <?php 
	   $gateway = $paymentMethod["gateway"];
	   
	   $sql = "SELECT name, path_name, logo FROM payment_gateway_data WHERE id='$gateway'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$gatewayData = $result->fetch_assoc();
		}else{
			$gatewayData["notFound"] = true;
		}
		print_r($gatewayData);
		
include "../paymentgateway/{$gatewayData["path_name"]}/index.php";	
?>

<?php 
 $paymentMethod["currency"] = $currency["code"];
?>

 <?php 
 
 $serviceFeePercentage =  $serviceValue['fee_percentage'];
$serviceFee  =  $serviceValue["fee"];
 $serviceFeeCapped  =  $serviceValue["fee_capped"];
if($serviceFeePercentage ==1 && ($serviceFee!=0 || $serviceFee!="")){
	  $serviceFee =  ($serviceFee/100)*trim($transactionValue["amount"]);
	 if($serviceFee > $serviceFeeCapped && ($serviceFeeCapped !='' || $serviceFeeCapped!=0) ){
		 $serviceFee = $serviceFeeCapped;
	 }
}

if($transactionValue["type"]=="recharge"){
	$methodFee = $paymentMethod["recharge_fee"];
	$methodFeeCapped = $paymentMethod["recharge_capped"];
	$methodFeePercentage = $paymentMethod["recharge_percentage"];
	
}else if($transactionValue["type"]=="wallet"){
	$methodFee = $paymentMethod["wallet_fee"];
	$methodFeeCapped = $paymentMethod["wallet_capped"];
	$methodFeePercentage = $paymentMethod["wallet_percentage"];
}



if($methodFeePercentage ==1 && ($methodFee!=0 || $methodFee!="")){
	  $methodFee =  ($methodFee/100)*trim($transactionValue["amount"]);
	 if($methodFee > $methodFeeCapped && ($methodFeeCapped !='' || $methodFeeCapped!=0) ){
		 $methodFee = $methodFeeCapped;
	 }
}
 
 
if($serviceFeePercentage==1){
	$servicePer = "(".$LANG["in_percentage"].")";
}

if($serviceFeeCapped > 0){
	$servicePer = $LANG["capped_at"].$serviceFeeCapped;
}
 
 
 echo $serviceFeePercentage;
 
 
   $transactionValue["payAmount"] = $transactionValue["amount"]+$serviceFee+$methodFee;
 
 ?>
						
						

 <title><?php echo $LANG["create_value"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
  <section id="content">
          <div class="container flexbox">
            <div class="section row "  >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div class="card-panel  hoverable ">
                      <div class="row">
					  
					   <div class="col s12 center-align"> 
					      <h5> <?php echo strtoupper($LANG["confirm_transaction_detials_below"]);?> </h5>
					  </div>
					  
					 
                                    	<div class="col s4 ">
                                            <p>
                                                <span class="light-blue-text"><?php echo $LANG["customer"]; ?></span><br>
                                                <b><?php echo $userInfo["name"]; ?></b><br>
                                                <b><?php echo $userInfo["phone"]; ?></b><br>
                                            </p>
                                        </div> 
                                        <div class="col s4">
                                            <p>
                                                <span class="light-blue-text"><?php echo $LANG["date"]; ?></span><br>
                                                <b>Aug 20, 2019</b><br>
                                            </p>
                                        </div> 
                                        <div class="col s4">
                                            <p>
                                                                                        	<span class="light-blue-text">Due Date</span><br>
                                                <b>Aug 20, 2019</b><br>
                                                

                                            </p>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $LANG["transaction_id"]; ?></th>
                                                        <th><?php echo $LANG["product"]; ?></th>
                                                        <th class="right-align"><?php echo $LANG["amount"]; ?></th>
                                                        <th class="right-align"><?php echo $LANG["convenience_fee"]; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    	<th> <?php echo $transactionValue["id"];?></th>
                                                        <td>SMS Recharge</td>
                                                        <td class="right-align">33.00</td>
                                 						<td class="right-align">&#8358;0.00<?php echo $servicePer ?></td>                       
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <span class="heading-title"><?php echo $LANG["thank_you"]; ?></span>
                                            
                                                                                        
                                                                              		<br>
                                       		<a id="cancel_inv" href="transaction" class="waves-effect waves-light btn dark-blue darken-2"><?php echo $LANG["change_payment_method"];  ?></a>     

                                        </div>
                                        <div class="col s12 m6 l6 right-align">
                                            <div class="text-right">
                                                <h6 class="m-t-sm light-blue-text"><b><?php echo $LANG["payment_method_charge"]; ?></b></h6>
                                                <h5 class="">&#8358;0.000</h5>
                                                <div class="divider"></div>
                                                                                        
                                                   

                                       


												   
                                                <h6 class="m-t-md text-success light-blue-text"><b><?php echo $LANG["total"]; ?></b></h6>
                                                <h4 class="text-success"><?php echo $transactionValue["payAmount"]; ?></h4>
                                                <div class="divider"></div>
                                                <h6 class="m-t-md text-success light-blue-text"><b><?php echo $LANG["payment_method"]; ?></b></h6>
                                                <h5 class="text-success"><?php echo $gatewayData["name"]; ?></h5>
                                                <br>

					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  <div>
					  
					  </div>
					  
					  
					  
					  
					  
					  
					  
					 
					<div class="row">
					     
                               <?php $btn =  '<button id="payNowButton" class="btn btn-success waves-effect waves-light  right" type="submit" >'. $LANG["pay_now"]. '</button>'; ?>
                              <?php echo paymentData($transactionValue,$userInfo,$paymentMethod,$btn);?>
							 
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
</div>
<?php include "../include/footer.php" ;?>