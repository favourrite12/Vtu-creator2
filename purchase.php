 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../include/header.php';?>
 <?php include '../../include/pagination.php'; $page = new pagination($conn);?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["transaction"]);  
?>

 

<?php
$sql = "SELECT id, display_name FROM service ";
 
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	      	$serviceValue[$row['id']]=$row['display_name'];		
		}
	  }else{
		$serviceValue["notFound"] = true;
	  }
	//print_r($serviceValue);
?>

<title>
<?php echo $LANG['purchase']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG["purchase"]; ?> </h4>
<?php echo $LANG['the_below_table_contains_payment_history_of_all_transactions_through_direct_online_payment']; ?>

			  
			  
			  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM guest_payment")->num_rows;
$page->searchForm("purchase_search.php");
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

$sql = "SELECT *  FROM guest_payment  ORDER BY reg_date DESC LIMIT $start,$stop";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th>#</th>
        <th ><?php echo $LANG['transaction_id']; ?></th>
	<th><?php echo $LANG["service"]; ?></th>
	<th><?php echo $LANG["amount"]; ?></th>
        <th><?php echo $LANG["status"]; ?></th>
        <th><?php echo $LANG["date"]; ?></th>
        <th><?php echo $LANG["gateway_response"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
     
	$date = date("d-m-Y @ g:ia ",$row["reg_date"]);	
	$serviceID  = $conn->query("SELECT service_id FROM recharge WHERE id='{$row["transaction_id"]}' ")->fetch_assoc()["service_id"];
	
	$gatewayResponse= !empty($row["gateway_response"])?$row["gateway_response"]:$LANG["none"];
	echo "<tr>";
	echo '<td>'.$i++.'</td>';
	echo '<td>'.$row["id"].'</td>';
        echo '<td>'.$serviceValue[$serviceID].'</td>';
	echo '<td>'.$row["amount"].'</td>';
	echo '<td>'.$LANG[$row["status"]].'</td>';
        echo '<td>'.$date.'</td>';
	echo '<td><center><a data-position="left" data-tooltip="'.$gatewayResponse.'" class="tooltipped"  href="javaScript:void(0)"><i class="material-icons">visibility</i></a> </center></td>';
	echo "</tr>";
	
} 
}else {
    echo ($LANG['no_transaction_found']);
    openAlert($LANG['no_transaction_found']);
}
?>
</table>
</div>

    <?php $page->getPage($currentPage, $totalQuery)?>

</div>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>




<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

