		<?php include '../include/checklogin.php';?>
		<?php include '../include/header.php';?>
		 <?php include '../../include/data_config.php';?>
		 <?php include '../../include/filter.php';?>
		 <?php include '../../include/webconfig.php';?>
		 <?php 
		include '../include/admininfo.php';
		$adminInfo = adminInfo($loginAdmin,$conn);
		//print_r($adminInfo);
		checkAccess($adminInfo["news_letter"]);
			     
		?>  
		 
		<script>
		function autoSave(output=false){
			var d = new Date();
			var id = document.getElementById('id').value;
			 var title = document.getElementById('title').value;
			 var content = CKEDITOR.instances.editor.getData();
			 var formData = new FormData();
		      formData.append("content",content);
			  formData.append("title",title);
			  formData.append("id",id);		
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				
				  var response = this.responseText.toString().trim(); 
				  	if(output){
						document.getElementById("output").innerHTML = response;
					}
				}
			  };
			  xhttp.open("POST", "editprocess.php?t="+d.getTime(), true);
			  xhttp.send(formData);
			  
			 return false;
		}
	</script>

		 
 <?php


   $id = xcape($conn,$_GET["id"]);
   $sql = "SELECT subject, content FROM news_letter WHERE id = '$id'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	   $title =   $row["subject"];
	   $content =   $row["content"];  
	}
}
?>
		
         <script src="../../create_article/ckeditor.js"></script>

	 <title><?php echo $LANG["configuration"];?> | <?php echo $LANG["edit_new_newsletter"];?></title>
  <section >
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"];?> | <?php echo $LANG["edit_new_newsletter"];?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
					
<section class="container">
			   
	<div class="row flex-items-sm-center py-3">
	<div class="col s12" id="output"><div  class="float-left"></i><small><?php echo $LANG['copy_from_word_editor_html']; ?></small></i></div> <div  class="right"></i><small><?php echo $LANG['auto_saving_enable_content_save_automatically']; ?></small></i></div></div>
		  <div class="col s12 form-group">
			<input id="title" onkeyup="autoSave()" class="form-control" value="<?php echo htmlspecialchars_decode($title) ;?>" required name="title" type="text" placeholder="Subject" />
			</div>
			
			 <input type="hidden" name="id" id="id" value="<?php echo $id ;?>" />
			 <div class="col s12 form-group">
				<textarea onchange="autoSave()" name="content" id="editor" rows="10" cols="80" required>  <?php echo htmlspecialchars_decode($content) ;?> </textarea>
				 </div>
				 
				
				
				
				
				
				
			<div class="col s12 form-group">
				<button type="button" class="btn btn-primary right"  onclick="ajaxConfirm('<?php echo $LANG["sending_it_out_now"]; ?>','send.php?id=<?php echo $id?>')" ><?php echo $LANG["send"]; ?> </button>
			  </div>
			
				
				
				 <div class="col-sm-2 form-group">
			</div>

		
	


</div>
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
      <li><a href="new.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["create_new_message"]) ?>" class="btn-floating tooltipped"><i class="material-icons">email</i></a></li>
      <li><a href="index.php" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>" class="btn-floating  tooltipped"><i class="material-icons">home</i></a></li>
    </ul>
  </div>
    <!-- END MAIN -->
	<?php include "../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>



<script>

CKEDITOR.replace( 'content', {
       on: {
        change: function( evt ) {
           autoSave();
        }
    }
} );

</script>
		
		
		
		