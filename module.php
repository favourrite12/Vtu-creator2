 <?php include '../include/ini_set.php';?>
 <?php include 'include/checklogin.php';?>
		

   <?php include '../include/data_config.php';?>
	 
	 <?php	 include 'include/header.php'; ?>


<?php 
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);

 echo checkAccess($adminInfo["module"]);

     
?>



<script>

function ProgressFunction(event){
        document.getElementById("progress-container").style.display = "block"
        var percent = (event.loaded / event.total)*100;
        percent = Math.round(percent);
        document.getElementById("progress-bar").innerHTML = percent+"%"
        document.getElementById("progress-bar").style.width = percent+"%"
			
			
}
function installModule(){

        var  formData = new FormData(document.getElementById('uploadForm'));
         var d = new Date();

          var xhttp = new XMLHttpRequest();
          xhttp.upload.addEventListener("progress", ProgressFunction, false);
          xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                 document.getElementById("progress-container").style.display = "none";
                  var response = this.responseText.toString().trim();
                   ajaxRequestResponse(response);
                }
          };
          xhttp.open("POST", "../processor/module_processor.php?t="+d.getTime(), true);
          xhttp.send(formData);

         return false;
        }		  
</script>

 
 <title> <?php echo $LANG["module_insaller"] ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"> <?php echo $LANG["module_insaller"] ?> (<?php echo $LANG["language"] ?>/<?php echo $LANG["payment_method"] ?>)</p>
              <div class="divider"></div>
             <div class="caption alert-danger"><?php echo $LANG["please_only_install_modules_from_lajela_official_site_and_only_source_that_you_trust"];?></div>
              <div class="flexbox">
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
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
	   
	   <form action="#"  class="row" id="uploadForm" onsubmit="return installModule()">
	  <input type="hidden" value="<?php echo $loginAdmin; ?>" id="admin" />
       

	   <br/>

	   <div id="description" class="form-group col s12">
		
	   </div>

	  
	   
	    
	   <div class="form-group col s12">
		<input id="file" class=" bg-secondary form-control  " type='file' accept="application/zip"  name="file">
		
	   </div>
		
	 
		
		 <div class="form-group col s12">
		<button   class="btn btn-success  right" type="submit"> <?php echo $LANG["upload"];?> <i class="fa fa-upload"> </i></button>
			</div>
		
		
	</form>
	</div>
	
</div>
	
 
   
 

 
  
  
  
  </div>
</section>

                     </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
        </section>





<?php include 'include/right-nav.php';?>
<?php include 'include/footer.php';?>