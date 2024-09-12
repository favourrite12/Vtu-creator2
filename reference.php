  <section id="content">
	             
             <p class="caption"><?php echo $LANG["most_of_gateway_required_mnique_character"] ?></p>
                  
          <div class="container flexbox">

              <div class="section" >
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
				    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/gateway_setting_reference.php');" >
						 
						  <input name="service" value="<?php echo $serviceValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
							
						 
							  <div class="input-field col s12 tooltipped"  data-position="bottom" data-tooltip="<?php echo $LANG["name_send_to_gateway"]; ?>">
							     <input  id="refKeyName" name="refKeyName" type="text" value="<?php echo $serviceValue['ref_key_name']; ?>">
							     <label for="name"><?php echo $LANG['key_name']; ?></label>
							  </div>
							  
							 
						  
						  
						 
								<div class="input-field col s12">
								<select name="refKeyType" required>
								 
								<option <?php if($serviceValue["ref_key_type"]=="numeric"){echo "selected"; } ?> value="numeric"><?php echo $LANG["numeric"]?></option>
								<option <?php if($serviceValue["ref_key_type"]=="alphanumeric"){echo "selected"; } ?> value="alphanumeric"><?php echo $LANG["alphanumeric"]?></option>
								 
								 
								</select>
								<label><?php echo $LANG["type"] ;?></label>
						      </div>
							  
							  
							  
						      <div class="input-field col s7">
							     <input  id="refKeyLen" name="refKeyLen" type="text" value="<?php echo $serviceValue['ref_key_len']; ?>">
							     <label for="refKeyLen"><?php echo $LANG['max_len']; ?></label>
							  </div>

							  
						      <div class="switch col s5 "  >
					<br/>
					<br/>
							 <div class="switch">
							<label>
							 <?php echo ucfirst($LANG["absolute_len"]) ;?>
							  <input <?php if($serviceValue['ref_key_absolute_len']==1){echo "checked";} ?> value="1" type="checkbox" name="refKeyAbsoluteLen">
							  <span class="lever"></span>
							 
							</label>
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
                