<?php include "../../include/ini_set.php" ;?>
<?php
include '../include/checklogin.php';
include '../include/header.php';
include '../../include/data_config.php';
?>

<?php include '../../include/webconfig.php';?>
<?php include '../../include/filter.php';?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["users"]);  
?>



<?php
 $selectedUser  = xcape($conn,$_GET['id']);
?>
<?php include '../../account/userinfor.php';?>

<title><?php echo $LANG["user_details"]?></title>

  <section id="content">
        
        
          <div class="container">
            <div class="section flexbox">
			  
			  

  <!-- Form with placeholder -->
  <div style="" class="col s12 m12 l6 custom-form-control ">
	<div class="card-panel hoverable">




<section class="container">
<div class="row py-3 flex-items-sm-center justify-content-center">
<div class="col-sm-12 row">
    <div class="left"> <h4><?php echo $LANG["user_details"]?></h4></div>
    <img style="height: 80px !important; width: 100px !important" class="responsive-img right h-sm-30" src="../../account/profile-pix/<?php echo $user['pix']?>" />
    <div class="clearfix"></div>				

<table class ="table">
<tr>

<tr>
   <td>
       <?php echo ucwords($LANG["user_name"]); ?>
   </td>
   <td>
     <?php echo $user["userName"]?>
   </td>
</tr>


   <td>
          <?php echo ucwords($LANG["full_name"]); ?>
   </td> 
   
   <td>
     <?php echo $user["name"]?>
   </td>
</tr>
<tr>
   <td>
        <?php echo ucwords($LANG["phone"]); ?>
   </td>
     <td>
     <?php echo $user["phone"]?>
   </td>
</tr>
<tr>
   <td>
      <?php echo ucwords($LANG["user_balance"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $user["balance"]?>
   </td>
</tr>
<tr>
   <td>
     <?php echo ucwords($LANG["earning_balance"]); ?>
   </td>
     <td>
      <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo $user["earnBalance"]; ?>
   </td>
</tr>








<tr>
   <td>
   <?php echo ucwords($LANG["email"]); ?>
   </td>
   <td>
     <?php echo $user["email"]?>
   </td>
</tr>

 

<tr>
   <td>
     <?php echo $LANG["last_seen"]; ?>
   </td>
     <td>
     <?php echo date("l j<\s\up>S</\s\up>, F Y @ g:ia ",$user["lastSeen"]); ?>
   </td>
</tr>
 





</table>

</div>
    

    
</section>

					
					
					
<?php 

if($infoNotFound===true){
    openAlert($LANG["no_record_found"]);
}

if($user["pix"]!="user.png"){
    $token = base64_decode($user["pix"]);
}

echo "<a href=\"javaScript:void(0)\" class=\"btn btn-flat red white-text left py-0\"  onclick=\"ajaxConfirm('{$LANG["the_record will_be_deleted_completely_this_action_can_not_be_undo"]}','../../processor/delete_user.php?id={$user["id"]}&token=$token')\"><i class=\"material-icons left\">delete</i>{$LANG['delete']}</a>";
echo "<a target=\"blank\" href=\"login.php?id={$user["id"]}\" class=\"btn  right py-0\"  >{$LANG['login']}</a>";
?>
					 					
            <div class="clearfix">
                
            </div>				
					
					
					



			 </div>
			</div>
		  </div>
		</div>
	  </div>
</section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>