 <?php include "../../include/ini_set.php"; ?>
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
	   
	   $sql = "SELECT name, id, display_name FROM service WHERE id='$id' OR name='$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceValue = $result->fetch_assoc();
		}else{
			$serviceValue["notFound"] = true;
		}
		$id = $serviceValue["id"];
			
			
			//print_r($serviceValue);
	  ?>
	  
	   
	  <?php
	  $settingButton  =  $LANG["service_settings"] ;
	  $new = empty($_GET["new"])? "false" : xcape($conn, $_GET["new"]);
	  if($new=='true'){
		  $settingButton  =  $LANG["skip"];
	  }
	?>
 
 <title><?php echo $LANG["display_value"] ;?>  - <?php echo $serviceValue['display_value'] ;?></title>
  <section id="content">
         <p id="scroll" class="caption">
		    <?php echo $LANG["display_value"] ;?> 
		 </p>
              <div class="divider"></div>
        
          <div class="container flexbox">
            <div class="section" >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable ">
                      <div class="row">
                        <form  class="col s12 my12" onsubmit="return ajaxRequest(this,'../../processor/new_service_display_value.php',getID('scroll'));">
						 <input name="service" value="<?php echo $id ?>" type="hidden" >
						  
						
						
						
						
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
                          <label for="name"><?php echo ucfirst($LANG["name"]) ;?></label>
							  </div>
						  </div> 
						  
						
						  
						  <div class="switch col s6" >
						  <br/>
							 <div class="switch">
							<label>
							<?php echo ucfirst($LANG["active"]) ;?>
							  <input value="1" checked type="checkbox" name="active">
							  <span class="lever"></span>
							</label>
						  </div>
						  </div> 
						  
                          
                            <div class="row">
                              <div class="input-field col s6">
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
       <li><a href="form.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="setting.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="view.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
	
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>