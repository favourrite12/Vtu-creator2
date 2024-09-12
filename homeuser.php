<?php 
$userStat = [];
$sql = "SELECT reg_date FROM users ORDER BY reg_date";
$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
    $userStat[date("Y",$row["reg_date"])] [date("n",$row["reg_date"])] [date("j",$row["reg_date"])] =  $userStat[date("Y",$row["reg_date"])] [date("n",$row["reg_date"])][date("j",$row["reg_date"])] + 1;
	}
	}else{

	}

//print_r($userStat);


?>
<script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable()
		data.addColumn('string', '<?php echo $LANG["date"];?>');
		data.addColumn('number', '<?php echo $LANG["users"];?>');
     
          data.addRows([
		
          <?php 
		  
		 
		  
	
	
			  $queryEndYear =  time();
			  $queryStartYear = time();
			  $default = true;
		  
		  
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
					 
					$myvalue = $userStat[$selectedYear][$mi][$i];

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

        var chart = new google.visualization.ColumnChart(document.getElementById('user_chart'));

        chart.draw(data, options);
      }
    </script>
  
<div id="user_chart" class="graph-view" style="width: 100%; height: 365px; clear:both"></div>
		
