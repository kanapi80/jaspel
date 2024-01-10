<style>
.btn {
  background-color: #666666;
  border: none;
  color: white;
  padding: 6px 8px;
  font-size: 12px;
  cursor: pointer;
  width:80px;
}
/* Darker background on mouse-over */
.btn:hover {
  background-color:#fc7d00;
   color: white;
   
}
#myTable1 {
  border-collapse: collapse;
  }
  #myTable1 tr th {
  	background: #345534;
    color: #fff;
    font-weight: bold;
	
}
#myTable1 th{
   border: 1px solid #e3e2e2;
}
#myTable1 td {
   border: 0px solid #e3e2e2;
}
#myTable1 tr:hover{
background-color: #d1d3d1;
}
</style>
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

//$search = ' WHERE a.TANGGAL like "'.$periode.'%" ';  
 
 
$poly = "";
if(!empty($_GET['poly'])) {
    $poly =$_GET['poly'];
} 

if($poly !="") {
    $search = $search." AND a.UNIT ='".$poly."' ";
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
if(!empty($_GET['urut'])){
	$urut =$_GET['urut']; 
} else{
$urut = "a.TANGGAL";
}
?>

<blockquote>&nbsp;</blockquote>
<div align="center">
	<div id="frame" style="width:100%;">
		<div id="frame_title" style="background-color:#184118">
			<h3>LAPORAN DETAIL FULL JASA JM RAWAT JALAN</h3>
		</div>
			<div align="center" >
				<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>" >
				<table width="98%" border="0" cellspacing="0" class="tb">
				<tr>
				  <td width="7%">
				Poliklinik <br /> <select style="height:22px;font-size:12px"  name="poly" id="poly" class="text" >
        <option value="0">-</option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly where jenispoly ='0' ORDER by nama ASC ")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 	?>
                <option value="<? echo $listpoly['kode'];?>" <?php if($listpoly['kode'] == $_REQUEST['poly']): echo 'selected="selected"'; endif; ?> ><? echo $listpoly['nama'];?></option>
			 	<? 
			 	} 
			 ?>
        </select></td>
				  <td width="8%">Dokter<br /> 
                    <select style="height:22px;font-size:12px"  name="dokter" id="dokter" class="text" >
                      <option value="0">-</option>
                      <? 
			 	$datadokter = mysql_query("SELECT * FROM m_dokter where KDPROFESI IN(0,1,3) AND st_aktif ='0' AND NAMADOKTER!='Residen, dr' AND KDDOKTER!='99' order by NAMADOKTER ASC ")or die (mysql_error());
				while ($listdokter = mysql_fetch_array($datadokter)){
			 	?>
                      <option value="<? echo $listdokter['KDDOKTER'];?>" <?php if($listdokter['KDDOKTER'] == $_REQUEST['dokter']): echo 'selected="selected"'; endif; ?> ><? echo $listdokter['NAMADOKTER'];?></option>
                      <? 
			 	} 
			 ?>
                    </select></td>
				  <td width="9%">No.Reg
				    <input type="text" style="width:150px;height:18px" name="no_sep"  value="<? if($no_sep!=""){
			  echo $no_sep;}?>" class="text" /></td>
				  <td width="9%">&nbsp;No.Medrek<br />
                    <input type="text" style="width:100%;height:18px" name="nomr"  value="<? if($nomr!=""){
			  echo $nomr;}?>" class="text" /></td>
				  <td width="16%" valign="bottom">Periode
                    <select style="height:22px;font-size:12px;width:100%"  name="periode" id="periode" class="text" >
                      <option value="0">-</option>
                      <? 
			 	$datadokter = mysql_query("SELECT * FROM jm_klaim where status!='N' order by id ASC ")or die (mysql_error());
				while ($listdokter = mysql_fetch_array($datadokter)){
			 	?>
                      <option value="<? echo $listdokter['periode'];?>" <?php if($listdokter['periode'] == $_REQUEST['periode']): echo 'selected="selected"'; endif; ?> ><? echo $listdokter['periode'];?></option>
                      <? 
			 	} 
			 ?>
                    </select></td>
				  <td width="16%" valign="bottom">Urut<br/>
                    <select style="height:23px;WIDTH:100%" name="urut"  class="text" >
                      <option value="a.TANGGAL" <? if($urut=="a.TANGGAL") echo "selected='selected'"; ?>>TANGGAL</option>
                      <option value="e.nama_tindakan" <? if($urut=="e.nama_tindakan") echo "selected='selected'"; ?>>TINDAKAN</option>
                      <option value="a.NONOTA" <? if($urut=="a.NONOTA") echo "selected='selected'"; ?>>NOTA</option>
                    </select></td>
				  <td width="16%" valign="bottom"><input type="hidden" name="link" value="<?=$_GET['link'];?>" />
				    
		          <button  type="submit" class="btn">&nbsp;<i class="fa fa-search"></i>&nbsp;&nbsp;C a r i&nbsp;</button></td>
				  <td width="38%">&nbsp;</td>
				</tr>
				</table>
				</form>
			</div>
			<br/>
            <?php
			$no =  0;
				 $sql = "select a.*, DATE_FORMAT(a.TANGGAL,'%d-%m-%Y') PERIODES,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan,f.JM
				 from t_billrajal a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_poly c ON c.kode =a.KDPOLY 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				 left join t_pendaftaran f ON f.IDXDAFTAR =a.IDXDAFTAR
				 ".$search." and a.CARABAYAR ='8' and a.KODETARIF!='07' and a.UNIT!='15' and a.UNIT!='16' and a.UNIT!='17' and a.UNIT!='20' and a.STATUS='SELESAI' AND e.kode_unit !='20' ORDER BY $urut ";
				$qry	= mysql_query($sql);
			?>
			<div id="table_search" >
				<table width="98%"  class="tb" cellspacing="1" cellspading="0" id="myTable1">
					<tr  align="center"  >
					  <th   rowspan="2">NO</th>
					  <th  rowspan="2">NO.REG</th>
					  <th  rowspan="2">TANGGAL </th>
					  <th  rowspan="2">NORM </th>
					  <th  rowspan="2">NAMA PASIEN</th>
					  <th  rowspan="2">RUANGAN</th>
					  <th rowspan="2">TINDAKAN</th>
					  <th rowspan="2">NAMA DOKTER  </th>
					  <th  rowspan="2">ORIGINAL </th>
					  <th colspan="2">UNSUR JASA </th>
					  <th colspan="2">JASA PELAYANAN </th>
					  <th colspan="2">JASA RSUD </th>
					  <th colspan="4">JASA PELAKSANA </th>
				  </tr>
					<tr  align="center">
					<th > SARANA </th>
					<th >JASA PELAYANAN  </th>
					<th  >JASA RSUD </th>
					<th  >JASA PELAKSANA </th>
					<th  >Opera<br>sional</th>
					<th  >Mana<br>jemen</th>
					<th  >Medis Sp </th>
					<th  >Medis<br> Umum </th>
					<th  >Para<br>medis</th>
					<th  >Keber<br>samaan</th>
					</tr>
                    <?php
					while($data = mysql_fetch_array($qry)){
						$no++;
					?>
						<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr4"; }
                else {
                echo "tr2";
                }
        ?>>
		<td align="center"><? echo $no; ?></td>
		<td  ><? echo $data['IDXDAFTAR'] ?></td>
		<td  ><? echo $data['PERIODES']; ?></td>
		<td align="left"><? echo $data['NOMR'] ?></td>
		<td align="left"><? echo $data['NAMA']; ?></td>
		<td align="left"><? echo $data['NAMAPOLY']; ?></td>
		<td align="left"><?=$data['nama_tindakan'];?></td>
		<td align="left"><? echo $data['NAMADOKTER']; ?></td>
		<td align="right" ><?=number_format($data['jumlah'],2,',','.');?></td>
		<td align="right"><?=number_format($data['JASA_SARANA'],2,',','.');?></td>
		<td align="right"><?=number_format($data['JASA_PELAYANAN'],2,',','.');?></td>
		<td align="right"><?=number_format($data['jasa_rs'],2,',','.');?></td>
		<td align="right"><?=number_format($data['jasa_pelaksana'],2,',','.');?></td>
		<td align="right"><?=number_format($data['operasional'],2,',','.');?></td>
		<td align="right"><?=number_format($data['manajemen'],2,',','.');?></td>
		<td align="right"><?=number_format($data['MEDIS'],2,',','.');?></td>
		<td align="right"><?=number_format($data['MEDIS_UMUM'],2,',','.');?></td>
		<td align="right"><?=number_format($data['PARAMEDIS'],2,',','.');?></td>
		<td align="right"><?=number_format($data['COSTSHARING'],2,',','.');?></td>
	</tr> <?	} ?>
<?php
$sql2= "select a.TANGGAL, SUM(a.jumlah) AS J_PELS,
SUM(a.JASA_SARANA) AS J_SARANA,
SUM(a.JASA_PELAYANAN) AS J_PELAYANAN,
SUM(a.jasa_rs) AS J_RS,
SUM(a.jasa_pelaksana) AS J_PELAKSANA,
SUM(a.operasional) AS J_OPERASIONAL,
SUM(a.manajemen) AS J_MANAJEMEN,
SUM(a.MEDIS) AS J_MEDIS,
SUM(a.MEDIS_UMUM) AS J_MEDIS_UMUM,
SUM(a.PARAMEDIS) AS J_PARAMEDIS,
SUM(a.COSTSHARING) AS J_BERSAMA,f.JM
from t_billrajal a
left join m_pasien b ON b.NOMR = a.NOMR 
left join m_poly c ON c.kode =a.KDPOLY 
left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
 left join t_pendaftaran f ON f.IDXDAFTAR =a.IDXDAFTAR
 ".$search." and a.CARABAYAR ='8' and a.KODETARIF!='07' and a.UNIT!='15' and a.UNIT!='16' and a.UNIT!='17' and a.UNIT!='20' and a.STATUS='SELESAI' AND e.kode_unit !='20' ";
$qry2	= mysql_query($sql2);
$data2 = mysql_fetch_array($qry2);

?>
			
			<tr style="font-weight:bold;color:#FFFFFF" bgcolor="#345534"  >
			<td align="center" ></td>
			<td align="center" >&nbsp;</td>
			<td align="center" >&nbsp;</td>
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="center" ></td>
			<td align="center" >&nbsp;</td>
			<td align="center" >JUMLAH</td>
			<td align="right" ><?=number_format($data2['J_PELS'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_SARANA'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_PELAYANAN'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_RS'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_PELAKSANA'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_OPERASIONAL'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_MANAJEMEN'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_MEDIS'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_MEDIS_UMUM'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_PARAMEDIS'],2,',','.');?></td>
			<td align="right" ><?=number_format($data2['J_BERSAMA'],2,',','.');?></td>
			</tr>
			  </table>
               <!-- <blockquote><a href="kasir_rekap/export_detail_jasa_poli.php?poly=<?=$_GET['poly']?>&dokter=<?=$_GET['dokter']?>&carabayar=<?=$_GET['carabayar']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>">Export Excel</a>  </blockquote>-->
	  </div>
  </div>             
</div>
</div>