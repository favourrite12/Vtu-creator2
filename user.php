 <?php include '../include/ini_set.php';?>
 <?php include 'include/checklogin.php';?>
 <?php include '../include/data_config.php';?>
 <?php include '../include/filter.php';?>
 <?php include 'include/header.php';?>
 
<?php 
   
include 'include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
checkAccess($adminInfo["users"]);   
?>
 
 
 
 
  <section class="container">
<?php 
$id =  mysqli_real_escape_string($conn, $_GET['id']);  
$queryStartYear =  mysqli_real_escape_string($conn, $_GET['start']);
$queryEndYear =  mysqli_real_escape_string($conn, $_GET['end']);  

  
$sql = "SELECT reg_date FROM users ORDER BY reg_date";
$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
    $stat[date("Y",$row["reg_date"])] [date("n",$row["reg_date"])] [date("j",$row["reg_date"])] =  $stat[date("Y",$row["reg_date"])] [date("n",$row["reg_date"])][date("j",$row["reg_date"])] + 1;
	}
	}else{

	}

//print_r($stat);


?>

 <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    

<script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable()
		data.addColumn('string', '<?php echo $LANG["date"];?>');
		data.addColumn('number', '<?php echo $LANG["users"];?>');
     
          data.addRows([
		
          <?php 
		  
		 
		  
		 
		  if(empty($queryStartYear) || empty($queryEndYear)){
			  $queryEndYear =  time();
			  $queryStartYear = time();
			  $default = true;
		  }else{
			  $queryStartYear = strtotime($queryStartYear);
			   $queryEndYear =  strtotime( $queryEndYear);
		  }
		  
		  $defaultStartDay = date("j",$queryStartYear);
		  $defaultStartMonth = date("n",$queryStartYear);
		  $defaultStartYear = date("Y",$queryStartYear); 
		  
		  $defaultEndDay = date("j",$queryEndYear);
		  $defaultEndMonth = date("n",$queryEndYear);
		  $defaultEndYear = date("Y",$queryEndYear);
		
		  
		  $yearDif = $defaultEndYear - $defaultStartYear;
		  
		  
        for($yi = 0; $yi <= $yearDif; $yi++ ){
			$selectedYear = $defaultStartYear + $yi;
			
			$endMonth = 12;
			$startMonth = 1;
			
			if($selectedYear == $defaultStartYear){
			 $startMonth = $defaultStartMonth;	 
			}
			
			if($selectedYear == $defaultEndYear){
			 $endMonth = $defaultEndMonth;		 
			}
			if($default){
				 $startMonth = date("n",time());
				 $endMonth	= date("n",time());	
			}
			
		   for($mi = $startMonth; $mi <= $endMonth; $mi++ ){
			   $startDay = 1;
			   $endDay = cal_days_in_month(CAL_GREGORIAN,$mi,$selectedYear);
			   
				//echo $month;
				if($selectedYear == $defaultStartYear && $mi==$defaultStartMonth){
				 $startDay = $defaultStartDay;
				
				 $endDay	= cal_days_in_month(CAL_GREGORIAN,$mi,$selectedYear);	 
				}
			
				if($selectedYear == $defaultEndYear && $mi == $defaultEndMonth){
				 $endDay = $defaultEndDay;		 
				}
	
				if($default){	
				 $startDay = 1;
			     $endDay = cal_days_in_month(CAL_GREGORIAN,$mi,$selectedYear);
			    }
				
				for($i =  $startDay; $i <= $endDay; $i++){
					 
					 $coma = ',';
					if($i == $endDay){
						//$coma='';
					}
					 
					$myvalue = $stat[$selectedYear][$mi][$i];

					if(empty($myvalue)){
						$myvalue = 'null';
					}
						
			
					$time = mktime(0,0,0,$mi,$i,$selectedYear);

					
					$time = date("D, j-n-y",$time);
					//$time = date("d",$time);
				
					
					
					echo "
					[ '$time', $myvalue ] $coma
					";
					//echo "<tr><td>$time $myvalue</td></tr>";
					
				
			}
		  }
		}		
		
		  ?>
       
	   ]);
   
        var options = {
        hAxis: {
          title: '<?php echo $LANG["date"];?>',
		  format: ''
        },
        vAxis: {
          title: '<?php echo $LANG["users"];?>',
		  format:''
        },
        backgroundColor: '#f1f8e9'
      };

        var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  
  <title><?php echo $LANG["users_statistic"] ;?></title>
  <section style="width:100% !important" id="content">
          <div class="container">
            <div class="section row">
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s12 m12 l12 ">
                    <div class="card-panel   hoverable ">
                   
				   
	 
<div class="row" >  
    <div class="col s12">
        <span class="right text-info "><i class="fa fa-check"></i> <?php echo $LANG["recommended_1_month_interval"];?></span>  
    </div>
<form  action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="get">
<?php
$startCal = mktime(0,0,0,$defaultStartMonth,$defaultStartDay,$defaultStartYear);
$endCal = mktime(0,0,0,$defaultEndMonth,$defaultEndDay,$defaultEndYear);
?>
 <div class="col m5 s4">  
<?php echo $LANG["starts"];?>  <input class="form-control datepicker mx-1"  value="<?php echo date('Y-m-d',$startCal);?>" type="date" name="start" /> 
 </div>
  <div class="col m5 s4"> 
    <?php echo $LANG["ends"];?> <input class="form-control datepicker  mx-1" type="date" value="<?php echo date('Y-m-d',$endCal);?>"  name="end" /> 
  </div>
  
  <div class="col m2 s4"> 
      <button class="btn waves-effect waves-light right"><i class="material-icons">visibility</i></button>
  </div>
</form>


</div>


<div id="curve_chart" class="graph-view" style="width: 100%; height: 400px; clear:both"></div>
		
		


</section>




                     </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>





<?php include 'include/right-nav.php';?>
<?php include 'include/footer.php';?>
		