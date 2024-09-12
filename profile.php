<?php include 'include/checklogin.php';?> 
<?php include 'include/header.php';?>
<?php include '../include/data_config.php';?>
<?php
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
?>
 <title><?php echo $adminInfo['name'];?> | <?php echo $LANG["profile"]?></title>
  


<style>

.dashboard-title {
     font-size:40px;
	 font-weight: bold;
}
.dashboard-image{
		height:140px;
		width:140px;
}
.dashboard-text-container{
		left: 120px;
}

.camera{
		left: 80px
}

@media only screen and (max-width: 600px) {
    .dashboard-title {
        font-size:18px
		
	}
	
	.dashboard-image{
		height:80px;
		width:80px;
	}
	.dashboard-text-container{
		left: 60px;
}

.camera{
		left: 40px
}
	
}
</style>

 <section class="container">
 

 


         
   
    
 
 <div class="row flex-items-sm-center justify-content-center  overflow-hidden py-3">

<div class="">
<br/>
<a class="right" href="change-password.php"><button class="btn" > <i class="fa fa-lock"></i> <?php echo $LANG["change_password"]; ?></button></a>

</div>

     <div class="flexbox clearfix">
 <div class=" custom-form-control">

 <div class="card-panel">
<div class="row">
  
 <div class="col l6">
<?php echo $LANG["user_name"]; ?>
 </div>
 
 <div class="col l6">
 <?php echo $adminInfo["user_name"] ?> 
 </div> 
 
 <div class="col l6">
<?php echo $LANG["full_name"]; ?>
 </div>
 
 <div class="col l6">
 <?php echo $adminInfo["name"] ?> 
 </div> 
 <div class="col l6">
<?php echo $LANG["phone"]; ?>
 </div>
 
 <div class="col l6">
 <?php echo $adminInfo["phone"] ?> 
 </div>
 
 
 <div class="col l6">
<?php echo $LANG["email"]; ?>
 </div>
 
 <div class="col l6">
 <?php echo $adminInfo["email"]?> 
 </div> 
 
 
 
</div>



</div>
</div>
</div>
</div>
 
 
 
 
 
 </section>
 
 
 
 
 
 
 
 
 
                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>





<?php include 'include/right-nav.php';?>
<?php include 'include/footer.php';?>
		
	
    
