<?php include 'include/header.php';?>
<?php include 'include/data_config.php';?>
<?php include 'include/filter.php';?>
<?php include 'include/getip.php';?>
<?php include 'include/feedbackprocessing.php';?>

<title><?php echo $LANG["feedback"];?> | <?php echo $webConfig["webName"];?></title>
<p class="caption"><?php echo $LANG["feedback"]; ?> - <?php echo $webConfig["webName"]; ?></p>
              <div class="divider"></div>
             
<div class="container">
    
   
 <section id="content">
        
        
 
            <div class="section container">
              
                  <!-- Form with placeholder -->
                  <div class="col s12 flexbox">
                        <div class="custom-form-control">
                    <div class="card-panel hoverable">  
                      

                        <h4><?php echo $LANG["tell_us_what_you_think_of_us"];?></h4>
                    <p><?php echo $LANG["well_all_need_people_who_will_give_us_feedback_that_is_how_we_improve"]; ?></p>

				
                            <form class="col s12 row" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="post">
                                <div class="input-field"><label><?php echo $LANG["first_name"]?></label>
                                            <input type="text" class="form-control" name="firstname" value="<?php echo $firstName?>" required="required" />
                                            <text><?php echo $firstNameError;?></text>
                                </div>
                                <div class="input-field"><label> <?php echo $LANG["last_name"]?> </label>
                                    <input class="form-control" type="text"  name="lastname" value="<?php echo $lastName?>" required="required" />
                                            <text><?php echo $lastNameError;?></text>
                                         </div>
                                <div class="input-field"><label> <?php echo $LANG["email"]?> </label>
                                    <input class="form-control" type="email"  name="email" value="<?php echo $email?>" required="required" />
                                            <text><?php echo $emailError;?></text>
                                        </div>
                                <div class="input-field"><label> <?php echo $LANG["phone"]?>  </label>
                                    <input class="form-control" type="tel"  name="phone" value="<?php echo $phone?>" required="required" />
                                            <text><?php echo $phoneError;?></text>
                                       </div>
                                      <div class="input-field"><label> <?php echo $LANG["message"]?></label>
                                            <textarea class="materialize-textarea" name="message"  required=""><?php echo $message;?></textarea>
                                            <text><?php echo $messageError;?></text>
                                      </div>
                                <button class="btn btn-info right" type="submit"><?php echo $LANG["submit"]?></button>
                            </form>

			</div>
			</div>
		</div>	
 </section>
</div>
</div></div>
	
<?php include 'include/footer.php';?>	