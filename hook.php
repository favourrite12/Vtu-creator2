<?php include "../../include/ini_set.php"; ?>
<?php include "../include/checklogin.php"; ?>
<?php include "../include/header.php"; ?>
<?php include "../../include/data_config.php"; ?>
<?php include "../../include/filter.php"; ?>
<?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["payment"]); ?>

 <title>Monnify Account</title>

 <div class="section flexbox">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12">
                      <div class="card-panel hoverable">
                          Copy this URL to webhook under settings on your monnify dashboard to enable instant wallet funding on your portal after successful transaction your reserved account,
                 
                          <br/>
                          <br/>
                          <div class="text-info" >http://<?php echo $webConfig["webLink"]?>/reserved-account/hook.php</div>
                          
                          <br/>
                          <br/>
                          Secured (SSL) <i>Please make sure you have SSL certificate installed on your server before using the url below</i>
                           
                          <br/>
                          <br/>
                          <div class="text-success"> https://<?php echo $webConfig["webLink"]?>/reserved-account/hook.php </div>
                          <br/>
                          <br/>
                          <div class="bold text-danger ">
                              Avoid Copying with space
                          </div>
                      </div>
                          
                  </div>
 </div>
</div>
</div>
<?php include "../include/footer.php"; ?>