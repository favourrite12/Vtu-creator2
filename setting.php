 <?php include "../../include/ini_set.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
 <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 
 
 <?php  $id = xcape($conn,$_GET["id"]); ?>
   <?php include "setting/image_upload.php"; ?>

 
<?php  $sql = "SELECT 
	   id, 
	   ref_key_name,
	   ref_key_len,
	   ref_key_type,
	   display_name,
           ref_key_absolute_len
	   
	   
	   FROM service_gateway WHERE id='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } $id = $serviceValue["id"]; ?>	  
 
 
  <title><?php echo $LANG["setting"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
 

 
 <style>
.carousel .carousel-item {
  width: 100%;
}
</style>

 
 

    <div class="col s12">
      <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#general"><?php echo $LANG['general']; ?></a></li>
        <li class="tab col s3"><a href="#reference"><?php echo $LANG["reference_character"]?></a></li>
     
      </ul>
    </div>
	
    <div id="general" class="col s12">
	
	  <?php include "setting/general.php"; ?>
	
	</div>

	
	
	<div id="reference" class="col s12">
	
	 <?php include "setting/reference.php"; ?>
	
	</div>
	
	
	
	
	
	
  </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <script>
$('ul.tabs').tabs({
  swipeable: true,
  responsiveThreshold: Infinity
});
 </script>
 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
         <li><a href="form.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["custom_value"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="view.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
		
 
 
 </div>
 </div>
 <?php include "../../include/right-nav.php"; ?>
 <?php include "../include/footer.php"; ?>