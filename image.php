
				

  <section class="container">
  
   
 <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $serviceValue["display_name"]; ?> - <?php echo $LANG["image"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s4 flexbox">
                    <div class="card-panel hoverable">
					
			<div class="row flex-items-sm-center justify-content-center">  
				<div class="col s12 align-middle text-center">
				<?php echo $fmsg ;?>
					 
				<form class="row py-1 flex-items-sm-center justify-content-center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
				 <center>
				  <label style="width:300px; height:200px;  display:inline-block;" class="col-sm-5  rounded border text-center w-50 h-25" id="scrn">
                                      <input name="id" type="hidden" value="<?php echo $serviceValue["id"]?>"/>

							
							<input style="display:none" onchange="readURL(this)" class="" accept="image/gif, image/jpeg, image/png" hidden id="imag" type="file" name="fileToUpload" id="fileToUpload">
					
                                                        <h5 class="valign" style=" background: rgba(0,0,0,.8)" id="select-image"><?php echo $LANG["please_select_an_image"];?></h5>
					</label>
					</center>
				
				  <div class="col s12">
				           <center> <button class="btn right waves-effect waves-light" type="submit" name="image"><i class="material-icons">cloud_upload</i></button></center>
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
    document.getElementById("scrn").style.backgroundImage = "url('../../uploads/service/<?php echo $serviceValue["image"]?>')";
   
</script>
 <style>
 #scrn{
 background-repeat: no-repeat;
 background-size:cover;
 }
 </style>
 
 
 
  
 
 </div>
 </div>
 
 