<?php include '../../include/ini_set.php'; ?> 
 <?php include '../include/checklogin.php';?>
<?php include '../include/header.php';?>
 <?php include '../../include/data_config.php';?>
 <?php include '../../include/filter.php';?>
 
 <?php 
include '../include/admininfo.php';
$adminInfo = adminInfo($loginAdmin,$conn);
//print_r($adminInfo);
 checkAccess($adminInfo["users"]);
?>
 
 
		
		 
		 
 <title><?php echo $LANG["registered_user"]; ?></title>
  <section id="content">
        
        
          <div class="container">
            <div class="section">
              <p class="caption"> <?php echo $LANG["registered_user"]; ?></p>
              <div class="divider"></div>
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6">
                    <div class="card-panel">
		


      <?php
  
       $id = xcape($conn, $_GET['id']);
       
       $sql = "SELECT  user_name,password,id FROM users  WHERE  id = '$id' ";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
         $_SESSION["login_user"] = $row["id"];
         $_SESSION["user_password"] = md5($row["password"]);

        }
        javaScriptRedirect("../../dashboard");
       }
       $conn->close();
       ?>

	

		  
                    </div>
        </section>





<?php include '../include/right-nav.php';?>
<?php include '../include/footer.php';?>
		