<?php include '../include/checklogin.php';?> 
<?php include '../dashboard/include/header.php';?>
<?php include '../include/data_config.php';?>

 <title><?php echo $user['username'];?> | Lajela</title>
  


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
 
 <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG["profile"]; ?> - <?php echo $user["name"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12">
                    <div class="card-panel hoverable">
 
 <div class="flex-items-sm-center justify-content-center" style="position:relative">
 <img style="position:relative; z-index:2" src="../../account/profile-pix/<?php echo $user['pix']?>" class="cyan circle responsive-img border rounded-circle border-secondary p-2 bg-white dashboard-image"/>
 
<a class="" href="change-passport.php"> <span style="position:absolute; z-index: 2; bottom: 0px; " class=" camera btn-floating btn"><i class="material-icons fa-2x"> photo_camera </i>
</span>
</a>

 <div style="position:absolute; z-index: 1; top: 20px; border-bottom:solid 2px black; background:#f5f5f0" class="rounded-top  col-sm-4 py-sm-2 px-4 col-sm-10 dashboard-text-container">
  <div class="text-success dashboard-title">  <?php echo $user['name'];?></div>
  <span><i class="material-icons">phone</i> <?php echo $user['phone'];?><span>
 </div>
 
 </div>
         
   
    
 
 <div class="row flex-items-sm-center justify-content-center  overflow-hidden py-3">

<div class="col-12 row">
 <div class="col m6 s12">
<a class="py-4 " href="editprofile.php"><button class="btn btn-flat"> <i class="material-icons left">edit</i><?php echo $LANG["edit_profile"];?></button></a>
</div>
 <div class="col m6 s12">
<a class="py-4 " href="change-password.php"><button class="btn btn-flat"> <i class="material-icons left">lock</i><?php echo $LANG["change_password"];?></button></a>

</div>
</div>

 <div class="divider"></div>
<div class="col s12 row">
 
<div class="row"> 
 <div class="col s3">
<?php echo $LANG["full_name"];?>
 </div>
 
 <div class="col s9">
 <?php echo $user['name'] ?> 
 </div>

 
 </div> 
 
 <div class="row"> 
 <div class="col s3">
<?php echo $LANG["country"];?>
 </div>
 
 <div class="col s9">
 <?php echo $user['country'] ?> 
 </div> 
  </div> 
 
 <div class="row"> 
 <div class="col s3">
<?php echo $LANG["region"];?>
 </div>
 
 <div class="col s9">
 <?php echo $user['region'] ?> 
 </div>
  </div> 
 
 <div class="row"> 
 
 <div class="col s3">
<?php echo $LANG["city"];?>
 </div>
 
 <div class="col s9">
 <?php echo $user['city']?> 
 </div> 
  </div> 
 
 <div class="row"> 
 <div class="col s3">
<?php echo $LANG["street"];?>
 </div>
 
 <div class="col s9">
 <?php echo $user['street']?>
 </div> 
  </div> 
 
 <div class="row"> 
 <div class="col s3">
<?php echo $LANG["zip_code"];?>
 </div>
 
 <div class="col s9">
 <?php echo $user['zipCode']?> 
 </div>
  </div> 
</div>



</div>
 
 
 
 
 
 </section>
 
 
 
 
 </div>
 </div>
 
 
 
 
	
    

<?php include '../dashboard/include/footer.php';?>