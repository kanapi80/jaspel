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



if ($_REQUEST['bulan'] != '') {
	$bulan = $_REQUEST['bulan'];
} else {
	$bulan = date('m');
}
if ($_REQUEST['tahun'] != '') {
	$tahun = $_REQUEST['tahun'];
} else {
	$tahun = date('Y');
}
$periode = "$tahun-$bulan";
$periode = $_GET['periode'];
$search = ' WHERE b.JM = "' . $periode . '" ';

//$search = ' WHERE a.TANGGAL like "'.$periode.'%" ';  

$crb = "";
if (!empty($_GET['crb'])) {
    $crb = $_GET['crb'];
}

if ($crb != "") {
    $search = $search . " AND a.kode ='" . $crb . "' ";
}
$poly = "";
if (!empty($_GET['poly'])) {
	$poly = $_GET['poly'];
}

if ($poly != "") {
	$search = $search . " AND a.UNIT ='" . $poly . "' ";
}
$dokter = "";
if (!empty($_GET['dokter'])) {
	$dokter = $_GET['dokter'];
}

if ($dokter != "") {
	$search = $search . " AND a.KDDOKTER ='" . $dokter . "' ";
}
$no_sep = "";
if (!empty($_GET['no_sep'])) {
	$no_sep = $_GET['no_sep'];
}
if ($no_sep != "") {
	$search = $search . " AND a.IDXDAFTAR LIKE '%" . $no_sep . "%' ";
}

$nomr = "";
if (!empty($_GET['nomr'])) {
	$nomr = $_GET['nomr'];
}

if ($nomr != "") {
	$search = $search . " AND a.NOMR LIKE '%" . $nomr . "%' ";
}
$periode = "";
if (!empty($_GET['periode'])) {
	$periode = $_GET['periode'];
}

if ($periode != "") {
	$search = $search . " AND b.JM = '" . $periode . "' ";
}
/*if (!empty($_GET['urut'])) {
	$urut = $_GET['urut'];
} else {
	$urut = "a.TANGGAL";
}*/
?>

<div class="table-responsive" style="padding-bottom:5px">
	<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
	<table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px;" border="0px">
			<tr>
			<td width="8%" >Asuransi<br><select  name="crb" class="form-cari">
															<option value="">-</option>
															<?
															$mysql 	= mysql_query('select KODE,NAMA from m_carabayar WHERE KODE IN (2,3,4,8,9)  order by KODE asc');
															if (mysql_num_rows($mysql) > 0) {
																while ($dsql = mysql_fetch_array($mysql)) {

																	if ($crb == $dsql['KODE']) : $zx = 'selected="selected"';
																	else : $zx = '';
																	endif;
																	echo '<option value="' . $dsql['KODE'] . '" ' . $zx . '>' . $dsql['NAMA'] . '</option>';
																}
															}
															?>
														</select>
													</td>
			<!--	<td width="7%">
					Poliklinik <br /> <select  name="poly" id="poly" class="form-cari">
						<option value="0">-</option>
						<?
						$qrypoly = mysql_query("SELECT * FROM m_poly where jenispoly ='0' ORDER by nama ASC ") or die(mysql_error());
						while ($listpoly = mysql_fetch_array($qrypoly)) {
						?>
							<option value="<? echo $listpoly['kode']; ?>" <?php if ($listpoly['kode'] == $_REQUEST['poly']) : echo 'selected="selected"';
																			endif; ?>><? echo $listpoly['nama']; ?></option>
						<?
						}
						?>
					</select></td>
				<td width="8%">Dokter<br />
					<select name="dokter" id="dokter" class="form-cari">
						<option value="0">-</option>
						<?
						$datadokter = mysql_query("SELECT * FROM m_dokter where KDPROFESI IN(0,1,3) AND st_aktif ='0' AND NAMADOKTER!='Residen, dr' AND KDDOKTER!='99' order by NAMADOKTER ASC ") or die(mysql_error());
						while ($listdokter = mysql_fetch_array($datadokter)) {
						?>
							<option value="<? echo $listdokter['KDDOKTER']; ?>" <?php if ($listdokter['KDDOKTER'] == $_REQUEST['dokter']) : echo 'selected="selected"';
																				endif; ?>><? echo $listdokter['NAMADOKTER']; ?></option>
						<?
						}
						?>
					</select>
				</td>
				<td width="9%">No.Reg
					<input type="form-cari" name="no_sep" value="<? if ($no_sep != "") {
																								echo $no_sep;
																							} ?>" class="form-cari" />
				</td>
				<td width="9%">&nbsp;No.Medrek<br />
					<input type="form-cari" name="nomr" value="<? if ($nomr != "") {
																								echo $nomr;
																							} ?>" class="form-cari" />
				</td>-->
				<td width="8%" valign="bottom">Periode
					<select style="width:100%" name="periode" id="periode" class="form-cari">
						<option value="0">-</option>
						<?
						$datadokter = mysql_query("SELECT a.periode,a.ket,b.NAMA FROM x_SettingKlaim a 
						left join m_carabayar b on b.KODE = a.KdCrb order by a.id ASC ") or die(mysql_error());
						while ($listdokter = mysql_fetch_array($datadokter)) {
						?>
							<option value="<? echo $listdokter['periode']; ?>" <?php if ($listdokter['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>><? echo $listdokter['periode']; ?>-<? echo $listdokter['NAMA']; ?><!--<? echo $listdokter['ket']; ?>--></option>
						<?
						}
						?>
					</select>
				</td>
				<!--<td width="10%" valign="bottom">Urut<br />
					<select  name="urut" class="form-cari">
						<option value="a.TANGGAL" <? if ($urut == "a.TANGGAL") echo "selected='selected'"; ?>>TANGGAL</option>
						<option value="e.nama_tindakan" <? if ($urut == "e.nama_tindakan") echo "selected='selected'"; ?>>TINDAKAN</option>
					
					</select>
				</td>-->
				<td  valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" />
				<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>
				</td>
				
			</tr>
		</table>
	</form>
</div>

<?php
$no;
$sql="SELECT a.*,b.JM,c.nama as poly FROM detail_billrajal a
left join t_pendaftaran b ON b.IDXDAFTAR =a.IDXDAFTAR
 left join m_poly c ON c.kode=a.UNIT and c.jenispoly='1'
where b.JM = '$periode' and a.kode='$crb' and  a.UNIT IN ('16','17','15','20') and a.KODETARIF !='07' and a.JASA_PELAYANAN !='0.00' order by a.TANGGAL,c.nama ";
$qry=mysql_query($sql);
?>
<div class="table-responsive">
    <table width="100%" cellpadding="0px" cellspacing="0" id="myTable1" style="font-size:9px" border="1px">
		<tr align="center">
			<th rowspan="2">NO</th>
			<th rowspan="2">NO.REG</th>
			<th rowspan="2">TANGGAL </th>
			<th rowspan="2">NORM </th>
			<th rowspan="2">NAMA PASIEN</th>
			<th rowspan="2">RUANGAN</th>
			<th rowspan="2">TINDAKAN</th>
			<th rowspan="2">NAMA DOKTER </th>
			<th rowspan="2">ORIGINAL </th>
			<th colspan="2">UNSUR JASA </th>
			<th colspan="2">JASA PELAYANAN </th>
			<th colspan="2">JASA RSUD </th>
			<th colspan="4">JASA PELAKSANA </th>
		</tr>
		<tr align="center">
			<th> SARANA </th>
			<th>JASA PELAYANAN </th>
			<th>JASA RSUD </th>
			<th>JASA PELAKSANA </th>
			<th>Opera<br>sional</th>
			<th>Mana<br>jemen</th>
			<th>Medis Sp </th>
			<th>Medis<br> Umum </th>
			<th>Para<br>medis</th>
			<th>Keber<br>samaan</th>
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
				<td><? echo $data['IDXDAFTAR'] ?><!--<? echo $data['carabayar'] ?>--></td>
				<td><? echo $data['TANGGAL']; ?></td>
				<td align="left"><? echo $data['NOMR'] ?></td>
				<td align="left"><? echo $data['NAMA']; ?></td>
				<td align="left"><? echo $data['poly']; ?>-<? echo $data['NAMAPOLY']; ?></td>
				<td align="left"><?= $data['nama_tindakan']; ?></td>
				<td align="left"><? echo $data['NAMADOKTER']; ?></td>
				<td align="right"><?= number_format($data['jumlah'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['JASA_SARANA'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['JASA_PELAYANAN'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['jasa_rs'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['jasa_pelaksana'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['operasional'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['manajemen'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['MEDIS'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['MEDIS_UM'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['PARAMEDIS'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['COSTSHARING'], 2, ',', '.'); ?></td>
			</tr> <?	} ?>
		<?php
		/*$sql2 = "select a.TANGGAL, SUM(a.jumlah) AS J_PELS,
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
 inner join t_pendaftaran f ON f.IDXDAFTAR =a.IDXDAFTAR
 " . $search . " and a.KODETARIF!='07' and a.UNIT!='15' and a.UNIT!='16' and a.UNIT!='17' and a.UNIT!='20' and a.STATUS='SELESAI' AND e.kode_unit !='20' ";
		$qry2	= mysql_query($sql2);
		$data2 = mysql_fetch_array($qry2);
		*/
$sql2 = "select a.KODETARIF,a.UNIT,a.kode_unit, SUM(a.jumlah) AS J_PELS,
SUM(a.JASA_SARANA) AS J_SARANA,
SUM(a.JASA_PELAYANAN) AS J_PELAYANAN,
SUM(a.jasa_rs) AS J_RS,
SUM(a.jasa_pelaksana) AS J_PELAKSANA,
SUM(a.operasional) AS J_OPERASIONAL,
SUM(a.manajemen) AS J_MANAJEMEN,
SUM(a.MEDIS) AS J_MEDIS,
SUM(a.MEDIS_UM) AS J_MEDIS_UMUM,
SUM(a.PARAMEDIS) AS J_PARAMEDIS,
SUM(a.COSTSHARING) AS J_BERSAMA,b.JM
from detail_billrajal a
left join t_pendaftaran b ON b.IDXDAFTAR = a.IDXDAFTAR
 left join m_poly c ON c.kode=a.UNIT
where b.JM = '$periode' and a.kode='$crb' and  a.UNIT IN ('16','17','15','20') and a.KODETARIF !='07' and a.JASA_PELAYANAN !='0.00'  ";
		$qry2	= mysql_query($sql2);
		$data2 = mysql_fetch_array($qry2); 
		?>

<tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
			<td align="center"></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center">&nbsp;</td>
			<td align="center">JUMLAH</td>
			<td align="right"><?= number_format($data2['J_PELS'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_SARANA'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_PELAYANAN'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_RS'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_PELAKSANA'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_OPERASIONAL'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_MANAJEMEN'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_MEDIS'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_MEDIS_UMUM'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_PARAMEDIS'], 2, ',', '.'); ?></td>
			<td align="right"><?= number_format($data2['J_BERSAMA'], 2, ',', '.'); ?></td>
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
