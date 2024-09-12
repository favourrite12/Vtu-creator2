 <?php include "../../include/ini_set.php"; ?>
  <?php include "../include/checklogin.php"; ?>
 <?php include "../include/header.php"; ?>
 <?php include "../../include/data_config.php"; ?>
 <?php include "../../include/filter.php"; ?>

  <?php  include '../include/admininfo.php'; $adminInfo = adminInfo($loginAdmin,$conn); checkAccess($adminInfo["service"]); ?>
 

 
 
 
 <title><?php echo $LANG['create_new']; ?> - <?php echo $LANG['gateway_setup']; ?></title>
  <section id="content">
        
        
          <div class="container">
		   <p class="caption"><?php echo $LANG['create_new']; ?> - <?php echo $LANG['gateway_setup']; ?></p>
              <div class="divider"></div>
			  
            <div class="section flexbox">
             
             
                  <!-- Form with placeholder -->
                  <div class="col s12 m12 l6 custom-form-control">
                    <div class="card-panel hoverable">
                      <div class="row">
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/new_gateway.php');" >
						 <div class="row">
							<div class="input-field col s12" >
							  <input  id="displayName" name="displayName" type="text" value="">
							  <label for="displayName"><?php echo $LANG['display_name']; ?></label>
							  </div>
						  </div>
						  
						
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['create']; ?>
                                  <i class="material-icons right">add</i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>
   
    <!-- END MAIN -->
	<?php include "../../include/right-nav.php"; ?>
    <?php include "../include/footer.php"; ?>
  </body>
</html>