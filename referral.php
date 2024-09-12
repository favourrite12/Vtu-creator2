 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../admin/include/header.php';?>
 

 
 
  <title><?php echo $LANG["referral_programme"]; ?> - <?php echo $LANG["configuration"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["referral_programme"]; ?> - <?php echo $LANG["configuration"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="flexbox">
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
 


<section   class="container">
<div id="scroll"></div>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["refer"]);
     
?>
<div class="row flex-items-sm-center justify-content-center  overflow-hidden py-3">
<form  id="settingForm" class="row col s12" method="post" onsubmit="return ajaxRequest(this,'../../processor/configureprocessing.php',getId('scroll'));"  action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
  <input type="hidden" name="admin" value="<?php echo $loginAdmin;?>">
 
 
 <?php 

$sql = "SELECT * FROM web_config WHERE  type='checked' AND key_group='referral' ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$checkValue = 0;
    $checkPercent ="";
	if($row["value"]==1){
		$checkPercent = "checked";
		$checkValue = 1;
	}
 echo ' 
  <input  id="id'.$row["array_key"].'" type="hidden" name="value[]" class="" value="'.$checkValue.'"/>
 <div class="switch">
   	<label for="'.$row["array_key"].'" >
	 <input '.$checkPercent.' id="'.$row["array_key"].'" type="checkbox"  onchange="checkValue(\'id'.$row["array_key"].'\',this)" class="" value="1"/>

	<span class="lever"></span>
	<i>'.$LANG[$row["display_name"]].'</i>
   
	
	</label>  
  </div>  
  <br/>
  
    <input value="'.$row["array_key"].'"  name="name[]" type="hidden" class="form-control" >
 '; 

}
}else {
    echo "0 results";
}
?>
  
 
  <div class=" col-12">
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
