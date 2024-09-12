

 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../admin/include/header.php';?>

 
  <title><?php echo $LANG["contact"]; ?> - <?php echo $LANG["configuration"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["contact"]; ?> - <?php echo $LANG["configuration"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                     <div class="card-panel hoverable">
 


<section   class="container">
<div id="scroll"></div>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["contact"]);
     
?>
<div class="row flex-items-sm-center justify-content-center  overflow-hidden py-3">
<form  id="settingForm" class="row col s12" method="post" onsubmit="return ajaxRequest(this,'../../processor/configureprocessing.php',getId('scroll'));"  action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
 <input type="hidden" name="admin" value="<?php echo $loginAdmin;?>">
 <?php 
$sql = "SELECT * FROM web_config WHERE key_group='contact' AND type='textarea' ORDER BY key_group";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
 echo ' 
 <div class="form-group col-6">
 <h5>'.$LANG[$row["display_name"]].'</h5>
 	
    <textarea   rows="1" name="value[]" class="form-control" >'.$row["value"].'</textarea>
	<label for="" class=""><i>'.$LANG[$row["description"]].'</i></label>
  </div>  
  
  
    <input value="'.$row["array_key"].'"  name="name[]" type="hidden" class="form-control" >
 '; 

}
}else {
   // echo "0 results";
}
?>
  
 
  <div class=" col-12">
    <button  type="submit" class="btn btn-success right" ><?php echo $LANG["save"];?></button>
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





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

