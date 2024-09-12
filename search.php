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
checkAccess($adminInfo["deposit"]);
     
?>



<?php $q = xcape($conn,$_GET["q"]);?>
 



<title>
<?php echo $LANG['user_funding_by_admin']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h5><?php echo $LANG["user_funding_by_admin"]; ?> </h5>

			  
			  
			  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM deposit WHERE (id='$q' OR status ='$q' OR amount ='$q')")->num_rows;
$page->searchForm($action,$q);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

$sql = "SELECT id,amount,status,reg_date FROM deposit WHERE (id='$q' OR status ='$q' OR amount ='$q') LIMIT $start,$stop";
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
        <th class="hide-on-med-and-down"><?php echo $LANG["date"]; ?></th>
        <th><?php echo $LANG["action"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
    $sn++;
    
    $method = $LANG[strtolower($row["payment_method"])];
      if(empty($method)){
          $method = $LANG["none"];
    }
	
    echo "<tr>";
    echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
    echo '<td class="hide-on-med-and-down">'.$row["id"].'</td>';
    echo '<td>'.$row["amount"].'</td>';
    echo '<td>'.$LANG[$row["status"]].'</td>';
    echo '<td class="hide-on-med-and-down"><center>'.date("d-m-Y", $row["reg_date"]).'</center></td>';
    echo '<td><center><a target="_blank" href="view.php?id='.$row["id"].'"><i class="material-icons">visibility<i> </a> </center></td>';
    echo "</tr>";
	
} 
}else {
    echo $LANG['no_transaction_found'];
   openAlert($LANG['no_transaction_found']);
}
?>
</table>
</div>

    <?php $page->getPage($currentPage, $totalQuery,$q)?>

</div>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>

</div>
 <?php include '../include/footer.php';?>

