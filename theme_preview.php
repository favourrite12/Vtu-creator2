<?php session_start();if(empty($_SESSION["admin"])){ header("Location: admin/login.php");}?>
<?php  include_once 'include/data_config.php';?><?php include_once  'include/ini_set.php';?><?php $themeId = $theme = mysqli_real_escape_string($conn,$_GET["id"]);  $theme = $conn->query("SELECT loc FROM theme WHERE id = '$theme'")->fetch_assoc()["loc"];if(!empty($theme)){include "themes/$theme/index.php";}else{?> <?php $themeNotFound=true; ?> <?php  include_once'include/webconfig.php';?><?php  include_once "language/{$webConfig["LANG"]}.php";?><title><?php echo $webConfig["homePageTitle"];?></title><div style="border:#ff0000 solid 4px; padding:  5px" ><center><?php echo $LANG["failed_to_load_theme"];?></center></div><?php } ?>
<?php if(!$themeNotFound){?>
<button style="position: fixed; left: 0; border-radius: 5px; padding: 5px 4px;
        bottom:0;background: #ff0000; color: #FFF; border: none;
        z-index: 99999999999999;" <?php echo "href=\"javaScript:void(0)\" onclick=\"ajaxConfirm('".ucfirst($LANG["please_confirm_this_action"].'('.$LANG["change_system_theme"].')')."','processor/apply_theme.php?id=$themeId','','','POST','info')\""?> ><?php echo $LANG["apply_this_theme"]?></button>
</button>
<?php } ?>