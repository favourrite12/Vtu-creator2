<?php include '../include/checklogin.php';?> 
<?php include '../dashboard/include/header.php';?>
<?php include '../include/data_config.php';?>

  <title><?php echo $LANG["change_profile_picture"]; ?></title>

            
				<?php
				
				$bytes = mt_rand();
				$utime = time();
				$pname = $bytes.$utime;
				$target_dir = "profile-pix/";
				$uploadOk = 1;
				$imageFileType = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
				$filename = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_FILENAME);
				$target_file = $target_dir.$bytes.'.'.$imageFileType;
				$dbdir = $bytes.'.'.$imageFileType;
				
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					clearstatcache();
					if (empty( $_FILES["fileToUpload"]["name"])){
						alertDanger($LANG["please_select_an_image"]);
						$uploadOk = 0;
                       $fmsg=="1";
					}
				  else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				  && $imageFileType != "gif"  ) {
					alertDanger($LANG["sorry_only_JPG_JPEG_PNG_GIF_files_are_allowed"]);
					$uploadOk = 0;
					$fmsg=="1";
				 }
				 
				 // Check file size
				else if ($_FILES["fileToUpload"]["size"] > 900000) {
					alertDanger($LANG["sorry_your_image_is_too_large_please_note_you_can_not_upload_an_image_that_is_more_900kb"]);
					$uploadOk = 0;
					$fmsg=="1";
				}
				 
				
				 // Check if $uploadOk is set to 0 by an error
				else if ($uploadOk == 0 && $fmsg=="") {
					alertDanger($LANG["there_was_an_error_uploading_your_file"]);
										
					
				 // if everything is ok, try to upload file
				 } else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					
					     $sql = "SELECT pix FROM users WHERE id='$loginUser'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
								$file = 'profile-pix/'.$row["pix"];
								unlink($file);
							}
							} 
					
					    
					
					
					      $sql = "UPDATE  users SET pix = '$dbdir'  WHERE id='$loginUser'";



						if (mysqli_query($conn, $sql)) {

							echo  '<script>
		
							location.href= "index.php";
							</script>';

						} else {

							alertDanger(mysqli_error($LANG["unknown_error"]));

						}
					
					     
					
						
					} else {
					    if($fmsg==""){
						alertDanger($LANG["there_was_an_error_uploading_your_file"]);
										
					}
					}
				 }
				}
				?>

  <section class="container">
  
   
 <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG["change_profile_picture"]; ?> - <?php echo $user["name"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s4 flexbox">
                    <div class="card-panel hoverable">
					
			<div class="row flex-items-sm-center justify-content-center">  
				<div class="col s12 align-middle text-center">
				<?php echo $fmsg ;?>
					 
				<form class="row py-1 flex-items-sm-center justify-content-center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
				 <center>
				  <label style="width:300px; height:200px; display:inline-block" class="col-sm-5  rounded border text-center w-50 h-25" id="scrn">
				  

							
							<input style="display:none" onchange="readURL(this)" class="" accept="image/gif, image/jpeg, image/png" hidden id="imag" type="file" name="fileToUpload" id="fileToUpload">
					
												<h5 class="valign" id="select-image"><?php echo $LANG["please_select_an_image"];?></h5>
					</label>
					</center>
				
				  <div class="col s12">
				           <center> <button class="btn right waves-effect waves-light" type="submit" name="submit"><i class="material-icons">cloud_upload</i></button></center>
					</div>
			
				 </form>
				  </div>

				 </section>
				
 
    </body>
    </html>
		<script>
		function getImage(){
		var imag = document.getElementById("select-image").innerHTML;
		alert(imag);
		var scrn = document.getElementById('scrn');
		scrn.style.backgroundImage = "url("+ imag +")";
		}



function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
					document.getElementById("select-image").innerHTML = "";;
					var imag = document.getElementById("imag").value;
					var scrn = document.getElementById('scrn');
					if(imag==""){
					document.getElementById("select-image").innerHTML ="Please Select an Image"
					}
					scrn.style.backgroundImage = "url("+ e.target.result +")";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
 <style>
 #scrn{
 background-repeat: no-repeat;
 background-size:cover;
 }
 </style>
 
 
 
  
 
 </div>
 </div>
 
 
 
 
	
    

<?php include '../dashboard/include/footer.php';?>