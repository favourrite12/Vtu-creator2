 <?php include "../../include/ini_set.php"; ?>
 <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>  
 <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 
   <?php  $id = xcape($conn,$_GET["id"]); $sql = "SELECT * FROM service_gateway WHERE id='$id'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $serviceValue = $result->fetch_assoc(); }else{ $serviceValue["notFound"] = true; } ?>
	  
	 <title> <?php echo $serviceValue["display_name"]?> - <?php echo $LANG["overview"]?> </title>
	 
   
	  

  <section id="content">
          <!--start container-->
          <div class="container">
            <!--card stats start-->
           	
			
            <!--card widgets start-->
            <div  id="card-widgets">
              <div class="row ">
			  
                  <div class="col s12 ">
                  <ul id="task-card" class="collection   hoverable">
                     <li class="collection-item teal accent-4 white-text">
                    <?php echo strtoupper($serviceValue["display_name"])?> -  <?php echo strtoupper($LANG["overview"])?>
                    </li>
                    
                    
                 <?php  foreach ($serviceValue as $key => $value) { if($key !="id"){ $keyName = $LANG[$key]; if(empty($keyName)){ $keyName = $key; } if($keyName=="ref_key_name"){ $keyName = $LANG["key_name"]; } elseif($keyName=="ref_key_type"){ $keyName = $LANG["type"]; $value = $LANG["$value"]; } elseif($keyName=="ref_key_len"){ $keyName = $LANG["max_len"]; } elseif($keyName=="ref_key_absolute_len"){ $keyName = $LANG["absolute_len"]; $value = $value == 1?$LANG["yes"]:$LANG["no"]; } ?>
                    
                    <li class="collection-item">
                      <?php echo $keyName ?>
                        <span class="secondary-content">
                          <?php echo $value ?>
                        </span> 
                      
                    </li>    
                    
                 <?php	 } } ?>	
                
					
                  </ul>
                </div>
				
				

               
               
              </div>
            </div>
            <!--card widgets end-->
    <div class="card-panel  hoverable ">
   <p class="card-title"><?php echo $LANG["form_field_list"]?></p>
  <?php	 $service = $serviceValue["id"]; $sql = "SELECT * FROM gateway_form  WHERE gateway='$service' ORDER BY name ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { ?>
   <table class="highlight">
        <thead>
          <tr>
              
              <th> <?php echo $LANG["name"]?></th>
              <th> <?php echo $LANG["type"]?></th>
            <th> <?php echo $LANG["value"]?></th>
              <th rowspan="4"> <?php echo $LANG["action"]?></th>
          </tr>
        </thead>
        <tbody>   
		
		<?php
 while($row = $result->fetch_assoc()) { $id = $row["id"]; $value = htmlspecialchars_decode($row["value"]); $type = $row["type"]; $name = $row["name"]; echo "<tr>
           
            <td>$name</td>
            <td>$type</td>
            <td>$value</td>
            <td>
			
	          <td><a href=\"edit-form.php?id=$id\" class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["edit"])."\" href=\"setting.php?id=$id\"><i class=\"material-icons right\">edit</i></a></td>
			  <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_gateway_form.php?id=$id')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			
			
			</td>
             </tr>
			"; } } ?>
			
			
		    </tbody>
                   </table>
            	
		</div>	  
		
			
						
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large">
      <i class="large material-icons">more_vert</i>
    </a>
    <ul>
      <li><a href="form.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["custom_value"]) ?>" class="btn-floating tooltipped"><i class="material-icons">text_fields</i></a></li>
      <li><a href="setting.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["settings"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">settings</i></a></li>
     <li><a href="edit.php?id=<?php echo $serviceValue["id"] ?>" data-position="left" data-tooltip="<?php echo ucfirst($LANG["edit"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">edit</i></a></li>
    </ul>
  </div>
		
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
		    <!-- END MAIN -->
			</div>
			</div>
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
	
	
  </body>
</html>
		