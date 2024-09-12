         <?php include '../include/checklogin.php';?>		
		<?php include '../../include/data_config.php';?>
		 <?php include '../include/filter.php';?>
		 
		<?php include "../../language/{$webConfig["LANG"]}.php"; ?>
            <?php 
            include '../include/admininfo.php';
            $adminInfo = adminInfo($loginAdmin,$conn);
            //print_r($adminInfo);
             if($adminInfo["news_letter"] != 1 || $adminInfo["news_letter"] != '1'){
              echo $LANG["access_denied_permisson"];
            exit;
             }

            ?>
		 
	<?php
				
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
	$title = xcape($conn, $_POST['title']);
	$content= xcape($conn, $_POST['content']);
	$id= xcape($conn, $_POST['id']);

	$regDate = time(); 
	$prc = 1;

	
	 if($prc ==1){
	   
	
    
	$sql = "UPDATE news_letter  SET
		content =  '$content',
		subject =  '$title',
		reg_date = '$regDate'
		WHERE id = '$id'
	";

	 if ($conn->query($sql) === TRUE) {
	  echo $LANG["changes_saved_successfully"];;
	 } else {
		 echo   $conn->error;
	}
    }
	}
	$conn->close();
	
	?>