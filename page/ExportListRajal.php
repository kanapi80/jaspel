<style> 
.nol{ mso-number-format:\@; } #myTable1 {  border-collapse: collapse;
}
</style>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=ListKlaimRajal".date('dmY').".xls");
?>
<?php
include("../include/connect.php"); 
include("../include/function.php");

$crb=$_GET['crb'];
$per=$_GET['per'];

?>


   <?php
			$no =  0;
				 $sql = "SELECT a.NOMR,a.TGLREG,a.IDXDAFTAR,a.JM, b.NAMA ,b.ALAMAT,e.nama as NAMAPOLY, f.NAMA as CARABAYAR, c.NAMADOKTER
FROM t_pendaftaran a
left join m_pasien b on a.NOMR=b.NOMR   
left join m_poly e on a.KDPOLY=e.kode  
left join m_carabayar f on f.KODE=a.KDCARABAYAR  
left join m_dokter c ON  c.KDDOKTER =a.KDDOKTER
where a.KDCARABAYAR ='$crb' and a.JM='$per'  ORDER BY a.TGLREG ASC ";
				$qry	= mysql_query($sql);
			?>
			<div align="center" >
				<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>" >
				  <B>
				  <center>
			    <div id="frame_title">
LIST KLAIM RAWAT INAP <BR />
        PERIODE <?=$_GET['per'];?> RSUD KABUPATEN INDRAMAYU
			    </div>
                <table width="98%"  class="tb" cellspacing="1" cellspading="0" border="1px">
            <tr>
		  <th width="34" align="center">NO</th>
			<th width="78" align="center">TANGGAL</th>
			<th width="77" align="center">NO.REG</th>
		    <th width="77" align="center">NOMR</th>
		    <th width="270" align="left">NAMA </th>
		    <th width="276" align="left">ALAMAT</th>
		    <th width="70" align="left">POLIKLINIK</th>
		    <th width="140" align="center">DOKTER</th>
		    <th width="77" align="center">CARA<br />BAYAR </th>
		    <th width="70" align="center">PERIODE</th>
			  <th width="100" align="center">REAL COST</th>
		    </tr>
                  <?php
					while($data = mysql_fetch_array($qry)){
						$no++;
			
					
					?>
               <tr title="<?= $data['NAMA'] ?> (<?= $data['NAMAPOLY'] ?>)" >
				<td align="center"><? 
										echo $no;
									?></td>
				<td align="center"><?= $data['TGLREG'] ?></td>
				<td align="center"><? echo $data['IDXDAFTAR']; ?></td>
				<td align="center"  class="nol"><? echo $data['NOMR']; ?></td>
				<td><?php echo $data['NAMA']; ?></td>
				<td><?php echo $data['ALAMAT']; ?></td>
				<td><?= $data['NAMAPOLY'] ?></td>

				<td align="left"><?= $data['NAMADOKTER'] ?></td>
				<td align="center"><?= $data['CARABAYAR'] ?> </td>
				<td align="center"><?= $data['JM'] ?></td>
				<td align="right"> <?php 
				$idx=$data['IDXDAFATAR'];
$sql2= "select  sum(jumlah) as total from t_billrajal
		where IDXDAFTAR =".$data['IDXDAFTAR']." group by IDXDAFTAR";
$qry2	= mysql_query($sql2);
$data2 = mysql_fetch_array($qry2);
?><?= $data2['total'] ?></td>
				</tr>
                  <?	} ?>
                  <?php /*
$sql2= "select    a.PERIODE, SUM(a.J_PEL) AS JUMLAH,SUM(a.J_KLAIM) AS KLAIM,
SUM(a.J_RSUD) AS J_RSUD, SUM(a.J_PELAYANAN) AS J_PELAYANAN,
SUM(a.J_RS_OPERASIONAL) AS OPERASIONAL,SUM(a.J_RS_MANAJEMEN) AS MANAJEMEN,
SUM(a.J_MEDIS) AS MEDIS,SUM(a.J_MEDIS_UMUM) AS MEDIS_UM
,SUM(a.J_PARAMEDIS) AS PARAMEDIS,SUM(a.J_KEBERSAMAAN) AS KEBERSAMAAN,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan
		 from t_billjkn a
		 left join m_pasien b ON b.NOMR = a.NOMR 
		 left join m_poly c ON c.kode =a.UNIT
		 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
		 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
		".$search." and a.RIRJ ='1' and c.jenispoly='0' and a.KODETARIF!='07' and a.STATUS='SELESAI' and a.R_JASA !='0.00'";
$qry2	= mysql_query($sql2);
$data2 = mysql_fetch_array($qry2);*/

?>
                </table>
			