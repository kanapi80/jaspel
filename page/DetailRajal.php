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
		background: #3fbafe;
		color: white;
		cursor: pointer;
		padding: 15px;
		border-radius: 4px;
	}

	#balik:hover {
		background: radial-gradient(circle, #1fe4f5 10%, #3fbafe 90%);
		font-size: 19px;
	}
</style>
<button onClick="topFunction()" id="balik" title="Go to top"><i class="fa fa-angle-double-up"></i></button>

<?php
include("include/connect.php");
require_once('new_pagination.php');

// $periode = $_GET['periode'];
// $search = ' WHERE Periode = "' . $periode . '" ';

$idx = "";
if (!empty($_GET['idx'])) {
	$idx = $_GET['idx'];
}
if ($idx != "") {
	$search = $search . " AND b.IdRegisterKunjungan LIKE '%" . $idx . "%' ";
}



$norm = "";
if (!empty($_GET['norm'])) {
	$norm = $_GET['norm'];
}
if ($norm != "") {
	$search = $search . " and b.NomorRekamMedis LIKE '%" . $norm . "%' ";
}
// $per = "";
// if (!empty($_GET['per'])) {
// 	$per = $_GET['per'];
// }
// if ($per != "") {
// 	$search = $search . " and cek='" . $per . "' ";
// }
// $ruangan = "";
// if (!empty($_GET['ruangan'])) {
// 	$ruangan = $_GET['ruangan'];
// }
// if ($ruangan != "") {
// 	$search = $search . " and Ruangan ='" . $ruangan . "' ";
// }
//$crb = "";
// $crb = $stts['KdCrb'];
// if (!empty($_GET['crb'])) {
// 	$crb = $_GET['crb'];
// }
// if ($crb != "") {
// 	$search = $search . " and NamaAsuransi='" . $crb . "' ";
// }
/*if (!empty($_GET['urut'])) {
	$urut = $_GET['urut'];
} else {
	$urut = "NO_PESERTA";
}*/
$nama = "";
if (!empty($_GET['nama'])) {
	$nama = $_GET['nama'];
}
if ($nama != "") {
	$search = $search . " and b.NamaPasien LIKE '%" . $nama . "%' ";
}
// $dokter = "";
// if (!empty($_GET['dokter'])) {
// 	$dokter = $_GET['dokter'];
// }
// if ($dokter != "") {
// 	$search = $search . " and SMF LIKE '%" . $dokter . "%' ";
// }
?>

<div class="table-responsive" style="padding-bottom:5px">
	<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px;" border="0px">
			<tr>
				<td width="12%">Asuransi<br>

				</td>
				<td width="7%">
					Poliklinik <br />

				</td>
				<td width="8%">Dokter<br />

				</td>
				<td width="9%">No.Reg
					<input type="form-cari" name="idx" value="<? if ($idx != "") {
																	echo $idx;
																} ?>" class="form-cari" />
				</td>
				<td width="9%">&nbsp;No.Medrek<br />
					<input type="form-cari" name="nomr" value="<? if ($nomr != "") {
																	echo $nomr;
																} ?>" class="form-cari" />
				</td>
				<td width="12%" valign="bottom">Periode

				</td>

				<td valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" />
					<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>
				</td>

			</tr>
		</table>
	</form>
</div>

<?php
$no;
$sql = "SELECT a.*,b.NomorRekamMedis,b.NamaPasien,b.NamaAsuransi,b.TanggalPulang,b.Ruangan FROM transaksirajal a
left join registerrajal b ON b.IdRegisterKunjungan=a.IdRegisterKunjungan
" . $search . " and a.KelompokTindakan !='PENJUALAN' order by a.IdRegisterKunjungan limit 10
 ";
$qry = mysql_query($sql);
?>
<div class="table-responsive">
	<table width="100%" cellpadding="0px" cellspacing="0" id="myTable1" style="font-size:9px" border="1px">
		<tr align="center">
			<th>NO</th>
			<th>TANGGAL PULANG</th>
			<th>NO.REG</th>
			<th>NO.RM</th>
			<th>NAMA PASIEN</th>
			<th>CARA BAYAR</th>
			<th>RUANGAN</th>
			<th>NAMA TINDAKAN</th>
			<th>KELOMPOK TINDAKAN</th>
			<th>TARIF </th>
			<th>SARANA </th>
			<th>JASA PELAKSANA </th>
			<th>JASA MEDIS </th>
			<th>JASA PARAMDEIS </th>
			<th>JASA KEBERSAMAAN </th>
		</tr>
		</tr>
		<?php
		while ($data = mysql_fetch_array($qry)) {
			$no++;
		?>
			<tr <? echo "class =";
				$count++;
				if ($count % 2) {
					echo "tr4";
				} else {
					echo "tr2";
				}
				?>>
				<td align="center"><? echo $no; ?></td>
				<td><? echo $data['TanggalPulang'] ?></td>
				<td><? echo $data['IdRegisterKunjungan'] ?></td>
				<td><? echo $data['NomorRekamMedis'] ?></td>
				<td align="left"><? echo $data['NamaPasien']; ?></td>
				<td align="left"><? echo $data['NamaAsuransi']; ?></td>
				<td align="left"><? echo $data['Ruangan']; ?></td>
				<td align="left"><? echo $data['NamaTindakan']; ?></td>
				<td align="left"><?= $data['KelompokTindakan']; ?></td>
				<td align="right"><?= number_format($data['TotalTarif'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['TarifJasaSarana'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['TarifJasaPelaksana'], 2, ',', '.'); ?></td>
				<td align="right"></td>
				<td align="right"></td>
				<td align="right"></td>
			</tr> <?	} ?>
		<?php

		$sql2 = "SELECT sum(a.TarifJasaSarana) as JsSarana,sum(a.TarifJasaPelaksama) as JsPelaksana 
		FROM transaksirajal a
		left join registerrajal b ON b.IdRegisterKunjungan=a.IdRegisterKunjungan
		" . $search . " and a.KelompokTindakan !='PENJUALAN'  limit 10 ";
		$qry2	= mysql_query($sql2);
		$data2 = mysql_fetch_array($qry2);

		?>

		<tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
			<td align="center"></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center">&nbsp;</td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="right"></td>
			<td align="right"><?= number_format($data2['JsSarana'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['JsPelaksana'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['JsPelaksana'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['JsPelaksana'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['JsPelaksana'], 2, ',', '.'); ?></td>
		</tr>
	</table>
	<!-- <blockquote><a href="kasir_rekap/export_detail_jasa_poli.php?poly=<?= $_GET['poly'] ?>&dokter=<?= $_GET['dokter'] ?>&carabayar=<?= $_GET['carabayar'] ?>&tgl_reg=<?= $_GET['tgl_reg'] ?>&tgl_reg2=<?= $_GET['tgl_reg2'] ?>">Export Excel</a>  </blockquote>-->
</div>
</div>
</div>
</div>

<script>
	//Get the button
	var mybutton = document.getElementById("balik");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {
		scrollFunction()
	};

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