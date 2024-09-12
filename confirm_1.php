<?php include "../include/ini_set.php" ;?>
<?php include "../include/header.php" ;?>
<?php include "../include/data_config.php" ;?>
<?php include "../include/filter.php" ;?>
<?php include "../include/webconfig.php" ;?>


<?php
if(!is_array("$LANG")){
  include "../language/{$webConfig["LANG"]}.php";
}
?>

<?php  $method = xcape($conn, $_GET["method"]); ?>
	
<?php 
if(!empty($_GET["recharge"])){
$id = xcape($conn,$_GET["recharge"]);
$sql = "SELECT * FROM recharge WHERE id = '$id' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
   $transactionValue = mysqli_fetch_assoc($result);
}else{
	$transactionValue["notFound"] = true;
}
$transactionValue["type"] = "recharge";
	//print_r($transactionValue);
}
$conn->query("UPDATE recharge SET payment_method_id='$card', payment_method_id='$method' WHERE id='$id'");
$changeMethod = "../buy/confirm.php?id=$id";
?>
<?php include '../account/userinfojson.php';?>

 <?php 
	   $service = $transactionValue["service_id"];
	   
	   $sql = "SELECT name, fee, fee_capped, fee_percentage, id, display_name FROM service WHERE id='$service' OR name='$service'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
			
			
?>

 <?php 
	   
	   
	   $sql = "SELECT * FROM payment_method WHERE id='$method'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$paymentMethod = $result->fetch_assoc();
		}else{
			$paymentMethod["notFound"] = true;
		}
		//print_r($paymentMethod);
			
			
?> 

<?php 
	   $currency = $paymentMethod["currency"];
	   
	   $sql = "SELECT * FROM currency WHERE id='$currency'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$paymentMethod['currency'] = $result->fetch_assoc();
		}else{
			$currency["notFound"] = true;
		}
		
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
		//print_r($gatewayData);
		
include "../paymentgateway/{$gatewayData["path_name"]}/index.php";	
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

 $displayMethodFee =  $methodFee;

if($methodFeePercentage ==1 && ($methodFee!=0 || $methodFee!="")){
	  $methodFee =  ($methodFee/100)*trim($transactionValue["amount"]);
	 if($methodFee > $methodFeeCapped && ($methodFeeCapped !='' || $methodFeeCapped!=0) ){
		
		 $methodFee = $methodFeeCapped;
		
	 }
}
 
 
 $transactionValue["payAmount"] = $transactionValue["amount"]+$serviceFee+$methodFee;
 $displayPayAmount = htmlspecialchars_decode($webConfig["currency"]["symbol"]).round($transactionValue["payAmount"],2);
if($paymentMethod["currency"]["id"] != $webConfig["currency"]["id"]){
   $paymentMethodRate = $paymentMethod["currency"]["rate"];
   $systemRate = $webConfig["currency"]["rate"];
   $amountToConvert =  $transactionValue["payAmount"];
   $transactionValue["payAmount"] =  ($amountToConvert * $systemRate)/$paymentMethodRate;
    $transactionValue["payAmount"] =  round($transactionValue["payAmount"],2);
	 $displayPayAmount =  $displayPayAmount." ".$LANG["converted_to"]." ".htmlspecialchars_decode($paymentMethod["currency"]["symbol"]).$transactionValue["payAmount"];
}
  
  
 ?>
<?php
$userInfo = userInfo($user,$conn);
$userInfo  = json_decode($userInfo,true);
if(empty($userInfo['name'])){
	$userInfo['name'] =  "Unregistered User";
	$userInfo['phone'] =  $transactionValue["phone"];
}
$userInfo['name'] =  ucwords($userInfo['name']);
?>
	
<?php 
 if($serviceFeePercentage==1){
	$servicePer = "(".$LANG["in_percentage"].")";
}

if($serviceFeeCapped > 0){
	$servicePer = $servicePer." - ".$LANG["fee_capped_at"]." ".htmlspecialchars_decode($webConfig["currency"]["symbol"]).$serviceFeeCapped;
}
?>

<?php 
 if($methodFeePercentage==1){
	$methodPer = "(".$LANG["in_percentage"].")";
}

if($serviceFeeCapped > 0){
	$methodPer = $methodPer." - ".$LANG["fee_capped_at"]." ".htmlspecialchars_decode($webConfig["currency"]["symbol"]).$methodFeeCapped;
}

?>	
						

 <title><?php echo $LANG["payment"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container flexbox">
            <div class="section row "  >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div id="payCard" class="card-panel   hoverable ">
                   
					  
					   <div class="col s11 center-align"> 
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
                                                <b><?php echo date("M d, Y",$transactionValue["reg_date"]); ?></b><br>
                                            </p>
                                        </div> 
                                        <div class="col s4">
                                            <p>
                                               <span class="light-blue-text"><?php echo $LANG["status"]; ?></span><br>
                                                <b><?php echo $transactionValue["status"] == "success"?$LANG["success"]:$LANG["pending"]; ?></b><br>
                                                

                                            </p>
                                        </div>
                                       
                                   
                                    <div class="row">
                                        <div class="col s11">
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
                                                        <td><?php echo $serviceValue["display_name"]; ?></td>
                                                        <td class="right-align"><?php echo  htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo $transactionValue["amount"]; ?></td>
                                 						<td class="right-align"><?php echo  htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo $serviceValue["fee"]; ?> <?php echo $servicePer ?></td>                       
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <span class="heading-title"><?php echo $LANG["thank_you"]; ?></span>
                                            
                                                                                        
                                                                              		<br>
                                       		<a  href="<?php echo $changeMethod; ?>" class="waves-effect waves-light btn dark-blue darken-2"><?php echo $LANG["change_payment_method"];  ?></a>     

                                        </div>
                                        <div class="col s12 m6 l6 right-align">
                                            <div class="text-right">
                                                <h6 class="m-t-sm light-blue-text"><b><?php echo $LANG["payment_method_charge"]; ?></b></h6>
                                                <p><?php echo  htmlspecialchars_decode($webConfig["currency"]["symbol"]); ?><?php echo  $displayMethodFee ; ?> <?php echo $methodPer; ?></p>
                                                <div class="divider"></div>
                                                                                        
                                                   

                                       


												   
                                                <h6 class="m-t-md text-success light-blue-text"><b><?php echo $LANG["total"]; ?></b></h6>
                                                <h5 class="text-success"><?php echo  $displayPayAmount ; ?></h5>
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
