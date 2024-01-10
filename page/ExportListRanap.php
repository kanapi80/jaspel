<style> 
.nol{ mso-number-format:\@; } #myTable1 {  border-collapse: collapse;
}
</style>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=ListKlaimRanap".date('dmY').".xls");
?>
<?php
include("../include/connect.php"); 
include("../include/function.php");

$asal = $_GET['asal'];
if ($asal != "1") {

	$search = $search . " and  a.keluarrs  is not null   ";
} else {
	$search = $search . " and DATE(a.keluarrs) is NULL ";
}

$no_sep = "";
if (!empty($_GET['no_sep'])) {
	$no_sep = $_GET['no_sep'];
}
if ($no_sep != "") {
	$search = $search . " AND a.id_admission LIKE '%" . $no_sep . "%' ";
}

if ($status != "") {
	$search = $search . " and a.JKN='" . $status . "' ";
}

$norm = "";
if (!empty($_GET['norm'])) {
	$norm = $_GET['norm'];
}

if ($norm != "") {
	$search = $search . " and b.nomr LIKE '%" . $norm . "%' ";
}

$per = "";
if (!empty($_GET['per'])) {
	$per = $_GET['per'];
}

if ($per != "") {
	$search = $search . " and a.JM='" . $per . "' ";
}

$ruangan = "";
if (!empty($_GET['ruangan'])) {
	$ruangan = $_GET['ruangan'];
}

if ($ruangan != "") {
	$search = $search . " and e.ket_ruang='" . $ruangan . "' ";
}
$crb = $stts['KdCrb'];
if (!empty($_GET['crb'])) {
	$crb = $_GET['crb'];
}

if ($crb != "") {
	$search = $search . " and f.KODE='" . $crb . "' ";
}
if (!empty($_GET['urut'])) {
	$urut = $_GET['urut'];
} else {
	$urut = "NO_PESERTA";
}

$no_sep = "";
if (!empty($_GET['no_sep'])) {
	$no_sep = $_GET['no_sep'];
}

if ($no_sep != "") {
	$search = $search . " and a.id_admission LIKE '%" . $no_sep . "%' ";
}
$nama = "";
if (!empty($_GET['nama'])) {
	$nama = $_GET['nama'];
}
if ($nama != "") {
	$search = $search . " and b.NAMA LIKE '%" . $nama . "%' ";
}

?>


   <?php
			$i = 0;
				$sql = "SELECT a.JM,a.id_admission, a.keluarrs, b.nama as namapasien, b.ALAMAT, a.nomr,   a.NO_PESERTA,a.statusbayar, DATE_FORMAT(a.masukrs,'%d-%m-%Y') masukrs, DATE_FORMAT(a.keluarrs,'%d-%m-%Y') keluarrs,  a.JKN, e.ket_ruang as namaruang,f.NAMA as CARABAYAR
FROM t_admission a
left join m_pasien b on a.nomr=b.NOMR   
left join m_ruang e on a.noruang=e.no  
left join m_carabayar f on f.KODE=a.statusbayar  
where a.statusbayar in (2,3,4,8,9)  " . $search . " ORDER BY a.$urut ASC ";
				$qry	= mysql_query($sql);
			?>
			<div align="center" >
				<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>" >
				  <B>
				  <center>
			    <div id="frame_title">
LIST KLAIM RAWAT INAP <BR />
RSUD KABUPATEN INDRAMAYU
			    </div>
                <table width="100%"  class="tb" cellspacing="1" cellspading="0" border="1px">
           <tr>
			<th width="24" rowspan="2" align="center">NO</th>
			<th colspan="2" align="center">TANGGAL</th>
			<th width="130" rowspan="2" align="center">NO.REG</th>
			<th width="130" rowspan="2" align="center">NOMR</th>
			<th width="270" rowspan="2" align="left">NAMA </th>
			<th width="276" rowspan="2" align="left">ALAMAT</th>
			<th width="147" rowspan="2" align="left">RUANGAN</th>
			<th width="77" rowspan="2" align="center">CARA<br />BAYAR </th>
			<th width="76" rowspan="2" align="center">PERIODE</th>
			<th width="180" rowspan="2" align="center">REAL COST </th>
			
		</tr>
		<tr>
			<th width="120" align="center">MASUK </th>
			<th width="120" align="center"> KELUAR</th>
		</tr>
                  <?php
					while($data = mysql_fetch_array($qry)){
						$no++;
			
					
					?>
              <tr title="<?= $data['namapasien'] ?> (<?= $data['namaruang'] ?>)" >
				<td align="center"><? echo $no; ?></td>
				<td align="center"><?= $data['masukrs'] ?></td>
				<td align="center"><?= $data['keluarrs'] ?></td>
				<td align="center"><? echo $data['id_admission']; ?></td>
				<td align="center" class="nol"><? echo $data['nomr']; ?></td>
				<td><?php echo $data['namapasien']; ?></td>
				<td><?php echo $data['ALAMAT']; ?></td>
				<td><?= $data['namaruang'] ?></td>

				<td align="center"><?= $data['CARABAYAR'] ?> </td>
				<td align="center"><?= $data['JM'] ?></td>
				<td align="center"><?php 	$ri = mysql_query("select IDXDAFTAR, 
	 SUM(jumlah) AS jmlri 
		from t_billranap 
		 where IDXDAFTAR = '$data[id_admission]'  ");
											$rri = mysql_fetch_array($ri);
											
											$rj = mysql_query("select IDXDAFTAR, 
	 SUM(jumlah) AS jmlrij 
		from t_billrajal
		 where IDXDAFTAR = '$data[id_admission]'  ");
											$rrij = mysql_fetch_array($rj);
											$real= $rri['jmlri']+ $rrij['jmlrij'];
											echo number_format($real);?></td>
				
			</tr>
		<?	}
		?>
	</table>
			