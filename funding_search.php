 <?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../include/header.php';?>
 <?php include '../../account/userinfojson.php';?>
 <?php include '../../include/pagination.php'; $page = new pagination($conn);?>

<?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["transaction"]);  
?>

 <?php $q = xcape($conn,$_GET["q"]);?>

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
<?php echo $LANG['wallet_funding']; ?>
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
			  <h4><?php echo $LANG["wallet_funding"]; ?> </h4>
  
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1;
$currentPage = xcape($conn, $_GET['page']);
$totalQuery = $conn->query("SELECT id FROM payment  WHERE (id='$q' OR status ='$q' OR amount ='$q')")->num_rows;
$page->searchForm("funding_search.php",$q);
$pageData = $page->getData($currentPage,$totalQuery);
$start = $pageData["start"];
$stop = $pageData["stop"];

$sql = "SELECT *  FROM payment WHERE (id='$q' OR status ='$q'  OR amount ='$q') ORDER BY reg_date DESC LIMIT $start,$stop";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">




<table class="bordered ">
<tr>
    <th>#</th>
        <th ><?php echo $LANG['transaction_id']; ?></th>
	<th><?php echo $LANG["amount"]; ?></th>
	<th><?php echo $LANG["date"]; ?></th>
        <th><?php echo $LANG["customer"]; ?></th>
        <th><?php echo $LANG["status"]; ?></th>
        <th><?php echo $LANG["gateway_response"]; ?></th>
</tr>
<?php 

    while($row = mysqli_fetch_assoc($result)) {
        $sn++;
	$gatewayResponse= !empty($row["gateway_response"])?$row["gateway_response"]:$LANG["none"];
	$date = date("d-m-Y @ g:ia ",$row["reg_date"]);
	$u =  userInfo($row["owner"],$conn);
        $u = json_decode($u,true);
	$owner = $u["name"];
	$ownerId = $u["id"];
	$phone = $u["phone"];
	$email = $u["email"];	
        
	echo '<td>'.$i++.'</td>';
	echo '<td>'.$row["id"].'</td>';
	echo '<td>'.$row["amount"].'</td>';
	echo '<td>'.$date.'</td>';
	echo '<td>'.$owner.'</td>';
	echo '<td>'.$LANG[$row["status"]].'</td>';
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

    <?php $page->getPage($currentPage, $totalQuery,$q)?>

</div>


                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>




<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>

