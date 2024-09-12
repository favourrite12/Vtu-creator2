<div id="scroll"></div> 

 <section id="content">
	  
          <div class="container flexbox">
            <div class="section" >
             
             
             
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
                      <div class="row">
					  
					  
                        <form action="#" class="col s12"  onsubmit="return ajaxRequest(this,'../../processor/payment_method_setting_fee.php',getID('scroll'));" >
						 
						  <input name="id" value="<?php echo $methodValue['id']; ?>" type="hidden" >
						 
						 <div class="row">
						
						  
					
						    <div class="row col s12">
						     <div class="left-align"><?php echo $LANG['for_direct_recharge']?></div>
							  <div class="input-field col s2">
							     <input  id="rechargeFee" name="rechargeFee" type="text" value="<?php echo $methodValue['recharge_fee']; ?>">
							     <label for="rechargeFee"><?php echo $LANG['fee']; ?></label>
							  </div> 
							  

									  
					    <div class="switch col s6 ">
				        	<br/>
					        <br/>
							 <div class="switch">
							<label>
							
							  <input <?php if($methodValue['recharge_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="rechargePercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["in_percentage"] ;?>
							</label>
						  </div>
					    </div> 

                        
						  <div class="input-field col s4 tooltipped"  data-position="bottom" data-tooltip="<?php echo  $LANG["fee_capped_at_description"]; ?>" >
							 <input  id="rechargeCapped" name="rechargeCapped" type="text" value="<?php echo $methodValue['recharge_capped']; ?>">
							 <label for="rechargeCapped"><?php echo $LANG['fee_capped_at']; ?></label>
						  </div> 
						  
						  
						    <div class="left-align"><?php echo $LANG['for_wallet_topup']?></div>
						  
						    <div class="input-field col s2">
							     <input  id="walletFee" name="walletFee" type="text" value="<?php echo $methodValue['wallet_fee']; ?>">
							     <label for="walletFee"><?php echo $LANG['fee']; ?></label>
							  </div> 
							  

									  
					        <div class="switch col s6 ">
				        	<br/>
					        <br/>
							 <div class="switch">
							<label>
							
							  <input <?php if($methodValue['wallet_percentage']==1){echo "checked";} ?> value="1" type="checkbox" name="walletPercentage">
							  <span class="lever"></span>
							  <?php echo $LANG["in_percentage"] ;?>
							</label>
						  </div>
					    </div> 

                        
						  <div class="input-field col s4 tooltipped"  data-position="bottom" data-tooltip="<?php echo  $LANG["fee_capped_at_description"]; ?>" >
							 <input  id="walletCapped" name="walletCapped" type="text" value="<?php echo $methodValue['wallet_capped']; ?>">
							 <label for="walletCapped"><?php echo $LANG['fee_capped_at']; ?></label>
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
                