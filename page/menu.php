<style>
.menu{width:100%;  padding:2px; float:left; font: 12px; font-family:"Square721 BT";}
.menu ul {float:left; margin:0; padding:0; list-style:none;}
.menu li:hover {background:linear-gradient(#0b7641, #065332);font-size:14px;font-weight:bold;}
.menu li {float:left; margin:0 1px; padding:0;font-size:14px; color:#FFFFFF; padding:6px; margin:0;  }
.menu li:active{background-color:#000000;}
.menu a {line-height:16px; float:left;color:#FFFFFF;font-family:"Square721 BT";}
.menu a:hover {color:#FF6600;}
.menu a.active {color:#FF0000; }
</style>
<? session_start();
if(!isset($_SESSION['SES_REG'])){
    header("location:login.php");
}
if($_SESSION['ROLES']=="31") { ?>
<div class="menu" style="width:100%;background-color:#065332">
<ul>
   <li><a href="remun.php?link=#">&nbsp;&nbsp;&nbsp;<i class="fa fa-home" style="font-size:16px;color:#FF6600"></i></a></li>
   <li><a href="remun.php?link=x_pegawai" >Pegawai</a>
   <li><a href="remun.php?link=x_index" >Index</a>
   <li><a href="remun.php?link=x_x1">Pendapatan</a> 
   <li><a href="remun.php?link=x_x2">Jasa</a>
   </li>
</ul>
</div>
<div class="menu" style="width:100%;background-color:#999999;padding:2px"></div>
	<? } ?>
