<?php
ini_set('memory_limit', '-1');

$file= $_GET['file'];
$name = $_GET['name'];
$type = $_GET['type'];
$file= base64_decode($file);
$name= base64_decode($name);
$fileType = mime_content_type($file);	

if(empty($name)){
$name = pathinfo($file)[basename];
}

$name = preg_replace('/[_-]?\w+\.\w+[_+]?/',"", $name);
$name = preg_replace('/[^\w\-]+/',"", $name);
$name = "$name(lajela.com)"; 
$name = $name.".".$type;

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$name."\""); 
readfile($file);
?>