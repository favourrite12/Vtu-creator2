<?php include '../../include/ini_set.php';?> 
<?php include '../include/checklogin.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 <?php include '../../include/webconfig.php';?>
 <?php include '../include/header.php';?>
 <?php include '../../include/pagination.php'; 
 $page = new pagination($conn);?>
<?php 
include '../include/admininfo.php'; 
$adminInfo = adminInfo($loginAdmin,$conn);
checkAccess($adminInfo["payment"]);
?>

<title>
Submitted Reserved Account
</title>
   
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              
	KYC submitted for approval


              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="row">
                    <div class="card-panel hoverable">
<?php
 $i=1; $currentPage = xcape($conn, $_GET['page']); 
 $totalQuery = $conn->query("SELECT id FROM reserved_account WHERE submitted='1' AND verified <> '1'")->num_rows;
 $page->searchForm($action); 
 $pageData = $page->getData($currentPage,$totalQuery); 
 $start = $pageData["start"]; 
 $stop = $pageData["stop"]; 
 $sql = "SELECT first_name, last_name, middle_name, id FROM reserved_account WHERE  submitted='1' AND verified <> '1' LIMIT $start,$stop"; 
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) { ?>
<div class="container pl-sm-5">

<div class="col s12">


<table class="bordered ">
<tr>
    <th class="hide-on-med-and-down">#</th>
        <th class="" >First Name</th>
	<th>Last Name</th>
        <th colspan="2">Middle Name</th>
        
</tr>
<?php  while($row = mysqli_fetch_assoc($result)) { $sn++; 
echo "<tr>"; echo '<td class="hide-on-med-and-down" >'.$i++.'</td>';
echo '<td>'.$row["first_name"].'</td>';
echo '<td>'.$row["last_name"].'</td>'; 
echo '<td>'.$row["middle_name"].'</td>'; 
echo '<td><center><a target="_blank" href="approval.php?id='.$row["id"].'"><i class="material-icons">visibility<i> </a> </center></td>'; 
echo "</tr>"; } }else { 
echo "NO KYC Submited for approval"; 
openAlert("NO KYC Submited for approval"); 

} ?>
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

