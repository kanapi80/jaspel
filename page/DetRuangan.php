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


$periode = $_GET['periode'];
$search = ' WHERE Periode = "' . $periode . '" ';

$crb = "";
if (!empty($_GET['crb'])) {
    $crb = $_GET['crb'];
}
if ($crb != "") {
    $search = $search . " AND KodeBayar ='" . $crb . "' ";
}
$poly = "";
if (!empty($_GET['poly'])) {
	$poly = $_GET['poly'];
}
if ($poly != "") {
	$search = $search . " AND KodePoly ='" . $poly . "' ";
}
$dokter = "";
if (!empty($_GET['dokter'])) {
	$dokter = $_GET['dokter'];
}

if ($dokter != "") {
	$search = $search . " AND KodeDokter ='" . $dokter . "' ";
}
$idx = "";
if (!empty($_GET['idx'])) {
	$idx = $_GET['idx'];
}
if ($idx != "") {
	$search = $search . " AND IdxDaftar LIKE '%" . $idx . "%' ";
}

$nomr = "";
if (!empty($_GET['nomr'])) {
	$nomr = $_GET['nomr'];
}

if ($nomr != "") {
	$search = $search . " AND Nomr LIKE '%" . $nomr . "%' ";
}
?>

<div class="table-responsive" style="padding-bottom:5px">
	<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
	<table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px;" border="0px">
			<tr>
			<td width="12%" >Asuransi<br><select  name="crb" class="form-cari">
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
			<td width="7%">
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
					<select style="width:100%" name="periode" id="periode" class="form-cari">
						<option value="0">-</option>
						<?
						$datadokter = mysql_query("SELECT a.periode,a.ket,b.NAMA FROM x_SettingKlaim a 
						left join m_carabayar b on b.KODE = a.KdCrb where a.KdCrb = '".$crb."' order by a.id DESC ") or die(mysql_error());
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
$sql="SELECT * FROM t_jaspel_ranap
" . $search . " and KodeTindakan!='07' and KodeUnit ='19' and JasaPelayanan !='0.00' order by Tanggal,Nomr ";
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
			<th rowspan="2">NAMA DOKTER</th>
			<th rowspan="2">TINDAKAN </th>
			<th rowspan="2">ORIGINAL </th>
			<th colspan="2">UNSUR JASA </th>
			<th colspan="2">JASA PELAYANAN </th>
			<th colspan="2">JASA RSUD </th>
			<th colspan="4">JASA PELAKSANA </th>
		</tr>
		<tr align="center">
			<th> SARANA </th>
			<th> PELAYANAN </th>
			<th> RSUD </th>
			<th> PELAKSANA </th>
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
				<td><? echo $data['IdxDaftar'] ?><!--<? echo $data['carabayar'] ?>--></td>
				<td><? echo $data['TglReg']; ?></td>
				<td align="left"><? echo $data['Nomr'] ?></td>
				<td align="left"><? echo $data['NamaPasien']; ?></td>
				<td align="left"><? echo $data['NamaPoly']; ?></td>
				<td align="left"><? echo $data['NamaDokter']; ?></td>
				<td align="left"><?= $data['NamaTindakan']; ?></td>
				<td align="right"><?= number_format($data['Original'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['JasaSarana'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['JasaPelayanan'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['JasaRS'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['JasaPelaksana'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['Operasional'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['Manajemen'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['Medis'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['MedisUmum'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['Paramedis'], 2, ',', '.'); ?></td>
				<td align="right"><?= number_format($data['Kebersamaan'], 2, ',', '.'); ?></td>
			</tr> <?	} ?>
		<?php
		$sql2 = "select SUM(Original) AS J_PELS,
SUM(JasaSarana) AS J_SARANA,
SUM(JasaPelayanan) AS J_PELAYANAN,
SUM(JasaRS) AS J_RS,
SUM(JasaPelaksana) AS J_PELAKSANA,
SUM(Operasional) AS J_OPERASIONAL,
SUM(Manajemen) AS J_MANAJEMEN,
SUM(Medis) AS J_MEDIS,
SUM(MedisUmum) AS J_MEDIS_UMUM,
SUM(Paramedis) AS J_PARAMEDIS,
SUM(Kebersamaan) AS J_BERSAMA
from t_jaspel_ranap
".$search." and KodeTindakan!='07' and KodeUnit ='19' and JasaPelayanan !='0.00'   ";
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
