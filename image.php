<?php include '../include/checklogin.php';?>
   <?php include '../../include/data_config.php';?>
	 <?php	 include '../include/header.php'; ?>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);

 echo checkAccess($adminInfo["icon"]);

     
?>


<script>
  var openFile = function(event) {
	 var input = event.target;
	var a =  URL.createObjectURL(input.files[0])
	document.getElementById("image").src = a;
	document.getElementById("preview").style.display = "block";
	document.getElementById('fileType').value = 'file';
  }
</script>




<script>

function ProgressFunction(event){
			document.getElementById("progress-container").style.display = "block"
			var percent = (event.loaded / event.total)*100;
			percent = Math.round(percent);
			document.getElementById("progress-bar").innerHTML = percent+"%"
			document.getElementById("progress-bar").style.width = percent+"%"
			
			
			}
			function uploadVideo() {
				var input = document.getElementById('file').value;
				var fileType = document.getElementById('fileType').value;
				if(input=="" && fileType==""){
					swal("<?php echo $LANG["please_select_an_image_or_insert_the_url"]?>",
                                        {icon:"error",button:'<?php echo $LANG["okay"]?>'}
                                              );
					return false;
			}else{
			 var d = new Date();
			 if(fileType == 'url'){
			 var imageUrl = document.getElementById('imageUrl').value;
			 var arrayKey = document.getElementById('arrayKey').value;
			 var formData = new FormData();
			  formData.append("url",imageUrl);
			  formData.append("arrayKey",arrayKey);
			  formData.append("admin",admin);
			  formData.append("filetype","url");
			  
			 }
			 if(fileType=='file'){
			var  formData = new FormData(document.getElementById('uploadForm'));
			 }
		
			  var xhttp = new XMLHttpRequest();
			  xhttp.upload.addEventListener("progress", ProgressFunction, false);
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				 document.getElementById("progress-container").style.display = "none";
				   ajaxRequestResponse(this.responseText.toString().trim()) 
				 
				
				}
			  };
			  xhttp.open("POST", "../../processor/icon_processing.php?t="+d.getTime(), true);
			  xhttp.send(formData);
			  
			 return false;
			}
			}
			
			
			  
			  function UrlFileBrowser(){
				  var s = document.getElementById('formSwitch');
				  var imageUrl = document.getElementById('imageUrl');
				  var file = document.getElementById('file');
				  if(imageUrl.style.display==='none'){
					  imageUrl.style.display='block';
					  file.style.display='none';
					  s.innerHTML ="<?php echo $LANG["upload_using_file_browser"];?>";
				  }else{
					  imageUrl.style.display ='none';
					  file.style.display='block';
					  s.innerHTML ="<?php echo $LANG["upload_using_link"]?>";
				  }
			  }
			  
			
			  
			  
		function getDetail(k) {
        var d = new Date();
		var  formData = new FormData();
		formData.append("key", k);


		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText.toString().trim());
		  document.getElementById("current-preview").style.display="block";
		 document.getElementById("description").innerHTML = response.description;
		 document.getElementById("current").src = "../../uploads/"+response.value;
		}
		};
		xhttp.open("POST", "geticondetail.php?t="+d.getTime(), true);
		xhttp.send(formData);

		return false;
	}

			  
			  
</script>


 <title><?php echo $LANG["configuration"] ?> | <?php echo $LANG["images"] ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"><?php echo $LANG["configuration"] ?> | <?php echo $LANG["images"] ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">

 <section class="container pt-4">
<div class="row flex-items-sm-center justify-content-center">  
    <div class="row col-12">
	<div class="progress col s12" id="progress-container" style="display:none">
	  <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
	  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
		
	  </div>
	</div>
	<div id="response" style="display:none" class="col s12">
	 
	 
	 
	</div>
	
	<div class="col s12">
	   
	   <form action="#"  class="row" id="uploadForm" onsubmit="return uploadVideo()">
	  <input type="hidden" value="<?php echo $loginAdmin; ?>" name="admin" id="admin" />
       <div class="input col s12">
		<select  onchange="getDetail(this.value)" name="arrayKey"  id="arrayKey"  >  
		<option value=""><?php echo $LANG["select_icon_image"]; ?></option>
	    <?php 

		$sql = "SELECT array_key,display_name FROM web_config WHERE key_group='image' ORDER BY display_name ";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		   while($row = $result->fetch_assoc()) {
			$serviceName = $LANG[$row["display_name"]];
		 echo ' 

			<option value="'.$row["array_key"].'" >'.$serviceName.'</option>

		   '; 
		   }
		}
		?>
		
		
		</select>
	   </div>   

	   <br/>

	   <div id="description" class="form-group col s12">
		
	   </div>

	  
	   
	    
	   <div class="form-group col s12">
		<input id="file" class=" bg-secondary form-control  " type='file' accept="image/*"  name="file" onchange='openFile(event)'>
		<input type="url" style="display:none !important" placeholder="https//www.example.com/example-image.jpg" onchange='videoFromUrl(event)' id="imageUrl" class="form-control" />
		<input type="hidden"  name="filetype" id="fileType"  />
		
		</div>
		
		 
		 
		
		 <div class="form-group col s12">
		<button   class="btn btn-success  right" type="submit"> <?php echo $LANG["upload"];?> <i class="fa fa-upload"> </i></button>
		<a href="javaScript:void(0)" id="formSwitch" onclick ="UrlFileBrowser()"><?php echo  $LANG["upload_using_link"]; ?></a>
		</div>
		
		
		</form>
	</div>
	
</div>
	
  <div class="col m6" style="display:none" id="current-preview">
  <fieldset>
    <legend><?php echo $LANG["preview"];?>: <i><?php echo $LANG["old_picture_image_icon"]; ?></i></legend> 
	
	<center><img style="width:100%"  id="current" class="opacity img-fluid"    src=""   /> </center>
	  
  
      </fieldset>
  </div> 
  
   
   
  <div class="col m6" style="display:none" id="preview">
 
     <fieldset>
	   <legend><?php echo $LANG["preview"];?>: <i><?php echo $LANG["new_picture_image_icon"]; ?></i></legend> 
		<center><img style="width:100%" id="image" class="opacity img-reposible"    src=""   /> </center>
     </fieldset>
 
  </div>

 
  
  
  
  </div>
</section>

                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>