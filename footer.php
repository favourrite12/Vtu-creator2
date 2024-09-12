</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <script>$(".clear-record").after('<li class="bold"><a  class="waves-effect waves-cyan green white-text text-uppercase" href="https://vtucreator.com/pro"><i class="material-icons left white-text">grade</i><span class="nav-text">Upgrade to Pro</span></a></li>');</script>
<!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START FOOTER -->
	<script>
	 $(document).ready(function(){
         $('.tooltipped').tooltip();
    });
	</script>
		
<?php 
 if(session_status()== PHP_SESSION_NONE){
     session_start();
 }
$_SESSION["webLink"]=$webConfig["webLink"];
?>	
		
<script>
var tab =  document.querySelectorAll(".tab a");
for(i=0; i<tab.length; i++){
tab[i].addEventListener("click", function(e){
	location.href = e.target.href;
});
}
</script> 
		
	
    <footer class="page-footer lajela-footer">
      <div class="footer-copyright">
        <div class="container">
          <span> <?php echo $LANG["copyright"] ?> &copy;
              <?php echo date("Y") ?> <?php echo $LANG["all_rights_reserved"] ?>
		  </span>
        </div>
      </div>
    </footer>
    <!-- END FOOTER -->
    <!-- ================================================================================================ -->
         <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/popper.min.js"></script>
	 <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/vendors/jquery-2.2.1.min.js"></script>
	 <!--materialize js-->
 
    <!--scrollbar-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
        <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/custom-script.js"></script>
    	<script src="//<?php echo $webConfig["webLink"];?>/bootstrap/bootstrap-3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/materialize.min.js"></script>
        <script type="text/javascript" src="//<?php echo $webConfig["webLink"];?>/js/js.php"></script>
        <!-- //////////////////////////////////////////////////////////////////////////// -->
	
 
   <script>
$(document).ready(function(){
    $(".show-menu").collapse("show");
	});
	
</script>

 <style>
         
        .lajela-footer{
            background-color: <?php echo $webConfig["footerBackgroundColor"];?> !important;
        }
        .lajela-footer *{
            color: <?php echo $webConfig["footerForegroundColor"];?> !important;
        }
        
         .lajela-header{
            background-color: <?php echo $webConfig["navBackgroundColor"];?> !important;
        }
        .lajela-header *{
            color: <?php echo $webConfig["navForegroundColor"];?> !important;
        }
        
        .btn{
            background-color: <?php echo  $webConfig["buttonBackgroundColor"];?> !important;
            color: <?php echo $webConfig["buttonForegroundColor"];?> !important;
            
        } 
    </style>
<style>
    .social-icons li{
        display: inline-block;
        width: 30px;
        height: 30px;
        text-align: center; 
        padding-top: 8px;
        margin-top: 40px;
    }
    .social-icons *{
        color:#fff !important; 
    }
    .social-icons li:hover{
        opacity: 0.6;
    }
</style>


