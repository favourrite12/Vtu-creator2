<div class="row">
<?php 
$result =  $conn->query("SELECT * FROM theme");
if($result > 0){
while($row = $result->fetch_assoc()){?>
    <div class="card col m4">
       <div class="card-image">
           <div class="theme-title"><span class="card-tit"><h5><?php echo $row["name"]?></h5></span></div>
           <img style="height: 250px" src="../../themes/<?php echo $row["loc"]?>/<?php echo $row["img"]?>">
         <a <?php echo "href=\"javaScript:void(0)\" onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"])."','../../processor/delete_theme.php?id={$row["id"]}')\""?> class="btn-floating halfway-fab waves-effect waves-light red">
             <i class="material-icons">delete</i>
           </a>
       </div>
       <div class="card-content">
           <a target="_blank" href="../../../theme_preview.php?id=<?php echo $row["id"];?>" class="btn left green"><i class="material-icons">visibility</i> </a>
           <button <?php echo "href=\"javaScript:void(0)\" onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"].'('.$LANG["change_system_theme"].')')."','../../processor/apply_theme.php?id={$row["id"]}','','','POST','info')\""?> class="btn right"><?php echo $LANG["apply"]?></button>
           <div class="clearfix"></div>
       </div>
     </div>
    <?php } } ?>
</div>
<style>
    .theme-title{
        color: #000;
    }
</style>   
<div data-position="left" data-tooltip="<?php echo $LANG["install_new_theme"] ?>" class=" tooltipped fixed-action-btn">
    <a href="new_theme.php" class="btn-floating btn-large">
      <i class="large material-icons">cloud_download</i>
    </a>
  </div>