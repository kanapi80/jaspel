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
		background: #3fbafe;
		color: white;
		cursor: pointer;
		padding: 10px;
		border-radius: 4px;
	}

	#balik:hover {
		background: radial-gradient(circle, #1fe4f5 10%, #3fbafe 90%);
		font-size: 19px;
	}
</style>
<button onClick="topFunction()" id="balik" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
<?php
include("./include/connect.php");
$id = $_GET["id"];

$myquery = "SELECT a.IdRegisterKunjungan, a.NamaAsuransi, a.NomorRekamMedis, a.Ruangan
,a.TanggalMasuk, a.NamaPasien, a.Total FROM registerranap a WHERE a.IdRegisterKunjungan=$id ";
$get = mysql_query($myquery) or die(mysql_error());
$userdata = mysql_fetch_assoc($get);
$crb = $userdata['NamaAsuransi'];

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
							<div>
								<div class="row m-b-20">
									<div class="col-lg-6 ">
										<div class="table-responsive">
											<table class="table" style="font-size:11px">
												<tr>
													<td>No.Registrasi</td>
													<td>: <b><?php echo $userdata['IdRegisterKunjungan']; ?></b></td>
													<td width="13%" valign="top">Cara Bayar</td>
													<td width="23%">: <b><?php echo $userdata['NamaAsuransi']; ?></b></td>
												</tr>
												<tr>
													<td>No.RM
														</td>
													<td>: <?php echo $userdata['NomorRekamMedis']; ?></td>
													<td valign="top">Tgl. Kunjungan</td>
													<td>: <?php echo $userdata['TanggalMasuk']; ?></td>
												</tr>
												<tr>
													<td width="11%">Nama pasien</td>
													<td width="22%">: <b><?php echo $userdata['NamaPasien']; ?></b></td>
													<td valign="top">Ruangan </td>
													<td>: <?php echo $userdata['Ruangan']; ?></td>
												</tr>
												<tr>
													<td valign="top"></td>
													<td> <!--<?php echo $userdata['TGLLAHIR1']; ?> /
                                    <?php
									$a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
									echo "umur " . $a[years] . " tahun " . $a[months] . " bulan " . $a[days] . " hari"; ?>--></td>
													<td>&nbsp;</td>
													<td></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="col-lg-6 col-md-4 ">
										<table width="100%" class="table" style="font-size:11px">
											<tr>
												<td width="30%">Jumlah Biaya </td>
												<td width="70%">: <b>Rp.
														<?= number_format(($userdata['Total'] ), 2, ',', '.'); ?>
													</b></td>
											</tr>
											<tr>
												<td colspan="2">
												<form name="simpan"  method="post" action="./page/SaveKlaim.php">
												<input name="id" type="hidden" value="<?= $_GET[id]; ?>" />
        <input name="nip" type="hidden" id="nip" value="<?= $_SESSION[NIP]; ?>" />
        <input name="jmbayar" type="hidden" id="jmbayar" value="<?php echo " " . date("h:i:sa"); ?>" />
        <input name="link" type="hidden" id="link" value="<?= $_GET['link']; ?>" />
		<input name="realcost" type="hidden" id="link" value="<?= $userdata['Total'] ; ?>" />
        <input name="opp" type="hidden" id="opp" value="simpan" />
<div class="input-group mb-3">
  <input type="number"   name="jumlah" class="form-control form-control-sm" placeholder="Input Nilai Klaim" required  >
  <div class="input-group-append">
    <button class="btn btn-sm btn-outline-primary" type="submit" >Simpan</button></fom>
	<!-- <form name="insert"  method="post" action="./page/RealisasiKlaim.php">
	<input name="nip" type="hidden" id="nip" value="<?= $_SESSION[NIP]; ?>" />
        <input name="jmbayar" type="hidden" id="jmbayar" value="<?php echo " " . date("h:i:sa"); ?>" />
        <input name="link" type="hidden" id="link" value="<?= $_GET['link']; ?>" />
		<input name="realcost" type="hidden" id="link" value="<?= $userdata['Total'] ; ?>" />
        <input name="opp" type="hidden" id="opp" value="simpan" />
	<button class="btn btn-sm btn-outline-primary" type="submit" >Realisasi</button></form> -->
	<!-- <a href="./page/BillingPasien.php?id=<?= $_GET['id'] ?>" target="_blank" ><button class="btn btn-sm btn-outline-primary" type="button" >Cetak</button></a> -->
<a href="./page/RealisasiKlaim.php?id=<?= $_GET['id'] ?>&op=insert&link=<?= $_GET['link'] ?>" target="_blank" ><button class="btn btn-sm btn-outline-primary" type="button" >Realisasi</button></a>
  
</div>
</div> </fom></td>
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
												<td ></td>
												<td><?php if ($status['JM'] == '' and $jm_st['status'] == 'ON') { ?>
														<!--<a href="page/FinalKlaimRajal.php?&jen=1&id_admission=<?= $_GET['id_admission'] ?>&nip=<?= $_SESSION['NIP'] ?>&periode=<?= $jm_st['periode']; ?>&link=<?= $_GET['link']; ?>&crb=<?= $crb; ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-edit" title="Period : <?= $jm_st['periode']; ?>"></i>&nbsp;&nbsp;Klaim&nbsp;&nbsp;</a>-->
														<a href="page/InsertPasien.php?&bulan=1&id=<?= $_GET['id'] ?>&nip=<?= $_SESSION['NIP'] ?>&periode=<?= $jm_st['periode']; ?>&link=<?= $_GET['link']; ?>&crb=<?= $crb; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit" title="Period : <?= $jm_st['periode']; ?>"></i>&nbsp;&nbsp;Pilih&nbsp;&nbsp;</a>
													<? } ?>
													<a href="./page/BillingPasien.php?id=<?= $_GET['id'] ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak&nbsp;&nbsp;</a>
												</td>
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

	<div class="col-lg-12">
		<div class="card">
			<!-- Tab panes -->
			<div class="card-body">
				<div class="table-responsive">
					<h5 class="card-title" style="color:#3fbafe"><b><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Tindakan&nbsp;<?= $data_rj['nama'] ?> </b></span></h5>

					<table width="100%" cellpadding="1px" cellspacing="0" id="myTable1" style="font-size:11px" border="0px">
						<tr>
							<th>NO</th>
							<th>TANGGAL PELAYANAN</th>
							<th>RUANGAN</th>
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
						$sqlbr2	= "SELECT  a.* FROM transaksiranap a WHERE a.IdRegisterKunjungan='" . $_GET['id'] . "'  Order By a.TanggalPelayanan,a.Poliklinik";
						$qrybr2 = mysql_query($sqlbr2) or die(mysql_error());
						while ($databr2 = mysql_fetch_array($qrybr2)) {
							if ($no % 2 == 0) $warna = $warnaGenap;
							else $warna = $warnaGanjil;
							$no++;
						?>
							<tr bgcolor="<? echo $warna ?>">
								<td align="center" valign="top"><? echo $no; ?></td>
								<td><?= $databr2['TanggalPelayanan'] ?></td>
								<td ><?= $databr2['Poliklinik'] ?></td>
								<td ><?= $databr2['NamaTindakan']; ?></td>
								<td  align="left"><? echo $databr2['NamaPelaksanaMedis']; ?></td>
								<td  align="right"><? echo number_format(($databr2['TotalTarif']), 2, ',', '.'); ?></td>
								<td  align="center"><? echo $databr2['Kuantitas']; ?></td>
								<td  align="right"><? echo number_format($databr2['TotalTarif'] * $databr2['Kuantitas'], 2, ',', '.'); ?></td>
							</tr>
						<? } ?>
						<tr style="font-weight:bold" bgcolor="#FFFFFF">
							<td colspan="7" align="right">Sub Total&nbsp;&nbsp;</td>
							<td align="right"> <? echo number_format($userdata['Total'], 2, ',', '.'); ?> </td>
						</tr>
					</table>
					<br />
				</div>
			</div>
		</div>
	</div>
</div>
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