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
<?php echo $LANG['newsletter']; ?> | <?php echo $LANG['subscriber']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG['newsletter']; ?> | <?php echo $LANG['subscriber']; ?> </h4>


			  
			  
			  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM news_letter_subscriber")->num_rows;
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

$sql = "SELECT status,email,reg_date FROM news_letter_subscriber LIMIT $start,$stop";
$result = $conn->query($sql);
$conn->error;
if ($result->num_rows > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th class="hide-on-med-and-down">#</th>
       
	<th><?php echo $LANG["email"]; ?></th>
	<th><?php echo $LANG["status"]; ?></th>
	 <th class="hide-on-med-and-down" ><?php echo $LANG['date']; ?></th>
        
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
   
    echo "<tr>";
    echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
    echo '<td>'.$row["email"].'</td>';
    echo '<td>'.$LANG[$row["status"]].'</td>';
    echo '<td class="hide-on-med-and-down">'.date("r",$row["reg_date"]).'</td>';
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

