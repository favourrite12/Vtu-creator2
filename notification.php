<div id="scrollNoti"> </div>
 <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/service_setting_notification.php',getID('scrollNoti'));" >
						 
						  <input name="service" value="<?php echo $serviceValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
							
							  
							  
									  
					    <div class="switch col s12 "  >
					
							 <div class="switch">
							<label>
							<?php echo $LANG["sms_notification_to_user"] ;?>
							  <input <?php if($serviceValue['sms_alert']==1){echo "checked";} ?> value="1" type="checkbox" name="smsAlert">
							  <span class="lever"></span>
							  
							</label>
						  </div>
					    </div> 	

						
						
						<br/>
				
						<br/>
						
					  <div class="switch col s12 "  >
					
							 <div class="switch">
							<label>
							 <?php echo $LANG["email_notification_to_user"] ;?>
							  <input <?php if($serviceValue['email_alert']==1){echo "checked";} ?> value="1" type="checkbox" name="emailAlert">
							  <span class="lever"></span>
							 
							</label>
						  </div>
					    </div> 					 
						
						<br/>
						<br/>
						
						<div class="switch col s12 "  >
					
							 <div class="switch">
							<label>
							 <?php echo $LANG["sms_notification_to_me"] ;?>
							  <input <?php if($serviceValue['sms_alert_me']==1){echo "checked";} ?> value="1" type="checkbox" name="smsAlertMe">
							  <span class="lever"></span>
							 
							</label>
						  </div>
					    </div> 
						
						<br/>
						<br/>
						
						<div class="switch col s12 "  >
					
							 <div class="switch">
							<label>
							 <?php echo $LANG["email_notification_to_me"] ;?>
							  <input <?php if($serviceValue['email_alert_me']==1){echo "checked";} ?> value="1" type="checkbox" name="emailAlertMe">
							  <span class="lever"></span>
							 
							</label>
						  </div>
					    </div> 		

						<br/>
						<br/>
						
						<div class="switch col s12 "  >
					
							 <div class="switch">
							<label>
							 <?php echo $LANG["email_failed"] ;?>
							  <input <?php if($serviceValue['email_failed']==1){echo "checked";} ?> value="1" type="checkbox" name="emailFailed">
							  <span class="lever"></span>
							 
							</label>
						  </div>
					    </div> 
						
						
						<br/>
						<br/>
						  
							<div class="input-field col s12 tooltipped"  data-position="top" data-tooltip="<?php echo $LANG["email_name_description"]; ?>">
								<select name="emailName">
								 
								<?php echo $emailOption ;?>
								 
								 
								</select>
								<label><?php echo $LANG["email_name"] ;?></label>
						      </div>
							  
							  
							  
							    
							<div class="input-field col s12 tooltipped"  data-position="top" data-tooltip="<?php echo $LANG["phone_name_description"]; ?>">
								<select name="phoneName">
								 
								<?php echo $phoneOption ;?>
								 
								 
								</select>
								<label><?php echo $LANG["phone_name"] ;?></label>
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
                 