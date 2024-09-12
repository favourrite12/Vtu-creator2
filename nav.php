<body>
    <?php  function show($menu){ define("reg", ($_SERVER['REQUEST_URI'])); if(stristr(reg,$menu)!==false){ return "show-menu"; } } function activeMenu($menu){ define("reg", ($_SERVER['REQUEST_URI'])); if(stristr(reg,$menu)!==false){ return "active"; } } $navAccess = adminNav($_SESSION["admin"],$conn); ?>
    
    <!-- Start Page Loading -->
   
   <?php if($webConfig["activeLoader"]==1){?>
     <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
   <?php } ?>
    
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
       <nav  class="navbar-color lajela-header">
          <div class="nav-wrapper">
          <a style="" href="//<?php echo $webConfig["webLink"]?>" class=" hide-on-large-only darken-1 left no-margin">
              <strong><span style="margin-left: 45px; padding-top: 1px !important; font-weight: bolder; font-size: 1.2em" ><?php echo $webConfig["webName"]?></span></strong>
          </a>
            
              
              
           <a style="padding-bottom:4px !important" href="//<?php echo $webConfig["webLink"]?>" class="hide-on-med-and-down darken-1 left no-margin">
               <strong><span style="margin-left: 5px; font-weight: bolder; font-size: 1.5em" ><?php echo strtoupper($webConfig["webName"])?></span></strong>
          </a>  
              
            
           
            <ul class="right">
                
             
                
                
         
            
              <li>
                <a href="//<?php echo $webConfig["webLink"]?>/admin/logout.php" class="hide-on-med-and-down waves-effect waves-block">
                   <?php echo $LANG["logout"]?>
                </a>
            </li>
            
            
              <li>
                <a href="javascript:void(0);" class=" waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                   <i class="material-icons">translate</i>
                </a>
              </li>
             
            
              
                
            
              
              <li class="hide-on-large-only"> 
                <a href="javascript:void(0);" class="waves-effect waves-light profile-button circle"  data-activates="profile-dropdown">
                    <i class="material-icons">more_vert</i>
                </a>
              </li>
 
            </ul>
            <!-- translation-button -->
            <ul id="translation-dropdown" class="dropdown-content">
             <?php  $sql = "SELECT name,file_name FROM lang WHERE active='1' ORDER BY name"; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {?>
              <li>
                  <a href="javaScript:void(0)" onclick=ajaxRequest('',"//<?php echo $webConfig["webLink"]?>/set_lang.php?id=<?php echo str_ireplace(".php","",$row["file_name"])?>") class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-gb"></i><?php echo $row["name"]?></a>
              </li>
            
              <?php } } ?>
              </ul>
          
            
                <!-- profile-dropdown -->
            <ul id="profile-dropdown" class="dropdown-content">
             
                  <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/admin/profile.php" class="grey-text text-darken-1">
                        <i class="material-icons">face</i><?php echo $LANG["profile"];?></a>
                    </li>
                               
                    <li class="divider"></li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/admin/change-password.php" class="grey-text text-darken-1">
                        <i class="material-icons">lock_outline</i><?php echo $LANG["change_password"]; ?></a>
                    </li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/admin/logout.php" class="grey-text text-darken-1">
                        <i class="material-icons">keyboard_tab</i> <?php echo $LANG["logout"]?></a>
                    </li>
             
            </ul>
            
            
            
            
           
          </div>
            
        </nav>
      </div>
      <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
	
	
    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">
        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
              <div class="row">
                
                <div class="col col s12">
                  <ul id="profile-dropdown-nav" class="dropdown-content">
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/admin/profile.php" class="grey-text text-darken-1">
                        <i class="material-icons">face</i><?php echo $LANG["profile"];?></a>
                    </li>
                               
                    <li class="divider"></li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/admin/change-password.php" class="grey-text text-darken-1">
                        <i class="material-icons">lock_outline</i><?php echo $LANG["change_password"]; ?></a>
                    </li>
                    <li>
                      <a href="//<?php echo $webConfig["webLink"]?>/admin/logout.php" class="grey-text text-darken-1">
                        <i class="material-icons">keyboard_tab</i> <?php echo $LANG["logout"]?></a>
                    </li>
                  </ul>
                  <a class="btn-flat center dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown-nav"><?php echo $navAccess["name"]; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                </div>
              </div>
            </li>
			
			
			<style>
			
			.collapse i{
				border-left: dotted 1px #000;
			}

			
			</style>
			
			
            <li class="no-padding">
              <ul class="collapsible" data-collapsible="accordion">
			  
			  
                <li class="bold">
                    <a target="blank" href="//<?php echo $webConfig["webLink"]?>" class="waves-effect waves-cyan green-text">
                      <i class="material-icons">public</i>
                      <span class="nav-text"><?php echo $LANG["visit_site"]?></span>
                    </a>
                </li>
                <div class="divider"></div>
                <li class="bold">
                  <a href="//<?php echo $webConfig["webLink"]?>/admin/" class="waves-effect waves-cyan">
                      <i class="material-icons">dashboard</i>
                      <span class="nav-text"><?php echo $LANG["admin_panel"]?></span>
                    </a>
                </li>

				
<?php  if($navAccess["service"]==1){ ?>
<li class="bold"><a  class="waves-effect waves-cyan '. <?php activeMenu("service")?> collapsible-header" data-toggle="collapse" data-target="#service" href="javaScript:void(0)"><i class="material-icons">store</i><span class="nav-text"> <?php echo $LANG["service"]; ?> </span></a></li>
		   
		   
	  <div id="service" class="collapse <?php show("service") ?>">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/service/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["home"]?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/service/new.php"><i class="fa fa-plus"></i><span class="nav-text"><?php echo $LANG["create_new_service"]; ?></span></a></li>
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/service/category.php"><i class="fa fa-credit-card"></i><span class="nav-text"><?php echo $LANG["create_service_category"]; ?></span></a></li>
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/gateway"><i class="material-icons">http</i><span class="nav-text"><?php echo $LANG["gateway_configuration"]; ?></span></a></li>

		 </div>
<?php  } ?>	

			
<?php  if($navAccess["web_config"]==1){ ?>
<li class="bold"><a  class="waves-effect waves-cyan '. <?php activeMenu("configuration")?> collapsible-header" data-toggle="collapse" data-target="#configuration" href="javaScript:void(0)"><i class="fa fa-cog"></i><span class="nav-text"> <?php echo $LANG["configuration"]; ?> </span></a></li>
		   
		   
	  <div id="configuration" class="collapse  <?php show("configuration") ?>">
	
              <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["general"]?></span></a></li>
	  	 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/appearance/"><i class="fa fa-television"></i><span class="nav-text"><?php echo $LANG["appearance"]?></span></a></li>
	  	
                 <?php if($navAccess["contact"]==1){ ?>
               <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/contact.php"><i class="fa fa-map-marker"></i><span class="nav-text"><?php echo $LANG["contact"]; ?></span></a></li>
                 <?php }?>
                <?php if($navAccess["payment"]==1){ ?>
                <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/payment.php"><i class="fa fa-credit-card"></i><span class="nav-text"><?php echo $LANG["payment"]; ?></span></a></li>
                  
                <?php } ?>
                
                 <?php if($navAccess["payment"]==1){ ?>
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/payout.php"><i class="fa fa-credit-card"></i><span class="nav-text"><?php echo $LANG["payout_request"]; ?></span></a></li>
                 <?php } ?>
                 <?php if($navAccess["licences_key"]==1){ ?>
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/discount.php"><i class="fa fa-gift"></i><span class="nav-text"><?php echo $LANG['discount'];?></span></a></li>
                  <?php } ?>
                 
                  <?php if($navAccess["icon"]==1){ ?>
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/image.php"><i class="fa fa-photo"></i><span class="nav-text"> <?php echo $LANG["images"];?> </span></a></li>
                  <?php } ?>
                 
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/about.php"><i class="fa fa-info-circle"></i><span class="nav-text"><?php echo $LANG["about_us"];?></span></a></li>
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/faq.php"><i class="fa fa-question-circle"></i><span class="nav-text"><?php echo $LANG["faq"]?> </span></a></li>
		 
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/terms.php"><i class="fa fa-legal"></i><span class="nav-text"><?php echo $LANG["terms_and_conditions"]; ?> </span></a></li>
                 <?php if($navAccess["sms"]==1){ ?>
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/sms.php"><i class="material-icons">phonelink_setup</i><span class="nav-text"><?php echo $LANG["sms_gateway"]?></span></a></li>
                  <?php }?>
                 <?php if($navAccess["email_access"]==1){ ?>
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/email.php"><i class="fa fa-server"></i><span class="nav-text"><?php echo $LANG["email_server"]?></span></a></li>
                <?php }?>
                  
                 <?php if($navAccess["refer"]==1){ ?>
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/referral.php"><i class="fa fa-map-marker"></i><span class="nav-text"><?php echo $LANG["referral_programme"]; ?></span></a></li>
                  <?php } ?>
                 
                 <?php if($navAccess["refer"]==1){ ?>
                 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/configuration/affiliate.php"><i class="fa fa-map-marker"></i><span class="nav-text"><?php echo $LANG["affiliate"]; ?></span></a></li>
                  <?php } ?>
	</div> 
<?php  } ?>
<?php  if($navAccess["transaction"]==1){ ?>

	<li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("transaction") ?>" data-toggle="collapse" data-target="#transaction" href="javaScript:void(0)"><i class="fa fa-cubes"></i><span class="nav-text"> <?php echo $LANG["transactions"]; ?> </span></a></li>
			   
	  <div id="transaction" class="collapse <?php  show("transaction")?> ">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/"><i class="fa fa-home"></i><span class="nav-text"> <?php echo $LANG["all_transactions"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/success.php"><i class="fa fa-check"></i><span class="nav-text"><?php echo $LANG["successful"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/pending.php"><i class="fa fa-spinner"></i><span class="nav-text"><?php echo $LANG["pending"] ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/failed.php"><i class="fa fa-warning"></i><span class="nav-text"><?php echo $LANG["failed"];?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/reversed.php"><i class="fa fa-refresh"></i><span class="nav-text"><?php echo $LANG["reversed"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/wallet.php"><i class="fa fa-google-wallet"></i><span class="nav-text"><?php echo $LANG["paid_with_wallet"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/transaction/card.php"><i class="fa fa-credit-card"></i><span class="nav-text"><?php echo $LANG["paid_with_card"]; ?></span></a></li>
		
	</div>
<?php
} ?>
<?php  if($navAccess["transaction"]=1){ ?>

	<li class="bold"><a  class="waves-effect waves-cyan collapsible-header<?php  activeMenu("api_trans") ?>" data-toggle="collapse" data-target="#apitransaction" href="javaScript:void(0)"><i class="material-icons">http</i><span class="nav-text"> <?php echo $LANG["api_transactions"]; ?> </span></a></li>
			   
	  <div id="apitransaction" class="collapse <?php  show("api_trans")?> ">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/api_trans/"><i class="fa fa-home"></i><span class="nav-text"> <?php echo $LANG["all_transactions"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/api_trans/success.php"><i class="fa fa-check"></i><span class="nav-text"><?php echo $LANG["successful"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/api_trans/pending.php"><i class="fa fa-spinner"></i><span class="nav-text"><?php echo $LANG["pending"] ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/api_trans/failed.php"><i class="fa fa-warning"></i><span class="nav-text"><?php echo $LANG["failed"];?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/api_trans/reversed.php"><i class="fa fa-refresh"></i><span class="nav-text"><?php echo $LANG["reversed"]; ?></span></a></li>
	  	
	</div>
<?php
} ?>

<?php  if($navAccess["payment_method"]==1){ ?>
	<li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("paymentmethod") ?>" data-toggle="collapse" data-target="#paymentmethod" href="javaScript:void(0)"><i class="material-icons">payment</i><span class="nav-text"> <?php echo $LANG["payment_method"]; ?> </span></a></li>
			   
	  <div id="paymentmethod" class="collapse <?php  show("paymentmethod")?> ">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/paymentmethod/"><i class="fa fa-home"></i><span class="nav-text"> <?php echo $LANG["home"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/paymentmethod/new.php"><i class="fa fa-check"></i><span class="nav-text"><?php echo $LANG["create_new"]; ?></span></a></li>
		
	</div>
<?php
} ?>

<?php  if($navAccess["currency"]==1){ ?>
	  <li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("currency") ?>" data-toggle="collapse" data-target="#currency" href="javaScript:void(0)"><i class="material-icons">attach_money</i><span class="nav-text"> <?php echo $LANG["currency"]; ?> </span></a></li>	   
	  <div id="currency" class="collapse <?php show("currency")?>">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/currency/"><i class="fa fa-home"></i><span class="nav-text"> <?php echo $LANG["home"]; ?></span></a></li>
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/currency/new.php"><i class="fa fa-check"></i><span class="nav-text"><?php echo $LANG["create_new"]; ?></span></a></li>
		
	</div>
<?php
} ?>
  
 <?php  if($navAccess["payment"]==1){ ?>
	  <li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("reserved-account") ?>" data-toggle="collapse" data-target="#reserved-account" href="javaScript:void(0)"><i class="fa fa-bank"></i><span class="nav-text"> Reserved Account </span></a></li>	   
	  <div id="reserved-account" class="collapse <?php show("reserved-account")?>">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/reserved-account/"><i class="fa fa-home"></i><span class="nav-text"> <?php echo $LANG["home"]; ?></span></a></li>
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/reserved-account/submitted.php"><i class="fa fa-check"></i><span class="nav-text">KYC Approval</span></a></li>
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/reserved-account/hook.php"><i class="fa fa-link"></i><span class="nav-text">Web Hook URL</span></a></li>
		
	</div>
<?php
} ?>
          
          
          
<?php  if($navAccess["language"]==1){ ?>
	  <li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("language") ?>" data-toggle="collapse" data-target="#lang" href="javaScript:void(0)"><i class="material-icons">translate</i><span class="nav-text"> <?php echo $LANG["language"]; ?> </span></a></li>	   
	  <div id="lang" class="collapse <?php show("language")?>">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/language/"><i class="fa fa-home"></i><span class="nav-text"> <?php echo $LANG["home"]; ?></span></a></li>
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/module.php"><i class="fa fa-download"></i><span class="nav-text"><?php echo $LANG["install_new_language"]; ?></span></a></li>
		
	</div>
<?php
} ?>

<?php  if($navAccess["admin"]==1){?>
	<li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("adminmanger")?>" data-toggle="collapse" data-target="#adminmanger" href="javaScript:void(0)"><i class="fa fa-user-secret"></i><span class="nav-text"><?php echo $LANG["admin_manager"]?></span></a></li>
			   
	  <div id="adminmanger" class="collapse <?php  show("adminmanger")?> ">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/adminmanger/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["home"]; ?></span></a></li>
	  	<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/adminmanger/create.php"> <i class="material-icons">person_add</i><span class="nav-text"><?php echo $LANG["create_new_admin"];?></span></a></li>
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/adminmanger/block.php">
		
		 <i class="fa-stack fa-sm">
		  <i class="fa fa-user fa-stack-1x"></i><span class="nav-text">
		  <i class="fa fa-ban fa-stack-2x text-danger" style="color:red;"></i><span class="nav-text">
		</i><span class="nav-text">
		</i><span class="nav-text">
		<span class="nav-text"><?php echo $LANG["block_admin"]?></span></a></li>
		
	</div>
<?php
} ?>
        
<?php  if($navAccess["users"]==1){?>
	<li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("users")?>" data-toggle="collapse" data-target="#registeredUsers" href="javaScript:void(0)"><i class="fa fa-users"></i><span class="nav-text"><?php echo $LANG["registered_user"]?></span></a></li>
			   
	  <div id="registeredUsers" class="collapse <?php  show("users")?> ">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/users/"><i class="material-icons">people</i><span class="nav-text"><?php echo $LANG["home"]; ?></span></a></li>
          <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/editbalance.php"> <i class="material-icons">account_balance</i><span class="nav-text"><?php echo $LANG["edit_user_balance"];?></span></a></li>
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/blockuser.php">
		
		 <i class="fa-stack fa-sm">
		  <i class="fa fa-user fa-stack-1x"></i><span class="nav-text">
		  <i class="fa fa-ban fa-stack-2x text-danger" style="color:red;"></i><span class="nav-text">
		</i><span class="nav-text">
		</i><span class="nav-text">
		<span class="nav-text"><?php echo $LANG["block_unblock_user"]?></span></a></li>
		
	</div>
<?php
} ?>	   

        
<?php  if($navAccess["update_access"]==1){ ?>	
 <li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php echo activeMenu("update") ?>" data-toggle="collapse"  data-target="#update" href="javascript:void(0)"><i class="fa fa-refresh"></i><span class="nav-text"> <?php echo $LANG["update"]?> </span></a></li>

                  <div id="update" class="collapse <?php echo show("update"); ?>" >
                  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/update/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["update_wizard"];?> </span></a></li>
                        <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/update/check.php"><i class="fa fa-code"></i><span class="nav-text"><?php echo $LANG["check_web_update"]; ?></span></a></li>
                        <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/update/dcheck.php"><i class="fa fa-database"></i><span class="nav-text"><?php echo $LANG["check_database_update"]; ?></span></a></li>

</div>

<?php } ?>
        
        
 <?php  if($navAccess["visitor"]==1){ ?>
<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/visitor.php"><i class="fa fa-line-chart"></i><span class="nav-text"><?php echo $LANG["visitors"]; ?></span></a></li>
<?php
} ?>
 <?php  if($navAccess["users"]==1){ ?>
<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/user.php"><i class="fa fa-line-chart"></i><span class="nav-text"><?php echo $LANG["users_statistic"]; ?> </span></a></li> 
<?php
 } ?>

 <?php  if($navAccess["news_letter"]==1){ ?>
 <li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php echo activeMenu("newsletter"); ?> " data-toggle="collapse" data-target="#newsletter" href="javaScript:void(0)"><i class="fa fa-newspaper-o"></i><span class="nav-text"> <?php echo $LANG["newsletter"]; ?> </span></a></li>
			   
	  <div id="newsletter" class="collapse <?php echo show("newsletter"); ?>  ">
	  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/newsletter/"><i class="fa fa-home"></i><span class="nav-text"><?php  echo $LANG["home"]; ?> </span></a></li>
		<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/newsletter/new.php">
         <i class="fa-stack fa-sm">
		  <i class="fa fa-newspaper-o fa-stack-1x"></i><span class="nav-text">
		  <i class="fa fa-plus fa-stack-2x"></i><span class="nav-text">
		</i><span class="nav-text">
		</i><span class="nav-text">

		<?php echo $LANG["create_new_newsletter"]?> </span></a></li>
		<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/newsletter/subscriber.php"><i class="fa fa-users"></i><span class="nav-text"> <?php echo $LANG["subscriber"]; ?></span></a></li>
		
	</div>
<?php
} ?>	
		   
 <?php  if($navAccess["slider"]==1){ ?>
<li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php echo activeMenu("slider"); ?> " data-toggle="collapse" data-target="#slider" href="javaScript:void(0)"><i class="fa fa-image"></i><span class="nav-text"><?php echo $LANG["home_slider"]; ?></span></a></li>
		   
		  <div id="slider" class="collapse <?php show("slider") ?> ">
		  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/slider/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["home"]; ?></span></a></li>
			<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/slider/new.php"> 
			
			<i class="fa-stack fa-sm">
		    <i class="fa fa-photo fa-stack-1x"></i><span class="nav-text">
		   <i class="fa fa-plus fa-stack-2x"></i><span class="nav-text">
			</i><span class="nav-text">
			</i><span class="nav-text">
			
			<?php echo $LANG["upload_new_banner"]; ?></span></a></li>
	</div>
<?php
} ?>


 <?php  if($navAccess["refer"]==1){ ?>
<li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php echo activeMenu("banner"); ?> " data-toggle="collapse" data-target="#banner" href="javaScript:void(0)"><i class="material-icons">picture_in_picture</i><span class="nav-text"><?php echo $LANG["advert_banner"]; ?></span></a></li>
		   
		  <div id="banner" class="collapse <?php show("banner") ?> ">
		  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/banner/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["home"]; ?></span></a></li>
			<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/banner/new.php"> 
			
			<i class="fa-stack fa-sm">
		    <i class="fa fa-photo fa-stack-1x"></i><span class="nav-text">
		   <i class="fa fa-plus fa-stack-2x"></i><span class="nav-text">
			</i><span class="nav-text">
			</i><span class="nav-text">
			
			<?php echo $LANG["upload_new_slider"]; ?></span></a></li>
	</div>
<?php
} ?>		
		   
 <?php  if($navAccess["feedback"]==1){ ?>
         <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/feedback"><i class="fa fa-comments-o"></i><span class="nav-text"><?php echo $LANG["feedback"] ?></span></a></li>      
<?php
} ?>		  
 <?php  if($navAccess["add_money"]==1){ ?>
	  <li class="bold"><a  class="waves-effect waves-cyan"  href="//<?php echo $webConfig["webLink"];?>/admin/editbalance.php"><i class="fa fa-credit-card"></i><span class="nav-text"><?php echo $LANG["edit_user_balance"]; ?></span></a></li>

<?php } ?>	
<?php  if($navAccess["users"]==1){ ?>
 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/blockuser.php">

		  <i class="fa-stack fa-sm px-0 mx-0">
		  <i class="fa fa-user fa-stack-1x"></i><span class="nav-text">
		  <i class="fa fa-ban fa-stack-2x text-danger" style="color:red;"></i><span class="nav-text">
		</i><span class="nav-text">
		</i><span class="nav-text"><?php echo $LANG["block_unblock_user"] ?></span></a></li>
		
		
<?php
} ?>	
		
		
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/profile.php"><i class="fa fa-user"></i><span class="nav-text"><?php echo $LANG["profile"]; ?></span></a></li>
		 

		 
<?php  if($navAccess["payment"]==1){ ?>	
	 <li class="bold"><a  class="waves-effect waves-cyan collapsible-header <?php activeMenu("payment") ?>" data-toggle="collapse" data-target="#payment" href="javaScript:void(0)"><i class="fa fa-globe"></i><span class="nav-text"> <?php echo $LANG["online_payment"] ; ?> </span></a></li>
			   
			  <div id="payment" class="collapse <?php echo show("payment") ?>" >
			  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/payment/"><i class="fa fa-home"></i><span class="nav-text"><?php echo $LANG["all_payment"]?> </span></a></li>
				<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/payment/purchase.php"><i class="fa fa-credit-card"></i><span class="nav-text"><?php echo $LANG["purchase"] ?></span></a></li>
				<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/payment/funding.php"><i class="fa fa-google-wallet"></i><span class="nav-text"><?php echo $LANG["wallet_funding"] ?></span></a></li>
				
			</div>
		 
<?php  } ?>	
<?php  if($navAccess["bank"]==1){ ?>
		  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/bank/"><i class="fa fa-bank"></i><span class="nav-text"><?php echo $LANG["bank_account"]; ?></span></a></li>
<?php
}?>
	 
<?php  if($navAccess["payment"]==1){ ?>	 
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/deposit"><i class="fa fa-bank"></i><span class="nav-text"><?php echo $LANG["bank_deposit"];?></span></a></li>
		 
<?php
} ?>

 <?php  if($navAccess["payment_method"]==1){ ?>	 
  <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/payment_gateway.php"><i class="fa fa-bank"></i><span class="nav-text"><?php echo $LANG["payment_gateway"];?></span></a></li>
		 
<?php
} ?>                
                 
                 
                 
                 
                 
                 
                 
<?php  if($navAccess["payment"]==1){ ?>	 
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/pay_noti"><i class="fa fa-info-circle"></i><span class="nav-text"><?php echo $LANG["payment_notification"]; ?></span></a></li>
		 
<?php } ?>
                 
<?php  if($navAccess["module"]==1){ ?>	 
		 <li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/module.php"><i class="fa fa-download"></i><span class="nav-text"><?php echo $LANG["module_insaller"]; ?></span></a></li>
		 
<?php } ?>
   
<li class="bold"><a  class="waves-effect waves-cyan" href="//<?php echo $webConfig["webLink"];?>/admin/clear_record.php"><i class="material-icons red-text">clear</i><span class="nav-text"><?php echo $LANG["clear_records"]; ?></span></a></li>
		 
		 
	

              </ul>
            </li>
          </ul>
          <a href="#" style="background: none; box-shadow: none" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
            <i class="material-icons">menu</i>
          </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->
		<div id="ajax-loader" style="display:none !important; position:fixed; background:rgba(0,0,0,.8); padding-top:0; top:0; left:0; right:0; bottom:0; z-index:99999999999999999999999999999999999999999999999999999999999999999999999999999999">
		 <div class="progress" style="margin:0">
            <div class="indeterminate"></div>
        </div>
        </div>
