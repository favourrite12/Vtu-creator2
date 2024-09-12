 <?php include "../include/ini_set.php"; ?>
 <?php include "../include/data_config.php"; ?>
 <?php include "../include/filter.php"; ?>
 <?php include "../include/header.php"; ?>


<?php 
if(!empty($_GET["recharge"])){
    include "recharge_processor.php";
    $id = xcape($conn, $_GET["recharge"]);
    $sql = "SELECT status,transaction_id FROM guest_payment WHERE id='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $status = $row["status"];
        $transactionId = $row["transaction_id"];
        if($status=="success"){
           $transaction = payService($conn, $transactionId);
           if($transaction===true){
              alertSuccess($GLOBALS["LANG"]["transaction_successful"]); 
           }
        }  else {
            alertDanger($LANG["transaction_failed_unable_to_verify_payment"]); 
            
        }
    }else{
         alertDanger($LANG["transaction_failed_unable_to_fetch_payment_data"]);
    }
}elseif (!empty($_GET["wallet"])) {
    include "wallet_processor.php";
    $transaction = fundWallet($conn, xcape($conn, $_GET["wallet"]));
}

?>






 <title><?php echo $LANG["transaction"] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container flexbox">
            <div class="section row "  >
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 custom-form-control ">
                    <div id="payCard" class="card-panel   hoverable ">
                   
                       <?php if($transaction===true){  ?>
                        <div class="alert alert-success text-center">
                            <h5> <?php echo strtoupper($LANG["transaction_successful"]) ;?></h5>
                         </div>
                       <?php }else{?>
                        <div class="alert alert-danger">
                            <h5 class="text-center title"> <?php echo strtoupper($LANG["transaction_failed"]) ;?></h5>
                            <ul>
                               <?php foreach ($transaction as $error) {?>
                                <li><i class="material-icons left small">error</i><?php echo $LANG[$error];?></li>
                               <?php }?>
                            </ul>
                         </div>
                       <?php }?>
                        <button class="btn waves-effect waves-green right"><?php echo $LANG["continue"];?></button>
                        <span class="clearfix"></span>
                    </div>
                  </div>
            </div>
          </div>
  </section>

</div>
</div>
<?php include "../include/footer.php"; ?>