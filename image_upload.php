                                <?php
				if(isset($_POST["image"])) {
				$bytes = mt_rand();
				$id =  xcape($conn, $_POST["id"]);
				$utime = time();
				$pname = $bytes.$utime;
				$target_dir = "../../uploads/service/";
                                if(!file_exists($target_dir)){
                                    mkdir($target_dir);
                                }
				$uploadOk = 1;
				$imageFileType = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
				$imageFileType = strtolower($imageFileType);
                                $filename = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_FILENAME);
				$target_file = $target_dir.$bytes.'.'.$imageFileType;
				$dbdir = $bytes.'.'.$imageFileType;
				
				// Check if image file is a actual image or fake image
				
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
					
                                             $sql = "SELECT image FROM service WHERE id='$id'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
								$file = '../../uploads/service/'.$row["image"];
							        unlink($file);
							}
						} 
					
					    
					
					
					      $sql = "UPDATE  service SET image = '$dbdir'  WHERE id='$id'";



						if ($conn->query($sql)===true) {
                                                    alertSuccess($LANG["changes_saved_successfully"]);

                                                     } else {
                                                         alertDanger($conn->error);
                                                
                                                     }

					     
					
						
					} else {
					    if($fmsg==""){
									
                                                alertDanger($LANG["there_was_an_error_uploading_your_file"]);
                                                    
                                                
                                                
					}
					}
				 }
                  
                                 javaScriptPushState("?id=$id#image");       
}
?>