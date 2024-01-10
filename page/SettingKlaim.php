<style>
  /* The Modal (background) */
  .modalx {
    display: block;
    /* Hidden by default */
    /*  display: none; /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.2);
    /* Black w/ opacity */
  }

  /* Modal Content */
  .modalx-content {
    /*background-color: #fefefe;*/
    margin: auto;
    padding: 20px ;
    border: 0px solid #888;
    width: 500px;
	border-radius:6px;
	 box-shadow:1px 1px 4px 1px #7f8180;
	background:linear-gradient(#bbb, #e5f4e5);
	padding-bottom:40px;
	
  }
 .modalx-content:hover {
 box-shadow:3px 1px 10px 1px #7f8180;
 }
  /* The Close Button */
  .closex {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .closex:hover,
  .closex:focus {
    color: red;
    text-decoration: none;
    cursor: pointer;
  }

</style>
<div class="row">
  <div class="col-lg-12">
    <div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">
      <div class="card-body">
        <div class="d-flex m-b-0 align-items-center no-block">
          <h5 class="card-title ">KLAIM ASURANSI </h5>

        </div>
      </div>
      <div class="card-body bg-light">
        <div class="row text-center m-b-20">
          <div class="col-lg-12 col-md-4 m-t-20">
            <h7 class="m-b-0 font-light">
              <?php
              session_start();
              include("include/connect.php");
              require_once('page/new_pagination.php');

            $periode=$_GET['periode'];
//$search = ' WHERE f.keluarrs like "'.$periode.'%" ';
$search = ' WHERE a.id !="" ';

$periode = "";
if(!empty($_GET['periode'])) {
    $periode =$_GET['periode'];
} 

if($periode !="") {
    $search = $search." AND a.periode = '".$periode."' ";
}
$grup = "";
if(!empty($_GET['grup'])) {
    $grup =$_GET['grup'];
} 

if($grup !="") {
    $search = $search." AND a.KdCrb = '".$grup."' ";
}
              ?>


              <div align="center" style="padding-bottom:5px">
                <form name="formsearch" method="get">
                  <table width="100%" style="background-color:transparent">
                    <tr valign="bottom">
                      <td width="150">Asuransi<br />
                        <select name="grup" class="form-cari">
                         	 <option value="" >-</option>
                          <?
                                $qrypoly = mysql_query("SELECT * FROM m_carabayar WHERE KODE IN (2,3,4,9)ORDER BY orders ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
								
                          <option value="<? echo $listpoly['KODE'];?>" <? if($grup==$listpoly['KODE']) echo "selected=selected"; ?>>
						  <? echo $listpoly['NAMA'];?></option>
                          <? } ?>
                        </select></td>
                      <td width="120">Periode<br />
					  <select class="form-cari" name="periode" placeholder="Periode" >
                     
                        <?
						   $mysql 	= mysql_query('select periode FROM x_SettingKlaim WHERE KdCrb = "'.$grup.'" order by id asc');
						   if(mysql_num_rows($mysql) > 0){
								while($dsql = mysql_fetch_array($mysql)){
									
									if($periode == $dsql['periode']): $zx = 'selected="selected"'; else: $zx = ''; endif;
									echo '<option value="'.$dsql['periode'].'" '.$zx.'>'.$dsql['periode'].'</option>';
								}
							}
						   ?>
                      </select></td>
                      <td width="284" ><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search" ></i>&nbsp;&nbsp;C a r i</button>   <input type="hidden" name="link" value="<?= $_GET['link']; ?>" />                   </td>
                      <td width="380" align="right" valign="bottom">
                    <a href="./index.php?link=<?=$_GET['link'];?>&verif=1"  >  <button type="button" name="tom" class="btn m-t-10 m-r-5 btn-outline-success btn-sm" ><i class="fa fa-plus" ></i>&nbsp;&nbsp;Klaim</button></a>                      </td>
                      <td width="5" align="right" valign="bottom">
                       <!-- <? $jumall = mysql_num_rows(mysql_query("SELECT * FROM m_pegawai where ONOFF='ON'")); ?>
                        <button type="button" class="btn m-t-10 m-r-5 btn-outline-success"> <?= $jumall; ?> </button>       -->               </td>
                    </tr>
                  </table>
                </form>
            
              </div>
              <div class="table-responsive" id="table_search">
                <table width="100%" cellpadding="2px" cellspacing="0" class="tb" id="myTable1"  style="font-size:10px" border="1px">
                  <tr align="center" style="height:50px">
                   <th width="2%" >NO</th>
              <th width="5%" >TANGGAL</th>
              <th width="10%" >ASURANSI</th>
              <th width="3%" align="LEFT" >PERIODE</th>
              <th width="8%" align="LEFT" >JUMLAH KLAIM </th>
              <th width="5%" align="left">TANGGAL KLAIM </th>
              <th width="7%" >USER</th> 
              <th width="18%" >KETERANGAN</th>
              <th width="5%" align="center" >STATUS</th> 
              <th width="5%" >AKSI</th>
                  </tr>
                 
                  <?
				  $link=$_GET['link'];
                  $sql = "SELECT  a.*,b.NAMA FROM x_SettingKlaim a
				  left join m_carabayar b ON a.KdCrb=b.KODE ".$search." order by b.NAMA,a.periode asc";
                  $NO = 0;
                  $pager = new PS_Pagination($connect, $sql, 10, 5,  "&periode=" . $periode , "index.php?link=$link&");

                  //The paginate() function returns a mysql result set
                  $NO = 0;
                  $rs = $pager->paginate();
                  while ($data = mysql_fetch_array($rs)) { ?>
                    <tr <? echo "class =";
                        $count++;
                        if ($count % 2) {
                          echo "tr4";
                        } else {
                          echo "tr2";
                        }
                        ?>>
                     <td align="center"><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*10)+$NO;?></td>
              <td align="center"><? echo $data['tanggal'];?></td>
			    <td align="left"><?=$data['NAMA']?></td>
			    <td align="center"><? echo $data['periode'];?></td>
			    <td align="right" style="padding-right:10px">Rp. <?=number_format($data['jumlah'],2,',','.');?></td>
              <td align="center"><? echo $data['tgl_input'];?></td>
            <td align="center"><? echo $data['nip'];?> </td>
              <td align="left" style="padding-left:10px" ><?=$data['ket']?></td>
              <td align="center"><?php if($data['status']=="ON") {?><btn type="button" class="btn btn-sm btn-success"><? echo $data['status'];?></btn><?php }else { ?><btn type="button" class="btn btn-sm btn-danger"><? echo $data['status'];?><? }?></btn></td>
              
              <td align="center">   
			<a href='./index.php?link=<?=$link;?>&verif=1&id=<?=$data['id'];?>&op=edit"' class="btn btn-sm btn-outline-warning" id="klaim" >Edit</a>  </td>
                    </tr>
                  <?  }

                  ?>
                </table>
                <?php
              //  echo "<div style='padding:5px;font-size:12px;font-family:Square721 BT' align=\"center\"><br />";
			  echo "<div style='padding:5px;' align=\"center\"><br />";

                echo $pager->renderFirst() . " | ";
                echo $pager->renderPrev() . " | ";
                echo $pager->renderNav() . " | ";
                echo $pager->renderNext() . " | ";
                echo $pager->renderLast();
                echo "</div>";
                ?>

              </div>
          </div>
        </div>
      </div>

    </div>

 


<div class="col-lg-12 col-md-4 m-t-20">
  <a href="index.php?link=#" class="btn m-t-10 m-r-5 btn-outline-info">
    KEMBALI </a>
</div>
</div>
<? if(!empty($_GET['verif'])){ ?> 
<!-- The Modal -->
<div id="myModalx" class="modalx">

  <!-- Modal content -->
  <div class="modalx-content" >
   <?php 
include("../include/connect.php");

		$q_pasien	= "select * from x_SettingKlaim where id !='N' order by id  desc limit 1";
  		$get = mysql_query ($q_pasien)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
?>
  <?php 
include("../include/connect.php");
$id=$_GET['id'];
		$jm	= "SELECT  a.*,b.NAMA FROM x_SettingKlaim a
				  left join m_carabayar b ON a.KdCrb=b.KODE
		 where a.id ='$id'";
  		$get = mysql_query ($jm)or die(mysql_error());
		$jms= mysql_fetch_assoc($get); 		
?>	
   <form name="simpan" id ="simpan" method="post" action="./page/SaveKlaim.php"  >
      <table width="100%" style="background:none">
        <tr style="color:#fff">
          <td width="90%" ><h5><i class="fa  fa-share-square-o" style="color:36bea6;font-size:20px"></i>&nbsp;SETTING KLAIM</h5><input name="id" type="hidden" value="<?=$_GET[id];?>" />
            <input name="NIP" type="hidden" id="NIP" value="<?=$_SESSION[NIP];?>" />
            <input name="JAMBAYAR" type="hidden" id="JAMBAYAR" value="<?php echo " " . date("h:i:sa");
?>" />
         
          <input name="kasir" type="hidden" id="kasir" value="<?=$_SESSION[NIP];?>" />
          <input name="op" type="hidden" id="op" value="<?=$_GET['op'];?>" /></td>
          <td width="10%"> <a href="index.php?link=SettingKlaim"><span class="closex">&times;</span></a></td>
        </tr>
        <tr>
          <td colspan="2"> Jumlah Klaim <br />
            <input type="hidden" name="link" value="<?= $_GET['link'] ?>" />
            <input name="jumlah" type="text" id="NAMA" onkeyup="this.value = this.value.toUpperCase()" required="required" value="<?=$jms['jumlah'];?>" class="form-control" /></td>
        </tr>

        <tr>
          <td colspan="2">Periode<br />
            <input type="text" name="periode" class="form-control" value="<? if(empty($_GET['id'])){ echo $cp=$userdata['periode']+1;  } else { echo $jms['periode'];  } ?>" /></td>
        </tr>
        <tr>
          <td colspan="2">Jenis Asuransi <br />
            <select style="font-size:11px;height:24px;width:100%" name="crb" class="form-control" >
               <option value="<?=$jms['KdCrb'];?>"  ><?=$jms['NAMA'];?></option>
			               <?
						   $mysql 	= mysql_query('select KODE,NAMA from m_carabayar WHERE KODE IN (2,3,4,8,9)  order by KODE asc');
						   if(mysql_num_rows($mysql) > 0){
								while($dsql = mysql_fetch_array($mysql)){
									
									if($crb == $dsql['KODE']): $zx = 'selected="selected"'; else: $zx = ''; endif;
									echo '<option value="'.$dsql['KODE'].'" '.$zx.'>'.$dsql['NAMA'].'</option>';
								}
							}
						   ?>
            </select></td>
        </tr>
        <tr>
          <td colspan="2">Status<br />
            <select style="font-size:11px;height:24px;width:100%" name="status" class="form-control" >
              <option value="<?=$jms['status'];?>"  ><?=$jms['status'];?></option>
			  <option value="ON"  >ON</option>
			  <option value="OFF"  >OFF</option>
			  <option value="LOCK"  >LOCK</option>
         </select></td>
        </tr>
        <tr>
          <td colspan="2">Keterangan<br />
            <input type="text" name="keterangan" class="form-control" value="<?=$jms['ket'];?>" /></td>
        </tr>
        <tr>
          <td colspan="2">Password
		        <input type="password" name="pass" class="form-control" required="required" />          </td>
        </tr>
        <tr>
          <td colspan="2">
            <button class="btn m-t-10 m-r-5 btn-outline-success" type="submit" style="width:100%;height:30px;"><i class="fa fa-save"></i>&nbsp;&nbsp;SIMPAN</button>          </td>
        </tr>
      </table>
    </form>

  </div>

</div>

<script>
  // Get the modal
  var modalx = document.getElementById("myModalx");
  // Get the button that opens the modal
  var btn = document.getElementById("klaim");
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("closex")[0];
  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modalx.style.display = "block";
  }
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modalx.style.display = "none";
  }
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modale) {
      modalx.style.display = "none";
    }
  }
</script>
<? } ?>
</body>