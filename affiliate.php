<?php include "include/ini_set.php"?>
<?php include "include/header.php"?>
 <?php include 'include/data_config.php';?>
 <?php include 'include/filter.php';?>
<?php include 'include/webconfig.php';?>

<?php if($webConfig["referralEnable"]!=1 && $webConfig["discountEnable"]!=1 && $webConfig["enableAPI"]!=1){
     javaScriptRedirect("index.php");
}
?>

<title><?php echo $LANG["affiliate"];?> | <?php echo $webConfig["webName"];?></title>
<div class="container">
 <section id="content">
            <div class="section container">
              <p class="caption"><?php echo $LANG["affiliate"]; ?> - <?php echo $webConfig["webName"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12">
                    <div class="card-panel hoverable">  
    
    <?php echo htmlspecialchars_decode($webConfig["affiliate"]);?>
                        
                    </div>
                    </div>
                    </div>
 </section>
</div>
</div>
</div>
<?php include "include/footer.php"?>
