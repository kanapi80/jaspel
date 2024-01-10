<?php 
session_start();

include '../include/connect.php'; 
include '../include/function.php';
$idxdaftar=$_GET['idxdaftar']; 
?>
<?
$nama_dokumen=$_GET['nomor']; //Beri nama file PDF hasil.
define('_MPDF_PATH','mpdf60/');
include(_MPDF_PATH . "mpdf.php");
//$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
$mpdf = new mPDF('', '', 0, '', 15, 10, 5, 20, 8, 8);

ob_start(); 
?>
   <style>
   body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;  
	font-family:verdana;
	font-size:10px;
	
}
  .responsive {
    width: 70%;
    height: auto; 
}

   </style> 
    
 <div align="center"> 
<img  src="../img/kop.png"  class="responsive"  />
<br/> 
 <?
echo "<table height='1px' border='0px'  width='98%'>";
echo "<tr  bgcolor='#fff' >";
echo "<td style='border-top:1px solid #000;border-bottom:3px solid #000 '></td>";
echo "</tr>";
echo "</table>";  ?> 
 
</div > 
	<?php
		$q_pasienx	= "select * from registerranap
		 where IdRegisterKunjungan = '$_GET[id]' ";
  		$getx = mysql_query ($q_pasienx)or die(mysql_error());
		$userdata = mysql_fetch_assoc($getx); 		
?> 
 
	
<table width="98%" border="0"   cellpadding="3px" cellspacing="0" >
        <tr height="35px" valign="middle" style="padding-top:20px">
          <td colspan="4" align="center"><u><strong>RINCIAN BIAYA </strong></u></td>
        </tr>
        <tr style="padding-top:20px"><td>Nomor RM </td>
		<td>: <?php echo $userdata['NomorRekamMedis'];?></td>
		<td>Cara Bayar </td>
		<td>: 
		  <?=$userdata['NamaAsuransi'];?></td>
        </tr>
        <tr>
		<td width="20%">No.Register Kunjunga  </td>
		<td width="40%">: <?=$userdata['IdRegisterKunjungan'];?> </td>
		<td>Ruangan</td>
		<td>:
		  <?=$userdata['Ruangan'];?></td>
        
        <tr>
          <td valign="top">Nama </td>
          <td>: <?php echo $userdata['NamaPasien'];?></td>
          <td>Masuk RS </td>
          <td>:
            <?=$userdata['TanggalMasuk'];?></td>
        </tr>
        <tr>
          <td valign="top">Umur </td>
          <td> :
            <?php $a = datediff($userdata['TGLLAHIR'], date("Y-m-d")); echo $a[years]." Tahun "; ?></td>
          <td>Keluar RS </td>
          <td>:
            <?=$userdata['TanggalPulang'];?></td>
        </tr>
</table>
 <?
echo "<table height='1px' border='0px'  width='100%'>";
echo "<tr  bgcolor='#fff' >";
echo "<td style='border-top:1px solid #000;'></td>";
echo "</tr>";
echo "</table>";  ?> 
<br/> 
	 
	 

<? if($userdata['Ruangan']!="0"  ){ ?> 
 <?=$userdata['Ruangan'];?> 
 
 <table   width="98%"  bgcolor="#000000"   cellspacing="1px" cellpadding="3px">
 <tr  bgcolor="#e9ebee"  >
 <td  width="5%" align="center" >No</td>
 <td width="42%"  align="center" >Uraian</td>
 <td width="21%" align="left" >Dokter</td>
 <td width="12%" align="center"  >Tarif</td>
 <td width="6%" align="center" >Qty</td>
 <td width="14%"  align="center">Jumlah</td>
 </tr>
  <?php 
	$urut=0;  
		$id=$_GET['id'];  
$sql	= "SELECT NamaTindakan,NamaPelaksanaMedis,Kuantitas,TotalTarif
FROM transaksiranap
WHERE IdRegisterKunjungan='".$id."'  order by TanggalPelayanan ASC ";
$qry= mysql_query($sql)or die(mysql_error());
while($data = mysql_fetch_array($qry)){
    $urut++;
?>
 <tr bgcolor="#FFFFFF" >
 <td align="center" valign="top"><? echo $urut; ?></td>
 <td  ><?  echo $data['NamaTindakan']; ?></td>
 <td align="left" ><?=$data['NamaPelaksanaMedis']; ?></td>
 <td align="right" ><? echo number_format(($data['TotalTarif']/$data['Kuantitas']),2,',','.'); ?></td>
 <td align="CENTER" ><? echo number_format(($data['Kuantitas']),0,',','.'); ?></td>
 <td align="right"  ><?=number_format($data['TotalTarif'],2,',','.');?></td>
 </tr>
 <? } ?>
  <tr  bgcolor="#FFFFFF" >
 <td colspan="5" align="right" style="border-top:1px solid "  >Jumlah&nbsp;&nbsp;</td>
 <td align="right" style="border-top:1px solid;font-size:10px"  ><b><?=number_format(($userdata['Total']),2,',','.')?></b></td>
 </tr>
</table> 

 <? } ?>
 <table   width="100%"  cellspacing="1px" cellpadding="3px">
 <tr   >
   <td align="right">&nbsp;</td> 
 <td width="32%" align="center">Indramayu, <?=date('d-m-Y');?></td> 
 </tr> 
 <tr >
   <td valign="top" align="right">&nbsp;</td> 
 <td  height="80px" valign="top" align="center">Kasir RSUD Kab. Indramayu</td> 
 </tr>
 <tr  >
   <td align="right">&nbsp;</td> 
 <td align="center"><b><u><?=$_SESSION['NIP'];?></u></b></td> 
 </tr> 
</table> 
  <?php
$html = ob_get_contents(); 
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>