 <?php include "../include/ini_set.php"; ?>
 <?php include "include/checklogin.php"; ?>
 <?php include "include/header.php"; ?>
 <?php include "../include/data_config.php"; ?>
 <?php include "../include/filter.php"; ?>  
<?php 
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["payment_method"]);
?>
 
   <?php 
		$serviceNumber = $conn->query("SELECT api FROM service")->num_rows;
		$categoryNumber = $conn->query("SELECT id FROM category")->num_rows;
		$formNumber = $conn->query("SELECT id FROM form")->num_rows;
		$plansNumber = $conn->query("SELECT id FROM plans")->num_rows;
	?>
 
 <title><?php echo $LANG["payment_gateway"]?></title>
 
 <section id="content" class="flexbox">
          <!--start container-->
          <div class="container custom-form-control">
           
            
			
			
			
			
			
			 <div class="card-panel  hoverable ">
                             
   
   <table class="bordered highlight table-responsible">
        <thead>
          <tr>
              <th> <?php echo $LANG["display_name"]?></th>  
              <th rowspan="5"> <?php echo $LANG["actions"]?></th>
          </tr>
        </thead>
        <tbody>   
		
		<?php	
		$service =  $serviceValue["id"];
			$sql = "SELECT name,id,path_name FROM payment_gateway_data ORDER BY name ASC";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				// output data of each row
			  while($row = $result->fetch_assoc()) {
			  $id = $row["id"];
			  $displayName = $row["name"];
                          $token = base64_encode($row["path_name"]);
			 
			  
	    echo "<tr>
            <td>$displayName</td>
          
            
			     <td><button onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../processor/delete_gateway.php?id=$id&token=$token')\"  class=\"btn-flat tooltipped\" data-position=\"bottom\" data-tooltip=\"".ucfirst($LANG["delete"])."\" ><i class=\"material-icons right\">delete</i></button>
			
			</td>

          </tr>
			";
			
			  }
			}
		?>	
	  </tbody>
      </table>
            	
</div>	 
			
<div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["install_new_payment_gateway"]) ?>">
    <a href="module.php" class="btn-floating btn-large red">
      <i class="large material-icons">file_download</i>
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
	<?php include "../include/right-nav.php"; ?>
    <?php include "include/footer.php"; ?>
  </body>
</html>
		