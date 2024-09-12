 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../../admin/include/header.php';?>


 <title><?php echo $LANG['payment']; ?> - <?php echo $LANG['configuration']; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG['payment']; ?> - <?php echo $LANG['configuration']; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 flexbox">
                    <div class="card-panel">
					
<section   class="container">
<div id="scroll"></div>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["payment"]);  
?>
<div class="row custom-form-control  overflow-hidden py-3">
<form  id="settingForm" class="row col s12" method="post" onsubmit="return ajaxRequest(this,'../../processor/configureprocessing.php',getId('scroll'));" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
<input type="hidden" name="admin" value="<?php echo $loginAdmin;?>">
 
 <?php 
$sql = "SELECT * FROM web_config WHERE key_group='payment' AND type='textarea' ORDER BY key_group";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
 echo ' 
 <div class="form-group col-6">
 <h5><strong>'.$LANG[$row["display_name"]].'</strong></h5>
 	<label for="" class="form-control-label"><i>'.$LANG[$row["description"]].'</i></label>
    <textarea rows="1" name="value[]" class="form-control" >'.$row["value"].'</textarea>
  </div>  
  
  
    <input value="'.$row["array_key"].'"  name="name[]" type="hidden" class="form-control" >
 '; 

}
}else {
    echo "0 results";
}
?>
  

<?php 

$sql = "SELECT * FROM web_config WHERE  type='checked' AND key_group='payment' ORDER BY key_group";
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



<br/>
 <div class="input-field">
    <input value="currency"  name="name[]" type="hidden" class="form-control" >
    <select  name="value[]">
     <option><?php echo $LANG["select_one_option"] ;?></option>
<?php 
    $sql = "SELECT name, id FROM currency ORDER BY name ASC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
              // output data of each row
        while($row = $result->fetch_assoc()){
            $selected  = "";
            if($webConfig["currency"]["id"]==$row["id"]){
                 $selected = "selected";
              }
           echo  "<option $selected value=\"{$row['id']}\">{$row['name']}</option>";
        }
      }
;?>


    </select>

    <label><?php echo $LANG["system_currency"] ;?></label>
</div>


 
  <div class=" col s12">
    <button  type="submit" class="btn btn-success right" ><?php echo $LANG["save"]?></button>
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
