<?php


function statusA($secs){
    $bit = array(
        'year'        => $secs / 31556926 % 12,
        'week'        => $secs / 604800 % 52,
        'day'        => $secs / 86400 % 7,
        'hour'        => $secs / 3600 % 24,
        'minute'    => $secs / 60 % 60,
        'second'    => $secs % 60
        );
        return $bit;
   }



function statusB($secs){
    $bit = array(
        'y'        => $secs / 31556926 % 12,
        'w'        => $secs / 604800 % 52,
        'd'        => $secs / 86400 % 7,
        'h'        => $secs / 3600 % 24,
        'min'    => $secs / 60 % 60,
        's'    => $secs % 60
        );
        
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . '';
        if($v == 1)$ret[] = $v . $k;
        }
    array_splice($ret, count($ret)-1, 0, 'and');
    $ret[] = 'ago.';
    
    return join(' ', $ret);
    }



	 include '../include/kformat.php';
   $sql = "SELECT * FROM users WHERE id = '$selectedUser'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
    while($row = $result->fetch_assoc()) {
	    $user['name'] = ucfirst($row["name"]);
	    $user['name'] = ucfirst($row["name"]);
		$user['id'] = $row["id"];
		$user['address'] = $row["address"];
		$user['email'] = $row["email"];
		$user['phone'] = $row["phone"];
		$user['country'] = $row["country"];
		$user['street'] = $row["street"];
		$user['zipCode'] = $row["zip_code"];
		$user['region'] = $row["region"];
		$user['city'] = $row["city"];
		$user['widget'] = $row["widget"];
		$user['refer'] = $row["refer"];
		$pix = $row["pix"];
		$user['userName'] = ucfirst($row["user_name"]);
		$user['password'] = $row["password"];
		$user['lastUpdate'] = $row["last_update"];
		$user['lastSeen'] = $row["last_seen"];
		$user['credit'] = $row["credit"];
		$user['earn'] = $row["earn"];
          	$user['balance'] =  number_format($row['credit'],2);
         	$user['kbalance'] =  kFormat($row['credit']);
        	$user['earnBalance'] =  number_format($row['earn'],2);
       	        $user['kearn'] =  kFormat($row['earn']);
		$user['pix'] = $pix;
		if(empty($pix)){
			$user['pix'] = 'user.png';
		}

	}
} else {
    $infoNotFound=true;
}
?>
