      <?php include '../include/ini_set.php';?>
	<?php include 'include/header.php';?>
	<?php include '../include/data_config.php';?>
	<title><?php echo $LANG["clear_records"] ?></title>
        
        <p class="caption"><?php echo $LANG["clear_records"]; ?></p>
              <div class="divider"></div>
              
		<section class="container flexbox">
                    <div class="custom-form-control">
                    <div class="card-panel">
                        <center>
                        <button  <?php echo "onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"].'('.$LANG["clear_visitor_data"].')')."','../../processor/clear_record.php?id=visitor')\"" ?>  class="btn">
                            <?php echo $LANG["clear_visitor_data"]; ?>
                        </button>
                            <br/>
                            <br/>
                         <button  <?php echo "onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"].'('.$LANG["clear_all_testing_transactions_on_api"].')')."','../../processor/clear_record.php?id=api')\"" ?>  class="btn">
                            <?php echo $LANG["clear_all_testing_transactions_on_api"]; ?>
                        </button>
                        </center>
                    </div>
                    </div>
                    
		
		
		
		
</section>

		


</div>
   </div>
     

<?php include 'include/footer.php';?>

		
		
	