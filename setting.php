 <?php include "../../include/ini_set.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
 <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 
 
 <?php  $id = xcape($conn,$_GET["id"]); ?>
   <?php include "setting/image_upload.php"; ?>

 
<?php  $sql = "SELECT 
	   name, 
	   id, 
           debug_mode,
	   active, 
	   email_failed,
	   amount_name,
	   description, 
	   fee,
	   email_name,
	   phone_name,
	   fee_capped,
	   fee_percentage,
	   sms_alert,
	   sms_alert_me,
	   email_alert,
	   email_alert_me,
	   api,
	   html_tag,
	   min,
	   max,
	   plan_display_name,
	   plan_name,
	   plan_field_required,
	   plan_fixed_price,
	   category,
	   display_name ,
           image	   
	   
	   FROM service WHERE id='$id' OR name='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } ?>
	  
	   
	   <?php  $serviceValue["amount_name"] = empty($serviceValue["amount_name"])? "amount": $serviceValue["amount_name"]; $serviceValue["phone_namme"] = empty($serviceValue["phone_name"])? "phone": $serviceValue["phone_name"]; $serviceValue["email_name"] = empty($serviceValue["phone_name"])? "email": $serviceValue["email_name"]; $id = $serviceValue["id"]; $sql = "SELECT * FROM commission_rate WHERE service='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $commissionRate = $result->fetch_assoc(); }else{ $commissionRate ["notFound"] = true; } $categoryOption =""; $sql = "SELECT display_name, id FROM category ORDER BY display_name ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()){ $selected = ""; if($serviceValue["category"]==$row["id"]){ $selected = "selected"; } $categoryOption = "<option $selected value=\"{$row['id']}\">{$row['display_name']}</option>$categoryOption"; } }else{ $categoryOption = 'false'; } $formOption =""; $sql = "SELECT display_name, name FROM form WHERE service='$id' ORDER BY display_name ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()){ $selectedEmail = $selectedPhone = $selectedForm = ""; if($serviceValue["amount_name"]==$row["name"]){ $selectedForm = "selected"; } if($serviceValue["phone_name"]==$row["name"]){ $selectedPhone = "selected"; } if($serviceValue["email_name"]==$row["name"]){ $selectedEmail = "selected"; } $formOption = "<option $selectedForm value=\"{$row['name']}\">{$row['display_name']}</option>$formOption"; $emailOption = "<option $selectedEmail value=\"{$row['name']}\">{$row['display_name']}</option>$emailOption"; $phoneOption = "<option $selectedPhone value=\"{$row['name']}\">{$row['display_name']}</option>$phoneOption"; } }else{ $formOption = 'false'; } $phoneOption = "<option value=\"\">{$LANG['select_one_option']}</option>$phoneOption."; $emailOption = "<option value=\"\">{$LANG['select_one_option']}</option>$emailOption"; $formOption = "<option value=\"\">{$LANG['select_one_option']}</option>$formOption"; $categoryOption = "<option value=\"\">{$LANG['select_one_option']}</option>$categoryOption"; ?>
	   
	  <?php
 $settingButton = $LANG["service_settings"] ; $new = xcape($conn, $_GET["new"]); if($new=='true'){ $settingButton = $LANG["skip"]; } ?>
 
 
  <title><?php echo $LANG["setting"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
 

 
 <style>
.carousel .carousel-item {
  width: 100%;
}
</style>

 
 

    <div class="col s12">
      <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#general"><?php echo $LANG['general']; ?></a></li>
        <li class="tab col s3"><a  href="#pricing"><?php echo $LANG['pricing']; ?></a></li>
        <li class="tab col s3 "><a href="#notification"><?php echo $LANG['notification']; ?></a></li>
         <li class="tab col s3"><a href="#image"><?php echo $LANG["image"]?></a></li>
      </ul>
    </div>
	
    <div id="general" class="col s12">
	
	  <?php include "setting/general.php"; ?>
	
	</div>
	
	
	
    <div id="pricing" class="col s12">
	     <?php include "setting/pricing.php"; ?>
	
	</div>
	
	
    <div id="notification" class="col s12">
	      <?php include "setting/notification.php"; ?>
	</div>
	
	
	
	
	<div id="image" class="col s12">
	
	 <?php include "setting/image.php"; ?>
	
	</div>
	
	
	
	
  </div>
 
 
 
 
 
 
 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="advance.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["html_tag"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">code</i></a></li>
      <li><a href="gateway.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["gateway_edit"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">http</i></a></li>
      <li><a href="plan.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_plan"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">subscriptions</i></a></li>
      <li><a href="form.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="view.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
		
 
 
 </div>
 </div>
 <?php include "../../include/right-nav.php"; ?>
 <?php include "../include/footer.php"; ?>