 <?php include "../../include/ini_set.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
<?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 <title><?php echo $LANG["gateway_setup"] ?></title>
 
<!-- Form with placeholder -->


  
	 <?php  $id = xcape($conn,$_GET["id"]); $serviceValue = $conn->query("SELECT display_name, id, gateway FROM service WHERE id='$id'")->fetch_assoc(); ?>
	  
	  
   <?php
 $settingButton = $LANG["service_settings"] ; $new = xcape($conn, $_GET["new"]); if($new=='true'){ $settingButton = $LANG["skip"]; } ?>
	  
	  
	  
	  <?php
 $new = xcape($conn, $_GET["new"]); if(empty($new)){ $new = "false"; } ?>
 
 
 <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
            
                  
			     <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 custom-form-control">
                    <div class="card-panel  hoverable">
					     <p class=""><?php echo $LANG["gateway_setup"];?> - <?php echo $serviceValue["display_name"];?>  </p>
					  <div class="divider py-0 my-0"></div>
                      <div class="row">
                          <form class=" row col s12" onsubmit="return ajaxRequest(this,'../../processor/service_gateway.php');" method="post" action="#" >
						<input name="id" type="hidden" value="<?php echo $id; ?> " />
						<input name="new" type="hidden" value="<?php echo $new; ?> " />
						 <?php  $sql = "SELECT id, display_name FROM service_gateway ORDER BY display_name ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $select = ""; $id = $row["id"]; $displayName = $row["display_name"]; if($id == $serviceValue["gateway"]){ $select = "selected"; } $gatewayOption = "<option   $select  value=\"$id\" > $displayName </option>".$gatewayOption ; ?>
						
                                      
                                                
                                          <?php } ?> 
						

                                              
                                        <div class="row col s12" >
                                           <div class="input-field col s12" >

                                               <select name="gateway">
                                                   <option value=""><?php echo $LANG["select_one_option"];?></option>
                                                 <?php echo $gatewayOption ?>
                                                </select>
                                           </div>
                                         </div>      
                                                
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right" type="submit" ><?php echo $LANG["save"]?>
                                  <i class="material-icons right">save</i>
                                </button>
                              </div>
                            </div>
                             
                              <?php  }else{ openAlert($LANG["no_record_found"]); echo $LANG["no_record_found"]; ?>
                                                <a href="../gateway/new.php" class="btn waves-effect waves-light right"  ><?php echo $LANG["create_new"]?>
                                  <i class="material-icons right">add</i>
                                </a>              
                              <?php
 } ?>
                                                
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>
		
		
		 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
        <li><a href="../gateway/new.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new"]) ?> (<?php echo ucfirst($LANG["gateway_setup"]) ?>)" class="btn-floating   tooltipped"><i class="material-icons">http</i></a></li>
      <li><a href="setting.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="plan.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_plan"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">subscriptions</i></a></li>
      <li><a href="form.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="view.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
      
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>


