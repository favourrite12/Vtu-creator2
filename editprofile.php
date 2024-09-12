
 <?php include '../include/checklogin.php';?>
 <?php include '../include/data_config.php';?>
 <?php include '../include/filter.php';?>
 <?php include '../dashboard/include/header.php';?>
 
 
 
<?php
include '../include/getip.php';
include 'userinfojson.php';
?>



<?php 

$user = userInfo($loginUser,$conn);
$user =  json_decode($user,true);
$name = $user['name'];
$email = $user['email'];
$city = $user['city'];
$phone = $user['phone'];
$region = $user['region'];
$street = $user['street'];
$zipCode = $user['zipCode'];
$country = $user['country'];

$ip = get_client_ip();
$u = file_get_contents("https://geo.lajela.com/json.php?ip=$ip");
$u =  json_decode($u,true);
$callCode = $u['calling_code'];

//echo geoip_country_name_by_name($ip);







if(empty($country)){
	$country = $u['country_name'];
}
if(empty($countryv)){
	$countryv = $u['country_name'];
}

if(empty($city)){
	$city = $u['city'];
}

if(empty($region)){
	$region = $u['region'];
}

if(empty($timeZone)){
	$timeZone = $u['time_zone']['name'];
}
//print_r($u);
?>
     <title><?php echo $LANG["edit_profile"]; ?></title>
<section  class="container">
<?php include 'edp.php';?>
 <section id="content">
        

 
            <div class="section container">
              <p class="caption"><?php echo $LANG["edit_profile"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 flexbox">
                    <div class="card-panel hoverable">	
<div class="row flex-items-sm-center justify-content-center custom-form-control overflow-hidden py-3">
<form class="row col s12" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
 
 
  <div class="input-field col-12">
 	<label for="" class="form-control-label"><?php echo $LANG["full_name"];?></label>
    <input value="<?php echo $name?>" type="text" name='name' class="form-control" >
	<?php echo $nameError;?>
  </div> 
  
  <div class="input-field  col-12">  
  <label for="" class="form-control-label "><?php echo $LANG["phone"];?></label>
    <input value="<?php echo $phone?>" type="tel" name='phone' class="form-control" >
	<?php echo $phoneError;?>
  </div>  
  
   <div class="input-field col-12">
 	<label for="" class="form-control-label"><?php echo $LANG["email"];?></label>
    <input value="<?php echo $email?>" type="email" name='email' class="form-control" >
	<?php echo $emailError;?>
  </div>  
  


 

 <div class="input-field col-12">
 	
   <select  name="country" class="" >
   <option value=""><?php echo $LANG["select_one_option"];?></option>
  <?php include 'country-select.php'; ?>
   </select>
 <label for="" class=""><?php echo $LANG["country"];?></label>
 </div>
 
 
  <div class="input-field col-12">
  	<label for="" class="form-control-label"><?php echo $LANG["region"];?></label>
    <input value="<?php echo $region?>" type="text" name="region" class="form-control" >
  </div> 
 
 <div class="input-field col-12">
 	<label for="" class="form-control-label"><?php echo $LANG["city"];?></label>
    <input value="<?php echo $city?>" type="text" name='city' class="form-control" >
  </div>   

  <div class="input-field col-12">
 	<label for="" class="form-control-label"><?php echo $LANG["street"];?></label>
    <input value="<?php echo $street?>" type="text" name='street' class="form-control" >
  </div>   

  <div class="input-field col-12">
 	<label for="" class="form-control-label"><?php echo $LANG["zip_code"]; ?></label>
    <input value="<?php echo $zipCode?>" type="text" name='zipCode' class="form-control" >
  </div>   
  

 
  <div class="input-field col-12">
    <button  type="submit" class="form-control btn btn-success" ><?php echo $LANG["edit_profile"];?></button>
 </div> 
 
</form>
</div>
</section>

<script>
	document.querySelector('option[value*="<?php echo $country ?>"]').selected = "selected";
	
</script>

       
   </div>
   </div>
     
 <?php include '../dashboard/include/footer.php';?>