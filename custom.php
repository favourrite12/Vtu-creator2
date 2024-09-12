
 <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/payment_method_setting_custom.php');" >
						 
						  <input name="id" value="<?php echo $methodValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
							
										
						   <?php for($i=0; $i < 4; $i++){ if(!empty($gatewayValue["custom_$i"])){ ?>
						   
						   <div class="input-field col s12">
							     <input  id="<?php echo "custom_$i" ?>" name="<?php echo "custom_$i" ?>" type="text" value="<?php echo $methodValue["custom_$i"]; ?>">
							     <label for="<?php echo "custom_$i" ?>"> <?php echo $gatewayValue["custom_$i"]; ?></label>
							  </div>
							   
						   <?php } }?>
						
						
						
						
											
						
						
						
						 
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
                  <script>
					ajaxRequest(getID('serviceForm'),'../../processor/service_setting_notification.php');
					  </script>