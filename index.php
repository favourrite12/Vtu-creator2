 <?php include "../include/ini_set.php"; ?>
 <?php include 'include/checklogin.php';?> 
 <?php include "include/header.php"; ?>
 <?php include "../include/data_config.php"; ?>
 <?php include "../include/xcape.php"; ?>  

<title><?php echo $LANG["admin_panel"]; ?></title>
<?php 
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
?>
	 
<?php 
    $totalTransaction = $conn->query("SELECT COUNT(id) AS total FROM recharge WHERE 1")->fetch_assoc()["total"];
    $APITransaction = $conn->query("SELECT COUNT(id) AS total FROM api_transaction WHERE 1")->fetch_assoc()["total"];
    $visitors = $conn->query("SELECT COUNT(id) AS total FROM visitor WHERE 1")->fetch_assoc()["total"];
    $users = $conn->query("SELECT COUNT(id) AS total FROM users WHERE 1")->fetch_assoc()["total"];
    $category = $conn->query("SELECT COUNT(id) AS total FROM category WHERE 1")->fetch_assoc()["total"];
    $service = $conn->query("SELECT COUNT(id) AS total FROM service WHERE 1")->fetch_assoc()["total"];
    $userBalance = $conn->query("SELECT SUM(credit) AS total FROM users  WHERE 1")->fetch_assoc()["total"];
    $userSpent = $conn->query("SELECT SUM(amount) AS total FROM recharge  WHERE status='success'")->fetch_assoc()["total"];
    $userSpent .=$conn->query("SELECT SUM(amount) AS total FROM api_transaction  WHERE status='success'")->fetch_assoc()["total"];
?>
 


<?php
$sql = "SELECT id, display_name FROM service";
 
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

  <section id="content">
          <!--start container-->
          <div class="container">
            <!--card stats start-->
             <div id="card-stats">
              <div class="row mt-1">
                  
                 <div class="col s12 m6 l3 ">
                  <div class="card gradient-45deg-purple-deep-orange min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s4 m4 left-align">
					   <i class="material-icons background-round mt-5">store</i>
					  </div>
                      <div class="col s8 m8 right-align">
					 
                          <p class="no-margin"><?php echo $LANG["service"];?> <?php echo formatWithSuffix($service);?></p>
                      </div>
					   <div class="col s12">
                        
                                               <p><?php echo $LANG["in_stock"];?> <span class="right"><?php echo $LANG["category"]?> <?php echo formatWithSuffix($category); ?></span></p>
                      </div>
                    </div>
                  </div>
                </div>  
                  
                  
                  <div class="col s12 m6 l3">
                  <div class="card  gradient-45deg-light-blue-cyan  min-height-100 white-text hoverable">
                   <div class="padding-4">
                      <div class="col s4 m4 left-align">
		        <i class="material-icons background-round mt-5">shopping_cart</i>
			</div>
                      <div class="col s8 m8 right-align">	 
                          <p class="no-margin"><?php echo $LANG["recharge"];?> <?php echo formatWithSuffix($totalTransaction);?></p>
                      </div>
		     <div class="col s12">
                        
                         <p><?php echo $LANG["transactions"];?><span class="right"><?php echo strtoupper($LANG["api"])?> <?php echo formatWithSuffix($APITransaction); ?></span></p>
                      </div>
                    </div>
                  </div>
                </div>
               <div class="col s12 m6 l3">
                  <div class="card  gradient-45deg-green-teal  min-height-100 white-text hoverable">
                    <div class="padding-4">
                      <div class="col s7 m7 left-align">
			<i class="material-icons background-round mt-5">people</i>
		      </div>
                      <div class="col s5 m5 right-align">
					 
                          <p class="no-margin"><?php echo $LANG["users"];?> <?php echo formatWithSuffix($users);?></p>
                      </div>
			<div class="col s12">
                        
                            <p><?php echo $LANG["clients"];?> <span class="right"><?php echo $LANG["visitors"]?> <?php echo formatWithSuffix($visitors); ?></span></p>
                      </div>
                    </div>
                  </div>
                </div>
                  
                <div class="col s12 m6 l3">
                  <div class="card  gradient-45deg-amber-amber  min-height-100 white-text hoverable">
                   <div class="padding-4">
                      <div class="col s4 m4 left-align">
                          <i class="material-icons background-round mt-5">account_balance</i>	</div>
                      <div class="col s8 m8 right-align">
                          <p class="no-margin"><?php echo $LANG["available"];?> <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?> <?php echo formatWithSuffix($userBalance);?></p>
                      </div>
					   <div class="col s12">
                        
                                               <p><?php echo $LANG["user_balance"];?> <span class="right"><?php echo $LANG["spent"];?> <?php echo htmlspecialchars_decode($webConfig["currency"]["symbol"]);?><?php echo formatWithSuffix($userSpent);?></span></p>
                      </div>
                    </div>
                  </div>
                </div>
               
              </div>
            </div>
           
            
    
   <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>         
            
            
            
 <?php 
if($adminInfo["transaction"]==1){
 ?>          
           
<?php 
	
	$success = $failed = $pending = $reversed = 0;
	$success = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='success'")->fetch_assoc()["total"];
	$failed = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='failed'")->fetch_assoc()["total"];
	$pending = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='pending'")->fetch_assoc()["total"];
        $reversed = $conn->query("SELECT count(id)AS total FROM recharge WHERE status='reversed'")->fetch_assoc()["total"];
	
echo "
     <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['{$LANG['status']}', '{$LANG['number']}'],
          ['{$LANG['successful']}',  $success],
          ['{$LANG['pending']}',   $pending],
          ['{$LANG['failed']}',  $failed],
          ['{$LANG['reversed']}',  $reversed]
        ]);

        var options = {
		  colors: ['green','#00FF00','red','blue'],
		  is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('transactionChart'));

        chart.draw(data, options);
      }
    </script>";
 
 
 ?>

 
            
            
            
            <!--work collections start-->
            <div id="work-collections">
              <div class="row">
                  
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h6><?php echo $LANG["transactions"];?></a></h6>
                         </div>
                       <div  style="height: 300px !important; width: 100% important" id="transactionChart"></div>
                  </div>
                    
                  </div>  
                    
                    
                    
                    
                    
                    
            
                  
               
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h5><?php echo $LANG["transactions"];?> <a class="right" href="transaction/"><?php echo $LANG["view_all"];?></a></h5>
                         </div>
                           <table class="table">
                          <tr>
                                  <th><?php echo $LANG["service"];?></th>
                                  <th><?php echo $LANG["amount"];?></th>
                                  <th colspan="2"><?php echo $LANG["status"];?></th>
                          </tr>
                          <?php
                          $i=1;
                          $sql = "SELECT id,status,amount,service_id FROM recharge WHERE 1 ORDER BY reg_date DESC LIMIT 5 ";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                                   $totalQuery = $result->num_rows;
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {


                                  $actionLink = '<td><center><a target="_blank" href="transaction/view.php?id='.$row["id"].'"><i class="material-icons">visibility</i></a> </center></td>';
                                  


                                  echo '<tr style="font-size:small">';
                                  echo '<td>'.$serviceValue[$row["service_id"]].'</td>';
                                  echo '<td>'.$row["amount"].'</td>';
                                  echo '<td>'.$LANG[$row["status"]].'</td>';
                                  echo  $actionLink;
                                  echo "</tr>";
                          } 
                          }
                          ?>
                          </table>
                  </div>
                </div>
                  
                  
                  
                  
                          
            <?php 

                    $success = $failed = $pending = $reversed = 0;
                    $success = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='success'")->fetch_assoc()["total"];
                    $failed = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='failed'")->fetch_assoc()["total"];
                    $pending = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='initiated'")->fetch_assoc()["total"];
                    $reversed = $conn->query("SELECT count(id)AS total FROM api_transaction WHERE status='reversed'")->fetch_assoc()["total"];
	
            echo "
                 <script type='text/javascript'>
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['{$LANG['status']}', '{$LANG['number']}'],
                      ['{$LANG['successful']}',  $success],
                      ['{$LANG['initiated']}',   $pending],
                      ['{$LANG['failed']}',  $failed],
                      ['{$LANG['reversed']}',  $reversed]
                    ]);

                    var options = {
                      
                              colors: ['green','#00FF00','red','blue'],
                              is3D: true
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('apiTransactionChart'));

                    chart.draw(data, options);
                  }
                </script>";


             ?>


                    
                    
             
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                           <h6><?php echo $LANG["api_transactions"];?></a></h6>
                         </div>
                       <div style="height: 300px !important; width: 100% important" id="apiTransactionChart"></div>
                  </div>
                </div>  
                  
                  
                  
                <div class="col s12 m6">
                   <div class="card  col s12 small hoverable ">
                         <div class="card-title">
                             <h5><?php echo $LANG["api_transactions"];?> <a class="right" href="api_trans/"><?php echo $LANG["view_all"];?></a></h5>
                         </div>
                           <table class="table">
                          <tr>
                                  <th><?php echo $LANG["service"];?></th>
                                  <th><?php echo $LANG["amount"];?></th>
                                  <th colspan="2"><?php echo $LANG["status"];?></th>
                          </tr>
                          <?php
                          $i=1;
                          $sql = "SELECT id,status,amount,service_id FROM api_transaction WHERE 1 ORDER BY reg_date DESC LIMIT 5 ";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                                   $totalQuery = $result->num_rows;
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {


                                   $actionLink = '<td><center><a target="_blank" href="api_trans/view.php?id='.$row["id"].'"><i class="material-icons">visibility</i></a> </center></td>';
                                  

                                  echo '<tr style="font-size:small">';
                              echo '<td>'.$serviceValue[$row["service_id"]].'</td>';
                                  echo '<td>'.$row["amount"].'</td>';
                                  echo '<td>'.$LANG[$row["status"]].'</td>';
                                  echo  $actionLink;
                                  echo "</tr>";
                          } 
                          }
                          ?>
                          </table>
                  </div>
                </div>
<?php }?>
    <?php 
if($navAccess["users"]==1){
 ?>
                <div class="col s12 m6">
                   <div class="card white col s12  hoverable ">
                         <div class="card-title">
                           <h6><?php echo $LANG["users"];?></h6>
                         </div>
                          <?php include "homeuser.php";?>
                  </div>
<?php } ?>
                    
<?php 
if($navAccess["visitor"]==1){
 ?>
                </div>
                <div class="col s12 m6">
                   <div class="card  col s12 white  hoverable ">
                         <div class="card-title">
                           <h6><?php echo $LANG["visitors"];?> </h6>
                         </div>
                          <?php include "homevisitor.php";?>
                  </div>
                </div>
<?php } ?>  
                  
                
                  
              </div>
            </div>
            <!--work collections end-->
            
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
   <!-- END MAIN -->
             
</div>
	<?php include "include/right-nav.php"; ?>
    <?php include "include/footer.php"; ?>
  </body>
</html>
	