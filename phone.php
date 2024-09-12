  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/pagination.php'; $page = new pagination($conn);?>

 
 
 
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["users"]);
?>
 
 

		
		
		 
		 
 <title><?php echo $LANG["registered_user"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"> <?php echo $LANG["registered_user"]; ?> - <?php echo $LANG["phone"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
		
<section class="container">
			   
	<div class="row flex-items-sm-center">
            
 <?php

  $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM users")->num_rows;
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

 
		  $sql = "SELECT phone FROM users ORDER BY name LIMIT $start,$stop";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
                            echo  '<textarea class="materialize-textarea lg-text-input" >';
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $phone =   $row["phone"];
					echo "$phone,";
					 
				}
                            echo   '</textarea>';
			}else{
                            openAlert($LANG["no_record_found"]);
			}
		?>
          

</div>
     <?php $page->getPage($currentPage, $totalQuery)?>
</section>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		
		
		