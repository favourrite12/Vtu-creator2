          <?php include '../include/checklogin.php';?>
		<?php include '../include/header.php';?>
		 <?php include '../../include/data_config.php';?>
		 <?php include '../../include/filter.php';?>
		 <?php include '../../include/webconfig.php';?>
		 <?php 
		include '../include/admininfo.php';
		$adminInfo = adminInfo($loginAdmin,$conn);
		//print_r($adminInfo);
		checkAccess($adminInfo["web_config"]);
			 
		?>	 
 <?php

   $id = xcape($conn,$_GET["id"]);
   $sql = "SELECT * FROM web_config WHERE array_key = 'about'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	   $name =   $row["array_key"];
	   $content =   $row["value"];  
	   $title =   $row["display_name"];  
	   $description =   $row["description"];  
	}
}
?>
		
         <script src="../../create_article/ckeditor.js"></script>

 <title><?php echo $LANG["about_us"]; ?> | <?php echo $LANG["configuration"]; ?> </title>

        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"]; ?> | <?php echo $LANG["about_us"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
					
<section class="container">
			   
	<div class="row flex-items-sm-center p-3">
	<div class="col s12" id="output"><div  class="float-left"></i><small> <?php echo $LANG["copy_from_word_editor_html"]; ?> </small></i></div> <div  class="right"></i><small><?php echo $LANG["auto_saving_enable_content_save_automatically"]?> </small></i></div></div>
		  <div class="col s12 form-group">
			<h4><?php echo $LANG[$title]?> <a class="tooltipped" data-position="top" data-tooltip="<?php echo $LANG[$description]?>"><i class="material-icons">help</i></a> </h4>
			</div>
			
			 <input type="hidden" name="name" id="name" value="<?php echo $name ;?>" />
			 <div class="col s12 form-group">
				<textarea class="hide" onchange="autoSaveConfiguration()" name="content" id="editor" rows="100" cols="100" required>  <?php echo htmlspecialchars_decode($content) ;?> </textarea>
				 </div>
				 
				
				
				
				
				
				
			<div class="col s12 form-group">
				<button  class="btn btn-primary right right"  onclick="autoSaveConfiguration(true);" ><?php echo $LANG["save"]; ?> <i class="fa fa-save"></i> </button>
			  </div>
			
				
				
				 <div class="col-sm-2 form-group">
			</div>
</div>


<script>

CKEDITOR.replace( 'content', {
       on: {
        change: function( evt ) {
           autoSave();
        }
    }
} );

</script>
		
		
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>		
		
		

                  
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              </div>
        </section>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>