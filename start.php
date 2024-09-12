<?php include '../include/checklogin.php';?>
 <div id="loaderDiv"  style="position:fixed; left:0;top:0;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:9999999999999999999999999999999999999">
		<div  style="width:100% !important" class = "mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
      <center> <i class="fa 	fa-refresh fa-spin fa-5x text-info pt-5 mt-5"></i> </center>
		
</div>



<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>
 
 <title><?php echo $LANG["install_update"]?></title>
 
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["update_access"]);
     
?>
<?php 
	$updates = $_SESSION["updates"];
	$host = 'https://update.lajela.com/provtu2/getcontent.php';
	$numberUpdate =  count($updates);
for($x = 0; $x < $numberUpdate ; $x++) {
	    $data = $updates[$x];
		$curl  = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $host,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_ENCODING => "",
		CURLOPT_POSTFIELDS => $data,
		CURLOPT_FOLLOWLOCATION=> true,
		CURLOPT_MAXREDIRS => 10,   
		CURLOPT_POSTREDIR => 3,   
		CURLOPT_TIMEOUT => 60,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		));
	       
		$update =  curl_exec($curl);
		curl_close($curl);
			
		$update =  json_decode($update,true);
		$updateContent = base64_decode($update["content"]);
		$updatePath = "../../".base64_decode($update["path"]);
		
		if(!file_exists(pathinfo($updatePath)["dirname"])){
		
			@mkdir(pathinfo($updatePath)["dirname"], 0777, true);
		}
		
		$updatePath = fopen($updatePath,'w');
	    fwrite($updatePath,$updateContent);
}

        $done = file_get_contents('https://update.lajela.com/provtu2/done.php');
		
		$done = "<?php \$var = '$done';?>";
			
	    if(file_put_contents("var.php",$done)){
		    $message = '<div class="alert alert-success alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong>'. $numberUpdate. ' '.$LANG["update_installed_successfully"].' <i class="fa fa-check" ></i></strong>. 
					 
					</div>
					<a class="btn btn-success right" href="index.php">'.$LANG["go_back"].'</a>';
					$_SESSION["updates"] = array();
                                        alertSuccess($LANG["update_installed_successfully"]);
		}else{
			 $message = '<div class="alert alert-danger alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong>'.$LANG["installation_failed"].' <i class="fa fa-check" ></i></strong>. 
					</div>
					<a class="btn btn-success right" href="index.php">'.$LANG["go_back"].'</a>';
                                        alertDanger($LANG["installation_failed"]);
		}
?>
  
<div class="container">
<div class="row flex-items-sm-center justify-content-center">
<div class="col s12"> 
    <div class="card-panel">
<?php echo $message; ?>
        <div class="clearfix"></div>
    </div>
</div>
</div>
</div>
</div>
</div>
<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

<script>
window.onload = function(e){ 
     document.getElementById("loaderDiv").style.display = "none";
}
</script>
