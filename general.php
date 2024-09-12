  <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/gateway_setting_general.php');" >
						 
						  <input name="service" value="<?php echo $serviceValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
							<div class="input-field col s12" >
							  <input  id="displayName" name="displayName" type="text" value="<?php echo $serviceValue['display_name']; ?>">
							  <label for="displayName"><?php echo $LANG['display_name']; ?></label>
							  </div>
						 
						
						
						 
				                     </div>
						  
						  
						

					
						  
                          
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light  right" type="submit" ><?php echo $LANG['save']; ?>
                                  <i class="material-icons right">save</i>
                                </button>
                              </div>
                          </div>
                      
                        </form>
						
						
                    </div>
                  </div>
                </div>
               </div>
            </div>
        </section>
                