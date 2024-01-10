<?

session_start();
include '../include/connect.php';
include '../include/function.php';
$nobill=$_GET['nobill']; 
$idxdaftar=$_GET['IDXDAFTAR'];
$sekarang=date('Y-m-d');

?>
<?php
$nama_dokumen='KUITANSI'; //Beri nama file PDF hasil.
define('_MPDF_PATH','MPDF60/');
include(_MPDF_PATH . "../mpdf60/mpdf.php");
//$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
$mpdf = new mPDF('', '', 0, '', 15, 15, 3, 15, 8, 8); // original
//$mpdf = new mPDF('', '', 0, '', 15, 15, 3, 0, 8, 8);

ob_start(); 
?>
 
 
  <style>
#myTable1 {
  border-collapse: collapse;
  }
  #myTable1 tr {
   border: 1px solid #000000;
}
#myTable1 th{
   border: 1px solid #000000;
}
#myTable1 td {
   border: 0px solid #000000;
}

   body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;  
	font-family:Calibri;
	
} 

   </style> 
<table width="100%">
<tr>
<td style="font-size:12px" valign="top" width="50%">
<?php


		$q_pasien	= "select t_billrajal.NOMR as MEDREK,t_billrajal.KODETARIF,t_billrajal.cetak,t_billrajal.NONOTA,  t_billrajal.JASA_PELAYANAN,t_billrajal.UNIT,sum(t_billrajal.JASA_PELAYANAN) as jum, m_pasien.TITLE,
		m_pasien.NAMA,
		m_pasien.TGLLAHIR,
		m_pasien.JENISKELAMIN,
		m_pasien.ALAMAT,
		m_unit.nama_unit,
		m_poly.nama as namapoli,
		m_dokter.NAMADOKTER		
		 from t_billrajal
		 LEFT JOIN m_pasien ON (m_pasien.NOMR=t_billrajal.NOMR)
		 LEFT JOIN m_unit ON (m_unit.kode_unit=t_billrajal.UNIT)
		 LEFT JOIN m_poly ON (m_poly.kode=t_billrajal.KDPOLY)
		 LEFT JOIN m_dokter ON (m_dokter.KDDOKTER=t_billrajal.KDDOKTER)
 	  where t_billrajal.IDXDAFTAR='$idxdaftar' AND t_billrajal.NOBILL='$nobill'  GROUP BY t_billrajal.NOBILL ";
  		$get = mysql_query ($q_pasien)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 
		
				
?>

<b style="font-size:16px"><u>RIncian Obat </u></b> 
<br/> 
<b style="font-size:16px"><?=$userdata['nama_unit']?></b> 
<br/>
<b style="font-size:20px">NOBILL :
<?=$_GET['nobill']?></b>
<br/>

</td>
<td width="50%" align="right"> <img  src="../img/kop.png" style="width:100%"   /></td>
</tr>
</table> 
<div  >

 
  </div>
<div align="center">   
 <?
echo "<table height='1px' border='0px'  width='100%'>";
echo "<tr  bgcolor='#fff' >";
echo "<td style='border-top:1px solid #000;border-bottom:2px solid #000 '></td>";
echo "</tr>";
echo "</table>";  ?> 
<div >

<table width="98%" border="0" style="font-size:12px" cellpadding="2px" cellspacing="0" >
        <tr><td style="padding-top:10px">No MR</td>
		<td style="padding-top:10px">: <?=$userdata['MEDREK']?> </td>
		<td style="padding-top:10px">Poliklinik</td>
		<td style="padding-top:10px">: <?=$userdata['namapoli']?></td>
        </tr>
        <tr>
		<td width="14%">Nama Lengkap</td>
		<td width="42%">: <?php	if(!empty($userdata['TITLE'])){ echo $userdata['TITLE']; echo " "; } echo $userdata['NAMA'];?> /  
		  <? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?>
          <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
		<td width="14%">Dokter</td>
		<td width="30%">: <?=$userdata['NAMADOKTER']?></td>
        </tr>
        <tr>
          <td valign="top">Alamat</td>
		  <td>: <?php echo $userdata['ALAMAT'];?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
        </tr>
        
        <tr><td style="padding-bottom:10px" valign="top">Tgl.Lahir (Umur)</td>
		<td style="padding-bottom:10px" valign="top">: <?php echo $userdata['TGLLAHIR'];?>  (<?php $a = datediff($userdata['TGLLAHIR'], date("Y-m-d")); echo $a[years]." tahun"; ?>)</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr> 
</table>
</div>  
<div  > 
 <table width="98%"  cellpadding="3px" cellspacing="0" bordercolor="#000000" style="font-size:12px" id="myTable1">
 <tr bgcolor="#FFFFFF" align="center">
 <td align ="center" width="5%"><div align="center"><strong>No</strong>.</div></td>
 <td  width="50%" style="border-right:1px;solid:black;"><div align="center"><strong>Rincian</strong></div></td>
 <td width="25%"><div align="center"><strong>Pelaksana</strong></div></td>
 <? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){?> <td align ="center"  width="12%"><div align="center"><strong>Jasa Pelayanan </strong></div></td><? } ?>
 <td align ="center"  width="12%"><div align="center"><strong>Tarif</strong></div></td>
 <td align ="center" width="8%"><div align="center"><strong>Qty</strong></div></td>
 <td align ="center" width="15%"><div align="center"><strong>Jumlah</strong></div></td>
 </tr>
  <?php
	$urut=0;
	if($userdata['KODETARIF']=="07"){
$sql3	= "SELECT t_billobat_rajal.kode_obat,
t_billobat_rajal.QTY,
t_billobat_rajal.harga as TARIFRS,  
m_barang.nama_barang as nama_tindakan2,
m_tarif2012.nama_tindakan,m_dokter.NAMADOKTER  
FROM t_billobat_rajal
LEFT JOIN m_barang ON (m_barang.kode_barang=t_billobat_rajal.kode_obat)
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billobat_rajal.kode_obat)
LEFT JOIN m_dokter ON (m_dokter.KDDOKTER=t_billobat_rajal.dokter)

WHERE   t_billobat_rajal.NOBILL='$nobill' order by t_billobat_rajal.id ASC ";
}else{
$sql3	= "SELECT t_billrajal.QTY, 
t_billrajal.TARIFRS,m_dokter.NAMADOKTER,  t_billrajal.JASA_PELAYANAN,t_billrajal.UNIT,
m_tarif2012.nama_tindakan 
FROM t_billrajal
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billrajal.KODETARIF)
LEFT JOIN m_dokter ON (m_dokter.KDDOKTER=t_billrajal.KDDOKTER)
WHERE t_billrajal.IDXDAFTAR='$idxdaftar' AND t_billrajal.NOBILL='$nobill' order by t_billrajal.IDXBILL ASC ";
}


$qry3= mysql_query($sql3)or die(mysql_error());
while($data3 = mysql_fetch_array($qry3)){

$kodes=substr($data3['kode_obat'],0,1);
    $urut++;
?>
 <tr bgcolor="#FFFFFF" >
 <td align="center" valign="top"><? echo $urut; ?>.</td>
 <td valign="top"  ><?=$data3['nama_tindakan']?><? if($kodes=="R"){ echo "Racikan"; } else { echo $data3['nama_tindakan2']; } ?></td>
 <td align="left" valign="top"><?=$data3['NAMADOKTER']?></td><? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){?><td align="right" valign="top"><? if($data3['UNIT']=="16" OR $userdata['UNIT']=="17"){ echo number_format(($data3['JASA_PELAYANAN']),2); } else { echo ""; } ?></td> <? } ?>
  <td align="right" valign="top"><? echo number_format(($data3['TARIFRS']),2); ?></td>
 <td align="center" valign="top"><? echo $data3['QTY']; ?></td>
 <td align="right" valign="top"><? echo number_format(($data3['QTY']*$data3['TARIFRS']),2,',','.'); ?></td>
 </tr>
 <? } ?>
  <tr style="font-weight:bold" bgcolor="#FFFFFF" >
 <td align="right" style="border-right:0px;solid:#fbfbfd;border-bottom:0px;solid:#fbfbfd ">&nbsp;</td>
 <td align="right">&nbsp;</td><? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){?><td align="left"><b>Total</b></td> 
 <? } ?>
 <td align="right"><? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){ echo number_format(($userdata['jum']),2); } else { echo ""; } ?></td>
 <td align="right">&nbsp;</td>
 <td align="right">&nbsp;</td>
 <td align="right"><!--<? echo number_format(($userdata['TOTTARIFRS']),2,',','.'); ?>--><? echo number_format(($userdata['TOTTARIFRS']+$userdata['TOTCOSTSHARING']),2,',','.'); ?></td>
 </tr>
  <tr style="font-weight:bold" bgcolor="#FFFFFF" >
<? if($userdata['TOTCOSTSHARING']>0){ ?>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td><? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){?>   <td align="right">&nbsp;</td><? } ?>
    <td align="right">&nbsp;</td>
    <td align="right">Diskon</td>
    <td align="right"><? echo number_format(($userdata['TOTCOSTSHARING']),2,',','.'); ?></td>
  </tr>
  <tr style="font-weight:bold" bgcolor="#FFFFFF" >
    <td align="right">&nbsp;</td> 
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td><? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){?> <td align="right">&nbsp;</td> <? } ?>
    <td align="right">&nbsp;</td>
    <td align="right">Sisa Bayar </td>
    <td align="right"><?php $sisa=($userdata['TOTTARIFRS']); echo number_format(($sisa),2,',','.'); ?></td> <? } ?>
  </tr>
<? if($userdata['KODETARIF']=="07"){ ?>
  <tr style="font-weight:bold" bgcolor="#FFFFFF" >  </tr>
  <tr style="font-weight:bold" bgcolor="#FFFFFF" >
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td><? if($userdata['UNIT']=="16" OR $userdata['UNIT']=="17"){?> <td align="right">&nbsp;</td><? } ?>
    <td align="right">&nbsp;</td>
    <td align="right">Pembulatan&nbsp;</td>
    <td align="right"><? 

#$hrg_asli=(int)$userdata['TOTTARIFRS'];
$hrg_asli=$userdata['TOTTARIFRS'];
$pecahan=substr($hrg_asli,-5);
if($pecahan>0 && $pecahan<100){
$tambah=100-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
}
else if($pecahan>100 && $pecahan<200){
$tambah=200-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>200 && $pecahan<300){
$tambah=300-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>300 && $pecahan<400){
$tambah=400-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>400 && $pecahan<500){
$tambah=500-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>500 && $pecahan<600){
$tambah=600-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>600 && $pecahan<700){
$tambah=700-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>700 && $pecahan<800){
$tambah=800-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>800 && $pecahan<900){
$tambah=900-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else if($pecahan>900 && $pecahan<1000){
$tambah=1000-$pecahan;
$hrg_jual=$hrg_asli+$tambah;
} 
else{
$hrg_jual=$hrg_asli;
} 
echo number_format($hrg_jual,2,',','.');
?></td>
  </tr>
  
  <? } ?>
 </table>
 
 <br/>
 <table style="font-size:12px"  width="100%" border="0">
 <tr>
  <td style="padding-left:10px" valign="bottom" width="65%"><?
//if($userdata['cetak']=="2"){
// echo "Cetakan Ke-2";
 //}
?></td>
 <td align="center">Indramayu, <?=$userdata['TGL']?>
 <br/>Kasir
 <br/> <br/> <br/>
 <br/>
 <u><?=$userdata['kasir']?></u></td>
 </tr>
 </table>
</div>
  <?php
$html = ob_get_contents(); 
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>
