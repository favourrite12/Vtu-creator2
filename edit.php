<?php include '../../include/ini_set.php';?>
<?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>

<?php include '../../include/filter.php';?>

 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["slider"]);
 
     
?>
<?php 
$id = xcape($conn, $_GET['id']);

 $sql = "SELECT * FROM slider WHERE id = '$id'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	$id = $row['id'];
	$description = $row['description'];
	$title = $row['title'];
	$active = $row['active'];
	$order = $row['slide_order'];
	$src = $row['src'];
	
		}
} else {
    $infoNotFound=true;
}
?>

<?php				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = xcape($conn, $_POST['title']);
	$src = xcape($conn, $_POST['src']);
	$description = xcape($conn, $_POST['description']);
	$id = xcape($conn, $_POST['id']);
	$order = xcape($conn, $_POST['order']);
	$active = xcape($conn, $_POST['active']);
	$align = xcape($conn, $_POST['align']);
	
	 
	$regDate = time(); 
	$prc = 1;

	
	//print_r($_POST);
	
	
		
	 if($prc ==1){
	 
    
	$sql = "UPDATE slider SET
		title = '$title',		
		description = '$description',
		active = '$active',
		align = '$align',
		slide_order = '$order'
		WHERE id = '$id';
   ";
 
	 if ($conn->query($sql) === TRUE) {
			openAlert($LANG["changes_saved_successfully"],$LANG["success"],"success");
			} else {
				openAlert($conn->error,$LANG["an_error_occurred"],"error");
				
			}
}
echo "<script>
history.pushState(null, '', location.href+'?id=$id');
</script>";
}	
?>

<title><?php echo ucfirst($LANG["edit"]);?> - <?php echo ucfirst($title);?></title>
		 <section id="content">
        
        
          <div class="container flexbox">
            <div class="section" >
              <p class="caption"><?php echo ucfirst($LANG["edit"]);?> - <?php echo ucfirst($title);?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 ">
                    <div class="card-panel  hoverable ">


<section class="container">

	<form class="row  flex-items-sm-center justify-content-center overflow-hidden py-3" method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' >
		<div class="col s12 m-0 p-0"><img src="../../uploads/<?php echo $src ;?>" class="img-fluid right img-thumbnail h-25 m-0 p-0"></div>
	<div class="col-sm-12 row">
		<div class="col s12 form-group">
		<?php echo $output; ?>
		</div>
			<div class="col s12 form-group">
			
			</div>
			<input type="hidden" value="<?php echo $id;?>" name="id"/>
			<input type="hidden" value="<?php echo $src;?>" name="src"/>
             <div class="input-field col s4">
                    <select name="align" required>
                    <option <?php echo $align=="center-align"? "selected": "";?> value="center-align"><?php echo $LANG["center"] ;?></option>
                    <option <?php echo $align=="left-align"? "selected": "";?> value="left-align"><?php echo $LANG["left"] ;?></option>
                    <option <?php echo $align=="right-align"? "selected": "";?> value="right-align"><?php echo $LANG["right"] ;?></option>

                    </select>
                    <label><?php echo $LANG["caption_position"] ;?></label>
              </div>
			
              <div class="col s6 form-group">
                  <br/>
			<input placeholder="<?php echo $LANG["slider_order_priority"];?>" type="number" value='<?php echo $order;?>'  class="form-control form-control-sm" name="order" id="order"  >
			 <?php echo $orderError;?>
		</div>
	
		<div class="custom-control custom-switch col-sm-2">
		<br/>
		<br/>
		<input checked name="active" type="checkbox" value="1" class="custom-control-input" id="active">
		<label class="custom-control-label" for="active"><?php echo $LANG["active"];?></label>
		</div>          
                        
                        
                        
		<div class="col s12 input-field">
			
			<input type="text" value='<?php echo $title;?>' class="form-control form-control-sm" name="title" id="title"  >
		   <label for="" class="form-control-label"><?php echo ucfirst($LANG["title"]); ?></label>
		   <?php echo $titleError;?>
		
		</div>

		<div class="col s12 input-field">
			<label for="" class=""><?php echo ucfirst($LANG["description"]); ?></label>
			<textarea  class="materialize-textarea" name="description" id="description" ><?php echo $description;?></textarea>
			 <?php echo $descriptionError;?>
		</div>
                        
                        
               
		
		
                        
              
			
		<div class="col s12 form-group">
			<button class="btn btn-md btn-success right"><?php echo $LANG["save"];?></button>
		   
		  
		</div>	
		
		   
	</div>
		
			
		
		
	</form>
	
</section>
		

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
      <li><a href="new.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["upload_new_slider"]) ?>" class="btn-floating tooltipped"><i class="material-icons">cloud_upload</i></a></li>
      <li><a href="index.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		