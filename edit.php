 <?php include "../../include/ini_set.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
<?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 <title><?php echo $LANG["gateway_setup"] ?></title>
 
<!-- Form with placeholder -->


  
	 <?php  $id = xcape($conn,$_GET["id"]); $sql = "SELECT * FROM service_gateway WHERE id='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } ?>
	  
	  
   <?php
 $settingButton = $LANG["service_settings"] ; $new = xcape($conn, $_GET["new"]); if($new=='true'){ $settingButton = $LANG["skip"]; } ?>
	  
	  
	  
	  <?php
 $new = xcape($conn, $_GET["new"]); if(empty($new)){ $new = "false"; } ?>
 
 
 <section id="content">
	  
          <div class="container">
            <div class="section" >
             
            
                  
			     <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12">
                    <div class="card-panel  hoverable">
                        <p class=""><?php echo ucfirst($LANG["edit"]);?> - <?php echo $serviceValue["display_name"];?>  </p>
					  <div class="divider py-0 my-0"></div>
                      <div class="row">
                          <form class=" row col s12" onsubmit="return ajaxRequest(this,'../../processor/edit_gateway.php');" method="post" action="#" >
						<input name="id" type="hidden" value="<?php echo $id; ?> " />
						<input name="new" type="hidden" value="<?php echo $new; ?> " />
						 <?php  $sql = "SELECT * FROM link ORDER BY key_value ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $docInf = ""; $input = ""; $name = $row["name"]; $name = $LANG["$name"]; $key = $row["key_value"]; $doc = $row["doc"]; $search = $row["doc"]; if(!empty($search)){ $docInfo = " - ".$LANG["double_click_to_learn_more"] .'" ondblclick="openLink(\''.$doc.'\',true)"'; } $value = $serviceValue["$key"]; $type = $row["type"]; $option = $row["option_value"]; if($type=="text"){ $input = "<div class=\"row col s6 tooltipped\" data-position=\"bottom\" data-tooltip=\"$name $docInfo\">
									<div class=\"input-field col s12\" >
									  <input name=\"$key\" placeholder=\"$name\" id=\"$key\" type=\"text\" value=\"$value\">
									  <label for=\"$key\">$key</label>
									  </div>
								  </div>"; }else if($type=="option"){ $option = explode(",",$option); $optionValue = ""; for($x=0;$x<count($option);$x++){ $select = ""; $optionList = $option[$x]; if($serviceValue["$key"]==$optionList){ $select = "selected"; } $optionValue =" <option  $select >$optionList</option>".$optionValue; } $input = " 
								<div class=\"row col s6 tooltipped\" data-position=\"top\" data-tooltip=\"$name $docInfo\">
								<div class=\"input-field col s12\">
								<select name=\"$key\">
								 $optionValue;
								</select>
								<label>$key</label>
								</div>
							  </div>"; } else if($type=="textarea"){ $input = "<div class=\"row cols tooltipped s6\" data-position=\"top\" data-tooltip=\"$name $docInfo\">
								<div class=\"input-field col s12\" >
								  <input placeholder=\"$name\"  name=\"$key\" id=\"$key\" type=\"text\" value=\"$value\">
								  <label for=\"$key\">$key</label>
								  </div>
							  </div>"; } echo $input; } } ?>
						  
						  
						   <div class="row col s6" >
									<div class="input-field col s12" >
							  <input name="response_level" placeholder="<?php echo $LANG["response_level"];?>" id="response_level" type="text" value="<?php echo $serviceValue["response_level"] ?>">
							  <label for="response_level"><?php echo $LANG["response_level"];?></label>
							  </div>
						  </div>
						  
						  					  
						  
						     <div class="row col s6">
								<div class="input-field col s12">
								<select name="response_format">
								  <option  <?php echo $serviceValue["response_format"] =="XML" ? "selected": ""; ?> > XML</option> 
								  <option <?php echo $serviceValue["response_format"] =="JSON" ? "selected": ""; ?> >JSON</option>;
								</select>
								<label><?php echo $LANG["response_format"]?></label>
						 		</div>
							  </div>
							  
							    <div class="row col s6">
									<div class="input-field col s12" >
									  <input name="success_key" id="success_key" type="text" value="<?php echo $serviceValue["success_key"] ?>">
									  <label for="success_key"><?php echo $LANG["success_key"]?></label>
									  </div>
								</div>
								  
								 
								  
								  <div class="row col s6 tooltipped" data-position="bottom" data-tooltip="<?php echo $LANG["success_text_description"] ?>">
									<div class="input-field col s12" >
									  <input name="success_text" id="success_text" type="text" value="<?php echo $serviceValue["success_text"] ?>">
									  <label for="success_text"><?php echo $LANG["success_text"];?></label>
									  </div>
								  </div>
								  
								  <div class="row col s6">
									<div class="input-field col s12" >
									  <input name="success_code"  id="success_code" type="text" value="<?php echo $serviceValue["success_code"] ?>">
									  <label for="success_code"><?php echo $LANG["success_code"];?></label>
									  </div>
								  </div>
								  
								  <div class="row col s6">
									<div class="input-field col s12" >
									  <input name="success_code_key"  id="success_code_key" type="text" value="<?php echo $serviceValue["success_code_key"] ?>">
									  <label for="success_text"><?php echo $LANG["success_code_key"];?></label>
									  </div>
								  </div>		
			
                          
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
		
		
		 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="setting.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["setting"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="form.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["custom_value"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="view.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
      
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>


