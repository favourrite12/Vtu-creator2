 <?php include "../../include/ini_set.php" ;?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
 <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 
 
  <?php  $id = xcape($conn,$_GET["id"]); $sql = "SELECT * FROM gateway_form WHERE id='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } $id = $serviceValue["id"]; $name = $serviceValue["name"]; $type = $serviceValue["type"]; $value = $serviceValue["value"]; $service= $serviceValue["gateway"]; ?>

 <title><?php echo $LANG["edit_form_field"] ;?>  - <?php echo $serviceValue['name'] ;?></title>
  <section id="content">
        
         <p id="scroll" class="caption"><?php echo $LANG["custom_value"] ;?> <?php echo $serviceValue['name'] ;?> <a href="form.php?id=<?php echo $service?>"> <button  class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["custom_value"] ;?>
                      <i class="material-icons left">add</i> 
					</button>
				</a>
			  </p>
			   <div class="divider"></div>
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
                        <form  class="col s12 my12" onsubmit="return ajaxRequest(this,'../../processor/edit_gateway_form.php',getID('scroll'));">
						 <input name="service" value="<?php echo $id ?>" type="hidden" >
						<div class="row" title="">
								<div class="input-field col s12">
								<select name="type" required>
								 <option value="CURLOPT_POSTFIELDS" <?php if($type=="CURLOPT_POSTFIELDS"){echo "selected";}?> >CURLOPT_POSTFIELDS</option>
								 <option <?php if($type=="header"){echo "selected";}?> value="header"> <?php echo strtoupper($LANG["send_via_http_header"]) ;?></option>
								 <option <?php if($type=="curl_param"){echo "selected";}?> value="curl_param"> <?php echo strtoupper($LANG["curl_param"]) ;?></option>
					           
								</select>
								<label><?php echo $LANG["type"] ;?></label>
						      </div>
						</div>
						
						
						
						 <div class="row">
							
						  
						 
						  <div class="row" >
							<div class="input-field col s12" >
							  <input value="<?php echo $name; ?>" id="name" name="name" type="text" required >
							  <label for="name"><?php echo $LANG["name"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row" >
							<div class="input-field col s12">
							  <textarea id="textarea1" name="value" class="materialize-textarea"><?php echo $value; ?></textarea>
							  <label for="textarea1"><?php echo $LANG["value"] ;?></label>
							</div>
						  </div>
						  
						  
						
						  
						  
						  
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["edit"] ;?>
                                  <i class="material-icons right">edit</i>
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
              </div>
        </section>
      
 
 
 
 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="form.php?id=<?php echo $service ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="setting.php?id=<?php echo $service ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="view.php?id=<?php echo $service ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
	
 
 
 
 
 
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
	
		  
	 

  </body>
</html>