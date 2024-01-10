 <script>
$(document).ready(function(){
$("#Bulanan").css("display","<? if($_GET['asal']=="1"){ echo "Block"; }else{ echo "none";} ?>"); //Menghilangkan form-input ketika pertama kali dijalankan
$(".detail").click(function(){ //Memberikan even ketika class detail di klik (class detail ialah class radio button)
if ($("input[name='asal']:checked").val() == "1" ) { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
$("#Bulanan").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
} else {
$("#Bulanan").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
}
});
});
</script>
 <script>
$(document).ready(function(){
$("#Semester").css("display","<? if($_GET['asal']=="2"){ echo "Block"; }else{ echo "none";} ?>"); //Menghilangkan form-input ketika pertama kali dijalankan
$(".detail").click(function(){ //Memberikan even ketika class detail di klik (class detail ialah class radio button)
if ($("input[name='asal']:checked").val() == "2" ) { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
$("#Semester").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
} else {
$("#Semester").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
}
});
});
</script>
<?php 
session_start();
 include("./include/connect.php");
#require_once('ps_pagination.php'); 
 
 if(!empty($_GET['periode'])){ 
 $search= " AND a.ID!='0'   ";  
 }else{
 $search= " AND a.ID='0'   ";  
 } 
   /*
if(!empty($_REQUEST['unit'])){
	$unit =$_REQUEST['unit'];  
} else{ 
	$unit =$_SESSION['KDUNIT'];  
} 
if($unit!="ALL DEPO") {
    $search = $search." AND a.KDUNIT='".$unit."' "; 
}
 */
  $unit = "";
if(!empty($_GET['unit'])) {
    $unit =$_GET['unit'];
} 

if($unit !="") {
    $search = $search." AND a.KDUNIT='".$unit."' ";
}

#$ibs = "";
if(!empty($_GET['ibs'])) {
    $ibs =$_GET['ibs'];
	if($ibs=="2"){
 		$search = $search." AND a.IBS!='1' ";
 	}else{
 		$search = $search." AND a.IBS='1' "; 
 	} 
}  
else{}
  
if(!empty($_GET['asal'])){ 
$asal=$_GET['asal'];
	if($_GET['asal']=="1"){
		if(!empty($_GET['poly'])){ 
		$poly=$_GET['poly'];
		$search =$search." AND a.UNIT='1' AND a.RUANG='$_GET[poly]' "; 
		}else{
		$search =$search." AND a.UNIT='1' ";
		}
	}else if($_GET['asal']=="2"){	
		if(!empty($_GET['ruang'])){ 
		$ruang=$_GET['ruang'];
		$search =$search." AND a.UNIT='2' AND d.ket_ruang='$_GET[ruang]' ";
		}else{
		$search =$search." AND a.UNIT='2' ";
		}
	}else{ $search =$search." AND a.UNIT!='0' "; }
 }
   
$nomr = "";
if(!empty($_GET['nomr'])) {
    $nomr =$_GET['nomr'];
} 

if($nomr !="") {
    $search = $search." AND a.NOMR LIKE '%".$nomr."%' ";
}
 
 $carabayar = "";
if(!empty($_GET['carabayar'])) {
    $carabayar =$_GET['carabayar'];
} 

if($carabayar !="") {
    $search = $search." AND a.CARABAYAR='".$carabayar."' ";
}
 $periode = "";
if(!empty($_GET['periode'])) {
    $periode =$_GET['periode'];
} 

if($periode !="") {
    $search = $search." AND a.JKN='".$periode."' ";
}
  
$apt = "";
if(!empty($_GET['apt'])) {
    $apt =$_GET['apt'];
} 

if($apt !="") {
    $search = $search." AND a.APT='$apt' ";
}
 
 
?>

<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title">
          <h3>LAPORAN PEMBAYARAN RESEP (LAINNYA) </h3>
        </div>
        <div align="center" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="100%" border="0" cellspacing="0" class="tb">
                        <tr>
						<td width="100px">DEPO<br/>
 <?php
$sql_ruang = "SELECT * from m_unit where kode='5' and grup_unit='1' order by nama_unit ";
$get_ruang = mysql_query($sql_ruang); 
?>
<select class="text" style="height:24px;font-size:11px" name="unit"  >
<option value="" >-</option>
<? while($data_ruang = mysql_fetch_array($get_ruang)){ ?>
<option value="<?=$data_ruang['kode_unit']?>"  <? if($unit==$data_ruang['kode_unit']) echo "selected=selected"; ?>  ><?=$data_ruang['nama_unit']?></option>
<? } ?>  </select> </td>
<td width="130px">
 <label> <input type="radio" name="asal" <? if($_GET['asal']!="1" or $_GET['asal']!="2"){ ?> checked="checked" <? } ?> class="detail"   />
   All</label>&nbsp;
  <label><input type="radio" name="asal" <? if($_GET['asal']=="1"){ ?> checked="checked" <? } ?> class="detail" value="1" />
   RJ</label>&nbsp;
  <label> <input type="radio"  name="asal" <? if($_GET['asal']=="2"){ ?> checked="checked" <? } ?> class="detail" value="2" />
 RI</label> :
 <br/>  
    
<div id="Bulanan">
<select name="poly" style="height:24px;font-size:11px" class="text" > 
	    <option value="">-</option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly order by nama ASC")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 	?>
                <option value="<? echo $listpoly['kode'];?>" <?php if($listpoly['kode'] == $_REQUEST['poly']): echo 'selected="selected"'; endif; ?> ><? echo $listpoly['nama'];?></option>
			 	<? 
			 	} 
			 ?>
        </select></div> 
<div id="Semester">
 <?php
$sql_ruangz = "SELECT ket_ruang from m_ruang GROUP BY ket_ruang order by ket_ruang ";
$get_ruangz = mysql_query($sql_ruangz); 
?>
<select class="text" name="ruang"  style="height:23px;font-size:11px" >
<option value="" >-</option>
<? while($data_ruangz = mysql_fetch_array($get_ruangz)){ ?>
<option value="<?=$data_ruangz['ket_ruang']?>"  <? if($ruang==$data_ruangz['ket_ruang']) echo "selected=selected"; ?>  ><?=$data_ruangz['ket_ruang']?></option>
<? } ?>  </select> 
		</div></td>
<td width="20px">IBS<br/>
<select name="ibs"  style="height:24px;font-size:11px"  class="text" > 
<option value=""    >All</option> 
<option value="1" <? if($ibs=="1") echo "selected='selected'"; ?>>IBS</option>  
<option value="2" <? if($ibs=="2") echo "selected='selected'"; ?>>Non-IBS</option> 
</select></td>  
<td width="70px">No.MR<br/><input type="text" name="nomr" style="height:17px;width:80px;font-size:11px"  value="<? if($nomr!="") { echo $nomr; }?>" class="text"></td>
<td width="100px">Nama Pasien<br/><input type="text" name="nama" style="height:17px;font-size:11px" id="nama" value="<? if($nama!="") { echo $nama; }?>" class="text"></td>
<td width="100px">Apoteker<br/>
<select name="apt" style="height:24px;font-size:11px" class="text" > 
	    <option value="">-</option>
             <? 
			 	$apts = mysql_query("SELECT APT FROM r_farmasi_1 group by APT order by APT ASC")or die (mysql_error());
				while ($dapt = mysql_fetch_array($apts)){
			 	?>
                <option value="<? echo $dapt['APT'];?>" <?php if($dapt['APT'] == $_REQUEST['apt']): echo 'selected="selected"'; endif; ?> ><? echo $dapt['APT'];?></option>
			 	<? 
			 	} 
			 ?>
        </select></td>
		<td width="100px">Cara Bayar<br/>
 <select name="carabayar"  style="height:24px;font-size:11px" class="text" >
                        <option value=""> -- </option>
                        <?
                                $qrycrbyr = mysql_query("SELECT * FROM m_carabayar where ORDERS>'2' ORDER BY ORDERS ASC")or die (mysql_error());
                                while ($listbyr = mysql_fetch_array($qrycrbyr)) {
                                    ?>
                        <option value="<? echo $listbyr['KODE'];?>" <? if($listbyr['KODE']==$carabayar) echo "selected=selected"; ?>><? echo $listbyr['NAMA'];?></option>
                        <? } ?>
                    </select></td>
<td width="50px">Periode<br/>
					 
					
					<select name="periode"  style="height:24px;font-size:11px" class="text" > 
                        <?
                                $qrycrbyrx = mysql_query("SELECT periode FROM jm_klaim GROUP BY periode ORDER BY periode DESC")or die (mysql_error());
                                while ($listbyrx = mysql_fetch_array($qrycrbyrx)) {
                                    ?>
                        <option value="<? echo $listbyrx['periode'];?>" <? if($listbyrx['periode']==$periode) echo "selected=selected"; ?>><? echo $listbyrx['periode'];?></option>
                        <? } ?>
                    </select>
					
 </td> 
		<td  ><br/><input  style="height:23px;width:80px;font-size:12px" type="submit" value="Cari" class="text"/>
              <input type="hidden" name="link" value="<?=$_GET['link'];?>" /></td>
                        </tr>
                </table>

            </form>
          <div id="table_search"><br/>
		  

<table class="tb" width="100%"   border="0" cellspacing="1" cellspading="1">
				<tr align="center"  >
				  <th width="40" rowspan="2">No</th>
				  <th width="70" rowspan="2">TANGGAL</th>
				  <th width="70" rowspan="2">NOMR</th>
				  <th rowspan="2" >NAMA PASIEN </th>
				  <th width="200" rowspan="2">POLI / RUANG </th>
				  <th colspan="5">RESEP</th>
				  <th width="110" rowspan="2">JUMLAH</th>
          </tr>
				<tr align="center"  >
				<th width="40">L</th>
				  <th width="40">R</th>
				  <th width="100">JM R/ </th>
				  <th width="100">OBAT</th>
				  <th width="100">ALAT</th>
			    </tr>
                    <?
$warnaGenap = "#f1f1f1";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
                    $NO=0; 
$sql = "SELECT  a.*, 
DATE_FORMAT(a.TANGGAL,'%d-%m-%Y') TGL_INPUT, 
sum(a.JMBAYAR) as JMBAYARS,
sum(a.JM_R) as JM_RS,
sum(a.QTY_R) as QTY_RS,
sum(a.JMALAT) as JMALATS,
SUM(IF (a.ID!='0',1,0 ) ) AS JMS, 
case when a.UNIT='1' then (SELECT nama FROM m_poly WHERE kode=a.RUANG)
 when a.UNIT='2' then (SELECT ket_ruang FROM m_ruang WHERE no=a.RUANG) 
  else '' end as ruangan ,
  b.NAMA as namapasien 
FROM r_farmasi_8 a      
LEFT JOIN m_pasien b on a.NOMR=b.NOMR 
WHERE a.JKN!='0' ".$search." GROUP BY a.NOBILL  ORDER BY a.NOBILL ASC"; 
 
$jalankan2 = mysql_query($sql) or die('Errorsx');	   
	while ($data=mysql_fetch_array($jalankan2)){  
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
	$NO++;
 
                         ?>
                        <tr bgcolor="<?=$warna;?>">
						<td style="font-size:12px" align="center"><? echo $NO; ?></td>
                        <td style="font-size:12px" align="center"><?=$data['TGL_INPUT']?></td>
                        <td style="font-size:12px" align="center"><?=$data['NOMR']?></td>
                        <td style="font-size:12px"><?=$data['namapasien']?></td>
                        <td style="font-size:12px"  ><?=$data['ruangan']?></td>                      
  						<td style="font-size:12px;padding-right:5px" align="right"><?=$data['JMS']?></td>
                        <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data['QTY_RS'],0,',','.'); ?></td>
                        <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data['JM_RS'],2,',','.'); ?></td>
                      
                    <td style="font-size:12px;padding-right:5px" align="right"><?=number_format(($data['JMBAYARS']-$data['JM_RS']-$data['JMALATS']),2,',','.'); ?></td>
                        <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data['JMALATS'],2,',','.'); ?></td>
                        <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data['JMBAYARS'],2,',','.'); ?></td>
                        </tr>
                       
                        <?	 }   ?>
						<? 
$select2=mysql_query("SELECT a.ID,
SUM(  IF (a.ID!='0',1,0 ) ) AS jumlah_l,
SUM(a.JMBAYAR) AS jumlah_bayar,
SUM(a.QTY_R) AS jumlah_r ,
SUM(a.JM_R) AS jumlah_rr ,
SUM(a.JMALAT) AS jumlah_alat 
FROM r_farmasi_8 a  
WHERE  a.ID!='0' ".$search."  "); 
 
$data2=mysql_fetch_array($select2);
		?>
						 <tr height="40px" bgcolor="#FFFF99" style="font-weight:bold" >
                          <td colspan="5" align="center" style="font-size:12px">TOTAL</td>
                          <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data2['jumlah_l'],0,',','.'); ?></td>
                          <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data2['jumlah_r'],0,',','.'); ?></td>
                          <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data2['jumlah_rr'],2,',','.'); ?></td>
                          <td style="font-size:12px;padding-right:5px" align="right"><?=number_format(($data2['jumlah_bayar']-$data2['jumlah_rr']-$data2['jumlah_alat']),2,',','.'); ?></td>
                          <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data2['jumlah_alat'],2,',','.'); ?></td>
                          <td style="font-size:12px;padding-right:5px" align="right"><?=number_format($data2['jumlah_bayar'],2,',','.'); ?></td>
                        </tr>
                </table> 
				 <br />
			 
          </div>
        </div>
    </div>

 
 
</div>