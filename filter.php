<?php 
    function xcape($conn, $var){ 
	   $var = mysqli_real_escape_string($conn,$var);
	  return  htmlspecialchars($var);
	}
?>

