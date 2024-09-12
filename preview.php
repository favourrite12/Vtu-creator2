          <?php include '../include/checklogin.php';?>
		 <?php include '../../include/data_config.php';?>
		 <?php include '../../include/filter.php';?>
		 
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


   $id = xcape($conn,$_GET["id"]);
   $sql = "SELECT subject, content FROM news_letter WHERE id = '$id'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	   $title =   $row["subject"];
	   $content =   htmlspecialchars_decode($row["content"]); 
  
	}
}

?>
<title><?php echo $title?> </title>
<h3><?php echo $title?> </h4>
<hr/>
<?php echo $content?>