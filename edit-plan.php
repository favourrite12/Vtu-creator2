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
	   
	   $sql = "SELECT * FROM plans WHERE id='$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$servicePlan = $result->fetch_assoc();
		}else{
			$servicePlan["notFound"] = true;
		}
		
		
		
		$id = $servicePlan["id"];
		$displayName = $servicePlan["display_name"];
		$value = $servicePlan["value"];
		$price = $servicePlan["price"];
		$active = $servicePlan["active"];
		$service = $servicePlan["service"];
		
			//print_r($servicePlan);
	  ?>
	  
	   <?php 
	   
	    
	   $sql = "SELECT display_name FROM service WHERE id='$service'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$serviceName = $result->fetch_assoc();
			$serviceName = $serviceName["display_name"];
		}
	   ?>
	
 
 
 
 <title><?php echo $LANG["edit_plan"] ;?>  - <?php echo $servicePlan['display_name'] ;?></title>
  <section id="content">
         <p id="scroll" class="caption"><?php echo $LANG["edit_plan"] ;?>  - <a class="btn-flat btn-small" href="view.php?id=<?php echo $service?>"><?php echo $serviceName ?></a> - <?php echo $servicePlan['display_name'] ;?> <a href="plan.php?id=<?php echo $service?>"> <button  class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["create_new_plan"] ;?>
                                  <i class="material-icons left">add</i>
                                </button>
								</a>
								</p>
              <div class="divider"></div>
        
          <div class="container flexbox">
            <div class="section" >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable ">
                      <div class="row">
                        <form  class="col s12 my12" onsubmit="return ajaxRequest(this,'../../processor/edit_service_plan.php',getID('scroll'));">
						 <input name="id" value="<?php echo $id ?>" type="hidden" >
						  
						
						
						
						
						 <div class="row">
							
						  
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input  value="<?php echo $displayName; ?>" id="name" name="displayName" type="text">
							  <label for="name"><?php echo $LANG["display_name"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row" >
							<div class="input-field col s12" >
                                                            <input value="<?php echo $value; ?>"  id="value" name="value" type="text" required >
							  <label for="value"><?php echo ucfirst($LANG["value"]) ;?></label>
							  </div>
						  </div> 
						  
						 
						  
						  
						  
						  <div class="row" title="">
							<div class="input-field col s12" >
							  <input value="<?php echo $price; ?>" id="name" name="price" type="number" >
							  <label for="name"><?php echo $LANG["price"] ;?> </label>
							  </div>
						  </div> 
						  
						  <div class="switch col s6" >
						  <br/>
							 <div class="switch">
							<label>
							<?php echo ucfirst($LANG["active"]) ;?>
							  <input <?php if($active==1){echo "checked" ;} ?> value="1" type="checkbox" name="active">
							  <span class="lever"></span>
							</label>
						  </div>
						  </div> 
						  
                          
                            <div class="row">
                              <div class="input-field col s6">
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
      <li><a href="form.php?id=<?php echo  $service  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="setting.php?id=<?php echo  $service  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="view.php?id=<?php echo  $service  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
	
 
 
 
 
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>