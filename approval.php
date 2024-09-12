<?php include "../../include/ini_set.php" ;?>
<?php
include '../include/checklogin.php'; 
include '../include/header.php'; 
include '../../include/data_config.php'; ?>
<?php include '../../account/userinfojson.php';?>
<?php include '../../include/webconfig.php';?>
<?php include '../../include/filter.php';?>
<?php  include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
checkAccess($adminInfo["transaction"]); ?>
<?php
$id= xcape($conn,$_GET['id']); 
$sql = "SELECT * FROM reserved_account WHERE id ='$id'";
$result = mysqli_query($conn, $sql); 
if (mysqli_num_rows($result) > 0) { 
    while($row = mysqli_fetch_assoc($result)) { 
        $id = $row["id"]; 
        $firstName = $row["first_name"]; 
        $lastName = $row["last_name"]; 
        $middlName = $row["middle_name"]; 
        $bvn = $row["bvn"];
        $status = $row["verified"]==1?"approved":"pending";
        $cardNumber = $row["card_number"]; 
        $cardType = $row["card_type"]; 
        $cardPath = $row["card_path"]; 
        $previousRejectReason = $row["reject_reason"]; 
        $date = date("l j<\s\up>S</\s\up>, F Y",$row["date_of_birth"]); 
        
      } } else { 
        openAlert("User Not Found");
      } ?>



<title>KYC Approval</title>

  <section id="content">
        
        
          <div class="container">
            <div class="section flexbox">
			  
			  

  <!-- Form with placeholder -->
  <div style="" class="col s12 m12 l6 custom-form-control ">
	<div class="card-panel hoverable">


<section class="container">
<div class="row py-3 flex-items-sm-center justify-content-center">
<div class="col-sm-12 row">
    <div class="left"> <h4>KYC Approval</h4>
    </div>
    <img style="height: 80px !important; width: 100px !important" class="responsive-img  materialboxed right h-sm-30" src="../../reserved-account/card/<?php echo $cardPath?>" />
    <div class="clearfix"></div>				
 

<table class ="table">
<tr>



   <td>
          First Name
   </td> 
   
   <td>
     <?php echo $firstName?>
   </td>
</tr>
<tr>
   <td>
       Last Name
   </td>
     <td>
     <?php echo $lastName?>
   </td>
</tr>
<tr>
   <td>
      Middle Name
   </td>
     <td>
     <?php echo $middlName?>
   </td>
</tr>
<tr>
   <td>
     BVN
   </td>
     <td>
      <?php echo $bvn; ?>
   </td>
</tr>



<tr>
   <td>
    Card Type
   </td>

     <td>
 <?php echo $cardType ;?>
   </td>
</tr>


 <tr>
   <td>
   Card Number
   </td>

     <td>
     <?php echo $cardNumber ; ?>
   </td>
</tr>

<tr>
    <td>
        Date of Birth
    </td>

    <td>
        <?php echo $date; ?>
    </td>
</tr>

<tr>
    <td>
        Status
    </td>

    <td>
        <?php echo $status; ?>
    </td>
</tr>

</table>

</div>
 
</section>
            
<section class="container">
    <form onsubmit="return ajaxRequest(this,'../../processor/kyc_approval.php');">
	      <div class="row  flex-items-sm-center justify-content-center">
                  
                  <input hidden name="id" value="<?php echo $id;?>"/>
                  <?php if(!empty($previousRejectReason)){?>
                  <div class="switch col s12 "  >
                       <h5> Reason for previous rejection.</h5>
                         <?php echo $previousRejectReason; ?>
                       <br/>
                       <br/>
                   </div>
                  <?php } ?>
                  <div id="rejectReason" class="col s12 input-field" style="display: none">
                      <textarea name="rejectReason" class="materialize-textarea"></textarea>
                      <label for="reasonRejected">Reason for rejecting the KYC</label>
                  </div>
                  <div class="switch col s6 "  >

                         <div class="switch">
                               <label>
                                 <input onchange="checkApproval(this)" id="approval" checked value="1" type="checkbox" name="approval">
                                 <span class="lever"></span>
                                 Approve
                               </label>
                         </div>
                   </div>
              	<div class="col s6 ">
			<button class="btn right btn-danger btn-sm py-0">Submit</button>
			</div>
              </div>
    </form>

</div>
</div>
</section>  
			 </div>
			</div>
		  </div>
		</div>
	  </div>
</section>

<script>
   function checkApproval(check){
       if(check.checked){
           document.getElementById("rejectReason").style.display="none";
       }else{
           document.getElementById("rejectReason").style.display="block";
       }
   } 
 </script>


<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>