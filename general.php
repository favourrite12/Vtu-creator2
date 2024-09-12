  <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/service_setting_general.php');" >
						 
						  <input name="service" value="<?php echo $serviceValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
							<div class="input-field col s12" >
							  <input  id="displayName" name="displayName" type="text" value="<?php echo $serviceValue['display_name']; ?>">
							  <label for="displayName"><?php echo $LANG['display_name']; ?></label>
							  </div>
						 
							  <div class="input-field col s12 tooltipped"  data-position="bottom" data-tooltip="<?php echo  $LANG["not_advisable_to_change_name"]; ?>">
							     <input  id="name" name="name" type="text" value="<?php echo $serviceValue['name']; ?>">
							     <label for="name"><?php echo $LANG['name_unique_id']; ?></label>
							  </div>
							  
							  
							  
							  <div class="input-field col s12">
							     <input  id="planName" name="planName" type="text" value="<?php echo $serviceValue['plan_name']; ?>">
							     <label for="planName"><?php echo $LANG['plans_name']; ?></label>
							  </div>
							  
							  <div class="input-field col s12">
							     <input  id="planDisplayName" name="planDisplayName" type="text" value="<?php echo $serviceValue['plan_display_name']; ?>">
							     <label for="planDisplayName"><?php echo $LANG['plans_display_name']; ?></label>
							  </div>
							  	
                      
                                                            <div class="switch col s6 "  >

                                                                         <div class="switch">
                                                                        <label>

                                                                          <input <?php if($serviceValue['plan_fixed_price']==1){echo "checked";} ?> value="1" type="checkbox" name="PlanFixedPrice">
                                                                          <span class="lever"></span>
                                                                          <?php echo ucfirst($LANG["fixed_price_on_plans"]) ;?>
                                                                        </label>
                                                                  </div>
                                                            </div> 
							 
						           <div class="switch col s6 "  >

                                                                         <div class="switch">
                                                                        <label>

                                                                          <input <?php if($serviceValue['plan_field_required']==1){echo "checked";} ?> value="1" type="checkbox" name="planFieldRequired">
                                                                          <span class="lever"></span>
                                                                          <?php echo ucfirst($LANG["plan_field_required"]) ;?>
                                                                        </label>
                                                                  </div>
                                                            </div>
						  
						 
								<div class="input-field col s12">
								<select name="category" >
								 
								<?php echo $categoryOption ;?>
								 
								 
								</select>
								<label><?php echo $LANG["service_category"] ;?></label>
						      </div>
							  
							  
							<div class="input-field col s12 tooltipped"  data-position="top" data-tooltip="<?php echo $LANG["amount_name_description"]; ?>">
								<select name="amountName">
								 
								<?php echo $formOption ;?>
								 
								 
								</select>
								<label><?php echo $LANG["amount_name"] ;?></label>
						      </div>
							  
							  
							  
						    
						
						
						
						 
							<div class="input-field col s12">
							  <textarea name="description" id="textarea2" class="materialize-textarea"><?php echo $serviceValue['description']; ?></textarea>
							  <label for="textarea2"><?php echo $LANG["description"] ;?></label>
							</div>
						 
				 </div>
						  
						  
						  			  
					    <div class="switch col s8 "  >
					
							 <div class="switch">
							<label>
							
							  <input <?php if($serviceValue['api']==1){echo "checked";} ?> value="1" type="checkbox" name="api">
							  <span class="lever"></span>
							  <?php echo $LANG["available_on_api"] ;?>
							</label>
						  </div>
					    </div> 	

						
					    <div class="switch col s4 "  >
					
							 <div class="switch">
							<label>
							
							  <input <?php if($serviceValue['active']==1){echo "checked";} ?> value="1" type="checkbox" name="active">
							  <span class="lever"></span>
							  <?php echo ucfirst($LANG["active"]) ;?>
							</label>
						  </div>
					    </div> 
	                                   <div class="row">					  
                                               <div class="switch col s6" >
                                                    <br/>
                                                           <div class="switch">
                                                          <label>
                                                          <?php echo ucfirst($LANG["debugging_mode"]) ;?>
                                                            <input  <?php if($serviceValue['debug_mode']==1){echo "checked" ;} ?> value="1" type="checkbox" name="debugMode">
                                                            <span class="lever"></span>
                                                          </label>
                                                 </div>
                                               </div>      
                                                  
                          
                            
                              <div class="input-field col s6">
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
                