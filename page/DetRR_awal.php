<style>

#balik {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: #345534;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#balik:hover {
  background-color: #fc7d00;
}
/* The Modal (background) */
.modalx {
  display: none; /* Hidden by default */
  /*  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modalx-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
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
  color: #000;
  form-cari-decoration: none;
  cursor: pointer;
} 
.btn2 {
  background-color: transparent;
  border: none;
  color: white;
  padding: 4px 8px;
  
  font-size: 12px;
  cursor: pointer;
  width:70px;
}
/* Darker background on mouse-over */
.btn2:hover {
  background-color:#e9e8e7;
   color: #fc7d00;
    font-weight:bold;
	border-radius:6px;
}
.btnz {
  box-sizing: border-box;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background-color: transparent;
  border:0px solid #e74c3c;
 
  color: #006666;
  cursor: pointer;
  display: flex;
  font-size: 12px;
  line-height: 1;
  padding:1em 1em;
  form-cari-decoration: none;
  font-family: 'Montserrat', sans-serif;
  font-weight: bold;
}
.btnz:hover, .btnz:focus {
  color: #006666;
  outline: 0;
}
.third {
  border-color: #027e19;
  color: #fff;/*tulisan*/
  box-shadow: 0 0 40px 40px #027e19 inset, 0 0 0 0 #006666;
  transition: all 150ms ease-in-out;
}
.third:hover {
  box-shadow: 0 0 10px 0 #046564 inset, 0 0 10px 4px #046564;
}
</style>
<button onClick="topFunction()" id="balik" title="Go to top"><i class="fas fa-angle-double-up"></i><br><i class="fas fa-angle-double-up" style="color:#00FF00"></i><br>Top</button>

<?php
include("include/connect.php");
require_once('new_pagination.php');


if($_REQUEST['bulan'] != ''){
	$bulan = $_REQUEST['bulan'];
}else{
$bulan=date('m');
}
if($_REQUEST['tahun'] != ''){
	$tahun = $_REQUEST['tahun'];
}else{
$tahun=date('Y');
}
 $periode="$tahun-$bulan";
 $periode=$_GET['periode']; 

$search = ' WHERE f.JM = "'.$periode.'" ';  



$crb = "";
if (!empty($_GET['crb'])) {
	$crb = $_GET['crb'];
}

if ($crb != "") {
	$search = $search . " AND a.CARABAYAR ='" . $crb . "' ";
}

$dokter = "";
if(!empty($_GET['dokter'])) {
    $dokter =$_GET['dokter'];
} 

if($dokter !="") {
    $search = $search." AND a.KDDOKTER ='".$dokter."' ";
}

$no_sep = "";
if(!empty($_GET['no_sep'])) {
    $no_sep =$_GET['no_sep'];
} 
if($no_sep !="") {
    $search = $search." AND a.IDXDAFTAR LIKE '%".$no_sep."%' ";
}

$nomr = "";
if(!empty($_GET['nomr'])) {
    $nomr =$_GET['nomr'];
} 

if($nomr !="") {
    $search = $search." AND a.NOMR LIKE '%".$nomr."%' ";
	} 

?>



<div class="table-responsive" style="padding-bottom:5px">
	<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px" border="0px">
                    <tr>
                    <td width="12%">Asuransi<br><select name="crb" class="form-cari">
						<option value="">-</option>
						<?
						$mysql     = mysql_query('select KODE,NAMA from m_carabayar WHERE KODE IN (2,3,4,8,9)  order by KODE asc');
						if (mysql_num_rows($mysql) > 0) {
							while ($dsql = mysql_fetch_array($mysql)) {

								if ($crb == $dsql['KODE']) : $zx = 'selected="selected"';
								else : $zx = '';
								endif;
								echo '<option value="' . $dsql['KODE'] . '" ' . $zx . '>' . $dsql['NAMA'] . '</option>';
							}
						}
						?>
					</select>
				</td>
                      <td width="12%">Dokter <br>
                        <select  name="dokter" id="dokter" class="form-cari" >
                            <option value="0">-</option>
                            <? 
			 	$datadokter = mysql_query("SELECT * FROM m_dokter where KDPROFESI ='1' AND st_aktif ='0' AND NAMADOKTER!='Residen, dr' AND KDDOKTER!='99' order by NAMADOKTER ASC ")or die (mysql_error());
				while ($listdokter = mysql_fetch_array($datadokter)){
			 	?>
                            <option value="<? echo $listdokter['KDDOKTER'];?>" <?php if($listdokter['KDDOKTER'] == $_REQUEST['dokter']): echo 'selected="selected"'; endif; ?> ><? echo $listdokter['NAMADOKTER'];?></option>
                            <? 
			 	} 
			 ?>
                        </select></td>
                      <td width="10%">No.Reg
                        <input type="form-cari"  name="no_sep"  value="<? if($no_sep!=""){
			  echo $no_sep;}?>" class="form-cari" /></td>
                      <td width="6%">No.RM<br />
                      <input type="form-cari" name="nomr"  value="<? if($nomr!=""){
			  echo $nomr;}?>" class="form-cari" /></td>
                     <td width="12%" valign="bottom">Periode
					<select style="width:100%" name="periode" id="periode" class="form-cari">
						<option value="0">-</option>
						<?
						$datadokter =mysql_query("SELECT a.periode,a.ket,b.NAMA FROM x_SettingKlaim a 
						left join m_carabayar b on b.KODE = a.KdCrb where b.KODE = '".$crb."' order by a.id ASC ") or die(mysql_error());
						while ($listdokter = mysql_fetch_array($datadokter)){
						?>
							<option value="<? echo $listdokter['periode']; ?>" <?php if ($listdokter['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>><? echo $listdokter['periode']; ?>-<? echo $listdokter['NAMA']; ?></option>
						<?
						}
						?>
					</select>
				</td>
                      <td width="10%" valign="bottom"><input type="hidden" name="link" value="<?=$_GET['link'];?>" />
                      <button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>
                      <td width="46%" align="right">
                           <!-- <button  type="button" class="btn btn-success btn-sm" id="klaim" ><i class="fa fa-cog fa-spin" ></i>&nbsp;&nbsp;Update Jasa</button> -->
                        </td>
                    </tr>
                  </table>
				</form>
			</div>
		
            <?php
			$no =  0;
				 $sql = "select a.TANGGAL as TANGGALS,a.NOMR as NOMRS,a.IDXDAFTAR as NONOTAS,a.jumlah as jumlahs,a.RIRJ,DATE_FORMAT(f.keluarrs,'%Y-%m-%d') TGL,
				 a.JASA_PELAYANAN as J_PELAYANAN,a.operasional as J_OPERASIONAL,a.manajemen as J_MANAJEMEN,
				 a.MEDIS as MEDISS,a.PARAMEDIS as PARAMEDISS,a.MEDIS_UM as MEDISUMUM,a.COSTSHARING AS KEBERSAMAAN, b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan
				 from t_billranap a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_poly c ON c.kode =a.UNIT 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				  join t_admission f ON f.id_admission = a.IDXDAFTAR
				".$search." and  a.UNIT ='15' and a.STATUS='SELESAI' and a.KODETARIF !='07' and a.JASA_PELAYANAN !='0.00' AND a.KODETARIF IN('04.03.05' ,'04.03.06')";
				$qry	= mysql_query($sql);
			?>
			<div class="table-responsive">
	<table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px">
    <tr>
					  <th width="3%" rowspan="2">NO</th>
					  <th width="7%" rowspan="2">TANGGAL </th>
					  <th width="13%" rowspan="2">RUANGAN</th>
					  <th width="13%" rowspan="2">NAMA DOKTER </th>
					  <th width="6%" rowspan="2">TGL.PULANG</th>
					  <th width="6%" rowspan="2">NO.REG</th>
					  <th width="7%" rowspan="2">NO.MR</th>
					  <th width="14%" rowspan="2">NAMA PASIEN </th>
					  <th width="17%" rowspan="2">TINDAKAN </th>
					  <th width="7%" rowspan="2">ORIGINAL</th>
					  <th width="7%" rowspan="2">JASA<BR> PELAYANAN </th>
					  <th colspan="2">JASA RSUD </th>
					  <th colspan="4">JASA PELAKSANA </th>
				  </tr>
					<tr  align="center">
					<th width="7%">Opera<br>sional</th>
					<th width="7%">Mana<br>jemen</th>
					<th width="7%">Medis Sp </th>
					<th width="7%">Medis<br> Umum </th>
					<th width="7%">Para<br>medis</th>
					<th width="7%">Keber<br>samaan</th>
					</tr>
                    <?php
					while($data = mysql_fetch_array($qry)){
						$no++;
					?>
						<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
		<td align="center"><? echo $no; ?></td>
		<td align="center"><? echo $data['TANGGALS']; ?></td>
		<td align="left"><? echo $data['NAMAPOLY']; ?></td>
		<td align="left"><? echo $data['NAMADOKTER']; ?></td>
		<td align="center"><? echo $data['TGL'] ?></td>
		<td align="center"><? echo $data['NONOTAS'] ?></td>
		<td align="center"><? echo $data['NOMRS'] ?></td>
		<td align="left"><? echo $data['NAMA']; ?></td>
		<td align="left"><? echo $data['nama_tindakan']; ?></td>
		<td align="right" ><? echo number_format($data['jumlahs'],2,',','.'); ?></td>
		<td align="right" ><? echo number_format($data['J_PELAYANAN'],2,',','.');  ?></td>
		<td align="right"><? echo number_format($data['J_OPERASIONAL'],2,',','.'); ?></td>
		<td align="right"><? echo number_format($data['J_MANAJEMEN'],2,',','.'); ?></td>
		<td align="right"><? echo number_format($data['MEDISS'],2,',','.');?></td>
		<td align="right"><? echo number_format($data['MEDISUMUM'],2,',','.'); ?></td>
		<td align="right"><? echo number_format($data['PARAMEDISS'],2,',','.');  ?></td>
		<td align="right"><? echo number_format($data['KEBERSAMAAN'],2,',','.');  ?></td>
	</tr> <?	} ?>

<?php
$sql3= "select 
SUM(a.jumlah) AS JUMLAH,
SUM(a.JASA_PELAYANAN) AS KLAIM,
SUM(a.operasional) AS OPERASIONAL,SUM(a.manajemen) AS MANAJEMEN,SUM(a.MEDIS) AS MEDIS,SUM(a.MEDIS_UM) AS MEDIS_UM
,SUM(a.PARAMEDIS) AS PARAMEDIS,SUM(a.COSTSHARING) AS KEBERSAMAAN,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan
		 from t_billranap a
		 left join m_pasien b ON b.NOMR = a.NOMR 
	     left join m_poly c ON c.kode =a.UNIT 
		 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
		 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
		 join t_admission f ON f.id_admission = a.IDXDAFTAR
		".$search."  and  a.UNIT ='15' and a.STATUS='SELESAI' and a.KODETARIF !='07' and a.JASA_PELAYANAN !='0.00' AND a.KODETARIF IN('04.03.05' ,'04.03.06') AND a.CARABAYAR!='8' ";
		
$qry3	= mysql_query($sql3);
$data3 = mysql_fetch_array($qry3);
?>
<?
$original = $data3['JUMLAH'];
$jaspel = $data3['KLAIM'];
$ops = $data3['OPERASIONAL'];
$man = $data3['MANAJEMEN'];
$spesialis = $data3['MEDIS'];
$medis = $data3['MEDIS_UM'];
$paramedis =$data3['PARAMEDIS'];
$bersama =$data3['KEBERSAMAAN'];
?>
		<tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="center" >&nbsp;</td>
			<td align="LEFT" >JUMLAH</td>
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="right" ><? echo number_format($original,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($jaspel,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($ops,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($man,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($spesialis,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($medis,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($paramedis,2,',','.');  ?></td>
			<td align="right" ><? echo number_format($bersama,2,',','.');  ?></td>
			</tr>
			  </table>
               <!-- <blockquote><a href="kasir_rekap/export_detail_jasa_poli.php?poly=<?=$_GET['poly']?>&dokter=<?=$_GET['dokter']?>&carabayar=<?=$_GET['carabayar']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>">Export Excel</a>  </blockquote>-->
	  </div>
  </div>             
</div>
</div>
<div id="myModalx" class="modalx">

  <!-- Modal content -->
  <div class="modalx-content" style="border-radius:12px;box-shadow:1px 1px 10px 1px #7f8180;"> 
 <div> <span class="closex">&times;</span>
   <h2 >UPDATE JASA JM </h2>
 </div>  <form method="post" action="./jasa/update_jasa_jm.php" enctype="multipart/form-data"  >
					<table style="font-size:13px"  width="100%" cellpadding="0" cellspacing="0"  >
					
					<tr>
		<td> Bulan <br /><input type="hidden"  name="link" value="<?=$_GET['link']?>" /> 
					<select name="bulan"  style="height:30px;width:100%;font-size:14px;"  class="form-cari" >  
<option value="01" <? if($bulans=="01") echo "selected='selected'"; ?>>Januari</option> 
<option value="02" <? if($bulans=="02") echo "selected='selected'"; ?>>Februari</option> 
<option value="03" <? if($bulans=="03") echo "selected='selected'"; ?>>Maret</option> 
<option value="04" <? if($bulans=="04") echo "selected='selected'"; ?>>April</option> 
<option value="05" <? if($bulans=="05") echo "selected='selected'"; ?>>Mei</option> 
<option value="06" <? if($bulans=="06") echo "selected='selected'"; ?>>Juni</option> 
<option value="07" <? if($bulans=="07") echo "selected='selected'"; ?>>Juli</option> 
<option value="08" <? if($bulans=="08") echo "selected='selected'"; ?>>Agustus</option> 
<option value="09" <? if($bulans=="09") echo "selected='selected'"; ?>>September</option> 
<option value="10" <? if($bulans=="10") echo "selected='selected'"; ?>>Oktober</option> 
<option value="11" <? if($bulans=="11") echo "selected='selected'"; ?>>November</option> 
<option value="12" <? if($bulans=="12") echo "selected='selected'"; ?>>Desember</option> 
</select></td>
</tr>

<tr>
<td>Tahun <br />
<select name="tahun"  style="height:30px;width:100%;font-size:14px;"  class="form-cari" >  
<option value="<?=date('Y');?>" <? if($tahuns==date('Y')) echo "selected='selected'"; ?>><?=date('Y');?></option> 
<option value="<?=date('Y')-1;?>" <? if($tahuns==date('Y')-1) echo "selected='selected'"; ?>><?=date('Y')-1;?></option> 
<option value="<?=date('Y')-2;?>" <? if($tahuns==date('Y')-2) echo "selected='selected'"; ?>><?=date('Y')-2;?></option> 
</select></td>
</tr>
<tr>
  <td>Password
    <input type="password" name="pass"  style="height:30px;width:100%;font-size:14px;" required="required"  /></td>
</tr>
<tr>
<td>
<button class="btn2" type="submit" style="width:100%;height:30px"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button> </td>
					</tr>
					</table>
					</form> 


 </div>

</div>
<script>
//Get the button
var mybutton = document.getElementById("balik");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
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
