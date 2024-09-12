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
	   
	   $sql = "SELECT * FROM category WHERE id='$id' OR name='$id'";
		 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			$categoryValue = $result->fetch_assoc();
		}else{
			$categoryValue["notFound"] = true;
		}
			//print_r($categoryValue);
	  ?>
	  
	   
	
 
 
 
 <title><?php echo $LANG["edit_service_category"] ;?>  - <?php echo $categoryValue['display_name'] ;?></title>
  <section id="content">
         <p id="scroll" class="caption"><?php echo $LANG["edit_service_category"] ;?>  - <?php echo $categoryValue['display_name'] ;?> </p>
              <div class="divider"></div>
        
          <div class="container flexbox">
            <div class="section" >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable ">
                      <div class="row">
                        <form  class="col s12 my12" onsubmit="return ajaxRequest(this,'../../processor/edit_service_category.php');">
						 <input name="id" value="<?php echo $categoryValue["id"] ?>" type="hidden" >
						  
						
						
						
						
						 <div class="row">
							
						  
						  
						  <div class="row">
							<div class="input-field col s12" >
							  <input value="<?php echo $categoryValue["display_name"]?>" id="displayName" name="displayName" type="text">
							  <label for="displayName"><?php echo $LANG["display_name"] ;?></label>
							  </div>
						  </div> 
						  
						  <div class="row" title="Enter Service Name">
							<div class="input-field col s12" >
							  <input value="<?php echo $categoryValue["name"]?>" id="name" name="name" type="text" required >
							  <label for="name"><?php echo $LANG["name_unique_id"] ;?></label>
							  </div>
						  </div> 
						  
						 
						  
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG["save"] ;?>
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
              </div>
        </section>
      
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>