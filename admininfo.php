
<?php
function adminInfo($selectedAdmin,$conn){
  $sql = "SELECT * FROM admin WHERE id = '$selectedAdmin' OR phone='$selectedAdmin' OR email='$selectedAdmin' OR user_name='$selectedAdmin'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
$r = $result->fetch_assoc();
$r["password"]="";


} else {
    $r["NotFound"]=true;
}
 return $r;
}
?>
