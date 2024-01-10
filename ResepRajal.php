<?php
session_start();
 include("../include/connect.php"); 
 include("../include/function.php");
 
$select=mysql_query("SELECT t_pendaftaran.NOMR,  
		m_pasien.NAMA,
		m_pasien.ALAMAT,
		m_pasien.JENISKELAMIN, 
m_pasien.TGLLAHIR,
m_carabayar.NAMA as CARABAYAR,
m_poly.NAMA as POLY,
m_dokter.NAMADOKTER, 
SUM(  IF (t_billrajal.STATUS ='SELESAI',t_billrajal.jumlah,0 ) ) AS jumlah_total, 
SUM(  IF (t_billrajal.QTY ='1.00',t_billrajal.TARIFRS,0 ) ) AS jumlah_plus, 
SUM(  IF (t_billrajal.QTY !='1',t_billrajal.jumlah,0 ) ) AS jumlah_min
FROM t_pendaftaran 
LEFT JOIN m_pasien ON(t_pendaftaran.NOMR=m_pasien.NOMR)
LEFT JOIN m_carabayar ON(t_pendaftaran.KDCARABAYAR=m_carabayar.KODE)
LEFT JOIN m_poly ON(t_pendaftaran.KDPOLY=m_poly.kode) 
LEFT JOIN m_dokter ON(t_pendaftaran.KDDOKTER=m_dokter.KDDOKTER) 
LEFT JOIN t_billrajal ON(t_pendaftaran.IDXDAFTAR=t_billrajal.IDXDAFTAR) and ( t_billrajal.KODETARIF='07') and ( t_billrajal.STATUS='SELESAI')
WHERE t_pendaftaran.IDXDAFTAR='".$_GET['idx']."' ");
		$data=mysql_fetch_array($select);
			?>
	 <table cellspacing='0' cellpadding='3' width="100%"  style=" font-family:Arial;font-size:14px;">
		<tr> <th align='center' colspan='4'>NOTA PEMBAYARAN<br/>RAWAT JALAN</th></tr>
          <tr>
              <td width="15%">Medrec </td>
              <td width="50%">: <?=$data['NOMR']?></td>
			  <td width="15%">Cara Bayar</td>
              <td width="20%">: <?=$data['CARABAYAR']?></td>
          </tr>
          <tr>
              <td>Nama </td>
              <td>: <?=$data['NAMA']?></td>
			  <td>Poliklinik</td>
              <td>: <?=$data['POLY']?></td>
          </tr>
          <tr>
              <td>Alamat</td>
              <td>: <?=$data['ALAMAT']?></td>
			  <td>Dokter</td>
              <td>: <?=$data['NAMADOKTER']?></td>
          </tr>
		  <tr>
              <td>Kelamin</td>
              <td>: <?=$data['JENISKELAMIN']?></td>
			  <td>&nbsp;</td>
              <td>&nbsp;</td>
          </tr>
		  <tr>
              <td>Umur</td>
              <td>:  <?php $a = datediff($data['TGLLAHIR'], date("Y-m-d"));
                          echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
				<td>&nbsp;</td>
              <td>&nbsp;</td>
          </tr>
</table>
		
		<p>
		
		<?
		$query="select t_billrajal.NOBILL,t_billrajal.QTY, 
			m_poly.nama as poly,
			m_unit.nama_unit as unit,
			t_billrajal.TARIFRS, 
m_dokter.NAMADOKTER 
		from t_billrajal   
			left join m_unit ON(t_billrajal.UNIT=m_unit.kode_unit) 
LEFT JOIN m_dokter ON(t_billrajal.KDDOKTER=m_dokter.KDDOKTER) 
LEFT JOIN m_poly ON(t_billrajal.KDPOLY=m_poly.kode)  
			where t_billrajal.IDXDAFTAR='".$_GET['idx']."' and t_billrajal.STATUS!='BATAL' and t_billrajal.KODETARIF='07' order by t_billrajal.IDXBILL asc ";
//$query="select * from perawat where ket='Aktif' order by nama ASC";
$jalankan = mysql_query($query) or die('Error');
	while ($dataorder2=mysql_fetch_array($jalankan)){ 

		 
			?>
<table width="100%" border="0" cellpadding="3" cellspacing="0" style=" font-family:Arial;font-size:14px;">
		
	   <tr>
	   <td colspan=3 align="left"><b> <?=$dataorder2['poly']?> - <?=$dataorder2['NAMADOKTER']?><? if($dataorder2['QTY']<"0"){ echo " (RETUR)"; }?></b></td>
		  <td colspan=3 align="right"><b> <?=$dataorder2['unit']?></b></td>
  </tr>
		 <tr>
          <td width="5%" align="center" style="border-top:1px solid #000; border-bottom:1px solid #000;">NO</td>
          <td width="15%" align="center" style="border-top:1px solid #000; border-bottom:1px solid #000;">Tanggal</td>
          <td width="45%" style="border-top:1px solid #000; border-bottom:1px solid #000;">Obat/Alkes Habis Pakai</td>
		  <td width="5%" align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;">QTY</td>
          <td width="15%" align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;">Harga</td>
          <td width="15%" align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;">Jumlah</td>
  </tr>
		 
			<?
			$no=0;
			if($dataorder2['QTY']>"0"){
$sqlobat = "SELECT a.tanggal,a.qty,a.harga,a.jumlah,
CASE WHEN a.kode_obat like '%.%' THEN (SELECT nama_tindakan FROM m_tarif2012 WHERE kode_tindakan=a.kode_obat) ELSE (SELECT nama_barang FROM m_barang WHERE kode_barang =a.kode_obat) END AS nama_barang 
FROM t_billobat_rajal a 
where a.nobill='".$dataorder2['NOBILL']."' and a.idxdaftar='".$_GET['idx']."'  ";	
}else{
$sqlobat = "SELECT DATE_FORMAT(a.TANGGAL,'%Y-%m-%d') AS tanggal,a.QTY as qty,a.HARGA as harga,a.JUMLAH as jumlah,
CASE WHEN a.KODE_OBAT like '%.%' THEN (SELECT nama_tindakan FROM m_tarif2012 WHERE kode_tindakan=a.KODE_OBAT) ELSE (SELECT nama_barang FROM m_barang WHERE kode_barang =a.KODE_OBAT) END AS nama_barang 
FROM t_retur a 
where a.NEWBILL='".$dataorder2['NOBILL']."' and a.IDXDAFTAR='".$_GET['idx']."'  ";
}		
			
				 
			$rowobat = mysql_query($sqlobat)or die(mysql_error()); 
			while ( $dataobat = mysql_fetch_array($rowobat)){
			$no++;
			?>
		
					<tr>
				  <td align='center'><? #echo $dc=$dc+1;?><?=$no?></td>
				  <td align="center"><?=$dataobat['tanggal']?></td>
				  <td><? if(!empty($dataobat['nama_barang'])){ echo $dataobat['nama_barang']; }else{ echo "Racikan"; } ?></td>
				  <td align='right'><?=number_format($dataobat['qty'],2,',','.')?></td>
				  <td align='right'><?=number_format($dataobat['harga'],2,',','.')?></td>
				  <td align='right'><?=number_format($dataobat['jumlah'],2,',','.')?></td>
				  </tr>
			<? } ?>
			
				<tr>
				<td colspan="3"  >&nbsp;			</td>
				<td colspan="2"  style="border-top:1px solid #000;" align="left">Jumlah SubTotal	</td>
				<td align="right" style="border-top:1px solid #000;"><b><? echo number_format($dataorder2['TARIFRS'],2,',','.');?></b></td>
				</tr>
				<tr><td colspan="7">&nbsp;  </td></tr>
</table>
			<? } ?> 
			<div align="right">
			<table width="50%" border="0" cellpadding="3"  cellspacing="0"  style=" font-family:Arial;font-size:14px;">
			<tr>
				<td colspan="6" style="border-top:1px solid #000;" >&nbsp;</td>
				<td align="right" style="border-top:1px solid #000;">Qty /R</td>
				<td align="right" style="border-top:1px solid #000;">Jumlah</td>
			  </tr>
			<tr>
				<td colspan="6" align="left" style="border-top:1px solid #000;">Jumlah SubTotal</td>
				<td style="border-top:1px solid #000;">&nbsp;</td>
						<?	  
$selectxx=mysql_query("SELECT SUM(jumlah) as jumlah_rrp,SUM(qty) as jumlah_rr
FROM t_billobat_rajal 
WHERE kode_obat='07.02.01' and idxdaftar='".$_GET['idx']."'  and status='keluar' ");
		$datarr=mysql_fetch_array($selectxx);
		?>
				<td align="right" style="border-top:1px solid #000;"><?=number_format((($data['jumlah_plus'])-($datarr['jumlah_rrp'])),2,',','.')?></td>
			  </tr>
			<tr>
			  <td colspan="6" align="left">Jumlah SubJasa</td>
			  <td align="right"><?=number_format($datarr['jumlah_rr'],2,',','.');?></td>
			  <td align="right"><?=number_format(($datarr['jumlah_rrp']),2,',','.');?></td>
			  </tr>
			<tr>
			<?	  
$selectxxr=mysql_query("SELECT SUM(QTY) as jumlahr_rrp 
FROM t_retur 
WHERE KODE_OBAT='07.02.01' and IDXDAFTAR='".$_GET['idx']."' and RIRJ='1' ");
		$rdatarr=mysql_fetch_array($selectxxr);
		?>
				<td colspan="6" width="45%" align="left">Jumlah Retur</td>
				<td align="right" width="20%">-<?=number_format($rdatarr['jumlahr_rrp'],2,',','.');?></td>
				<td align="right" width="35%" ><b><?=number_format($data['jumlah_min'],2,',','.');?></b></td>
			  </tr>
			<tr>
				<td colspan="6" align="left" style="border-top:1px solid #000;">Jumlah Total</td>
				<td align="right" style="border-top:1px solid #000;"><?=number_format(($datarr['jumlah_rr']-$rdatarr['jumlahr_rrp']),2,',','.');?></td>
				<td align="right" style="border-top:1px solid #000;"><b><?=number_format($data['jumlah_total'],2,',','.');?></b></td>
			  </tr>
			</table>
			</div>
			</p> 

<br/><br/> 