<?php include "include/ini_set.php"?>
<?php include "include/header.php"?>
 <?php include 'include/data_config.php';?>
<?php include 'include/webconfig.php';?>
<title><?php echo $LANG["about_us"];?> | <?php echo $webConfig["webName"];?></title>
<div class="container">
    
   
 <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG["about_us"]; ?> - <?php echo $webConfig["webName"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12">
                    <div class="card-panel hoverable">  
    
    

<?php echo htmlspecialchars_decode($webConfig["about"]);?>
                        
                    </div>
                    </div>
                    </div>
 </section>
</div>
</div>

</div>
<?php include "include/footer.php"?>
