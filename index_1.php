 <?php include '../include/ini_set.php';?>
 <?php include '../include/checklogin.php';?>
 <?php include '../dashboard/include/header.php';?>
 <?php include '../include/filter.php';?>
 <?php include '../include/pagination.php'; $page = new pagination($conn);?>



<title>
<?php echo $LANG['transaction_history']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG["transactions"]; ?> </h4>
<?php echo $LANG['the_below_table_contains_payment_history_of_all_transactions']; ?>

			  
			  
			  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM payment WHERE  owner='$loginUser'")->num_rows;
$page->searchForm($action);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];
//refresh
$sql = "SELECT reg_date,settled,id,amount,status FROM payment WHERE owner='$loginUser' LIMIT $start,$stop";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th class="hide-on-med-and-down">#</th>
        <th class="hide-on-med-and-down" ><?php echo $LANG['transaction_id']; ?></th>
	<th><?php echo $LANG["amount"]; ?></th>
	<th><?php echo $LANG["status"]; ?></th>
        <th class="hide-on-med-and-down" colspan="2"><?php echo $LANG["date"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
    $link = "view.php?id=";
    $icon = "visibility";
    if($row["status"]=="pending"){
      $link="method.php?wallet=";
      $icon = "refresh";
    }
    echo "<tr>";
    echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
    echo '<td class="hide-on-med-and-down">'.$row["id"].'</td>';
    echo '<td>'.$row["amount"].'</td>';
    echo '<td>'.$LANG[$row["status"]].'</td>';
    echo '<td class="hide-on-med-and-down"><center>'.date("h:i:a d-M-Y",$row["reg_date"]).'</center></td>';
    echo '<td><center><a target="_blank" href="'.$link.$row["id"].'"><i class="material-icons">'.$icon.'<i> </a> </center></td>';
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

</div>
 <?php include '../dashboard/include/footer.php';?>

