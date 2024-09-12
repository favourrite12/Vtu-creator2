<?php include "../include/ini_set.php" ;?>
<?php 
$sentOption = json_decode($_REQUEST["option"],true);
$header = json_decode($_REQUEST["header"],true);
$data = json_decode($_REQUEST["value"],true);
?>
<?php 
$option = array(
    'CURLOPT_RETURNTRANSFER' => true,
    'CURLOPT_POST' => true,
    'CURLOPT_ENCODING' => "",
    'CURLOPT_HTTPHEADER' => "",
    'CURLOPT_FOLLOWLOCATION'=> true,
    'CURLOPT_MAXREDIRS' => 10,   
    'CURLOPT_POSTREDIR' => 3,   
    'CURLOPT_TIMEOUT' => 30,
    'CURLOPT_HTTP_VERSION' => 'CURL_HTTP_VERSION_1_1',
    'CURLOPT_CUSTOMREQUEST' => "POST",
);
if(!empty($header)){      
$header = [implode(',',$header)];
}
?>

<?php
foreach ($sentOption as $key => $value) {
    if(isset($sentOption[$key])){
      $option[$key]=$value;  
    }
}
?>
<?php 

$curl  = curl_init();

curl_setopt($curl, CURLOPT_URL, $_REQUEST["url"]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, $option["CURLOPT_RETURNTRANSFER"]);
curl_setopt($curl, CURLOPT_POST, $option["CURLOPT_POST"]);
curl_setopt($curl, CURLOPT_ENCODING, $option["CURLOPT_ENCODING"]);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_REFERER, $option["CURLOPT_REFERER"]);
curl_setopt($curl, CURLOPT_HTTPHEADER, array($headers));
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $option["CURLOPT_FOLLOWLOCATION"]);
curl_setopt($curl, CURLOPT_MAXREDIRS, $option["CURLOPT_MAXREDIRS"]);   
curl_setopt($curl, CURLOPT_POSTREDIR, $option["CURLOPT_POSTREDIR"]);   
curl_setopt($curl, CURLOPT_TIMEOUT, $option["CURLOPT_TIMEOUT"]);
curl_setopt($curl, CURLOPT_HTTP_VERSION, $option["CURLOPT_HTTP_VERSION"]);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $option["CURLOPT_CUSTOMREQUEST"]);

echo curl_exec($curl); 
curl_close($curl);

?>