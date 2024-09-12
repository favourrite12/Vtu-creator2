  <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 
<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["bank"]);
?>
 
 
  <?php
 
	function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
 
 
 
 

		

<script>
function previewNewsletter(id) {
  window.open("preview.php?id="+id, "_blank", "toolbar=no,scrollbars=no,resizable=yes,status=no");
}
</script>		
		 

		 <title><?php echo $LANG["bank_account"]?></title>
		
<section class="container">
  <section id="content">
        
        
 
            <div class="section container">
              <p class="caption"><?php echo $LANG['bank_account']; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel hoverable">			   
	<div class="row flex-items-sm-center">
	
	<table class="table">
 <?php

		  $sql = "SELECT * FROM bank";
		  $result = $conn->query($sql);
			if ($result->num_rows > 0) {
			   // output data of each row
				while($row = $result->fetch_assoc()) {
				   $bankName =   $row["bank_name"];
				   $date  = date("c",$row["reg_date"]);
				   $date =   time_elapsed_string($date);
				   $id =   $row["id"];
				   $accountNumber = $row["account_number"];
				   $accountType = $row["account_type"];
				   $accountName = $row["account_name"];
				  
					echo "<tr>
					      <td>$bankName</td>
					      <td>$accountName</td>
					      <td>$accountNumber</td>
					      <td>$accountType</td>
					      <td>$date</td>
					      <td><a class=\"btn btn-primary btn-sm py-0\"  href=\"edit.php?id=$id\" >{$LANG["edit"]}</a></td>
					      <td><button class=\"btn btn-danger btn-sm py-0\"  onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_bank.php?id=$id')\">{$LANG['delete']}</button></td>
					     </tr>";
					
				}
			}else{
				openAlert($LANG["no_bank_account_found"]);
			}
		?>
	</table>	 

</div>
</section>

                    </div>
                  </div>
                </div>
              </div>
        </section>




 <div class="fixed-action-btn tooltipped" data-position="left" data-tooltip="<?php echo ucfirst($LANG["add_new_bank_account"]) ?>">
    <a href="new.php" class="btn-floating btn-large">
      <i class="large material-icons">add</i>
    </a>
  </div>

<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		
		
		