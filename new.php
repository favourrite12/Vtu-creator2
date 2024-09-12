	 
<?php include '../include/checklogin.php';?>
		

   <?php include '../../include/data_config.php';?>
	 
	 <?php	 include '../include/header.php'; ?>


 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["slider"]);
?>


<script>
  var openFile = function(event) {
	 var input = event.target;
	var a =  URL.createObjectURL(input.files[0])
	document.getElementById("image").src = a;
	document.getElementById("preview").style.visibility = "visible"
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
					swal("<?php echo trim($LANG["oops"]);?>", "<?php echo trim($LANG["please_select_an_image_or_insert_the_url"]);?>","error",{"button":"<?php echo trim($LANG["okay"]);?>"});
					return false;
			}else{
			 var d = new Date();
			 if(fileType == 'url'){
			 var imageUrl = document.getElementById('imageUrl').value;
			 var typeText = document.getElementById('advertTypeText').value;
			 var active = document.getElementById('active').value;
			  var formData = new FormData();
			  formData.append("url",imageUrl);
			  formData.append("type",typeText);
			  formData.append("filetype","url");
			  formData.append("active",active);
			  
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
			  xhttp.open("POST", "../../processor/banner_processing.php?t="+d.getTime(), true);
			  xhttp.send(formData);
			  
			 return false;
			}
			}
			
			
			 var videoFromUrl = function(event) {
				var input = event.target;
				var a =  input.value;
				document.getElementById("image").src = a;
				var video = document.getElementById("scream");
				document.getElementById("preview").style.visibility = "visible";
				document.getElementById('fileType').value = 'url';
				
			  }
			  
			  
			  
			  
			  
			  function UrlFileBrowser(){
				  var s = document.getElementById('formSwitch');
				  var imageUrl = document.getElementById('imageUrl');
				  var file = document.getElementById('file');
				  if(imageUrl.style.display==='none'){
					  imageUrl.style.display='block';
					  file.style.display='none';
					  s.innerHTML ="<?php echo trim($LANG["upload_using_file_browser"]);?>";
				  }else{
					  imageUrl.style.display ='none';
					  file.style.display='block';
					  s.innerHTML ="<?php echo trim($LANG["upload_using_link"]);?>";
				  }
			  }
			  
			  

			</script>

  <title><?php echo trim($LANG["upload_new_banner"]);?></title>

  <section id="content">
        
        
          <div class="container flexbox">
            <div class="section" >
              <p class="caption"><?php echo $LANG["upload_new_banner"] ;?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control">
                    <div class="card-panel  hoverable ">
 <section class="container pt-4">
<div class="row flex-items-sm-center justify-content-center">  
    <div class="row col s12">
	
	<div class="progress col s12" id="progress-container" style="display:none">
	  <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
	  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
		
	  </div>
	</div>
	<div id="response" style="display:none" class="col s12">
	 
	</div>
	
	<div class="col s12">
	   
	   <form action="#"  class="row" id="uploadForm" onsubmit="return uploadVideo()">
	   <div class="input-field col s8">
               <select name="type" id="advertTypeText" required>
                    <option <?php echo $type=="long"? "selected": "";?> value="long"><?php echo $LANG["long"] ;?></option>
                    <option <?php echo $type=="full"? "selected": "";?> value="full"><?php echo $LANG["full"] ;?></option>
                    <option <?php echo $type=="side"? "selected": "";?> value="side"><?php echo $LANG["side"] ;?></option>
                    <option <?php echo $type=="rect"? "selected": "";?> value="side"><?php echo $LANG["rect"] ;?></option>

                    </select>
                    <label><?php echo $LANG["type"] ;?></label>
              </div>
	   
	   
		<div class=" col-sm-2">
                    <br/>
                    <br/>
		<input <?php if($active==1){echo "checked" ;} ?>  name="active" type="checkbox" value="1"  id="active">
		<label class="custom-control-label" for="active"><?php echo ucfirst($LANG["active"]);?></label>
		</div>	
	   
	   <div class="form-group col s12">
		<input id="file" class=" bg-secondary form-control  " type='file' accept="image/*"  name="file" onchange='openFile(event)'>
		<input type="url" style="display:none" placeholder="https//www.example.com/example-image.jpg" onchange='videoFromUrl(event)' id="imageUrl" class="form-control" />
		<input type="hidden"  name="filetype" id="fileType"  />
	   </div>
		
		   
		 
		
		 <div class="form-group col s12">
		<button   class="btn btn-success right" type="submit"><?php echo $LANG["upload"]?> <i class="fa fa-upload"> </i></button>
		<a href="javaScript:void(0)" id="formSwitch" onclick ="UrlFileBrowser()"><?php echo $LANG["upload_using_link"]?></a>
		</div>
		
		
		</form>
	</div>
	<hr class="text-danger"/>
</div>
	
  <div class="col s12" style="visibility:hidden" id="preview">
  <fieldset>
    <legend><?php echo $LANG["preview_click_on_upload_to_save_this_image"];?></legend> 
	
	<center><img width="100%" id="image" class="opacity img-fluid"    src=""   /> </center>
	  
  
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



 <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["home"]) ?>">
    <a href="index.php" class="btn-floating btn-large">
      <i class="large material-icons">home</i>
    </a>
  </div>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>