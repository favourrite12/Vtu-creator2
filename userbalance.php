
<?php
function userBalance($id,$conn){
   
   $sql = "SELECT credit FROM users WHERE id = '$id' OR phone='$id' OR email='$id' OR user_name='$id'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	   
		return $row["credit"];
	
       	
	}
} else {
    return "NotFound";
}


}
?>
