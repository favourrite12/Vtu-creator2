
<?php
function userInfo($id,$conn){
   
   $sql = "SELECT * FROM users WHERE id = '$id' OR phone='$id' OR email='$id' OR user_name='$id'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	    $user["id"] = ucfirst($row["id"]);
	    $user["name"] = ucfirst($row["name"]);
		$user["email"] = $row["email"];
		$user["phone"] = $row["phone"];
		$user["country"] = $row["country"];
		$user["region"] = $row["region"];
		$user["city"] = $row["city"];
                $user["referBy"] = $row["refer_by"];
		$user["street"] = $row["street"];
		$user["zipCode"] = $row["zip_code"];
		$user["credit"] = $row["credit"];
		$user["status"] = $row["status"];
		$user["blockReason"] = $row["block_reason"];
		$pix = $row["pix"];
		$user["userName"] = ucfirst($row["user_name"]);
		$user["lastUpdate"] = $row["last_update"];
       	
	}
} else {
    $user["NotFound"]=true;
}


$user["pix"] = $pix;
if(empty($pix)){
	$user["pix"] = 'user.png';
}


$user =  json_encode($user);
return $user;
}
?>
