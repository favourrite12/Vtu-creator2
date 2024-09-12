<?php
   session_start();
 ?>  
<?php 
function includeDB($file){
	if(file_exists($file)){
		return $file;	
	}else if(file_exists("../$file")){
			return "../$file";
	}else if(file_exists("../../$file")){
		return "../../$file";
	}else if(file_exists("../../../$file")){
		return "../../../$file";
	}else if(file_exists("../../../../$file")){
		return "../../../../$file";
	}
}
 function loginJavaScriptExitLocationDirect($url){
       echo "<script>location.href='$url'</script>";
   }
   if(empty($_SESSION["webLink"])){
       include_once includeDB('include/data_config.php');
      $_SESSION["webLink"] = $conn->query("SELECT value FROM web_config WHERE array_key='webLink'")->fetch_assoc()["value"];
   }
   $ts = includeDB($_SERVER["REQUEST_URI"]);
    $ts = base64_encode($ts);
    if(!isset($_SESSION['admin'])){
  
   
      loginJavaScriptExitLocationDirect("//{$_SESSION["webLink"]}/admin/login.php?do_to=$ts");
	    exit;
   }else{ 
        $loginAdmin = $_SESSION["admin"];
        include_once includeDB('include/data_config.php');
          $sql = "SELECT id FROM admin  WHERE  id = '$loginAdmin' AND status='block' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			unset($_SESSION["admin"]);
			loginJavaScriptExitLocationDirect("//{$_SESSION["webLink"]}/admin/login.php?do_to=$ts");
	        exit;
		}else{
		
		$sql = "SELECT password FROM admin  WHERE  id = '$loginAdmin'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				
			 while($row = $result->fetch_assoc()) {
		        if($_SESSION["admin_password"]!=md5($row["password"])){
			loginJavaScriptExitLocationDirect("//{$_SESSION["webLink"]}/admin/logout.php");
	        exit;
		 }
                         }
		}
		}
		
		
		
		
		
        $date = time();
   
		$sql = "UPDATE admin SET last_seen='$date' WHERE id='$loginAdmin'";

		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
		} else {
			//echo "Error updating record: " . $conn->error;
		}

		$conn->close();
   
   }
  ?>   