<?php 
	function welcomeMail($name,$webName){
	 $message = '<center>
        <div style="display:inline-block;max-width:300px;text-align:justify;background:#f2f2f2;padding:4px; border-radius:5px">
        </p><strong> '.$GLOBALS["LANG"]["hey"].' '.ucwords($name).',</strong> </p>
        <p> '.$GLOBALS["LANG"]["thank_you_for_registering_us_we_are_so_excited_to_have_you_as_our_user"].'</p>
		<p>'.$GLOBALS["LANG"]["as_we_know_the_customer_needs_the_best_customer_service_we_are_dedicated_to_giving_you_exactly_that"].' </p>
		<p>'.$GLOBALS["LANG"]["kind_regards"].'</p>
		<p>'.$webName.'</p>
		</div>
		</center>
		';	
		return $message;
}
?>