<?php include 'include/data_config.php';?>
<?php include 'include/filter.php';?>
<?php 
$webLink = $conn->query("SELECT value FROM web_config WHERE array_key='webLink'")->fetch_assoc()["value"];
$img = $_GET["type"];
$img  = xcape($conn, $img);
 $sql = "SELECT url FROM ad_banner WHERE type = '$img' ORDER BY RAND() LIMIT 1";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
		$data = base64_encode(file_get_contents("https://$webLink/banners/".$row["url"]));
	}
}
$data = base64_decode($data);
$im = imagecreatefromstring($data);
if ($im !== false) {
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
}
?>
