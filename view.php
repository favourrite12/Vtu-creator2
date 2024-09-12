<?php include "../../include/ini_set.php" ;?>
<?php
include '../include/checklogin.php';
include '../include/header.php';
include '../../include/data_config.php';
?>
<?php include '../../account/userinfojson.php';?>
<?php include '../../include/webconfig.php';?>
<?php include '../../include/filter.php';?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["transaction"]);
?>
<?php
$id= $_GET['id'];
$id = preg_replace("/[^0-9]/", "", "$id");
$sql = "SELECT * FROM recharge WHERE id ='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $amount = $row["amount"];
        $phone = $row["phone"];
        $serviceId = $row["service_id"];
        $email = $row["email"];
        $user = $row["user"];
        $paymentMethod = $row["payment_method"];
        $status = $row["status"];
        $paymentCode = $row["payment_code"];
        $errorMessage = $row["error_message"];
	    $iniBalance = $row["ini_balance"];
        $payAmount = $row["pay_amount"];
        $finalBalance = $row["final_balance"];
        $fee = empty($row["fee"])?0:$row["fee"];
		$gatewayResponse =  $row["gateway_response"];
		//echo  $paymentCode;
		$date = date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$row["reg_date"]);
    }
} else {
    openAlert('no_transaction_found');
}
?>
<?php 
	   
	   $sql = "SELECT display_name, image FROM service WHERE id='$serviceId' OR name = '$serviceId'";
		 
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
$userInfo = userInfo($user,$conn);
$userInfo  = json_decode($userInfo,true);
if(empty($userInfo['name'])){
	$userInfo['name'] =  "Unregistered User";
	$userInfo['phone'] =  "$phone";
}
$userInfo['name'] =  ucwords($userInfo['name']);
?>


<title><?php echo $LANG["transaction_details"]?></title>

  <section id="content">
        
        
          <div class="container">
            <div class="section flexbox">
			  
			  

  <!-- Form with placeholder -->
  <div style="" class="col s12 m12 l6 custom-form-control ">
	<div class="card-panel hoverable">









<section class="container">
<div class="row py-3 flex-items-sm-center justify-content-center">
<div class="col-sm-12 row">
    <div class="left"> <h4><?php echo $LANG["transaction_details"]?></h4></div>
    <img style="height: 80px !important; width: 100px !important" class="responsive-img right h-sm-30" src="../../uploads/service/<?php echo $serviceValue['image']?>" />
    <div class="clearfix"></div>				
 <?php if(!empty(trim($errorMessage)) && $status=="failed"){ ?>
    <div class="alert alert-danger left-align">
        <h6 class="text-center title"> <?php echo strtoupper($LANG["error_message"]) ;?></h6>
        <ul>
            
 <?php foreach (explode(",",$errorMessage) as $error) {?>
            <li><i class="material-icons left small">error</i><?php echo $LANG[$error];?></li>
           <?php }?>
        </ul>
     </div>
   <?php }?>  

<table class ="table">
<tr>

<tr>
   <td>
       <?php echo ucwords($LANG["transaction_id"]); ?>
   </td>
   <td>
     <?php echo $id?>
   </td>
</tr>


   <td>
          <?php echo ucwords($LANG["service_name"]); ?>
   </td> 
   
   <td>
     <?php echo $serviceValue["display_name"]?>
   </td>
</tr>
<tr>
   <td>
        <?php echo ucwords($LANG["phone"]); ?>
   </td>
     <td>
     <?php echo $phone?>
   </td>
</tr>
<tr>
   <td>
      <?php echo ucwords($LANG["amount"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $amount?>
   </td>
</tr>


<tr>
   <td>
     <?php echo ucwords($LANG["fee"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $fee; ?>
   </td>
</tr>


<?php if($paymentMethod == "card"){ 
    $cardFee = $conn->query("SELECT fee FROM guest_payment WHERE transaction_id='$id'")->fetch_assoc()["fee"];
?>
<tr>
   <td>
     <?php echo ucwords($LANG["card_processing_fee"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $cardFee; ?>
   </td>
</tr>

<?php } ?>



<tr>
   <td>
    <?php echo ucwords($LANG["amount_charged"]); ?>	
   </td>

     <td>
   <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $payAmount ;?>
   </td>
</tr>

<?php if(strtolower($paymentMethod)=="wallet"){?>
 <tr>
   <td>
   <?php echo ucwords($LANG["initial_balance"]); ?>	
   </td>

     <td>
     <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $iniBalance ; ?>
   </td>
</tr>


 <tr>
   <td>
     <?php echo ucwords($LANG["final_balance"]); ?>	
   </td>

     <td>
     <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $finalBalance; ?>
   </td>
</tr>

<?php } ?>


<?php if(!empty($email)){ ?>
<tr>
   <td>
   <?php echo ucwords($LANG["email"]); ?>
   </td>
   <td>
     <?php echo $email?>
   </td>
</tr>
<?php } ?>

 <tr>
   <td>
     <?php echo ucwords($LANG["payment_method"]); ?>
   </td>
   <td>
     <?php echo ucwords($LANG[$paymentMethod])?>
   </td>
</tr>

<tr>
   <td>
     <?php echo $LANG["status"]; ?>	
   </td>

     <td>
      <?php echo ucwords($LANG["$status"]); ?>
   </td>
</tr>

<tr>
   <td>
     <?php echo $LANG["date"]; ?>
   </td>
     <td>
     <?php echo $date; ?>
   </td>
</tr>



<?php 
$gatewayResponse= json_decode($gatewayResponse,true);
$sql = "SELECT name, display_name FROM display_value WHERE active='1' AND service='$serviceId' ";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
?>
<tr>
    <td colspan="2">
 <h5 class="title"><?php echo $LANG["token"];?></h5>
    </td>
</tr> 

 <?php 
   // output data of each row
   
    while($row = $result->fetch_assoc()) {
          if(!empty($gatewayResponse[$row["name"]])){
			  
?>
<tr>
	 <td> <?php  echo $row["display_name"]?> </td> 
	 <td> <?php echo  $gatewayResponse[$row["name"]];?></td>
</tr>
<?php
       }
	}  
}
?>


<tr>
    <td colspan="2">
 <h5 class="title"><?php echo ucwords($LANG["customer"]); ?></h5>
    </td>
</tr> 
 <tr>
   <td>
   <?php echo ucwords($LANG["name"]); ?>
   </td>
   <td>
     <?php echo $userInfo["name"];?>
   </td>
</tr> 
<?php if(!empty($phone)){ ?>
 <tr>
   <td>
  <?php echo ucwords($LANG["phone"]); ?>
   </td>
   <td>
     <?php echo $userInfo["phone"];?>
   </td>
</tr> 
<?php } ?>


</table>

</div>
    

    
</section>


<?php 
if($status!="reversed" && $paymentMethod == "wallet"){
echo '<section class="container">

	<div class="row  flex-items-sm-center justify-content-center">
			<div class="col s12 ">
				'."<button class=\"btn right btn-danger btn-sm py-0\"  onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','reverse.php?id=$id')\">{$LANG['reverse_transaction']}</button>
			</div>

</div>
</div>
</section>  
";
}
?>


			 </div>
			</div>
		  </div>
		</div>
	  </div>
</section>
<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>