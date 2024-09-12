<div id="scroll"></div> 

 <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/service_setting_pricing.php',getID('scroll'));" >
						 
						  <input name="service" value="<?php echo $serviceValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
						
						  <div class="input-field col s12"  >
							     <input  id="min" name="min" type="text" value="<?php echo $serviceValue['min']; ?>">
							     <label for="min"><?php echo $LANG['min_amount']; ?></label>
							  </div>
							  
							  
							<div class="input-field col s12" >
							  <input  id="max" name="max" type="text" value="<?php echo $serviceValue['max']; ?>">
							  <label for="max"><?php echo $LANG['max_amount']; ?></label>
							  </div>
						 
							 							
							  
							  <div class="input-field col s12"  >
							     <input  id="fee" name="fee" type="text" value="<?php echo $serviceValue['fee']; ?>">
							     <label for="fee"><?php echo $LANG['fee_charge']; ?></label>
							  </div>
						  
									  
					    <div class="switch col s8 " >
					
							 <div class="switch">
							<label>
							
							<br/>
							  <input <?php if($serviceValue['fee_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="feePercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["fee_percentage"] ;?>
							</label>
						  </div>
					    </div> 	 
						
						
						
						  <div class="input-field col s4 tooltipped"  data-position="bottom" data-tooltip="<?php echo  $LANG["fee_capped_at_description"]; ?>" >
							 <input  id="feeCapped" name="feeCapped" type="text" value="<?php echo $serviceValue['fee_capped']; ?>">
							 <label for="feeCapped"><?php echo $LANG['fee_capped_at']; ?></label>
						  </div>
						
						
						<div class="caption"><?php echo $LANG['set_commission_rate_for_service']?></div>
						
					
						<div class="row col s12">
						
							  <div class="input-field col s7">
							     <input  id="unregisteredUser" name="unregisteredUser" type="text" value="<?php echo $commissionRate['unregistered_user']; ?>">
							     <label for="unregisteredUser"><?php echo $LANG['unregistered_user']; ?></label>
							  </div> 
							  

									  
					    <div class="switch col s5 ">
				        	<br/>
					        <br/>
							 <div class="switch">
							<label>
							
							  <input <?php if($commissionRate['unregistered_user_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="unregisteredUserPercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["in_percentage"] ;?>
							</label>
						  </div>
					    </div> 	 
<div class="col s12"></div>
						 <div class="input-field col s7"  >
							     <input  id="referrerUser" name="referrerUser" type="text" value="<?php echo $commissionRate['referrer_user']; ?>">
							     <label for="referrerUser"><?php echo $LANG['referrer_earns']; ?></label>
							  </div>
						  
						
						   <div class="switch col s5"  >
					<br/>
					<br/>
							 <div class="switch">
							<label>
							
							  <input <?php if($commissionRate['referrer_user_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="referrerUserPercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["in_percentage"] ;?>
							</label>
						  </div>
					    </div> 		
						
						

						<div class=" col s12"  ></div>
						
						<div class="input-field col s7"  >
							     <input  id="registeredUser" name="registeredUser" type="text" value="<?php echo $commissionRate['registered_user']; ?>">
							     <label for="registeredUser"><?php echo $LANG['registered_user']; ?></label>
							  </div>
						  
						  
						 
							  
							  
									  
					 									  
					    <div class="switch col s5 "  >
					<br/>
					<br/>
							 <div class="switch">
							<label>
							
							  <input <?php if($commissionRate['registered_user_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="registeredUserPercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["in_percentage"] ;?>
							</label>
						  </div>
					    </div> 
						
						
						<div class=" col s12"  ></div>
						
						<div class="input-field col s7"  >
							     <input  id="apiUser" name="apiUser" type="text" value="<?php echo $commissionRate['api_user']; ?>">
							     <label for="apiUser"><?php echo $LANG['api_user']; ?></label>
							  </div>
						  
						  
						 
							  
							  
									  
					    <div class="switch col s5 "  >
					<br/>
					<br/>
							 <div class="switch">
							<label>
							
							  <input <?php if($commissionRate['api_user_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="apiUserPercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["in_percentage"] ;?>
							</label>
						  </div>
					    </div> 
						
						
						
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
                