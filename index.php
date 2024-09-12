  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 
 
 
 
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["admin"]);
?>
 
 
 
<script>
 function confirmAction(event,msg=""){
	 if(msg == ""){
	   var msg = "<?php echo $LANG["confirm_this_action"] ?>";
	 }
	 var r =  confirm(msg);
	 if(!r){
	   event.preventDefault()
	 }
	}
</script>
		
		
		 
		 
 <title><?php echo $LANG["configuration"]; ?> |  <?php echo $LANG["admin_manager"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"]; ?> |  <?php echo $LANG["admin_manager"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
		
<section class="container">
			   
	<div class="row flex-items-sm-center">
	<table class="table">
 <?php

		  $sql = "SELECT id, name, status FROM admin";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $name =   $row["name"];
				   $id =   $row["id"];
					echo "<tr>
					      <td>$sn</td>
					      <td>$name</td>
					      <td>$status</td>
					      <td><a class=\"btn btn-success  py-0\" href=\"edit.php?id=$id\">{$LANG['edit']}</a></td>
					      <td><a class=\"btn btn-secondary  py-0\" href=\"block.php?id=$id\">{$LANG['block_unblock']}</a></td>
					       <td><button class=\"btn btn-danger btn-sm py-0\"  onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_admin.php?id=$id&token=$token')\">{$LANG['delete']}</button></td>
					     </tr>";
					 
				}
			}else{
				//echo "No New Letter Created";
			}
		?>
	</table>	 

</div>
</section>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>



 <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_admin"]) ?>">
     <a href="create.php" class="btn-floating btn-large">
      <i class="large material-icons">person_add</i>
    </a>
  </div>

<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		
		
		