<?php 
function includeHelper($file){
	if(file_exists($file)){
		return $file;
		
	}else if(file_exists("../$file")){
			return "../$file";
	}else if(file_exists("../../$file")){
		return "../../$file";
	}else if(file_exists("../../../$file")){
		return "../../../$file";
	}
}
  include_once  includeHelper("sendMail/sendMail.php");
  $GLOBALS["mail"] =  new sendMail($webConfig["licencesToken"]); 
  $GLOBALS["conn"]=$conn;
  include_once includeHelper('sendNoti.php');
  include_once includeHelper('sendSMS/index.php');
?>
<?php
function payService($conn,$id,$referrer="",$isWallet=false,$isAPI=false){
$errorLevel = 1;
$goReady =  1;

if($isAPI===false){
$id = preg_replace("/[^0-9]/", "", "$id");
$sql = "SELECT id, service_id, transaction_value,status,error_level,reg_date FROM recharge WHERE id ='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $date = $row["reg_date"];
        $serviceId = $row["service_id"];
        $transactionValue = json_decode($row["transaction_value"],true);
        $status = $row["status"];
        $TranErrorLevel = $row["error_level"];
    }
}  else {
    $goReady = 0; 
    $error[] = "failed_unable_to_fetch_transaction_data";
    $apiStatusCode="404";
}
}else if($isAPI===true){
if (!empty($id)) {
        $postValue  = $id;
        $serviceID =  $serviceId = xcape($conn,$postValue["serviceID"]);
        $transactionValue = $postValue;
        $requestId = xcape($conn,$transactionValue['requestID']);
}  else {
    $goReady = 0; 
    $error[] = "failed_unable_to_fetch_transaction_data";
     $apiStatusCode="404";
}
}
if(empty($serviceId)) {
   $goReady = 0; 
    $error[] = "service_cannot_be_empty";
     $apiStatusCode="204";
}else{
     $sql = "SELECT * FROM service WHERE id='$serviceId' OR name='$serviceId'";
	 
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		$serviceValue = $result->fetch_assoc();
                $serviceId = $serviceValue["id"];
	}else{
		$serviceValue["notFound"] = true;
                $goReady = 0; 
                $error[] = "service_cannot_be_found";
	}
        
        if($serviceValue["notFound"]!=true){
           $sql = "SELECT * FROM service_gateway WHERE id='{$serviceValue['gateway']}'";
            $result = $conn->query($sql);
		

            if ($result->num_rows > 0) {
                // output data of each row
                $gateway =  $result->fetch_assoc();
                 $gatewayId = $gateway["id"];
                foreach ($gateway as $key => $gateValue) {
                    if($key!="display_name" || $key!="id"){
                        $serviceValue[$key] = $gateValue;
                    }
                }
                    
             }  
//echo $conn->error;			 
        }
        
	
        
}     
 if($serviceValue['active'] !=1 && $serviceValue["notFound"]!==true && !empty($serviceId)){
   $error[] = "service_disabled";
   $goReady = 0;   
    $apiStatusCode="406";
}       
        
     
        
if($status=="success" || $TranErrorLevel > 1 ){
    $error[]="transaction_could_not_be_initiated_because_it_was_settled_and_completed";
  $goReady = 0;
    $apiStatusCode="406";
}     
        
    
 // TransactionValue Error Check       
if($serviceValue["notFound"]===true  || $goReady != 1){
    //$serviceValue["notFound"];
}else{
    $amount =  $transactionValue[$serviceValue['amount_name']];
    $phone =  $transactionValue[$serviceValue['phone_name']];
    $email =  $transactionValue[$serviceValue['email_name']];

if($amount > $serviceValue['max'] && $serviceValue['max'] !=0 ){
 $error[] = "amount_above_max";	
 $goReady = 0;
 $apiStatusCode="402";
}


if($amount < $serviceValue['min'] && $serviceValue['min'] !=0 ){
	
   $error[] =  "amount_below_min";	
   $goReady = 0;
    $apiStatusCode="402";
}



if(!empty($serviceValue['ref_key_name'])){

$refGenerated = mt_rand();

if($serviceValue['ref_key_type'] == 'alphanumeric'){
$refGenerated = hash("sha256",$refGenerated);
}

if(strlen($refGenerated) > $serviceValue['ref_key_len']){
	$refGenerated = substr($refGenerated,0,$serviceValue['ref_key_len']);
}else if($serviceValue['ref_key_absolute_len']==1 && strlen($refGenerated) != $serviceValue['ref_key_len']){
	$refGenerated =  str_pad($refGenerated,$serviceValue['ref_key_len'],$refGenerated,STR_PAD_BOTH);
}
	
 $transactionValue[$serviceValue['ref_key_name']] = $refGenerated;
}


//$error;

//echo $requestId;



//DISCOUNT CALCULATION START
if($GLOBALS["webConfig"]["discountEnable"]==1){
$sql = "SELECT * FROM commission_rate WHERE service ='$serviceId'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($isWallet===true && $GLOBALS["webConfig"]["userDiscountEnable"]==1){
             $discount = $row["registered_user"];
             $percent = $row["registered_user_percentage"];
        }elseif ($isAPI===true && $GLOBALS["webConfig"]["APIdiscountEnable"]==1) {
             $discount = $row["api_user"];
             $percent = $row["api_user_percentage"];            
        }elseif($GLOBALS["webConfig"]["unregisteredUserDiscountEnable"]==1){
             $discount = $row["unregistered_user"];
             $percent = $row["unregistered_user_percentage"];
        }
        if($GLOBALS["webConfig"]["referralEnable"]==1){
             $referEarn = trim($row["referrer_user"]);
             $referEarnPercent = $row["unregistered_user_percentage"];
             $referEarn = trim($referEarn);
             
             if($referEarn != 0 && $referEarn !="0" && !empty($referEarn)){
              if($referEarnPercent != 1){
                  $referEarn =  ($referEarn/100)*trim($amount);
               }
             }  else {
                $referEarn=0; 
             }
        }else{
            $referEarn = 0;
        }
    }
} 
$discount = trim($discount);
if($discount != 0 && $discount !="0" && !empty($discount)){
 if($percent == 1){
 $discount =  ($discount/100)*trim($amount);
}
}else{
  $discount = 0;
}
 $discount;
//// DISCOUNT CALCULATION END
}else{
	$discount = 0;
}
//////CALCULATION FEE
$feePer =  $serviceValue['fee_percentage'];
$fee  =  $serviceValue["fee"];
 $feeCapped  =  $serviceValue["fee_capped"];
if($feePer==1 && ($fee!=0 || $fee!="")){
	  $fee =  ($fee/100)*trim($amount);
	 if($fee > $feeCapped && ($feeCapped !='' && $feeCapped!=0) ){
		 $fee = $feeCapped;
	 }
}

//////
 $discount = $amount - $discount;
 $payAmount = $discount+$fee;

if($isWallet==true || $isAPI==true){
    if($GLOBALS["user"]["credit"] < $payAmount){
    $error[]  =  "insufficient_balance";
    $apiStatusCode="402";
    $goReady = 0;
    }
}


if($isAPI===true && $GLOBALS["webConfig"]["APIReferEnable"]!=1){
    $referEarn =1;
}elseif($isWallet===true && $GLOBALS["webConfig"]["userReferEnable"]!=1 ){
    $referEarn =1;   
}

if($isWallet===true){
$sql = "UPDATE recharge SET user='{$GLOBALS['user']['id']}' WHERE id='$id'";
$conn->query($sql);
}

$sendMail = $email;

$sql = "SELECT required, name, value, type FROM form WHERE type <> 'html_tag' AND type <> 'image'  AND service='$serviceId'";
	 
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        
            $value = $row['value'];
            if(trim($row["type"])=='header'){
                    $headers[] = "'".$row['name'] .":$value'";
            }else if($row["type"]=='server' || $row["type"]=='hidden'){
                    $transactionValue[$row['name']] = $value;
          }
    }
}

$sql = "SELECT value, name, type FROM gateway_form WHERE gateway='$gatewayId'";	 
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        
            $value = $row['value'];
            if(trim($row["type"])=='header'){
                    $headers[] = $row['name'] .":$value";
            }else if($row["type"]=='server' || $row["type"]=='hidden' || $row["type"]=="CURLOPT_POSTFIELDS"){
                    $transactionValue[$row['name']] = $value;
          }
    }
}

if($serviceValue['debug_mode']==1){
print_r($serviceValue);
print_r($transactionValue); 
print_r($transactionValue);
}
//$headers = [implode(',',$headers)];
//$headers =  json_encode($headers);	
$conn->query("UPDATE service SET hit=hit+1 WHERE id='$serviceId'");
}
 
if($goReady == 1){
    
    
    if($isAPI===true){
    $postValue = json_encode($postValue);
    $phone = xcape($conn, $phone);
    $amount = xcape($conn, $amount);
    $email = xcape($conn, $email);
    $id =  mt_rand()+time();
    $status = "initiated";
    $regDate = time();
    $date = $regDate;
    $APIrefer = xcape($conn,$transactionValue['refer']);
      
    $sql = "INSERT INTO api_transaction (
		id, 
		request_id,
		user,
		service_id,
		amount,
		phone,
		reg_date,
		status,
		email,
		refer,
		transaction_value,
                fee
		 )
		VALUES (
		'$id', 
		'$requestId', 
		'{$GLOBALS['user']['id']}',
		'$serviceId',
		'$amount',
		'$phone',
		'$regDate',
		'$status',
		'$email',
		'$APIrefer',
		'$postValue',
                '$fee'
		)";
    $conn->query($sql);
    //echo $sql.$conn->error;
    }
    
    	
    	$referLink= $serviceValue["CURLOPT_REFERER"];
	  if(empty($referLink)){
	  $referLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	}
	
	if($serviceValue["CURLOPT_CUSTOMREQUEST"]=="GET"){ 
    $seperator =  "?";
    $queryData = parse_url($serviceValue["CURLOPT_URL"])["query"];
     if(!empty($seperator)){
	$seperator =  "&";
     }
    $queryURL = $serviceValue["CURLOPT_URL"].$seperator.http_build_query($transactionValue);
	}
	
	$curl  = curl_init();
	
	curl_setopt($curl, CURLOPT_URL, $serviceValue["CURLOPT_URL"].$queryURL);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, $serviceValue["CURLOPT_RETURNTRANSFER"]);
	curl_setopt($curl, CURLOPT_POST, $serviceValue["CURLOPT_POST"]);
	curl_setopt($curl, CURLOPT_ENCODING, $serviceValue["CURLOPT_ENCODING"]);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $transactionValue);
	curl_setopt($curl, CURLOPT_REFERER, $referLink);
        
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $serviceValue["CURLOPT_FOLLOWLOCATION"]);
	curl_setopt($curl, CURLOPT_MAXREDIRS, $serviceValue["CURLOPT_MAXREDIRS"]);   
	curl_setopt($curl, CURLOPT_POSTREDIR, $serviceValue["CURLOPT_POSTREDIR"]);   
	curl_setopt($curl, CURLOPT_TIMEOUT, $serviceValue["CURLOPT_TIMEOUT"]);
	curl_setopt($curl, CURLOPT_HTTP_VERSION, $serviceValue["CURLOPT_HTTP_VERSION"]);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $serviceValue["CURLOPT_CUSTOMREQUEST"]);
	
    $transaction = curl_exec($curl); 
	
	curl_close($curl);
	
    
if($serviceValue["response_format"]=="XML"){
 // Convert xml string into an object 
$transaction = simplexml_load_string($$transaction); 
// Convert into json 
$transaction = json_encode($transaction); 
}         
            
$transaction = json_decode($transaction,true);
if(!empty($serviceValue['response_level'])){
  foreach ($transaction as $tran => $value) {  
   if($tran == $serviceValue['response_level'] )	{
	  $transaction =  $value;
   }	   
 }
}
$gatewayResponse =  json_encode($transaction);
if(!$isAPI){
$conn->query("UPDATE recharge SET gateway_response='$gatewayResponse' WHERE id='$id'");
}else{
	$conn->query("UPDATE api_transaction SET gateway_response='$gatewayResponse' WHERE id='$id'");
}
$status =  $transaction[$serviceValue["success_key"]];

//echo $buy;
$settled = "UPDATE recharge SET settled='1' WHERE id='$id'";
$referEarn = $referEarn+$conn->query("SELECT earn FROM users WHERE id='$referrer'")->fetch_assoc()["earn"];
$settleRefer = "UPDATE users SET earn = '$referEarn' WHERE id='$referrer'";
if(!$isAPI){
if($status == $serviceValue['success_text']){
         $lit = '<a href="//'.$GLOBALS["webConfig"]["webLink"].'/transaction/view.php?id='.$id.'">
	<button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$GLOBALS["LANG"]["view"].'</strong></button>
	</a>'; 
if($isWallet===true){

$paymentMethod = "wallet";
$iniBalance = $GLOBALS['user']["credit"];
$buy =  $GLOBALS['user']["credit"] - $payAmount;
$sql = "UPDATE users SET credit='$buy' WHERE id='{$GLOBALS['user']["id"]}'";
$conn->query($sql);   
$sql = "UPDATE recharge SET ini_balance='$iniBalance', final_balance='$buy'  WHERE id='$id'";
$conn->query($sql);

if($GLOBALS["webConfig"]["userReferRecursive"]==1 && $GLOBALS["webConfig"]["userReferEnable"]!=1 && $GLOBALS["webConfig"]["referralEnable"]==1){
    $conn->query($settleRefer);
}

}else{
    $paymentMethod = "card";
    if($GLOBALS["webConfig"]["referralEnable"]==1){
    $conn->query($settleRefer);
}
}

$sql = "UPDATE recharge SET payment_method='$paymentMethod', status='success', pay_amount='$payAmount', error_message='', error_level='0',fee='$fee' WHERE id='$id'";
$conn->query($sql);
$conn->query($settled);

}else{
        $goReady = 0;  
	$errorLevel = 2;
	$error[] = "gateway_error";
        $conn->query($settled);
//        Update Error Level Here           
}

//API TRANSACTION STARTS HERE
}elseif($isAPI===true){
$conn->query("UPDATE api_transaction SET gateway_response='$status',code='$apiStatusCode' WHERE id='$id'");
if($status == $serviceValue['success_text']){
    
if($GLOBALS["webConfig"]["APIReferRecursive"]==1 && $GLOBALS["webConfig"]["APIReferEnable"]!=1 && $GLOBALS["webConfig"]["referralEnable"]==1){
    $conn->query($settleRefer);
}
$iniBalance = $GLOBALS['user']["credit"];
$buy =  $GLOBALS['user']["credit"] - $payAmount;
$conn->query("UPDATE users SET credit='$buy' WHERE id='{$GLOBALS['user']["id"]}'");   
$sql = "UPDATE api_transaction SET ini_balance='$iniBalance', final_balance='$buy', pay_amount='$payAmount', status='TRANSACTION_SUCCESSFUL', description='TRANSACTION_SUCCESSFUL', error_message='', error_level='0',code='200' WHERE id='$id'";
$conn->query($sql);

 $lit = '<a href="//'.$GLOBALS["webConfig"]["webLink"].'/api_transaction/view.php?id='.$id.'">
    <button style="border:none;color:white;background:blue;padding:10px;border-radius:5px"><strong>'.$GLOBALS["LANG"]["view"].'</strong></button>
    </a>';

}else{
    $goReady = 0;  
    $errorLevel = 2;
    $error[] = "gateway_error";
    $apiStatusCode = "405";

//Update Error Level Here           
}

}
}

if($goReady!=1){
    if($errorLevel==1){
   if($serviceValue["email_failed"]==1){
      $GLOBALS["mail"]->send($GLOBALS["webConfig"]["supportEmail"],"{$GLOBALS["LANG"]["failed_transaction"]} {$serviceValue["display_name"]} $lit","{$GLOBALS["LANG"]["failed_transaction"]} {$serviceValue["display_name"]}",$GLOBALS["webConfig"]["webName"],$GLOBALS["webConfig"]["replyTo"]);
   }
  }  
 

foreach ($error as $msg) {
   $errorMessage =  $GLOBALS["LANG"]["$msg"]."".$errorMessage;
}
$error = implode(',',$error);
if(!$isAPI){
$sql = "UPDATE recharge SET error_message='$error', error_level='$errorLevel' WHERE id='$id'";
$conn->query($sql);
alertDanger($errorMessage);
}elseif ($isAPI===true) {
 $error = strtoupper($error);
 $sql = "UPDATE api_transaction SET error_message='$error', error_level='$errorLevel',description='$error' WHERE id='$id'";
$conn->query($sql);   
        
        $response["code"] = $apiStatusCode;
	$response["status"] = "TRANSACTION_FAILED";
	$response["description"] = $error;
        $response["content"]["requestID"] = $requestId;
        $response["content"]["serviceID"] = $serviceID;
        $response["content"]["image"] = "//".$GLOBALS["webConfig"]["webLink"]."/uploads/service/".$serviceValue["image"];
        $response["content"]["status"] = "TRANSACTION_FAILED";
        $response["content"]["description"]  = $error;
        $response["content"]["serviceName"] = $serviceValue["display_name"];
        $response["content"]["code"] = $apiStatusCode;
        
        if($errorLevel==2){
        $response["content"]["email"] = $email;
        $response["content"]["amount"] = $amount;
        $response["content"]["phone"] = $phone;
        $response["content"]["transactionID"] = $id;
        $response["gateway"]["referrer"] = $APIrefer;
        $response["content"]["postValues"]  = json_decode($postValue,true);
        $response["content"]["date"] = date("c",$regDate);
        }
       return $response; 
}
return explode(",",$error);
}else{
    
  if($status == $serviceValue['success_text']){
     if($isWallet==true && $isAPI===true){
         $sendMail = $GLOBALS["users"]["email"];
     }
   $message =  mailNoti($serviceValue["display_name"], $payAmount, $id, $date, $GLOBALS['user']['name'], $lit);
    $subject = "{$GLOBALS["LANG"]["successful_transaction"]} {$serviceValue["display_name"]} $id";
   if($serviceValue["email_alert"]==1){
   $GLOBALS["mail"]->send("$sendMail","$message","$subject",$GLOBALS["webConfig"]["webName"],$GLOBALS["webConfig"]["replyTo"]);
  } 
  if($serviceValue["email_alert_me"]==1){
   $GLOBALS["mail"]->send($GLOBALS["webConfig"]["supportEmail"],"$message","$subject",$GLOBALS["webConfig"]["webName"],$GLOBALS["webConfig"]["replyTo"]);
  }

  if($serviceValue["sms_alert"]==1){
      sendSMS($phone, "{$GLOBALS["LANG"]["successful_transaction"]} http://{$GLOBALS["webConfig"]["webLink"]}");
  }
   if($serviceValue["sms_alert_me"]==1){
       $sendPhone = explode(",",$GLOBALS["webConfig"]["webLink"])[0];
      sendSMS($sendPhone, "{$GLOBALS["LANG"]["successful_transaction"]} http://{$GLOBALS["webConfig"]["webLink"]}");
  }
 
 } 
    
    
  
 if($status == $serviceValue['success_text'] && $isAPI===false){
    return true;
}elseif($status == $serviceValue['success_text'] && $isAPI===true){
        $response["code"] = 200;
	$response["status"] = "TRANSACTION_SUCCESSFUL";
	$response["description"] = "TRANSACTION_SUCCESSFUL";
        $response["content"]["transactionID"] = $id;
        $response["content"]["requestID"] = $requestId;
        $response["content"]["amount"] = $amount;
        $response["content"]["phone"] = $phone;
        $response["content"]["serviceID"] = $serviceID;
        $response["content"]["amountPaid"] = $payAmount;
        $response["content"]["initialBalance"] = $iniBalance;
        $response["content"]["finalBalance"] = $buy;
        $response["content"]["image"] = "//".$GLOBALS["webConfig"]["webLink"]."/uploads/service/".$serviceValue["image"];
        $response["content"]["fee"] = $fee;
        $response["content"]["serviceName"] = $serviceValue["display_name"];
        $response["content"]["postValues"]  = json_decode($postValue,true); 
        $response["gateway"]["referrer"] = $APIrefer;
        $response["content"]["status"] = "TRANSACTION_SUCCESSFUL";
        $response["content"]["code"] = 200;
        $response["content"]["description"]  = "TRANSACTION_SUCCESSFUL";
        $response["content"]["postValue"]  = json_decode($postValue,true);
        $response["content"]["date"] = date("c",$regDate);
   return $response; 
}

}
}
?>