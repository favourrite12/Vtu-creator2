<?php include '../../include/ini_set.php';?>
<?php include '../include/checklogin.php';?>
<?php include '../../include/data_config.php';?>
<?php include '../../include/filter.php';?>
<?php include '../../admin/include/header.php';?>
  <title><?php echo $LANG["email_server"]; ?> - <?php echo $LANG["configuration"]; ?></title>
  <section id="content">
  <?php $LANG["use_email_function"] = "Use Mail Function"; ?>   
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["email_server"]; ?> - <?php echo $LANG["configuration"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 flexbox">
                    <div class="card-panel hoverable">
 


<section   class="container custom-form-control">
<div id="scroll"></div>
<?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["email_access"]); ?>
<div class="row flex-items-sm-center justify-content-center  overflow-hidden py-3">
<form  id="settingForm" class="row col s12" method="post" onsubmit="return ajaxRequest(this,'../../processor/mini_config_processing.php',getId('scroll'));"  action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
  <input type="hidden" name="admin" value="<?php echo $loginAdmin;?>">
 
 <?php  $sql = "SELECT * FROM mini_config WHERE key_group='email' AND type='textarea' ORDER BY id"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { echo ' 
 <div class="form-group col-12">
 <h6><strong>'.$LANG[$row["display_name"]].'</strong></h6>
 	<label for="" class="form-control-label"><i>'.$LANG[$row["description"]].'</i></label>
    <textarea rows="1" name="value[]" class="form-control" >'.$row["value"].'</textarea>
  </div>  
  
    <input value="'.$row["array_key"].'"  name="name[]" type="hidden" class="form-control" >
 '; } }else { echo "0 results"; } ?>

 
  
 <?php  $sql = "SELECT * FROM mini_config WHERE key_group='email' AND type='checked'"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $checkValue = 0; $checkPercent =""; if($row["value"]==1){ $checkPercent = "checked"; $checkValue = 1; } echo ' 
  <input  id="id'.$row["array_key"].'" type="hidden" name="value[]" class="" value="'.$checkValue.'"/>
 <div class=" col-sm-6 switch">
 <div class="switch">
 <h5><strong>'.$LANG[$row["display_name"]].'</strong></h5>
   	<label for="'.$row["array_key"].'" >
	 <input '.$checkPercent.' id="'.$row["array_key"].'" type="checkbox"  onchange="checkValue(\'id'.$row["array_key"].'\',this)" class="" value="1"/>

	<span class="lever"></span>
	<i>'.$LANG[$row["description"]].'</i>
   
	
	</label>
  </div>  
  </div>  
  
  
    <input value="'.$row["array_key"].'"  name="name[]" type="hidden" class="form-control" >
 '; } }else { echo "0 results"; } ?>
  
 
  <div class=" col s12">
    <button  type="submit" class="btn btn-success  right" ><?php echo $LANG["save"]?></button>
 </div> 
 
</form>
</div>
</section>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>




<script>

 function checkValue(t,c){
  if(c.checked){
  document.getElementById(t).value= 1;
  }else{
   document.getElementById(t).value=0;
  }
  }
 
</script>
<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
