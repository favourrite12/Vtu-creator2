 <?php include "../../include/ini_set.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>  
  <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 <title><?php echo $LANG["gateway_configuration"] ;?></title>
 
  <section id="content">
          <!--start container-->
          <div class="container">
           
            <section id="content">
        
         <p id="scroll" class="caption"><?php echo $LANG["gateway_configuration"] ;?> 
			  </p>
			   <div class="divider"></div> 
			
			
			
			
			
			 <div class="card-panel  hoverable ">
 	<?php	 $sql = "SELECT * FROM service_gateway  ORDER BY display_name ASC"; $result = $conn->query($sql); if ($result->num_rows > 0) { ?>				
   <table class="bordered highlight">
        <thead>
          <tr>
              <th> <?php echo $LANG["display_name"]?></th>
    
              <th rowspan="5"> <?php echo $LANG["actions"]?></th>
          </tr>
        </thead>
        <tbody>   
		
	<?php
 while($row = $result->fetch_assoc()) { $id = $row["id"]; $displayName = $row["display_name"]; $value = htmlspecialchars_decode($row["value"]); $type = $row["type"]; $active = $row["active"]==1?ucfirst($LANG["active"]):ucfirst($LANG["disabled"]); echo "<tr>
            <td>$displayName</td>
            <td>
			
			<a class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".$LANG["service_overview"]."\" href=\"view.php?id=$id\"><i class=\"material-icons right\">visibility</i></a></td>
			  <td><a class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["settings"])."\" href=\"setting.php?id=$id\"><i class=\"material-icons right\">settings</i></a></td>
                          <td><a href=\"javaScript:void(0)\" onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"].'('.$LANG["copy_gateway"].')')."','../../processor/gateway_copy.php?id=$id','','','POST','info')\" class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["copy_gateway"])."\"><i class=\"material-icons right\">content_copy</i></a></td>
			  <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_service_gateway.php?id=$id')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			</td>

          </tr>
			"; } }else{ openAlert($LANG["no_record_found"]); echo $LANG["no_record_found"]; } ?>
			
			
		</tbody>
      </table>
            	
		</div>	 


			
			
<div class="fixed-action-btn">
    <a href="new.php" class="btn-floating btn-large tooltipped btn" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new"]) ?>" >
      <i class="large material-icons">add</i>
    </a>
  </div>
            <!--work collections end-->
            
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
		