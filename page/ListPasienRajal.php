<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<style>
	.alert {
		padding: 5px;
		margin: 0;
		background-color: #fef9f0;
		color: red;
	}
</style>
<script>
	$(document).ready(function() {
		$("#Bulanan").css("display", "<? if ($_GET['asal'] != "1") {
											echo "Block";
										} else {
											echo "none";
										} ?>"); //Menghilangkan form-input ketika pertama kali dijalankan
		$(".detail").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
			if ($("input[name='asal']:checked").val() == "2") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
				$("#Bulanan").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
			} else {
				$("#Bulanan").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
			}
		});
	});
</script>
<?php
session_start();
include("include/connect.php");
require_once('new_pagination.php');

/*
if (!empty($_GET['tahun'])) {
	$tahuns = $_GET['tahun'];
} else {
	$tahuns = date('Y');
}
if (!empty($_GET['bulan'])) {
	$bulans = $_GET['bulan'];
} else {
	$bulans = date('m');
}
if (!empty($_GET['tgl'])) {
	$tgl = $_GET['tgl'];
	$periode = "$tahuns-$bulans-$tgl";
} else {
	$periode = "$tahuns-$bulans";
}

*/
/*$asal = $_GET['asal'];
if ($asal != "1") {

	$search = $search . " and  a.TGLREG  is not null   ";
} else {
	$search = $search . " and DATE(a.keluarrs) is NULL ";
}*/

$no_sep = "";
if (!empty($_GET['no_sep'])) {
	$no_sep = $_GET['no_sep'];
}
if ($no_sep != "") {
	$search = $search . " AND IdRegisterKunjungan LIKE '%" . $no_sep . "%' ";
}



$norm = "";
if (!empty($_GET['norm'])) {
	$norm = $_GET['norm'];
}

if ($norm != "") {
	$search = $search . " and NomorRekamMedis LIKE '%" . $norm . "%' ";
}

$per = "";
if (!empty($_GET['per'])) {
	$per = $_GET['per'];
}

if ($per != "") {
	$search = $search . " and cek='" . $per . "' ";
}

$ruangan = "";
if (!empty($_GET['ruangan'])) {
	$ruangan = $_GET['ruangan'];
}

if ($ruangan != "") {
	$search = $search . " and Ruangan ='" . $ruangan . "' ";
}
//$crb = "";
$crb = $stts['NamaAsuransi'];
if (!empty($_GET['crb'])) {
	$crb = $_GET['crb'];
}

if ($crb != "") {
	$search = $search . " and NamaAsuransi='" . $crb . "' ";
}
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
	$search = $search . " and NamaPasien LIKE '%" . $nama . "%' ";
}
$dokter = "";
if (!empty($_GET['dokter'])) {
	$dokter = $_GET['dokter'];
}
if ($dokter != "") {
	$search = $search . " and SMF LIKE '%" . $dokter . "%' ";
}
?>


<div class="table-responsive" style="padding-bottom:3px">
	<form name="formsearch" method="get">
		<table width="100%" cellpadding="0px" cellspacing="0" style="font-size:10px" border="0px">
			<tr>
			<td width="110">Carabayar <br />
					<select style="font-size:11px;width:100%" name="crb" class="form-cari">
					<option value="<?=$stts['NamaAsuransi']; ?>"><?=$stts['NamaAsuransi'];?></option>
						<?
						$mysql 	= mysql_query('select*  from payment  where status=2');
						if (mysql_num_rows($mysql) > 0) {
							while ($dsql = mysql_fetch_array($mysql)) {

								if ($crb == $dsql['paymentname']) : $zx = 'selected="selected"';
								else : $zx = '';
								endif;
								echo '<option value="' . $dsql['paymentname'] . '" ' . $zx . '>' . $dsql['paymentname'] . '</option>';
							}
						}
						?>
					</select>				</td>
				<td width="90">No.Reg
					<input type="text" style="width:100%" name="no_sep" value="<? if ($no_sep != "") {
																					echo $no_sep;
																				} ?>" class="form-cari" />
				</td>
				<td width="90">No.RM <br />
					<input type="text" style="width:100%;" name="norm" value="<? if ($norm != "") {
																					echo $norm;
																				} ?>" class="form-cari" />
				</td>
				<td width="246">Nama Pasien <br />
					<input type="text" style="width:100%;" name="nama" value="<? if ($nama != "") {
																					echo $nama;
																				} ?>" class="form-cari" />
				</td>


				<td width="180">
					<input type="hidden" name="link" value="<?= $_GET['link']; ?>" />
					.<br />
					<button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>
				</td>
			</tr>
		</table>

	</form>
</div>
<div class="table-responsive">
	<table width="100%" cellpadding="0px" cellspacing="0" id="myTable1" style="font-size:10px" border="1px">

		<tr>
			<th width="24" align="center">NO</th>
			<th width="78" align="center">TANGGAL MASUK</th>
			<th width="78" align="center">TANGGAL PULANG</th>
			<th width="77" align="center">NO.REG</th>
			<th width="77" align="center">NOMR</th>
			<th width="270" align="left">NAMA </th>
			<th width="120" align="left">RUANGAN</th>
			<th width="100" align="right">REALCOST</th>
			<!-- <th width="100" align="right">KLAIM</th> -->
			<!-- <th width="140" align="center">DOKTER</th> -->
			<th width="120" align="center">CARABAYAR </th>
			<!-- <th width="70" align="center">PERIODE</th> -->
			<th width="30" align="center">AKSI</th>
		</tr>
		<?
		$i = 0;
		$sql = "SELECT * FROM registerrajal
where NamaAsuransi IN ('Jasa Raharja','JM') " . $search . " ORDER BY TanggalPulang ASC ";
		$pager = new PS_Pagination($connect, $sql, 10, 5,  "&nama=" . $nama . "&ruangan=" . $ruangan . "&crb=" . $crb . "&nomr=" . $nomr . "&per=" . $per . "&status=" . $status, "index.php?link=ListPasien&");

		//The paginate() function returns a mysql result set 
		$rs = $pager->paginate();
		if (!$rs) die(mysql_error());
		while ($data = mysql_fetch_array($rs)) {
			$i++; ?>
			<tr title="<?= $data['NamaPasien'] ?> (<?= $data['NamaPasien'] ?>)">
				<td align="center"><? if ((!isset($_REQUEST['page'])) or ($_REQUEST['page'] == 1)) {
										echo $i;
									} else {
										echo ($_REQUEST['page'] - 1) * 10 + $i;
									} ?></td>
				<td align="center"><?= $data['TanggalMasuk'] ?></td>
				<td align="center"><?= $data['TanggalPulang'] ?></td>
				<td align="center"><? echo $data['IdRegisterKunjungan']; ?></td>
				<td align="center"><? echo $data['NomorRekamMedis']; ?></td>
				<td><?php echo $data['NamaPasien']; ?></td>
				<td><?= $data['Ruangan'] ?></td>
				<td align="right"><?php echo number_format($data['Total']);?></td>
				<!-- <td align="right" >
				<button type="submit" class="<?php if($data['Total']<$data['NilaiRealisasi']){echo "btn btn-success btn-sm";} if($data['Total']>$data['NilaiRealisasi']){echo "btn btn-danger btn-sm";}if($data['Total']==$data['NilaiRealisasi']){echo "btn btn-info btn-sm";}?>"><?php if ($data['NamaAsuransi']=="BPJS / JKN") { echo number_format($data['NilaiRealisasi']);}else{ echo number_format($data['Total']);}?></button>	</td> -->
				<!-- <td align="left"><?= $data['SMF'] ?></td> -->
				<td align="center"><?php echo $data['NamaAsuransi'] ;?> </td>
				<!-- <td align="center"><?= $data['cek'] ?></td> -->
				<td align="center">
					<a href='index.php?link=PilihPasienRajal&id=<?= $data['IdRegisterKunjungan'] ?>' class="btn btn-sm btn-outline-success">&#187;</a>
				</td>
			</tr>
		<?	}
		?>
	</table>

	<?php

	//Display the full navigation in one go
	//echo $pager->renderFullNav();

	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";

	//Display the link to first page: First
	echo $pager->renderFirst() . " | ";

	//Display the link to previous page: <<
	echo $pager->renderPrev() . " | ";

	//Display page links: 1 2 3
	echo $pager->renderNav() . " | ";

	//Display the link to next page: >>
	echo $pager->renderNext() . " | ";

	//Display the link to last page: Last
	echo $pager->renderLast();

	echo "</div>";
	?>
	<br />
	<center><a href='./page/ExportListRajal.php?crb=<?= $_GET['crb']; ?>&per=<?= $_GET['per']; ?>' class="btn btn-sm btn-outline-success">Export Excel</a>
	</center>
</div>
</div>
</div>
</div>