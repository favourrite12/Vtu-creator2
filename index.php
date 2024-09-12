 <?php include "../../include/ini_set.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
 <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 
 <?php  $id = xcape($conn,$_GET["id"]); ?>
   <?php include "setting/image_upload.php"; ?>


  <title><?php echo $LANG["appearance"] ;?>  - <?php echo $LANG['configuration'] ;?></title>
 
 
 <style>
.carousel .carousel-item {
  width: 100%;
}
</style>

 

    <div class="col s12">
      <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#colors"><?php echo $LANG['colors']; ?></a></li>
        <li class="tab col s3"><a href="#themes"><?php echo $LANG["themes"]?></a></li>
     
      </ul>
    </div>
	
    <div id="colors" class="col s12">
	
	  <?php include "color.php"; ?>
	
	</div>

	
	
	<div id="themes" class="col row s12">
	
	 <?php include "theme.php"; ?>
	
	</div>
	
  </div>
 
 </div>
 </div>
 <?php include "../../include/right-nav.php"; ?>
 <?php include "../include/footer.php"; ?>