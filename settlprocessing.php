<?php include '../../include/ini_set.php';?>		
<?php include '../include/checklogin.php';?>		
<?php include '../../include/data_config.php';?>
<?php include "../../language/{$webConfig["LANG"]}.php";?>
<?php include '../../include/filter.php';?>

		 <?php 
		include '../include/admininfo.php';
		$adminInfo = adminInfo($loginAdmin,$conn);
		//print_r($adminInfo);
		 if($adminInfo["payment"] != 1 || $adminInfo["payment"] != '1'){
		 echo $LANG["access_denied_permisson"];
		exit;
		 }	 
		?>
		 
	<?php
				
	
		
	$id= xcape($conn, $_GET['id']);

	$regDate = time(); 
	$prc = 1;
  if(empty($id)){
 $output['message'] = $LANG['no_transaction_found'];
 $output['status'] = 'error';
 $output['title'] = $LANG["an_error_occurred"];
 $output['button']=$LANG["okay"];
 $output['close'] = true;
 $output['icon'] = "error";
 $prc = 0;
  }
	
	 if($prc ==1){
	   
	
    
	$sql = "UPDATE payout_request  SET
		settled =  '1',
		settled_date = '$regDate',
		admin = '$loginAdmin'
		WHERE id = '$id'
	";

	 if ($conn->query($sql) === TRUE) {
	     $output['message'] = $LANG['changes_saved_successfully'];
    	    $output['id'] = $id;
		$output['status']=$LANG["success"];
		$output['title']=$LANG["success"];
		$output['icon'] = "success";
		$output['close'] = false;
		$output['new'] = true;
		$output['button']=$LANG["continue"];
		$output['link']="";
   
} else {
	    $output['message']=$conn->error;
	    $output['title']=$LANG["not_successful"];
		$output['status']="error";
		$output['button']=$LANG["okay"];
		$output['close'] = true;
		$output['icon'] = "error";
}
}
echo json_encode($output);
$conn->close();
	?>