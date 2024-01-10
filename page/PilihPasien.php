<!-- datetime -->
<script language="javascript">
	function hanyaAngka(e, decimal) {

		var key;
		var keychar;
		if (window.event) {
			key = window.event.keyCode;
		} else
		if (e) {
			key = e.which;
		} else return true;

		keychar = String.fromCharCode(key);
		if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
			return true;
		} else
		if ((("0123456789").indexOf(keychar) > -1)) {
			return true;
		} else

		if (decimal && (keychar == ".")) {
			return true;
		} else return false;
	}
</script>
<link href="jasa/kay.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ranap/datetimepicker_css.js"></script>
<!-- -->
<? if (!empty($_GET['psn'])) { ?>
	<script type="text/javascript">
		alert('Order Ke Kamar Operasi Telah Disimpan.');
	</script>
<? } ?>
<script language="javascript">
	function printIt() {
		content = document.getElementById('valid');
		head = document.getElementById('head_report');
		w = window.open('about:blank');
		w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
		w.document.write(head.innerHTML);
		w.document.write(content.innerHTML);
		w.document.writeln("<script>");
		w.document.writeln("window.print()");
		w.document.writeln("</" + "script>");
	}
</script>


<style>
	/* The Modal (background) */
	.modal {
		display: block;
		/* Hidden by default */
		position: fixed;
		/* Stay in place */
		z-index: 1;
		/* Sit on top */
		padding-top: 75px;
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
		background-color: rgba(0, 0, 0, 0.4);
		/* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
		background-color: #fefefe;
		margin: auto;
		margin-bottom: 150px;
		border: 1px solid #888;
		width: 60%;
	}

	/* The Close Button */
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}
	#balik {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background:#3fbafe ;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#balik:hover {
  background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);
 font-size: 19px;
}
</style>
<button onClick="topFunction()" id="balik" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
<?php
include("./include/connect.php");
$id_admission = $_GET["id_admission"];
?>

<?php
$myquery = "SELECT a.nomr, a.kirimdari, a.dokter_penanggungjawab AS dokter_penanggungjawab,a.perawat,a.statusbayar, DATE_FORMAT(a.masukrs,'%d-%m-%Y')masukrs, DATE_FORMAT(a.keluarrs,'%d-%m-%Y')keluarrs,a.noruang, a.nott,b.TGLLAHIR, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.alergi,b.alergiobat, c.NAMA AS CARABAYAR, a.id_admission, a.noruang, d.NAMA AS POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang,f.ket_ruang, DATE_FORMAT(b.TGLLAHIR,'%d/%m/%Y') AS TGLLAHIR1, a.statusbayar,a.nott
FROM t_admission a
JOIN m_pasien b ON a.nomr=b.NOMR
JOIN m_carabayar c ON a.statusbayar=c.KODE 
JOIN m_poly d ON d.KODE=a.kd_rujuk 
JOIN m_ruang f ON f.no=a.noruang

LEFT JOIN m_dokter e ON a.dokter_penanggungjawab=e.KDDOKTER 



WHERE a.id_admission='" . $_GET["id_admission"] . "'";
$get = mysql_query($myquery) or die(mysql_error());
$userdata = mysql_fetch_assoc($get);
$id_admission	= $userdata['id_admission'];
$nomr			= $userdata['nomr'];
$noruang		= $userdata['noruang'];
$kdpoly			= $userdata['kirimdari'];
$kddokter		= $userdata['dokter_penanggungjawab'];
$tglreg			= $userdata['TGLREG'];
$kelas			= $userdata['kelas'];
$masukrs		= $userdata['masukrs'];
$jk				= $userdata['JENISKELAMIN'];
$perawat		= $userdata['perawat'];
$crb			=$userdata['statusbayar'];

mysql_query("update t_billranap set NOMR='$nomr' where IDXDAFTAR='$_GET[id_admission]'");
mysql_query("update t_bayarranap set NOMR='$nomr' where IDXDAFTAR='$_GET[id_admission]'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
					<h5 class="card-title ">Identitas Pasien </h5>

				</div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
						<div >
                    <div class="row m-b-20">
                        <div class="col-lg-6 ">
                            <div class="table-responsive">
                             <table class="table" style="font-size:11px" >
                                <tr>
                                  <td>No.Registrasi</td>
                                  <td>: <b><?php echo $userdata['id_admission']; ?></b></td>
                                  <td width="13%" valign="top">Cara Bayar</td>
                                  <td width="23%">: <?php echo $userdata['CARABAYAR']; ?></td>
                                </tr>
                                <tr>
                                  <td>No MR</td>
                                  <td>: <?php echo $userdata['nomr']; ?></td>
                                  <td valign="top">DPJP</td>
                                  <td>: <?php echo $userdata['NAMADOKTER']; ?></td>
                                </tr>
                                <tr>
                                  <td width="11%">Nama pasien</td>
                                  <td width="22%">: <?php echo $userdata['NAMA']; ?></td>
                                  <td valign="top">Nama Ruang</td>
                                  <td>: <?php echo $userdata['ket_ruang']; ?></td>
                                </tr>
                                <tr>
                                  <td valign="top">Alamat </td>
                                  <td>: <?php echo $userdata['ALAMAT']; ?></td>
                                  <td valign="top">Masuk RS </td>
                                  <td>: <?php echo $userdata['masukrs']; ?></td>
                                </tr>
                                <tr>
                                  <td valign="top">Tgl.Lahir</td>
                                  <td>: <?php echo $userdata['TGLLAHIR1']; ?><!-- /
                                    <?php
											$a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
											echo "umur " . $a[years] . " tahun " . $a[months] . " bulan " . $a[days] . " hari"; ?>--></td>
                                  <td>Keluar RS </td>
                                  <td>: <?php echo $userdata['keluarrs']; ?></td>
                                </tr>
                              </table>
                            </div>
                                                </div>

                        <div class="col-lg-6 col-md-4 ">
                          
                          
                              <?
							  
											$st_jm = mysql_query("select * from x_SettingKlaim where KdCrb ='$crb'  and periode is not null and status ='ON'");
											$jm_st = mysql_fetch_array($st_jm);
											//echo $jm_st['periode'];
											?>
                              <?php
											$t_global = mysql_query("select IDXDAFTAR, 
	 SUM(IF(KODETARIF!='07' ,jumlah,0 ) ) AS jmlrj 
		from t_billrajal 
		 where IDXDAFTAR = '$_GET[id_admission]' and NONOTA is NULL and STATUS!='BATAL'");
											$global = mysql_fetch_array($t_global);

											$t_global2 = mysql_query("select IDXDAFTAR, 
	 SUM(IF(KODETARIF='07' and STATUS='SELESAI'   ,jumlah,0 ) ) AS farrj 
		from t_billrajal 
		 where IDXDAFTAR = '$_GET[id_admission]' and NONOTA is NULL ");
											$global2 = mysql_fetch_array($t_global2);

											$t_global3 = mysql_query("select IDXDAFTAR, 
	 SUM(IF(KODETARIF!='07' and STATUS!='BATAL' ,jumlah,0 ) ) AS jmlri 
		from t_billranap 
		 where IDXDAFTAR = '$_GET[id_admission]' and NONOTA is NULL ");
											$global3 = mysql_fetch_array($t_global3);

											$t_global4 = mysql_query("select IDXDAFTAR, 
	 SUM(IF(KODETARIF='07' and STATUS!='BATAL'  ,jumlah,0 ) ) AS farri 
		from t_billranap 
		 where IDXDAFTAR = '$_GET[id_admission]' and NONOTA is NULL ");
											$global4 = mysql_fetch_array($t_global4);

											?>


<?
											$status_pasien = mysql_query("select t_pendaftaran.RAJAL,t_pendaftaran.OBATRAJAL,t_admission.RANAP,t_admission.OBATRANAP,t_admission.JM
 from t_pendaftaran
 LEFT JOIN t_admission ON(t_pendaftaran.IDXDAFTAR=t_admission.id_admission) 
where t_pendaftaran.IDXDAFTAR='$_GET[id_admission]' ");
											$status = mysql_fetch_array($status_pasien);
											?>

                            <table width="100%" class="table" style="font-size:11px" >
                              <tr>
                                <td width="30%">Jumlah Biaya </td>
                                <td width="70%">: <b>Rp.
                                    <?= number_format(($global['jmlrj'] + $global2['farrj'] + $global3['jmlri'] + $global4['farri']), 2, ',', '.'); ?>
                                </b></td>
                              </tr>
                              <tr>
                                <td>Periode</td>
                                <td>: <?php echo $jm_st['periode']; ?></td>
                              </tr>
                              <tr>
                                <td>Keterangan</td>
                                <td>: <?php echo $jm_st['ket']; ?></td>
                              </tr>
                              <tr>
                                <td>Status Klaim </td>
                                <td>: <? if (!empty($status['JM'])) {
												echo "TERKLAIM";
											} else {
												echo "<a style='color:red;font-weight:bold'>Belum Terklaim</a>";
											} ?></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td><?php if ($status['JM'] == '' and $jm_st['status']=='ON') { ?>
<!--<a href="page/FinalKlaim.php?&jen=1&id_admission=<?= $_GET['id_admission'] ?>&nip=<?= $_SESSION['NIP'] ?>&periode=<?= $jm_st['periode']; ?>&link=<?=$_GET['link'];?>&crb=<?=$crb;?>" class="btn btn-sm btn-outline-info"><i class="fa fa-edit" title="Period : <?= $jm_st['periode']; ?>"></i>&nbsp;&nbsp;Klaim&nbsp;&nbsp;</a>-->
<a href="page/InsertPasienRanap.php?&bulan=1&id_admission=<?= $_GET['id_admission'] ?>&nip=<?= $_SESSION['NIP'] ?>&periode=<?= $jm_st['periode']; ?>&link=<?=$_GET['link'];?>&crb=<?=$crb;?>" class="btn btn-sm btn-info"><i class="fa fa-edit" title="Period : <?= $jm_st['periode']; ?>"></i>&nbsp;&nbsp;Pilih&nbsp;&nbsp;</a> 
<? } ?>

											<a href="./page/BillingPasien.php?idxdaftar=<?= $_GET['id_admission'] ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak&nbsp;&nbsp;</a>  </td>
                              </tr>
                            </table>
                      </div>

                    </div>

					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$tindrjl	= "SELECT t_pendaftaran.NOMR,SUM(t_billrajal.jumlah) as jml_tind,m_poly.nama
FROM t_pendaftaran
LEFT JOIN m_poly ON (t_pendaftaran.KDPOLY=m_poly.kode) 
LEFT JOIN t_billrajal ON (t_pendaftaran.IDXDAFTAR=t_billrajal.IDXDAFTAR) and (t_billrajal.KODETARIF!='07') 
WHERE t_pendaftaran.IDXDAFTAR='" . $_GET['id_admission'] . "' AND t_billrajal.STATUS !='BATAL'  ";
	$qrjl = mysql_query($tindrjl) or die(mysql_error());
	$data_rj = mysql_fetch_array($qrjl);
	?>

	<div class="col-lg-12">
		<div class="card">
			<!-- Tab panes -->
			<div class="card-body">
				<div class="table-responsive" >
					<h5 class="card-title" style="color:#3fbafe"><b><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Tindakan&nbsp;<?= $data_rj['nama'] ?> </b></span></h5>

					<table width="100%" cellpadding="1px" cellspacing="0" id="myTable1" style="font-size:11px" border="0px">
						<tr>
							<th>NO</th>
							<th>NOBILL</th>
							<th>URAIAN</th>
							<th align="right">DOKTER</th>
							<th align="right">TARIF</th>
							<th align="center">QTY</th>
							<th align="right">JUMLAH</th>
						</tr>
						<?php
						$no = 0;
						$warnaGenap = "#f1f2f5";   // warna abu-abu
						$warnaGanjil = "#fff";  // warna putih
						$sqlbr2	= "SELECT t_billrajal.STATUS,t_billrajal.KDPOLY,t_billrajal.NOBILL,t_billrajal.TANGGAL,t_billrajal.QTY,t_billrajal.TARIFRS,t_billrajal.jumlah,m_tarif2012.nama_tindakan,m_dokter.NAMADOKTER 
FROM t_billrajal
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billrajal.KODETARIF)  
LEFT JOIN m_dokter ON (t_billrajal.KDDOKTER=m_dokter.KDDOKTER)
WHERE t_billrajal.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billrajal.KODETARIF!='07'  and t_billrajal.STATUS!='BATAL' order by m_tarif2012.kode_gruptindakan,m_tarif2012.nama_tindakan ASC ";


						$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
						while ($databr2 = mysql_fetch_array($qrybr2)) {

							if ($no % 2 == 0) $warna = $warnaGenap;
							else $warna = $warnaGanjil;
							$no++;
						?>
							<tr bgcolor="<? echo $warna ?>">
								<td width="5%" align="center" valign="top"><? echo $no; ?></td>
								<td width="8%"><?= $databr2['NOBILL'] ?></td>
								<td width="37%"><?= $databr2['nama_tindakan']; ?></td>
								<td width="20%" align="left"><? echo $databr2['NAMADOKTER']; ?></td>
								<td width="10%" align="right"><? echo number_format(($databr2['TARIFRS']), 2, ',', '.'); ?></td>
								<td width="5%" align="center"><? echo $databr2['QTY']; ?></td>
								<td width="15%" align="right"><? echo number_format($databr2['jumlah'], 2, ',', '.'); ?></td>
							</tr>
						<? } ?>
						<tr style="font-weight:bold" bgcolor="#FFFFFF">
							<td colspan="6" align="right">Sub Total&nbsp;&nbsp;</td>
							<td align="right">
								<?
								echo number_format(($data_rj['jml_tind']), 2, ',', '.');
								?> </td>
						</tr>
					</table>
					<br />
					<?
					$selectrd = mysql_query("SELECT a.IDXBILL, b.PETUGAS
FROM t_billranap a 
LEFT join t_admission b ON b.id_admission = a.IDXDAFTAR
WHERE  a.IDXDAFTAR='" . $_GET['id_admission'] . "'  and a.KODETARIF!='07' and a.STATUS!='BATAL' and a.NONOTA IS NULL limit 1");
					$datard = mysql_fetch_array($selectrd);
					if (empty($datard['PETUGAS'])) {	?>


						<a href="./index.php?link=PILIH PASIEN&id_admission=<?= $_GET['id_admission'] ?>&verif_rj=1"  class="btn btn-sm btn-outline-info"><i class="fa fa-edit" style="color:#fc7d00;"></i>&nbsp;&nbsp;Validasi&nbsp;&nbsp;</a>
					<? }	?>

				</div>
			</div>
		</div>
	</div>



<?php
$sqlbr	= "SELECT t_billranap.KDPOLY,m_ruang.ket_ruang,m_ruang.keterangan 
FROM t_billranap
LEFT JOIN m_ruang ON (t_billranap.KDPOLY=m_ruang.no)  
WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' GROUP BY t_billranap.KDPOLY order by t_billranap.IDXBILL ASC ";
$qrybr = mysql_query($sqlbr) or die(mysql_error());
while ($databr = mysql_fetch_array($qrybr)) {
?>
	<div class="col-lg-12">
		<div class="card">
			<!-- Tab panes -->
			<div class="card-body">
				<div class="table-responsive" >
					<span style="font-size:18px;color:#3fbafe;text-align:left"><b><i class="fa fa-graduation-cap"></i>
						Tindakan&nbsp;<?= $databr['ket_ruang'] ?>
						</b></span>

					<table width="100%" cellpadding="1px" cellspacing="0" id="myTable1" style="font-size:11px" border="0px">
						<tr>
							<th width="5%">NO</th>
							<th width="8%">NOBILL</th>
							<th width="37%">URAIAN</th>
							<th width="20%" align="right">DOKTER</th>
							<th width="10%" align="right">TARIF</th>
							<th width="5%" align="center">QTY</th>
							<th width="15%" align="right">JUMLAH</th>
						</tr>
						<?php
						$no = 0;
						$warnaGenap = "#f1f2f5";   // warna abu-abu
						$warnaGanjil = "#fff";  // warna putih
						$sqlbr2	= "SELECT t_billranap.KDPOLY,t_billranap.NOBILL,t_billranap.TANGGAL,t_billranap.QTY,t_billranap.TARIFRS,t_billranap.jumlah,m_tarif2012.nama_tindakan, m_dokter.NAMADOKTER
FROM t_billranap
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billranap.KODETARIF)  
LEFT JOIN m_dokter ON (t_billranap.KDDOKTER=m_dokter.KDDOKTER)    
WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billranap.KODETARIF!='07' and t_billranap.KDPOLY='$databr[KDPOLY]' and t_billranap.STATUS!='BATAL' order by m_tarif2012.kode_gruptindakan,m_tarif2012.nama_tindakan ASC ";


						$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
						while ($databr2 = mysql_fetch_array($qrybr2)) {

							if ($no % 2 == 0) $warna = $warnaGenap;
							else $warna = $warnaGanjil;
							$no++;
						?>
							<tr bgcolor="<? echo $warna ?>">
								<td align="center" valign="top"><? echo $no; ?></td>
								<td><?= $databr2['NOBILL'] ?></td>
								<td><?= $databr2['nama_tindakan']; ?></td>
								<td align="left"><? echo $databr2['NAMADOKTER']; ?></td>
								<td align="right"><? echo number_format(($databr2['TARIFRS']), 2, ',', '.'); ?></td>
								<td align="center"><? echo $databr2['QTY']; ?></td>
								<td align="right"><? echo number_format($databr2['jumlah'], 2, ',', '.'); ?></td>
							</tr>
						<? } ?>
						<tr style="font-weight:bold" bgcolor="#FFFFFF">
							<td colspan="6" align="right">Sub Total&nbsp;&nbsp;</td>
							<td align="right">
								<?

								$selectr = mysql_query("SELECT IDXBILL,SUM(jumlah) as jumlah_ranap 
FROM t_billranap 
WHERE  IDXDAFTAR='" . $_GET['id_admission'] . "' and KDPOLY='$databr[KDPOLY]' and KODETARIF!='07' and STATUS!='BATAL' ");
								$datar = mysql_fetch_array($selectr);
								echo number_format(($datar['jumlah_ranap']), 2, ',', '.');
								?> </td>
						</tr>
					</table>
					<br />
				<? } ?>
				<?
				$selectrd = mysql_query("SELECT a.IDXBILL, b.PETUGAS
FROM t_billranap a 
LEFT join t_admission b ON b.id_admission = a.IDXDAFTAR
WHERE  a.IDXDAFTAR='" . $_GET['id_admission'] . "'  and a.KODETARIF!='07' and a.STATUS!='BATAL' and a.NONOTA IS NULL limit 1");
				$datard = mysql_fetch_array($selectrd);
				if (empty($datard['PETUGAS'])) {	?>
					<a href="./index.php?link=PILIH PASIEN&id_admission=<?= $_GET['id_admission'] ?>&verif=1"  class="btn btn-sm btn-outline-info"><i class="fa fa-edit" style="color:#fc7d00;"></i>&nbsp;&nbsp;Validasi&nbsp;&nbsp;</a><? } ?>
				</div>

			</div>
		</div>
	</div>





	<?php
	$tindrjl2	= "SELECT t_pendaftaran.NOMR,SUM(t_billrajal.jumlah) as jml_rsp,m_poly.nama
FROM t_pendaftaran
LEFT JOIN m_poly ON (t_pendaftaran.KDPOLY=m_poly.kode) 
LEFT JOIN t_billrajal ON (t_pendaftaran.IDXDAFTAR=t_billrajal.IDXDAFTAR) and (t_billrajal.KODETARIF='07') 
WHERE t_pendaftaran.IDXDAFTAR='" . $_GET['id_admission'] . "'  ";
	$qrjl2 = mysql_query($tindrjl2) or die(mysql_error());
	$data_rj2 = mysql_fetch_array($qrjl2);
	?>
	<div class="col-lg-12">
		<div class="card">
			<!-- Tab panes -->
			<div class="card-body">
				<div class="table-responsive" >
					<span style="font-size:18px;color:#3fbafe;text-align:left"><b><i class="fa fa-graduation-cap"></i>
							<zzz>Resep&nbsp;<?= $data_rj2['nama'] ?></zzz>
						</b></span>
					<table width="100%" cellpadding="1px" cellspacing="0" id="myTable1" style="font-size:11px" border="0px">
						<tr>
							<th style="width:4%;">NO.BILL</th>
							<th style="width:15%;">TANGGAL</th>
							<th style="width:25%;">URAIAN</th>
							<th style="width:20%; text-align:right;">TARIF</th>

							<th style="width:20%; text-align:right;">JUMLAH </th>
							<th style="width:10%; text-align:center;">PRINT</th>
						</tr>
						<tbody class="list_billrajal">
							<?
							$warnaGenap = "#fff";   // warna abu-abu
							$warnaGanjil = "#f1f2f5";  // warna putih
							$bayar_rj = "select t_billrajal.*,t_bayarrajal.STATUS as STATUS_BYR,t_bayarrajal.JMBAYAR
from t_billrajal
LEFT JOIN t_bayarrajal ON(t_billrajal.NOBILL=t_bayarrajal.NOBILL)
 WHERE t_billrajal.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billrajal.STATUS!='BATAL' and t_billrajal.KODETARIF='07' and t_billrajal.QTY>'0' order by t_billrajal.IDXBILL ASC ";
							$jalan_rj = mysql_query($bayar_rj) or die('Error');

							$norbr = 0;

							while ($data_rj = mysql_fetch_array($jalan_rj)) {
								$norbr++;
								if ($norbr % 2 == 0) $warna = $warnaGenap;
								else $warna = $warnaGanjil;

							?>
								<form action="cartbill_ris.php" method="post" enctype="multipart/form-data">
									<tr bgcolor="<? echo $warna ?>">
										<td><?= $data_rj['NOBILL'] ?></td>
										<td><?= $data_rj['TANGGAL'] ?></td>
										<td>Pelayanan Resep
											<input type="hidden" name="nobill" value="<?= $data_rj['NOBILL'] ?>" />
											<input type="hidden" name="id_admission" value="<?= $_GET['id_admission'] ?>" />
											<input type="hidden" name="carabayar" value="<?= $userdata['statusbayar'] ?>" />
											<input type="hidden" name="kasir" value="<?= $_SESSION['NIP'] ?>" />
										</td>
										<td align="right">Rp. <?= number_format($data_rj['TARIFRS'], 2, ',', '.'); ?></td>
										<td align="right">

											<? if ($data_rj['STATUS_BYR'] == "LUNAS") {
												echo number_format($data_rj['JMBAYAR'], 2, ',', '.');
											} else { ?>
												<?
												$hrg_asli = (int)$data_rj['jumlah'];
												$pecahan = substr($hrg_asli, -3);
												if ($pecahan > 0 && $pecahan < 100) {
													$tambah = 100 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 100 && $pecahan < 200) {
													$tambah = 200 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 200 && $pecahan < 300) {
													$tambah = 300 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 300 && $pecahan < 400) {
													$tambah = 400 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 400 && $pecahan < 500) {
													$tambah = 500 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 500 && $pecahan < 600) {
													$tambah = 600 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 600 && $pecahan < 700) {
													$tambah = 700 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 700 && $pecahan < 800) {
													$tambah = 800 - $pecahan;

													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 800 && $pecahan < 900) {
													$tambah = 900 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else if ($pecahan > 900 && $pecahan < 1000) {
													$tambah = 1000 - $pecahan;
													$hrg_jual = $hrg_asli + $tambah;
												} else {
													$hrg_jual = $hrg_asli;
												} ?>
												<input type="hidden" name="jumlah_bayar" style="width:100%;padding-right:5px;text-align:right" value="<? echo $hrg_jual; ?>" />
												<input type="text" name="jumlah_bayars" readonly="" style="width:100%;padding-right:5px;text-align:right" value="<?= number_format($hrg_jual, 2, ',', '.') ?>" />
											<? } ?>
										</td>
										<td align=right>
											<? if ($data_rj['STATUS_BYR'] == "LUNAS") { ?>
												<a href="./kasir_rekap/kuitansi_p.php?IDXDAFTAR=<?= $data_rj['IDXDAFTAR'] ?>&nobill=<?php echo $data_rj['NOBILL']; ?>&kasir=<?= $_SESSION['NIP'] ?>" target='_blank' class="ui-button" style="border-radius:6px;border-color:#CCCCCC;width:150px"><i class="fas fa-print" style="color:#fc7d00;"></i>&nbsp;&nbsp;<?= $data_rj['NONOTA']; ?>&nbsp;&nbsp;</a>
											<? } ?>
										</td>
									</tr>
								</form>
								<tr>
								<? } ?>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><b>Jumlah / Sisa</b></td>
								<td align="right"> <b><?

														$selectrrbrd = mysql_query("SELECT t_billrajal.IDXBILL,SUM(t_billrajal.jumlah) as jml_rsp,t_bayarrajal.STATUS
FROM t_billrajal 
LEFT JOIN t_bayarrajal ON(t_billrajal.NOBILL=t_bayarrajal.NOBILL)
WHERE  t_billrajal.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billrajal.KODETARIF='07'   ");
														$datarrbrd = mysql_fetch_array($selectrrbrd);
														echo "Rp. ";
														echo number_format(($datarrbrd['jml_rsp']), 2, ',', '.');
														?></b></td>
								<td>&nbsp;</td>
								<td align=right><a href="./kasir_rekap/copyresep_rajal.php?idx=<?= $_GET['id_admission'] ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak&nbsp;&nbsp;</a></td>
								</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<?php
	$sqlrbr	= "SELECT t_billranap.KDPOLY,m_ruang.ket_ruang,m_ruang.keterangan 
FROM t_billranap
LEFT JOIN m_ruang ON (t_billranap.KDPOLY=m_ruang.no)  
WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billranap.KODETARIF='07' GROUP BY t_billranap.KDPOLY order by t_billranap.IDXBILL ASC ";
	$qryrbr = mysql_query($sqlrbr) or die(mysql_error());
	while ($datarbr = mysql_fetch_array($qryrbr)) {
	?>
		<div class="col-lg-12">
			<div class="card">
				<!-- Tab panes -->
				<div class="card-body">
					<div class="table-responsive">
						<span style="font-size:18px;color:#3fbafe;text-align:left"><b><i class="fa fa-graduation-cap"></i>
								<zzz>Resep&nbsp;<?= $datarbr['ket_ruang'] ?></zzz>
							</b></span>

						<table width="100%" cellpadding="1px" cellspacing="0" id="myTable1" style="font-size:11px" border="0px">
							<tr>
								<th style="width:4%;">NO.BILL</th>
								<th style="width:15%;">TANGGAL</th>
								<th style="width:25%;">URAIAN</th>
								<th style="width:20%; text-align:right;">TARIF</th>
								<th style="width:20%; text-align:right;">JUMLAH </th>
								<th style="width:10%; text-align:center;">PRINT</th>
							</tr>
							<tbody class="list_billrajal">
								<?
								$warnaGenap = "#fff";   // warna abu-abu
								$warnaGanjil = "#f1f2f5";  // warna putih
								$sqlrbr2 = "select t_billranap.*,t_bayarranap.STATUS as STATUS_BYR,t_bayarranap.JMBAYAR
from t_billranap
LEFT JOIN t_bayarranap ON(t_billranap.NOBILL=t_bayarranap.NOBILL)
 WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billranap.STATUS!='BATAL' and t_billranap.KDPOLY='$datarbr[KDPOLY]' and t_billranap.KODETARIF='07' and t_billranap.QTY>'0' order by t_billranap.IDXBILL ASC ";
								$jalankanrbr2 = mysql_query($sqlrbr2) or die('Error');

								$norbr = 0;

								while ($datarbr2 = mysql_fetch_array($jalankanrbr2)) {
									$norbr++;
									if ($norbr % 2 == 0) $warna = $warnaGenap;
									else $warna = $warnaGanjil;

								?>
									<form action="cartbill_ranap_s.php" method="post" enctype="multipart/form-data">
										<tr bgcolor="<? echo $warna ?>">
											<td><?= $datarbr2['NOBILL'] ?></td>
											<td><?= $datarbr2['TANGGAL'] ?></td>
											<td>Pelayanan Resep
												<input type="hidden" name="nobill" value="<?= $datarbr2['NOBILL'] ?>" />
												<input type="hidden" name="id_admission" value="<?= $_GET['id_admission'] ?>" />
												<input type="hidden" name="carabayar" value="<?= $userdata['statusbayar'] ?>" />
												<input type="hidden" name="kasir" value="<?= $_SESSION['NIP'] ?>" />
											</td>
											<td align="right">Rp. <?= number_format($datarbr2['TARIFRS'], 2, ',', '.'); ?></td>
											<td align="right">

												<? if ($datarbr2['STATUS_BYR'] == "LUNAS") {
													echo number_format($datarbr2['JMBAYAR'], 2, ',', '.');
												} else { ?>
													<?
													$hrg_asli = (int)$datarbr2['TARIFRS'];
													$pecahan = substr($hrg_asli, -3);
													if ($pecahan > 0 && $pecahan < 100) {
														$tambah = 100 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 100 && $pecahan < 200) {
														$tambah = 200 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 200 && $pecahan < 300) {
														$tambah = 300 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 300 && $pecahan < 400) {
														$tambah = 400 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 400 && $pecahan < 500) {
														$tambah = 500 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 500 && $pecahan < 600) {
														$tambah = 600 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 600 && $pecahan < 700) {
														$tambah = 700 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 700 && $pecahan < 800) {
														$tambah = 800 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 800 && $pecahan < 900) {
														$tambah = 900 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else if ($pecahan > 900 && $pecahan < 1000) {
														$tambah = 1000 - $pecahan;
														$hrg_jual = $hrg_asli + $tambah;
													} else {
														$hrg_jual = $hrg_asli;
													} ?>
													<input type="hidden" name="jumlah_bayar" style="width:100%;padding-right:5px;text-align:right" value="<? echo $hrg_jual; ?>" />
													<input type="text" name="jumlah_bayars" readonly="" style="width:100%;padding-right:5px;text-align:right" value="<?= number_format($hrg_jual, 2, ',', '.') ?>" />
												<? } ?>
											</td>
											<td align=right>
												<? if ($datarbr2['STATUS_BYR'] == "LUNAS") { ?>
													<a href="./kasir_rekap/kuitansi3_p.php?IDXDAFTAR=<?= $datarbr2['IDXDAFTAR'] ?>&nobill=<?php echo $datarbr2['NOBILL']; ?>&kasir=<?= $_SESSION['NIP'] ?>" class="ui-button" style="border-radius:6px;border-color:#CCCCCC;width:150px;display:block" target="_blank"><i class="fas fa-print" style="color:#fc7d00;"></i>&nbsp;&nbsp;<?= $datarbr2['NONOTA'] ?>&nbsp;&nbsp;</a>
												<? } ?>
											</td>
										</tr>
									</form>
									<tr>
									<? } ?>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><b>Jumlah / Sisa</b></td>
									<td align="right"> <b><?

															$selectrrbr = mysql_query("SELECT t_billranap.IDXBILL,SUM(t_billranap.TARIFRS) as jumlah_rranap,t_bayarranap.STATUS
FROM t_billranap 
LEFT JOIN t_bayarranap ON(t_billranap.NOBILL=t_bayarranap.NOBILL)
WHERE  t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billranap.KDPOLY='$datarbr[KDPOLY]' and t_billranap.KODETARIF='07'  ");
															$datarrbr = mysql_fetch_array($selectrrbr);
															echo "Rp. ";
															echo number_format(($datarrbr['jumlah_rranap']), 2, ',', '.');
															?></b></td>
									<td>&nbsp;</td>
									<td align=right><a href="./kasir_rekap/copyresep_ranap.php?idx=<?= $_GET[id_admission] ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak&nbsp;&nbsp;</a></td>
									</tr>
							</tbody>
						</table>
						<br />
					<? } ?>
					</div>
				</div>
			</div>
		</div>

		<!--<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script> -->
		<!-- RETURN -->


		<br />



		<!--
  <div id="frame" style="width:100%"   >
<fieldset >
<legend > &nbsp;Return&nbsp; </legend>
 
 <div > 
 <div>
<fieldset   >
 

<legend > &nbsp;Resep&nbsp;</legend>
 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tr>
  	<th style="width:80px;">No.BILL</th>
    <th style="width:100px;">No Nota </th>
    <th style="width:100px;">Apotek</th>
    <th style="width:150px;">Ruang / Klinik</th>
    <th style="width:200px;">Dokter </th> 
    <th style="width:100px; text-align:right;">Tarif</th>
    
    <th style=" width:50px;text-align:right;">Shift</th> 
    <th style=" width:110px;text-align:right;">Nilai Return </th> 
    <th style=" width:80px;text-align:center;">Aksi</th>
    <th  >Kuitansi</th>
  </tr>
    <tbody class="list_billrajal">
 
 <?
	$warnaGenap = "#f1f2f5";   // warna abu-abu
	$warnaGanjil = "#fff";  // warna putih
	$sqlrbr2 = "SELECT t_bayarreturn.*,m_ruang.ket_ruang,m_ruang.keterangan ,m_poly.nama as namapoly,m_dokter.NAMADOKTER
FROM t_bayarreturn
LEFT JOIN m_ruang ON (t_bayarreturn.RUANG=m_ruang.no) 
LEFT JOIN m_poly ON (t_bayarreturn.RUANG=m_poly.kode)  
LEFT JOIN m_dokter ON (t_bayarreturn.KDDOKTER=m_dokter.KDDOKTER)   
WHERE t_bayarreturn.IDXDAFTAR='" . $_GET['id_admission'] . "'  order by t_bayarreturn.IDXRETURN ASC  ";
	$jalankanrbr2 = mysql_query($sqlrbr2) or die('Error');

	$norbr = 0;

	while ($datarbr2 = mysql_fetch_array($jalankanrbr2)) {
		$norbr++;
		if ($norbr % 2 == 0) $warna = $warnaGenap;
		else $warna = $warnaGanjil;

	?>
<form action="cartbill_return_s.php" method="post" enctype="multipart/form-data">
  	<tr bgcolor="<? echo $warna ?>" >
		<td ><?= $datarbr2['NOBILL'] ?></td>
		 <td ><?= $datarbr2['NONOTA'] ?></td>
		 <td ><?= $datarbr2['NIP'] ?></td>
		 <td ><? if ($datarbr2['RIRJ'] == "1") {
					echo $datarbr2['namapoly'];
				} else {
					echo $datarbr2['ket_ruang'];
				} ?></td>
		 <td ><?= $datarbr2['NAMADOKTER'] ?>
		<input type="hidden" name="idx" value="<?= $datarbr2['IDXDAFTAR'] ?>" /> 
		 <input type="hidden" name="nobill" value="<?= $datarbr2['NOBILL'] ?>" /> 
		<input type="hidden" name="nonota" value="<?= $datarbr2['NONOTA'] ?>" /> 
		<input type="hidden" name="kasir" value="<?= $_SESSION['NIP'] ?>" /> 
		<input type="hidden" name="RIRJ" value="<?= $datarbr2['RIRJ'] ?>" /> </td>
		<td align="right" >Rp. <?= number_format($datarbr2['TARIFRS'], 2, ',', '.'); ?></td>
		<td  align="center"  >
		<? if ($datarbr2['CARABAYAR'] == "1" && $datarbr2['STATUS'] == "TRX") {  ?>
		     <select name="shift"  class="text">
                <option value="">-</option><option value="1"> 1 </option><option value="2"> 2 </option><option value="3"> 3 </option>
            </select>
			<? } ?>	
			<? if ($datarbr2['STATUS'] == "LUNAS") {
				echo $datarbr2['SHIFT'];
			} ?>			</td>
    	 
	<td align="right">
	
	 <? if ($datarbr2['STATUS'] == "LUNAS") {
			echo number_format($datarbr2['JMRETURN'], 2, ',', '.');
		} else { ?>
<?
			$hrg_asli = (int)$datarbr2['TARIFRS'];
			$pecahan = substr($hrg_asli, -3);
			if ($pecahan > 0 && $pecahan < 100) {
				$tambah = 100 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 100 && $pecahan < 200) {
				$tambah = 200 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 200 && $pecahan < 300) {
				$tambah = 300 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 300 && $pecahan < 400) {
				$tambah = 400 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 400 && $pecahan < 500) {
				$tambah = 500 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 500 && $pecahan < 600) {
				$tambah = 600 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 600 && $pecahan < 700) {
				$tambah = 700 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 700 && $pecahan < 800) {
				$tambah = 800 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 800 && $pecahan < 900) {
				$tambah = 900 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else if ($pecahan > 900 && $pecahan < 1000) {
				$tambah = 1000 - $pecahan;
				$hrg_jual = $hrg_asli + $tambah;
			} else {
				$hrg_jual = $hrg_asli;
			} ?>
<input type="hidden" name="jumlah_bayar"  style="width:100%;padding-right:5px;text-align:right"  value="<? echo $hrg_jual; ?>"  />
<input type="text" name="jumlah_bayars" readonly=""  style="width:100%;padding-right:5px;text-align:right"  value="<?= number_format($hrg_jual, 2, ',', '.') ?>"  />
<? } ?></td>
	<td align="center">
		<? if ($datarbr2['CARABAYAR'] == "1" && $datarbr2['STATUS'] == "TRX") {  ?>
	  <input type="Submit"  value="Proses"  class="text bayar"  />	
	  <? } ?></td>
	<td > 
	 <? if ($datarbr2['STATUS'] == "LUNAS") { ?> 
		<a href="./kasir_rekap/kuitansi_all.php?opsi=5&IDXDAFTAR=<?= $datarbr2['IDXDAFTAR'] ?>&NONOTA=<?= $datarbr2['NORETURN']; ?>&kasir=<?= $_SESSION['NIP'] ?>" target='_blank'  style="display:block " ><input type='button' value='<?= $datarbr2['NORETURN'] ?>' class='text'></a>
		<? } ?> </td>
  	</tr>
	</form>
	<? } ?>
  	 
	</tbody>
  </table> 
  <br/> 
  </fieldset>
</div>

  </fieldset>
</div>
<br/>
-->
		<!--RAWAT JALAN -->

		<? if (!empty($_GET['verif_rj'])) { ?>

			<!-- The Modal -->
			<div id="myModal" class="modal">

				<!-- Modal content -->
				<div class="modal-content">
					<span onclick="window.location.href='index.php?link=PILIH PASIEN&id_admission=<?= $_GET['id_admission'] ?>'" class="close">&times;</span>

					<div>

						<?php
						$sqlbr	= "SELECT t_billrajal.KDPOLY,m_poly.nama,m_dokter.NAMADOKTER
FROM t_billrajal
LEFT JOIN m_poly ON (t_billrajal.KDPOLY=m_poly.kode)
LEFT JOIN m_dokter ON (t_billrajal.KDDOKTER=m_dokter.KDDOKTER)    
WHERE t_billrajal.IDXDAFTAR='" . $_GET['id_admission'] . "' GROUP BY t_billrajal.KDPOLY order by t_billrajal.IDXBILL ASC ";
						$qrybr = mysql_query($sqlbr) or die(mysql_error());
						while ($databr = mysql_fetch_array($qrybr)) {
						?>

							<a style="font-size:14px;font-weight:bold"><?= $databr['nama'] ?></a>

							<table width="100%" cellpadding="0px" cellspacing="0px">
								<tr bgcolor="#ccc">
									<th width="2%">NO</th>
									<th width="3%" align="center">TANGGAL</th>
									<th width="15%">
										<div align="left">URAIAN</div>
									</th>
									<th width="12%" align="left">DOKTER</th>
									<th width="5%" align="right">TARIF</th>
									<th width="2%" align="center">
										<div align="center">QTY</div>
									</th>
									<th width="5%" align="right">JUMLAH</th>
									<th colspan="3" align="center" width="3%">
										<div align="center">AKSI</div>
									</th>
								</tr>

								<?php
								$no = 0;
								$warnaGenap = "#def8ed";   // warna abu-abu
								$warnaGanjil = "#fff";  // warna putih
								$sqlbr2	= "SELECT t_billrajal.KODETARIF,t_billrajal.KDPOLY,t_billrajal.IDXBILL,t_billrajal.CARABAYAR,t_billrajal.NOBILL,t_billrajal.TANGGAL,t_billrajal.QTY,t_billrajal.TARIFRS,t_billrajal.jumlah,m_tarif2012.nama_tindakan,m_dokter.NAMADOKTER,m_tarif2012.tarif
FROM t_billrajal
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billrajal.KODETARIF)  
LEFT JOIN m_dokter ON (t_billrajal.KDDOKTER=m_dokter.KDDOKTER)    
WHERE t_billrajal.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billrajal.KODETARIF!='07' AND t_billrajal.STATUS!='BATAL'  order by m_tarif2012.kode_gruptindakan,m_tarif2012.nama_tindakan ASC ";


								$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
								while ($databr2 = mysql_fetch_array($qrybr2)) {

									if ($no % 2 == 0) $warna = $warnaGenap;
									else $warna = $warnaGanjil;
									$no++;
								?>

									<form action="./kasir_rekap/pasien_ranap_rj.php" method="post" enctype="multipart/form-data">
										<tr bgcolor="<? echo $warna ?>">
											<td align="center" valign="top"><? echo $no; ?></td>
											<td align="center"><?= $databr2['TANGGAL'] ?></td>
											<td><?= $databr2['nama_tindakan']; ?>
												<input name="qty_lama" type="hidden" value="<?= $databr2['QTY']; ?>">
												<input name="IDXBILL" type="hidden" value="<?= $databr2['IDXBILL']; ?>">
												<input name="NOBILL" type="hidden" value="<?= $databr2['NOBILL']; ?>">
												<input name="CARABAYAR" type="hidden" value="<?= $databr2['CARABAYAR']; ?>">
												<input name="id_admission" type="hidden" value="<?= $_GET['id_admission']; ?>">
												<input name="kode" type="hidden" value="<?= $databr2['KODETARIF']; ?>">
												<input name="opsi" type="hidden" value="edit">
											</td>
											<td align="left"><?= $databr2['NAMADOKTER']; ?></td>
											<td align="right"><? echo number_format(($databr2['tarif']), 2, ',', '.'); ?></td>
											<td align="center"><?= $databr2['QTY']; ?></td>
											<td align="right"><? echo number_format($databr2['jumlah'], 2, ',', '.'); ?></td>
											<td width="30" align="right"> <? if (empty($databr2['NONOTA'])) { ?><? if ($databr2['QTY'] > 1) { ?> <input name="qty" type="text" style=" width:30px;height:18px;padding-left:3px "><? } ?></td>
											<td width="38"><? if ($databr2['QTY'] > 1) { ?>
													<input type="Submit" value="Save" style="font-size:10px;padding:5px" class="btn success" /><? } ?><? } ?>
											</td>
											<td width="41" align="center" style="padding:10px"><? if (empty($databr2['NONOTA'])) { ?> <a href="./kasir_rekap/pasien_ranap_rj2.php?opsi=hapus&id_admission=<?= $_GET['id_admission'] ?>&IDXBILL=<?= $databr2['IDXBILL'] ?>&NOBILL=<?= $databr2['NOBILL'] ?>&CARABAYAR=<?= $databr2['CARABAYAR'] ?>" class="btn danger" style="color:#FFFFFF;padding:5px ">X</a><? } ?></td>
										</tr>
									</form>
								<? } ?>
								<tr style="font-weight:bold" bgcolor="#FFFFFF">
									<td colspan="6" align="right">Sub Total&nbsp;&nbsp;</td>
									<td align="right">
										<?

										$selectr = mysql_query("SELECT IDXBILL,SUM(jumlah) as jumlah_ranap 
FROM t_billrajal 
WHERE  IDXDAFTAR='" . $_GET['id_admission'] . "' and KDPOLY='$databr[KDPOLY]' and KODETARIF!='07' and STATUS!='BATAL' order by IDXBILL asc ");
										$datar = mysql_fetch_array($selectr);
										echo number_format(($datar['jumlah_ranap']), 2, ',', '.');
										?> </td>
									<td align="right">&nbsp;</td>
									<td align="right">&nbsp;</td>
									<td align="right">&nbsp;</td>
								</tr>
							</table>
							<br />
						<? } ?>


						<a style="font-size:14px;font-weight:bold">DATA TERVALIDASI </a>
						<table width="100%" cellpadding="0px" cellspacing="0px">
							<tr style="font-weight:bold" bgcolor="#ccc">
								<td width="2%">NO</td>
								<td width="3%">TANGGAL</td>
								<td width="20%">URAIAN</td>
								<td width="15%" align="LEFT">DOKTER</td>
								<td width="10%" align="right">TARIF</td>
								<td width="5%" align="center">QTY</td>
								<td width="10%" align="right">JUMLAH</td>
								<td width="5%" align="center">AKSI</td>
							</tr>
							<?php
							$no = 0;
							$warnaGenap = "#f1f2f5";   // warna abu-abu
							$warnaGanjil = "#fff";  // warna putih
							$sqlbr2	= "SELECT t_billrajal.KDPOLY,t_billrajal.IDXBILL,t_billrajal.CARABAYAR,t_billrajal.NOBILL,t_billrajal.TANGGAL,t_billrajal.QTY,t_billrajal.TARIFRS,t_billrajal.jumlah,m_tarif2012.nama_tindakan ,m_dokter.NAMADOKTER
FROM t_billrajal
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billrajal.KODETARIF)  
LEFT JOIN m_dokter ON (t_billrajal.KDDOKTER=m_dokter.KDDOKTER)    

WHERE t_billrajal.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billrajal.KODETARIF!='07' AND t_billrajal.STATUS='BATAL'  order by m_tarif2012.kode_gruptindakan,m_tarif2012.nama_tindakan ASC ";


							$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
							while ($databr2 = mysql_fetch_array($qrybr2)) {

								if ($no % 2 == 0) $warna = $warnaGenap;
								else $warna = $warnaGanjil;
								$no++;
							?>
								<tr bgcolor="<? echo $warna ?>">
									<td align="center" valign="top"><? echo $no; ?></td>
									<td align="center"><?= $databr2['TANGGAL'] ?></td>
									<td><?= $databr2['nama_tindakan']; ?> </td>
									<td align="left"><?= $databr2['NAMADOKTER']; ?></td>
									<td align="right"><? echo number_format(($databr2['TARIFRS']), 2, ',', '.'); ?></td>
									<td align="center"><?= $databr2['QTY']; ?></td>
									<td align="right"><? echo number_format($databr2['jumlah'], 2, ',', '.'); ?></td>
									<td align="center" style="padding:10px"><? if (empty($databr2['NONOTA'])) { ?> <a href="./kasir_rekap/pasien_ranap_rj2.php?opsi=ralat&id_admission=<?= $_GET['id_admission'] ?>&IDXBILL=<?= $databr2['IDXBILL'] ?>&NOBILL=<?= $databr2['NOBILL'] ?>&CARABAYAR=<?= $databr2['CARABAYAR'] ?>" class="btn info" style="color:#FFFFFF;padding:5px ">Batal</a><? } ?></td>
								</tr>
							<? } ?>
						</table>
						<br /> <br /> <br />
						<div align="right">
							<a href="index.php?link=PILIH PASIEN&id_admission=<?= $_GET['id_admission'] ?>" style="color:#FFFFFF" class="btn success">Selesai</a>
						</div>
					</div>


					</p>
				</div>
			</div>
		<? } ?>

		<!--END RAJAL-->



		<? if (!empty($_GET['verif'])) { ?>

			<!-- The Modal -->
			<div id="myModal" class="modal">

				<!-- Modal content -->
				<div class="modal-content">
					<span onclick="window.location.href='index.php?link=PILIH PASIEN&id_admission=<?= $_GET['id_admission'] ?>'" class="close">&times;</span>
					<p>
					<div>

						<?php
						$sqlbr	= "SELECT t_billranap.KDPOLY,m_ruang.ket_ruang,m_ruang.keterangan 
FROM t_billranap
LEFT JOIN m_ruang ON (t_billranap.KDPOLY=m_ruang.no)  
WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' GROUP BY t_billranap.KDPOLY order by t_billranap.IDXBILL ASC ";
						$qrybr = mysql_query($sqlbr) or die(mysql_error());
						while ($databr = mysql_fetch_array($qrybr)) {
						?>
							<div align="left">
								<a style="font-size:14px;font-weight:bold"><?= $databr['ket_ruang'] ?> - <?= $databr['keterangan'] ?></a>
							</div>

							<table width="100%" cellpadding="0px" cellspacing="0px">
								<tr>
									<th width="5%">No</th>
									<th width="80">Tanggal</th>
									<th>Uraian</th>
									<th width="10%" align="right">Dokter</th>
									<th width="10%" align="right">Tarif</th>
									<th width="5%" align="center">Qty</th>
									<th width="15%" align="right">Jumlah</th>
									<th colspan="2" align="center">EDIT</th>
									<th width="1%" align="center">HPS</th>
								</tr>
								<?php
								$no = 0;
								$warnaGenap = "#f1f2f5";   // warna abu-abu
								$warnaGanjil = "#fff";  // warna putih
								$sqlbr2	= "SELECT t_billranap.KDPOLY,t_billranap.KODETARIF,t_billranap.TANGGAL,t_billranap.IDXBILL,t_billranap.NOBILL,t_billranap.NONOTA,t_billranap.CARABAYAR,t_billranap.QTY,t_billranap.TARIFRS,t_billranap.jumlah,m_tarif2012.nama_tindakan,m_tarif2012.jasa_sarana,m_tarif2012.jasa_pelayanan,m_tarif2012.tarif,m_dokter.NAMADOKTER
FROM t_billranap
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billranap.KODETARIF)  
LEFT JOIN m_dokter ON (t_billranap.KDDOKTER=m_dokter.KDDOKTER)    
WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billranap.KODETARIF!='07' and t_billranap.KDPOLY='$databr[KDPOLY]' and t_billranap.STATUS!='BATAL' order by m_tarif2012.kode_gruptindakan,m_tarif2012.nama_tindakan ASC ";


								$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
								while ($databr2 = mysql_fetch_array($qrybr2)) {

									if ($no % 2 == 0) $warna = $warnaGenap;
									else $warna = $warnaGanjil;
									$no++;
								?>

									<form action="./kasir_rekap/pasien_ranap_v_jm.php" method="post" enctype="multipart/form-data">
										<tr bgcolor="<? echo $warna ?>">
											<td align="center" valign="top"><? echo $no; ?></td>
											<td align="center"><?= $databr2['TANGGAL'] ?></td>
											<td><?= $databr2['nama_tindakan']; ?>
												<input name="qty_lama" type="hidden" value="<?= $databr2['QTY']; ?>">
												<input name="IDXBILL" type="hidden" value="<?= $databr2['IDXBILL']; ?>">
												<input name="NOBILL" type="hidden" value="<?= $databr2['NOBILL']; ?>">
												<input name="CARABAYAR" type="hidden" value="<?= $databr2['CARABAYAR']; ?>">
												<input name="id_admission" type="hidden" value="<?= $_GET['id_admission']; ?>">
												<input name="kode" type="hidden" value="<?= $databr2['KODETARIF']; ?>">
												<input name="opsi" type="hidden" value="edit">
											</td>
											<td align="left"><?= $databr2['NAMADOKTER']; ?></td>
											<td align="right"><? echo number_format(($databr2['TARIFRS']), 2, ',', '.'); ?></td>
											<td align="center"><?= $databr2['QTY']; ?></td>
											<td align="right"><? echo number_format($databr2['jumlah'], 2, ',', '.'); ?></td>
											<td width="3%" align="right"> <? if (empty($databr2['NONOTA'])) { ?> <input name="qty" type="text" style=" width:30px;height:18px;padding-left:3px "><? } ?></td>
											<td width="3%"><? if (empty($databr2['NONOTA'])) { ?> <input type="Submit" value="Save" style="font-size:10px;padding:5px" class="btn success" /><? } ?></td>
											<td align="right" style="padding:10px"><? if (empty($databr2['NONOTA'])) { ?> <a href="./kasir_rekap/pasien_ranap_v_jm.php?opsi=hapus&id_admission=<?= $_GET['id_admission'] ?>&IDXBILL=<?= $databr2['IDXBILL'] ?>&NOBILL=<?= $databr2['NOBILL'] ?>&CARABAYAR=<?= $databr2['CARABAYAR'] ?>" class="btn danger" style="color:#FFFFFF;padding:5px ">X</a><? } ?></td>
										</tr>
									</form>
								<? } ?>
								<tr style="font-weight:bold" bgcolor="#FFFFFF">
									<td colspan="6" align="right">Sub Total&nbsp;&nbsp;</td>
									<td align="right">
										<?

										$selectr = mysql_query("SELECT IDXBILL,SUM(jumlah) as jumlah_ranap 
FROM t_billranap 
WHERE  IDXDAFTAR='" . $_GET['id_admission'] . "' and KDPOLY='$databr[KDPOLY]' and KODETARIF!='07' and STATUS!='BATAL' order by IDXBILL asc ");
										$datar = mysql_fetch_array($selectr);
										echo number_format(($datar['jumlah_ranap']), 2, ',', '.');
										?> </td>
									<td align="right">&nbsp;</td>
									<td align="right">&nbsp;</td>
									<td align="right">&nbsp;</td>
								</tr>
							</table>
							<br />
						<? } ?>


						<a style="font-size:14px;font-weight:bold">DATA TERHAPUS</a>
						<table width="100%" cellpadding="0px" cellspacing="0px">
							<tr style="font-weight:bold" bgcolor="#ccc">
								<td width="5%">No</td>
								<td width="80">Tanggal</td>
								<td>Uraian</td>
								<td width="10%" align="right">Dokter</td>
								<td width="10%" align="right">Tarif</td>
								<td width="5%" align="center">Qty</td>
								<td width="15%" align="right">Jumlah</td>
								<td width="5%" align="center">OPSI</td>
							</tr>
							<?php
							$no = 0;
							$warnaGenap = "#f1f2f5";   // warna abu-abu
							$warnaGanjil = "#fff";  // warna putih
							$sqlbr2	= "SELECT t_billranap.KDPOLY,t_billranap.TANGGAL,t_billranap.IDXBILL,t_billranap.NOBILL,t_billranap.NONOTA,t_billranap.CARABAYAR,t_billranap.QTY,t_billranap.TARIFRS,t_billranap.jumlah,m_tarif2012.nama_tindakan, m_dokter.NAMADOKTER
FROM t_billranap
LEFT JOIN m_tarif2012 ON (m_tarif2012.kode_tindakan=t_billranap.KODETARIF)  
LEFT JOIN m_dokter ON (t_billranap.KDDOKTER=m_dokter.KDDOKTER)    
WHERE t_billranap.IDXDAFTAR='" . $_GET['id_admission'] . "' and t_billranap.KODETARIF!='07' and t_billranap.STATUS='BATAL' order by t_billranap.IDXBILL ASC ";


							$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
							while ($databr2 = mysql_fetch_array($qrybr2)) {

								if ($no % 2 == 0) $warna = $warnaGenap;
								else $warna = $warnaGanjil;
								$no++;
							?>
								<tr bgcolor="<? echo $warna ?>">
									<td align="center" valign="top"><? echo $no; ?></td>
									<td align="center"><?= $databr2['TANGGAL'] ?></td>
									<td><?= $databr2['nama_tindakan']; ?> </td>
									<td align="right"><?= $databr2['NAMADOKTER']; ?></td>
									<td align="right"><? echo number_format(($databr2['TARIFRS']), 2, ',', '.'); ?></td>
									<td align="center"><?= $databr2['QTY']; ?></td>
									<td align="right"><? echo number_format($databr2['jumlah'], 2, ',', '.'); ?></td>
									<td align="right" style="padding:10px"><? if (empty($databr2['NONOTA'])) { ?> <a href="./kasir_rekap/pasien_ranap_v_jm.php?opsi=ralat&id_admission=<?= $_GET['id_admission'] ?>&IDXBILL=<?= $databr2['IDXBILL'] ?>&NOBILL=<?= $databr2['NOBILL'] ?>&CARABAYAR=<?= $databr2['CARABAYAR'] ?>" class="btn info" style="color:#FFFFFF;padding:5px ">Batal</a><? } ?></td>
								</tr>
							<? } ?>
						</table>
						<br /> <br /> <br />
						<div align="right">
							<a href="index.php?link=PILIH PASIEN&id_admission=<?= $_GET['id_admission'] ?>" style="color:#FFFFFF" class="btn success">Selesai</a>
						</div>
					</div>


					</p>
				</div>
			</div>
		<? } ?>

		<script type="text/javascript">
			var rupiah = document.getElementById('rupiah');
			rupiah.addEventListener('keyup', function(e) {
				// tambahkan 'Rp.' pada saat form di ketik
				// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
				rupiah.value = formatRupiah(this.value, 'Rp.');
			});
			/* Fungsi formatRupiah */
			function formatRupiah(angka, prefix) {
				var number_string = angka.replace(/[^,\d]/g, '').toString(),
					split = number_string.split(','),
					sisa = split[0].length % 3,
					rupiah = split[0].substr(0, sisa),
					ribuan = split[0].substr(sisa).match(/\d{3}/gi);
				// tambahkan titik jika yang di input sudah menjadi angka ribuan
				if (ribuan) {
					separator = sisa ? '.' : '';
					rupiah += separator + ribuan.join('.');
				}
				rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
				return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
			}
		</script>



		<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			btn.onclick = function() {
				modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
				modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		</script>
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