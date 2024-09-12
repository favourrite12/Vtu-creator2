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
	   
	   $sql = "SELECT 
	   id, 
	   display_name,
	   html_tag
	   
	   FROM service WHERE id='$id' OR name='$id'";
		 
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
 
 
 
 


 <section id="content">
	  
          <div class="container">
            <div class="section" >
             
             
             <div class="caption"><?php echo $LANG['html_tag_description']?></div>
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div class="card-panel  hoverable">
					
					
					<div id="htmlTagContainer" style="display:none">
						  <?php echo $LANG["preview"] ;?>					  
						  <div id="htmlTagSource" class="lg-text-input">
						  </div>
						     <div class="divider"></div>   
					</div>
					
                      <div class="row">
					  
					  
                        <form action="#"   onsubmit="return ajaxRequest(this,'../../processor/service_setting_advance.php');" >
						 
						  <input name="service" value="<?php echo $serviceValue['id']; ?>" type="hidden" >
						 
						 
						
						 
							<div id="htmlTagEditor" class="input-field">
							  <textarea  name="htmlTag" id="htmlTag" class="materialize-textarea lg-text-input"><?php echo htmlspecialchars_decode($serviceValue['html_tag']); ?></textarea>
							  <label for="htmlTag"><?php echo $LANG["html_tag"] ;?></label>
							</div>
						 
				           

						  
						   
						
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button type="button" onclick="htmlTagPreview('htmlTagEditor','htmlTagContainer','htmlTagSource','visibility-icon')" class="btn waves-effect waves-light  left" type="submit" ><?php echo $LANG['preview']; ?>
                                  <i id="visibility-icon" class="material-icons right">visibility</i>
                                </button>
								
								<button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['save']; ?>
                                  <i class="material-icons right">save</i>
                                </button>
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
						  function htmlTagPreview(i,c,s,b=""){
						      if(getID(c).style.display==="none"){
								  $("#"+c).show("slow","swing",function(){
									  if(!b==""){
									      getID(b).innerHTML = "visibility_off";
									  }
									  
								  });
								  
								  $("#"+i).hide("slow");
								  getID(s).innerHTML = getId("htmlTag").value;
							  }else{
								  $("#"+i).show("slow","swing",function(){
									  if(!b==""){
									   getID(b).innerHTML = "visibility";
									  }
								  });
								  $("#"+c).hide("slow");
								  
							  }
						  }
						  </script> 
						  
						  
						  
						  
						  
						  
						  
 
 
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="setting.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">settings</i></a></li>
      <li><a href="gateway.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["gateway_edit"]) ?>" class="btn-floating   tooltipped"><i class="material-icons">http</i></a></li>
      <li><a href="plan.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_plan"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">subscriptions</i></a></li>
      <li><a href="form.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["new_form_field"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="view.php?id=<?php echo  $serviceValue["id"]  ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["service_overview"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
		
 
 
 </div>
 </div>
 <?php include "../../include/right-nav.php"; ?>
 <?php include "../include/footer.php"; ?>