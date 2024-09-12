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
	   
	   $sql = "SELECT name, id, display_name FROM service WHERE id='$id' OR name = '$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
			//print_r($serviceValue);
			$id = $serviceValue["id"];
	  ?>
	  
 
 
 
 <title><?php echo $LANG["new_form_field"] ;?>  - <?php echo $serviceValue['display_name'] ;?></title>
  <section id="content">
        
         <p id="scroll" class="caption"><?php echo $LANG["new_form_field"] ;?><a class="btn-flat btn-small" href="view.php?id=<?php echo $id ?>" ><?php echo $serviceValue['display_name'] ;?></a> 
		      <a href="plan.php?id=<?php echo $id?>"> 
		 <button  class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["create_plan"] ;?>
                      <i class="material-icons left">view_module</i> 
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
                        <form  class="col s12 my12" onsubmit="return ajaxRequest(this,'../../processor/new_service_form.php',getID('scroll'));">
						 <input name="service" value="<?php echo $id ?>" type="hidden" >
						  
						<div class="row" title="">
								<div class="input-field col s12">
								<select name="type" required>
								 <option value="text">text</option>
								 <option value="password">password</option>
								 <option value="option" >option</option>
								 <option value="hidden">hidden</option>
								 <option value="email">email</option>
								 <option value="date">date</option>
								 <option value="number">number</option>
								 <option value="textarea">textarea</option>
								 <option value="file">file</option>
								 <option value="html"><?php echo $LANG["html_tag"]?></option>
								 <option value="image">image</option>
								 <option value="checkbox">checkbox</option>
								 <option value="switch">switch</option>
								 <option value="radio">radio</option>
								 <option value="reset">reset</option>
                                                                 <option value="custom"> <?php echo strtoupper($LANG["custom_form_field_type"]) ;?></option>
								 <hr/>
								
								
								 <option value="header"> <?php echo strtoupper($LANG["send_via_http_header"]) ;?></option>
								 <option value="server"> <?php echo strtoupper($LANG["use_in_server_side"]) ;?></option>
								 <option value="curl_param"> <?php echo strtoupper($LANG["curl_param"]) ;?></option>
					           
								</select>
								<label><?php echo $LANG["input_type"] ;?></label>
						      </div>
						</div>
						
						<div class="switch col s12" >
							 <div class="switch">
							<label>
							<?php echo $LANG["submit_required_long"] ;?>
							  <input value="1" type="checkbox" name="required">
							  <span class="lever"></span>
							</label>
						  </div>
						  </div> 
						
						 <div class="row">
							
						  
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input  id="name" name="displayName" type="text">
							  <label for="name"><?php echo $LANG["display_name"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input  id="name" name="name" type="text" required >
							  <label for="name"><?php echo $LANG["name_unique_id"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row">
							<div class="input-field col s12">
							  <textarea id="textarea1" name="value" class="materialize-textarea"></textarea>
							  <label for="textarea1"><?php echo ucfirst($LANG["value"]) ;?> (<?php echo ucfirst($LANG["optional"]) ;?>)</label>
							</div>
						  </div>
						  
						  
						  <div class="row tooltipped" data-position="bottom" data-tooltip="<?php echo $LANG["order_position_description"] ;?>">
							<div class="input-field col s12" >
							  <input  id="name" name="order" type="number" value="">
							  <label for="name"><?php echo $LANG["order_position"] ;?> </label>
							  </div>
						  </div> 
						  
						  
						  
						  
						  <div class="row" >
							<div class="input-field col s12">
							  <textarea name="description" id="textarea2" class="materialize-textarea"></textarea>
							  <label for="textarea2"><?php echo $LANG["description"] ;?></label>
							</div>
						  </div>
						  
						  <div class="row" title="">
							<div class="input-field col s12" >
							  <input  id="name" name="maxLen" type="number" value="">
							  <label for="name"><?php echo $LANG["max_len"] ;?> </label>
							  </div>
						  </div>  
						  
						  
						  
						  <div class="row tooltipped" data-position="bottom" data-tooltip="<?php echo $LANG["custom_class_name_defined_on_your_custom_css"] ;?> ">
							<div class="input-field col s12" >
							  <input  id="name" name="className" type="text" value="">
							  <label for="name"><?php echo $LANG["custom_class_name"] ;?> </label>
							  </div>
						  </div> 
						  
						  <div class="row tooltipped" data-position="bottom" data-tooltip="<?php echo $LANG["regular_expression_for_validation"];?>">
							<div class="input-field col s12" >
							  <input  id="name" name="regx" type="text" value="">
							  <label for="name"><?php echo $LANG["pattern_regx"] ;?></label>
							  </div>
						  </div>
						  
						  <div class="row tooltipped" data-position="bottom" data-tooltip="<?php echo $LANG['custom_attribute_pair_with_value'];?>">
							<div class="input-field col s12" >
							  <textarea class="materialize-textarea"  id="name" name="attribute" type="text"></textarea>
							  <label for="name"><?php echo $LANG["custom_attribute"] ;?></label>
							  </div>
						  </div> 
						  
						  
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["create"] ;?>
                                  <i class="material-icons right">add</i>
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
      <li><a href="advance.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["html_tag"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">code</i></a></li>
      <li><a href="gateway.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["gateway_edit"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">http</i></a></li>
      <li><a href="plan.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_plan"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">subscriptions</i></a></li>
      <li><a href="setting.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="view.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
	
	  
	  
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>