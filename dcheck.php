<?php include '../include/checklogin.php';?>

 <div id="loaderDiv"  style="position:fixed; left:0;top:0;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:9999999999999999999999999999999999999">
		<div  style="width:100% !important" class = "mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
      <center> <i class="fa 	fa-refresh fa-spin fa-5x text-info pt-5 mt-5"></i> </center>
		
</div>

<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>
<title><?php echo  $LANG["check_database_update"]; ?></title>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["update_access"]);
     
?>
<?php 
	
		$host = 'https://update.lajela.com/provtu2/dgetupdate.php';
	    include "dvar.php";
		$data =  json_decode($var,true);
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
	       
		$updates =  curl_exec($curl);
		
		curl_close($curl);
			
		$updates =  json_decode($updates,true);
		$numberUpdate =  count($updates);
		
		if($updates["upToDate"]){
		$message = '<div class="alert alert-success alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong> '.$LANG["congratulations_your_database_structures_is_up_to_date"].'<i class="fa fa-check" ></i></strong>. 
					 
					</div>
					<a class="btn btn-success right" href="index.php">'.$LANG["go_back"].'</a>';
		}else{
			$_SESSION["dupdates"] = $updates;
		     $btn = '<a class="btn btn-success left" href="dstart.php">'.$LANG["install_update"].'</a>
			 <a class="btn btn-info right" href="dupdateinfo.php">'.$LANG["view_info"].'</a>';
			$message = '<div class="alert alert-info alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <i class="fa fa-refresh" ></i>  '.$numberUpdate.' '.$LANG["update_is_are_available_for_your_database_structure"].' .
					</div>'.$btn;
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