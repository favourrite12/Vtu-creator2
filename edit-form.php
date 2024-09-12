 <?php include "../../include/ini_set.php" ;?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["service"]);  
?>
 
 
  <?php 
	   $id = xcape($conn,$_GET["id"]);
	   
	   $sql = "SELECT * FROM form WHERE id='$id' OR name = '$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
			$id = $serviceValue["id"];
			$name = $serviceValue["name"];
			$displayName = $serviceValue["display_name"];
			$service = $serviceValue["service"];
			$type = $serviceValue["type"];
			$value = $serviceValue["value"];
			$regx = $serviceValue["regx"];
			$description = $serviceValue["description"];
			$className = $serviceValue["class_name"];
			$attribute = $serviceValue["attribute"];
			$maxLen = $serviceValue["max_len"];
			$required = $serviceValue["required"];
			$orderKey = $serviceValue["order_key"];
	  ?>
	  
	
 
 

 <title><?php echo $LANG["edit_form_field"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
  <section id="content">
        
         <p id="scroll" class="caption"><?php echo $LANG["edit_form_field"] ;?> <?php echo $serviceValue['display_name'] ;?> <a href="form.php?id=<?php echo $service?>"> <button  class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["new_form_field"] ;?>
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
                        <form  class="col s12 my12" onsubmit="return ajaxRequest(this,'../../processor/edit_service_form.php',getID('scroll'));">
						 <input name="service" value="<?php echo $id ?>" type="hidden" >
						<div class="row" title="">
								<div class="input-field col s12">
								<select name="type" required>
								 <option value="text" <?php if($type=="text"){echo "selected";}?> >text</option>
								 <option value="password" <?php if($type=="password"){echo "selected";}?> >password</option>
								 <option value="option" <?php if($type=="option"){echo "selected";}?> >option</option>
								 <option option="hidden" <?php if($type=="hidden"){echo "selected";}?> >hidden</option>
								 <option value="email" <?php if($type=="email"){echo "selected";}?> >email</option>
								 <option value="date" <?php if($type=="date"){echo "selected";}?> >date</option>
								 <option value="textarea" <?php if($type=="textarea"){echo "selected";}?> >textarea</option>
								 <option value="number" <?php if($type=="number"){echo "selected";}?> >number</option>
								 <option value="file" <?php if($type=="file"){echo "selected";}?> >file</option>
								 <option value="html" <?php if($type=="html"){echo "selected";}?>  ><?php echo $LANG["html_tag"]?></option>
								 <option value="image" <?php if($type=="image"){echo "selected";}?> >image</option>
								 <option value="checkbox" <?php if($type=="checkbox"){echo "selected";}?> >checkbox</option>
								 <option value="switch" <?php if($type=="switch"){echo "selected";}?> >switch</option>
								 <option value="radio" <?php if($type=="radio"){echo "selected";}?> >radio</option>
								 <option value="reset" <?php if($type=="reset"){echo "selected";}?> >reset</option>
                                                                 <option value="custom" <?php if($type=="custom"){echo "selected";}?> > <?php echo strtoupper($LANG["custom_form_field_type"]); ?></option>
								 <hr class="pink"/>
								
								 <option <?php if($type=="header"){echo "selected";}?> value="header"> <?php echo strtoupper($LANG["send_via_http_header"]) ;?></option>
								 <option <?php if($type=="server"){echo "server";}?> value="server"> <?php echo strtoupper($LANG["use_in_server_side"]) ;?></option>
								 <option <?php if($type=="curl_param"){echo "curl_param";}?> value="curl_param"> <?php echo strtoupper($LANG["curl_param"]) ;?></option>
					           
								</select>
								<label><?php echo $LANG["type"] ;?></label>
						      </div>
						</div>
						
						<div class="switch col s12" >
							 <div class="switch">
							<label>
							<?php echo $LANG["submit_required_long"] ;?>
							  <input <?php if($required=="1" && $required==1){echo "checked";}?>  value="1" type="checkbox" name="required">
							  <span class="lever"></span>
							</label>
						  </div>
						  </div> 
						
						 <div class="row">
							
						  
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input value="<?php echo $displayName; ?>"  id="name" name="displayName" type="text">
							  <label for="name"><?php echo $LANG["display_name"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row" >
							<div class="input-field col s12" >
							  <input value="<?php echo $name; ?>" id="name" name="name" type="text" required >
							  <label for="name"><?php echo $LANG["name"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row tooltipped" data-possition="bottom" data-tooltip="<?php echo $LANG['use_lajela_tag']?>">
							<div class="input-field col s12">
							  <textarea id="textarea1" name="value" class="materialize-textarea"><?php echo $value; ?></textarea>
							  <label for="textarea1"><?php echo $LANG["value"] ;?></label>
							</div>
						  </div>
						  
						  
						  <div class="row tooltipped" data-possition="bottom" data-tooltip="<?php echo $LANG["order_position_description"] ;?>">
							<div class="input-field col s12" >
							  <input  id="name" name="order" type="number" value="<?php echo $orderKey; ?>">
							  <label for="name"><?php echo $LANG["order_position"] ;?> </label>
							  </div>
						  </div> 
						  
						  
						  
						  
						  <div class="row" >
							<div class="input-field col s12">
							  <textarea name="description" id="textarea2" class="materialize-textarea"><?php echo $description; ?></textarea>
							  <label for="textarea2"><?php echo $LANG["description"] ;?></label>
							</div>
						  </div>
						  
						  <div class="row" >
							<div class="input-field col s12" >
							  <input  id="name" name="maxLen" type="number" value="<?php echo $maxLen; ?>" >
							  <label for="name"><?php echo $LANG["max_len"] ;?> </label>
							  </div>
						  </div>  
						  
						  
						  
						  <div class="row tooltipped" data-possition="bottom" data-tooltip="<?php echo $LANG["custom_class_name_defined_on_your_custom_css"] ;?> ">
							<div class="input-field col s12" >
							  <input  id="name" name="className" type="text" value="<?php echo $className; ?>">
							  <label for="name"><?php echo $LANG["custom_class_name"] ;?> </label>
							  </div>
						  </div> 
						  
						  <div class="row tooltipped" data-possition="bottom" data-tooltip="<?php echo $LANG["regular_expression_for_validation"];?>">
							<div class="input-field col s12" >
							  <input  id="name" name="regx" type="text" value="<?php echo $regx; ?>">
							  <label for="name"><?php echo $LANG["pattern_regx"] ;?></label>
							  </div>
						  </div>
						  
						  <div class="row tooltipped" data-possition="bottom" data-tooltip="<?php echo $LANG['custom_attribute_pair_with_value'];?>">
							<div class="input-field col s12" >
							    <textarea name="attribute" id="textarea2" class="materialize-textarea"><?php echo $attribute; ?></textarea>
							  <label for="name"><?php echo $LANG["custom_attribute"] ;?></label>
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
      <li><a href="advance.php?id=<?php echo $service ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["html_tag"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">code</i></a></li>
      <li><a href="gateway.php?id=<?php echo $service ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["gateway_edit"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">http</i></a></li>
      <li><a href="plan.php?id=<?php echo  $service  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_plan"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">subscriptions</i></a></li>
      <li><a href="form.php?id=<?php echo  $service ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="setting.php?id=<?php echo  $service  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="view.php?id=<?php echo  $service  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
	
 
 
 
 
 
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
	
		  
	 

  </body>
</html>