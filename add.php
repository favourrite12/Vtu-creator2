<?php include '../include/ini_set.php';?>
<?php include '../include/checklogin.php';?>
<?php include '../dashboard/include/header.php';?> 
<?php include '../include/webconfig.php';?>
<?php include '../include/filter.php';?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $amount = xcape($conn, $_POST["amout"]);
 $id = mt_srand()+time();
 $regDate =  time();
 $sql = "INSERT INTO payment (id, amount,owner,reg_date) VALUES( '$id','$amount','$loginUser','$regDate')";
 if($conn->query($sql)===true){
     javaScriptRedirect("method.php?wallet=$id");
 }else{
     alertDanger($LANG["unknown_error"]);
 }
 
}
?>







<title><?php echo $LANG['wallet_funding']; ?></title>
<?php
//print_r($user); 
?>

  <section id="content">
<div class="col s12">
      <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#card"><?php echo $LANG['pay_with_card']; ?></a></li>
        <li class="tab col s3"><a  href="#deposit"><?php echo $LANG['bank_details']; ?></a></li>
      </ul>
</div>



<div id="deposit" class="">
	 
<div class="container flexbox">
  <div class="section" >


        <!-- Form with placeholder -->
        <div class="row col s6 m12 l12">
      <div  class="card-panel  hoverable ">


<?php echo $LANG["how_to_pay_to_bank_account"];?>

<br>
<br>
<table class="responsive-table">
<th><?php echo $LANG["bank_name"]?>
</th>

<th><?php echo $LANG["account_name"]?>
</th>

<th><?php echo $LANG["account_number"]?>
</th>

<th><?php echo $LANG["account_type"]?>
</th>
<?php

		  $sql = "SELECT * FROM bank";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $bankName =   $row["bank_name"];
				   $id =   $row["id"];
				   $accountNumber = $row["account_number"];
				   $accountType = $row["account_type"];
				   $accountName = $row["account_name"];
				  
					echo "<tr>
					      <td>$bankName</td>
					      <td>$accountName</td>
					      <td>$accountNumber</td>
					      <td>$accountType</td>
					     </tr>";
					
				}
			}else{
				echo $LANG["no_record_found"];
			}
		?>
</table>
</div>
        </div>
  </div>
</div>
</div>
  </section>

      
      
      
      
<div id="card" class="">
<?php echo $LANG["please_note_that_funding_your_wallet_attracts_fee"];?>	 
<div class="container flexbox">
  <div class="section" >


        <!-- Form with placeholder -->
        <div class="row col s6 m12 l12 custom-form-control">
      <div  class="card-panel  hoverable ">




        <form class="row flex-items-sm-center justify-content-center border border-success px-3 overflow-hidden py-3 " method="post" id="register" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' id="contact_form">							
         <div class="input-field col s12">
                 <input type="text" class="form-control" name="amount" id="amount">
                 <label for="usr"><?php echo $LANG["amount"]; ?> <i><?php echo $LANG["1000_for_1000"];?></i> </label>      
        </div>

        <div class="input-field col s12">
             <button class="btn right waves-effect waves-light"><?php echo $LANG["continue"]?></button>
         </div>
         </form>
        </div>
</div>
</div>
</div>
</div>



 </section>
 
</div>
</div>
</div>
</div>
</div>
</div>

<?php include '../dashboard/include/footer.php';?> 