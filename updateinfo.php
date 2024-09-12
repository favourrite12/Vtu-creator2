<?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
<?php include '../../include/data_config.php';?>
<title><?php echo $LANG["view_info"]?></title>
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["update_access"]);
     
?>

<?php 
		
		$host = 'https://update.lajela.com/provtu2/info.php';
		
		$updates =  $_SESSION["updates"];
		for($x = 0; $x < count($updates) ; $x++) {
			$data[] = $updates[$x]["key"];
		}
		
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
		
		if($updates["noValue"]){
		$message = '<div class="alert alert-danger alert-dismissable mt-5">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					 <strong> '.$LANG["value_not_found_or_not_sent"].' </strong>. 
					 
					</div>
					<a class="btn btn-success right" href="check.php">'.$LANG["go_back"].'</a>';
		}else{
			$numberUpdate =  count($updates);
			for($x = 0; $x < $numberUpdate ; $x++) {
				$name = $updates[$x]["name"];
				$description = $updates[$x]["description"];
				$releaseTime = date("r",$updates[$x]["releaseTime"]);
				$updateTime = date("r",$updates[$x]["updateTime"]);
				
		     $btn = '<a class="btn btn-success right" href="start.php">'.$LANG["install_update"].'</a>';
					$message = '
					<tr><td>'
					.$name.'</td>
					<td>'.$description.'</td>
					<td>'.$updateTime.'</td>
					<td>'.$releaseTime.'</td>'
					.$message;
					
		    }
			$message = '<table class="table thead-dark"> 
					<tr>
					<th>'.$LANG["name"].'</th>
					<th>'.$LANG["description"].'</th>
					<th>'.$LANG["update_date"].'</th>
					<th>'.$LANG["release_date"].'</th>
					</tr>
					'.$message.'
					</tr>
				</table>'.$btn;
		}
		?>
		
<!DOCTYPE html>

  
  
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