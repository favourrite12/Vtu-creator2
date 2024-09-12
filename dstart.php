<?php include '../include/checklogin.php';?>

 <div id="loaderDiv"  style="position:fixed; left:0;top:0;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:9999999999999999999999999999999999999">
		<div  style="width:100% !important" class = "mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
      <center> <i class="fa 	fa-refresh fa-spin fa-5x text-info pt-5 mt-5"></i> </center>
		
</div>



<?php include '../include/header.php';?>
<title><?php echo $LANG["install_update"]?></title>
<?php include '../../include/data_config.php';?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["update_access"]);
     
?>
<?php 
	$updates = $_SESSION["dupdates"];
	$host = 'https://update.lajela.com/provtu2/dgetcontent.php';
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
		$updatePath = "database.sql";
		
		$updatePath = fopen($updatePath,'w');
	    fwrite($updatePath,$updateContent);
		$numError = 0;
		// Name of the file
		$filename = 'database.sql';
     $successNumber =0;
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line) {
		// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

		// Add this line to the current segment
			$templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';') {
				// Perform the query
				$queryInitiated  = $queryInitiated. "<li>$templine</li>";
				if(!$conn->query($templine)){
					$errorNumber++;
				$errorFound = true;
				$connError =  mysqli_error($conn);
				$error = $error."<li>
				Query: $templine  <br/>
				<strong>{$LANG["an_error_occurred"]}: $connError </strong> <br /> </li>";
				}else{
					$successNumber++;
					$success = "<li>$templine</li>".$success;
				}
				// Reset temp variable to empty
				$templine = '';
			}
		}
		
		
		
		
		
}

        $done = file_get_contents('https://update.lajela.com/provtu2/ddone.php');
		$done = "<?php \$var = '$done';?>";
			
	    if(file_put_contents("dvar.php",$done)){
		    $message = $message. '<div class="alert alert-secondary alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>'.$numberUpdate.' '.$LANG["query_installed"].' </i></strong>
					 <ol>'. $queryInitiated. ' </ol>. 
					 
					</div>';
					$_SESSION["dupdates"] = array();
					
		}
		if($errorFound){
			 $message = $message. '<div class="alert alert-danger alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong> '.$errorNumber.' '.$LANG["unsuccessful_query"].' </i></strong>
					 <br/><ol>
					  '.$error.' 
					  <ol>
					</div>
					';
		}
		if($numberUpdate > 0){
		 $message = $message. '<div class="alert alert-success alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong> '.$successNumber.' '.$LANG["successful_query"].' </i></strong>
					 <br/><ol>
					  '.$success.' 
					  <ol>
					</div>';
		}
					$message = $message.'<a class="btn btn-success right" href="index.php">'.$LANG["go_back"].'</a>';
		
		fclose($updatePath); 
		unlink("database.sql");
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