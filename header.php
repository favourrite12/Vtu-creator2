<?php  function includeCheck($file){ if(file_exists($file)){ return $file; }else if(file_exists("../$file")){ return "../$file"; }else if(file_exists("../../$file")){ return "../../$file"; }else if(file_exists("../../../$file")){ return "../../../$file"; }else if(file_exists("../../../../$file")){ return "../../../../$file"; }else{ return false; } } ?> <?php include includeCheck('include/data_config.php');?><?php include includeCheck('include/webconfig.php');?><?php include includeCheck("language/{$webConfig["LANG"]}.php"); ?><div class="vt" style="position: fixed; right: 2; bottom: 0; "><a target="id" href="http://vtucreator.com">Developed By VTU Creator</a></div><style> .vt *{color: <?php echo $webConfig["footerForegroundColor"] ?> !important}</style>
	 
<?php
function adminNav($selectedAdmin,$conn){ $sql = "SELECT * FROM admin WHERE id = '$selectedAdmin' OR phone='$selectedAdmin' OR email='$selectedAdmin' OR user_name='$selectedAdmin'"; $result = $conn->query($sql); if ($result->num_rows > 0) { $r = $result->fetch_assoc(); $r["password"]=""; } else { $r["NotFound"]=true; } return $r; } ?>
	 
<?php
if(!function_exists("formatWithSuffix")){ function formatWithSuffix($input) { $suffixes = array('', 'k', 'm', 'g', 't'); $suffixIndex = 0; while(abs($input) >= 1000 && $suffixIndex < sizeof($suffixes)) { $suffixIndex++; $input /= 1000; } return ( $input > 0 ? floor($input * 1000) / 1000 : ceil($input * 1000) / 1000 ) . $suffixes[$suffixIndex]; } } ?>


  <style>
 .flexbox {
  display: flex;
  flew-wrap: wrap;
  justify-content: center;
  align-items: center;
  }
  </style>
  	
<style>
	@media only screen and (min-height: 550px) {
	  .lg-text-input {
		height: 250px !important;
		margin: 0 !important;
	  }
	}
	
	
	@media only screen and (min-width: 550px) {
	  .custom-form-control {
		width: 500px !important;
	  }
	}
	
	@media only screen and (max-width: 992px) {
	  .custom-form-control {
		width: 400px !important;
	  }
	}
	
	@media only screen and (max-width: 600px)  {
	  .custom-form-control {
		width: 300px !important;
	  }
	}	
	
	@media only screen and (max-width: 400px)  {
	  .custom-form-control {
		width: 300px !important;
	  }
	}
	
	@media only screen and (max-width: 300px)  {
	  .custom-form-control {
		width: 250px !important;
	  }
	}
	@media only screen and (max-width: 270px)  {
	  .custom-form-control {
		width: 100% !important;
	  }
	}
</style>
  
	

  <style>

.dashboard-title {
     font-size:40px;
	 font-weight: bold;
}
.dashboard-image{
		height:140px;
}
.dashboard-text-container{
		left: 120px;
}

@media only screen and (max-width: 600px) {
    .dashboard-title {
        font-size:18px
	}
	
	.dashboard-image{
		height:80px;
	}
	.dashboard-text-container{
		left: 60px;
}
	
}
</style>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  
  <?php echo htmlspecialchars_decode($webConfig["header"]) ?>
  
 <link rel="shortcut icon" href="//<?php echo $webConfig["webLink"];?>/uploads/<?php echo $webConfig["favicon"] ?>" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="theme-color"  content="<?php echo $webConfig["navBackgroundColor"];?>"/>







  <link rel="stylesheet" href="//<?php echo $webConfig["webLink"];?>/bootstrap/bootstrap-3.4.1/css/bootstrap.min.css">

   
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  
  
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="<?php echo $webConfig["keyWord"] ?>" />
		<meta name="description" content="<?php echo $webConfig["description"] ?>" />
		<meta name="author" content="<?php echo $webConfig["webAuthor"] ?>" />
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			  

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
   

    <!-- Tile icon for Win8 (144x144 + tile color) -->
  
    <meta name="msapplication-TileColor" content="#3372DF">

 


<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />	
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="keywords" content="<?php echo $webConfig["keyWord"] ?>" />
<meta name="description" content="<?php echo $webConfig["description"] ?>" />
<meta name="author" content="<?php echo $webConfig["webAuthor"] ?>" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<meta name="mobile-web-app-capable" content="yes">
<meta name="msapplication-TileColor" content="#00bcd4">
<meta name="msapplication-TileImage" content="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="msapplication-tap-highlight" content="no">
<?php echo htmlspecialchars_decode($webConfig["header"]) ?>
<?php include includeCheck("language/{$webConfig["LANG"]}.php"); ?>

  
  </head>
  
	  <style>
 .flexbox {
  display: flex;
  flew-wrap: wrap;
  justify-content: center;
  align-items: center;
  }
  </style>
  	


<?php  function checkAccess($access){ if($access != 1 || $access != '1'){ die( "
<script>
  swal('".$GLOBALS["LANG"]["access_denied"]."','".$GLOBALS["LANG"]["access_denied_permisson"]. "', 'error',{button:false,
    closeOnEsc: false,
    closeOnClickOutside:false  
});
</script>" ); } } function openAlert($msg,$title='',$state="info"){ if(empty($title)){ $title = strtoupper($GLOBALS["LANG"]["oops"]); } echo "<script>
swal('".addslashes($title)."','".addslashes($msg). "', '$state',{'button':'{$GLOBALS["LANG"]["okay"]}'});
</script>"; } ?>


<!-- Favicons-->
<link rel="icon" href="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>" sizes="32x32">
<link rel="shortcut icon" href="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>" />
<!-- Favicons-->
<link rel="apple-touch-icon-precomposed" href="//<?php echo $webConfig["webLink"] ?>/uploads/<?php echo $webConfig["favicon"] ?>">
<!-- For iPhone -->

<!--JQuery-->
 <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/vendors/jquery-2.2.1.min.js"></script>
	
 
 <script src="//<?php echo $webConfig["webLink"];?>/js/color-picker.min.js" type="text/javascript"></script>
 <link href="//<?php echo $webConfig["webLink"];?>/css/color-picker.min.css" rel="stylesheet" type="text/css"/>


<!--External CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//<?php echo $webConfig["webLink"];?>/css/animate/animate.css"/>

<!-- CORE CSS-->
<link rel="stylesheet" href="//<?php echo $webConfig["webLink"] ?>/bootstrap/bootstrap-3.4.1/css/bootstrap.min.css">
<link href="//<?php echo $webConfig["webLink"] ?>/css/materialize.css" type="text/css" rel="stylesheet">
<link href="//<?php echo $webConfig["webLink"] ?>/css//style.css" type="text/css" rel="stylesheet">


<!-- Custome CSS-->
<link href="//<?php echo $webConfig["webLink"] ?>/css/custom/custom.css" type="text/css" rel="stylesheet">

<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
<link href="//<?php echo $webConfig["webLink"] ?>/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
 
<script src="//<?php echo $webConfig["webLink"];?>/js/file/sweetalert.min.js" type="text/javascript"></script>
    	
 
 </head>		
		
 <?php include 'nav.php';?>
					

    <div id="loaderDiv"  style="position:fixed; left:0;top:-7;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:9999999999999999999999999999999999999;display:none">
     <div class="progress grey">
         <div style="display:none" id="lajelaLoader1" class="indeterminate red"></div>
         <div style="display:none" id="lajelaLoader2" class="indeterminate blue"></div>
         <div  style="display:none" id="lajelaLoader3" class="indeterminate green"></div>    
  </div>
                            
</div>
  <div id="scroll"></div>
		
 
<?php
 function alertSuccess($msg){ echo "<script>
swal('".addslashes(strtoupper(trim($GLOBALS["LANG"]["success"])))."','".addslashes(trim($msg)). "', 'success',{'button':'{$GLOBALS["LANG"]["okay"]}'});
</script>"; } function alertDanger($msg){ echo "<script>
swal('".addslashes(strtoupper(trim($GLOBALS["LANG"]["failed"])))."','".addslashes(trim($msg)). "', 'error',{closeOnEsc: false, closeOnClickOutside:false, 'button':'{$GLOBALS["LANG"]["okay"]}'});
</script>"; } ?>	

