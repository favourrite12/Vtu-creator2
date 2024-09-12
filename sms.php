<?php include "../../include/ini_set.php"; ?>
<?php include "../include/checklogin.php"; ?>
<?php include "../../include/data_config.php"; ?>
<?php include "../../include/filter.php"; ?>
<?php include "../include/header.php"; ?>
<title><?php echo $LANG["sms_gateway"] ?></title>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["sms"]);
?>
<section id="content">

         <div class="container">
           <div class="section flexbox" >
 <!-- Form with placeholder -->
                 <div class="row col custom-form-control m6">
                   <div class="card-panel  hoverable">
                                            <p class=""><?php echo $LANG["sms_gateway"];?>  </p>
                                         <div class="divider  py-0 my-0"></div>
                     <div class="row">
                       <form class=" row col s12" onsubmit="return ajaxRequest(this,'../../processor/mini_config_processing.php');" method="post" action="#">
                           
                           
                        <input name="id" type="hidden" value="<?php echo $id; ?> " />
                                <input name="new" type="hidden" value="<?php echo $new; ?> " />
                                 <?php  $sql = "SELECT id, display_name FROM service_gateway ORDER BY display_name ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $select = ""; $id = $row["id"]; $displayName = $row["display_name"]; if($id == $serviceValue["gateway"]){ $select = "selected"; } $gatewayOption = "<option   $select  value=\"$id\" > $displayName </option>".$gatewayOption ; ?>



                          <?php } ?> 



                        <div class="row col s12" >
                           <div class="input-field col s12" >

                               <select name="value[]">
                                   <option value=""><?php echo $LANG["select_one_option"];?></option>
                                 <?php echo $gatewayOption ?>
                                </select>
                           </div>
                         </div>      

                                <input value="SMS_gateway" name="name[]" type="hidden"/>
                             
                              <?php  }else{ openAlert($LANG["no_record_found"]); echo $LANG["no_record_found"]; ?>
                                                <a href="../gateway/new.php" class="btn waves-effect waves-light right"  ><?php echo $LANG["create_new"]?>
                                  <i class="material-icons right">add</i>
                                </a>              
                              <?php
                        } ?>
                                                
                          </div>
                           
            
                            <?php 
                            $sql = "SELECT array_key,description,value FROM mini_config WHERE key_group='sms' AND array_key<>'SMS_gateway' AND array_key<>'SMS_debugMode' ORDER BY array_key ASC";
                           $result = $conn->query($sql);

                           if ($result->num_rows > 0) {
                                   // output data of each row
                                   while($row = $result->fetch_assoc()) {
                                   $docInf = "";
                                   $input = "";
                                   $description = $LANG[$row["description"]];
                                   $value =  $row["value"];
                                   $key = $row["array_key"];                    

                                    $input = "<div class=\"row col s12\" >
                                           <div class=\"input-field col s12\" >
                                             <textarea class=\"materialize-textarea\" name=\"value[]\" id=\"$key\">$value</textarea>
                                             <label for=\"$key\">{$LANG[$row["description"]]}</label>
                                             </div>

                                     </div>";

                                   echo $input;
                                   echo '<input value="'.$row["array_key"].'"  name="name[]" type="hidden" class="form-control" >';

                             }
                           }
                             ?>
                        
 <?php 
$sql = "SELECT * FROM mini_config WHERE key_group='sms' AND type='checked'";
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
 '; 

}
}else {
    echo "0 results";
}
?>        
                                         
						  

                           <div class="row">
                             <div class="input-field col s12">
                               <button class="btn waves-effect waves-light right" type="submit" ><?php echo $LANG["save"]?>
                                 <i class="material-icons right">save</i>
                               </button>
                             </div>
                           </div>
                         </div>
                       </form>
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
      
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>