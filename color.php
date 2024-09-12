<form  id="settingForm" class="row col s12" method="post" onsubmit="return ajaxRequest(this,'../../processor/configureprocessing.php',getId('scroll'));"  action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
  <input type="hidden" name="admin" value="<?php echo $loginAdmin;?>">
 
<div id="navigationColor" class="row valign-wrapper">
     <div class="col s4">
          <?php echo $LANG["navigation"]?>
          
        </div>
        <div class="col s4">
          <?php echo $LANG["background"]?>
          <div class="input-field inline">
              <input name="value[]" value="<?php echo $webConfig["navBackgroundColor"]?>" style="width: 65px !important" id="navBG" type="text" >
         </div>
            <input value="navBackgroundColor"  name="name[]" type="hidden" >
        </div>
        <div class="col s4">
          <?php echo $LANG["foreground"]?>
            <div style="width: 60px !important" class="input-field inline">
            <input name="value[]" value="<?php echo $webConfig["navForegroundColor"]?>" id="navFG" type="text" >
         </div>
             <input value="navForegroundColor"  name="name[]" type="hidden" >
        </div>
</div>

<div id="footerColor" class="row valign-wrapper">
     <div class="col s4">
          <?php echo $LANG["footer"]?>
          
        </div>
        <div class="col s4">
          <?php echo $LANG["background"]?>
          <div class="input-field inline">
              <input name="value[]"  value="<?php echo $webConfig["footerBackgroundColor"]?>" style="width: 65px !important" id="footerBG" type="text" >
          <input value="footerBackgroundColor"  name="name[]" type="hidden" >
          </div>
        </div>
        <div class="col s4">
          <?php echo $LANG["foreground"]?>
            <div  style="width: 60px !important" class="input-field inline">
            <input name="value[]"  value="<?php echo $webConfig["footerForegroundColor"]?>" id="footerFG" type="text" >
          <input value="footerForegroundColor"  name="name[]" type="hidden" >
            </div>
        </div>
</div>


<div id="btnColor" class="row valign-wrapper">
     <div class="col s4">
          <?php echo $LANG["button"]?>
          
        </div>
        <div class="col s4">
          <?php echo $LANG["background"]?>
          <div class="input-field inline">
              <input  name="value[]" value="<?php echo $webConfig["buttonBackgroundColor"]?>" style="width: 65px !important" id="btnBG" type="text" >
          <input value="buttonBackgroundColor"  name="name[]" type="hidden" >
          </div>
        </div>
        <div class="col s4">
          <?php echo $LANG["foreground"]?>
            <div style="width: 60px !important" class="input-field inline">
            <input  name="value[]" value="<?php echo $webConfig["buttonForegroundColor"]?>" id="btnFG" type="text" >
          <input value="buttonForegroundColor"  name="name[]" type="hidden" >
            </div>
        </div>
</div>
  <div class="col s12">
      <button class="btn waves-effect waves-light right"><?php echo $LANG["save"];?></button>
  </div>
</form>

    <script>
        
   function changeColor(el,type,val){
       if(type=="background"){
       document.getElementById(el).style.backgroundColor = val;
       }else{
          document.getElementById(el).style.color = val;
       }
   }
   <?php 
   $pickGroup = array(
       array(
           "navigationColor","navBG","navFG",
           "footerColor","footerBG","footerFG",
           "btnColor","btnBG","btnFG", 
       ),
        array(
           "footerColor","footerBG","footerFG",
       ),
        array(
           "btnColor","btnBG","btnFG", 
       )
   );
   for($i = 0; $i < count($pickGroup); $i++){
   ?>
   function <?php   echo $pickGroup[$i][1];?>update() {
        <?php   echo $pickGroup[$i][1];?>.set(this.value).enter();
    }

    var <?php   echo $pickGroup[$i][1];?> = new CP(document.querySelector('#<?php   echo $pickGroup[$i][1];?>'));

    <?php   echo $pickGroup[$i][1];?>.on("change", function(color){ 
        this.source.value = '#' + color;
        //document.getElementById("co").value=color;
        changeColor('<?php   echo $pickGroup[$i][0];?>','background',"#"+color)
    });

    

    <?php   echo $pickGroup[$i][1];?>.source.oncut = <?php   echo $pickGroup[$i][1];?>update;
    <?php   echo $pickGroup[$i][1];?>.source.onpaste = <?php   echo $pickGroup[$i][1];?>update;
    <?php   echo $pickGroup[$i][1];?>.source.onkeyup = <?php   echo $pickGroup[$i][1];?>update;
    <?php   echo $pickGroup[$i][1];?>.source.oninput = <?php   echo $pickGroup[$i][1];?>update;
   
   function <?php   echo $pickGroup[$i][2];?>update() {
        <?php   echo $pickGroup[$i][2];?>.set(this.value).enter();
    }

    var <?php   echo $pickGroup[$i][2];?> = new CP(document.querySelector('#<?php   echo $pickGroup[$i][2];?>'));

    <?php   echo $pickGroup[$i][2];?>.on("change", function(color){ 
        this.source.value = '#' + color;
        //document.getElementById("co").value=color;
        changeColor('<?php   echo $pickGroup[$i][0];?>','color',"#"+color)
    });

    

    <?php   echo $pickGroup[$i][2];?>.source.oncut = <?php   echo $pickGroup[$i][2];?>update;
    <?php   echo $pickGroup[$i][2];?>.source.onpaste = <?php   echo $pickGroup[$i][2];?>update;
    <?php   echo $pickGroup[$i][2];?>.source.onkeyup = <?php   echo $pickGroup[$i][2];?>update;
    <?php   echo $pickGroup[$i][2];?>.source.oninput = <?php   echo $pickGroup[$i][2];?>update;
  
   
   
   <?php } ?>
    </script>