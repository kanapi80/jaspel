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
//$search = ' WHERE f.keluarrs like "'.$periode.'%" ';
$search = ' WHERE JM ="' . $periode . '" ';

$crb = "";
if (!empty($_GET['crb'])) {
	$crb = $_GET['crb'];
}

if ($crb != "") {
	$search = $search . " AND a.CARABAYAR ='" . $crb . "' ";
}
$poly = "";
if (!empty($_GET['poly'])) {
	$poly = $_GET['poly'];
}

if ($poly != "") {
	$search = $search . " AND c.ket_ruang ='" . $poly . "' ";
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
if (!empty($_GET['urut'])) {
	$urut = $_GET['urut'];
} else {
	$urut = "f.keluarrs";
}
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
					<h5 class="card-title ">Detail Rawat Inap </h5>

				</div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
							<div>

								<div class="table-responsive" style="padding-bottom:5px">
											<form name="formsearch" method="get" action="<?php $_SERVER['../page/PHP_SELF']; ?>">
											<table width="100%" cellpadding="0px" cellspacing="0" style="font-size:10px" border="0px">
												<tr>
													<th width="12%" >Asuransi<br><select  name="crb" class="form-cari">
															<option value="">-</option>
															<?
															$mysql 	= mysql_query('select KODE,NAMA from m_carabayar WHERE KODE IN (2,3,4,9)  order by KODE asc');
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
													</th>
													<th width="10%"> Ruang &nbsp;&nbsp;
														<select class="form-cari" name="poly" id="poly">
															<option value="0">-</option>
															<?
															$qrypoly = mysql_query("SELECT * FROM m_ruang group by ket_ruang ORDER by ket_ruang ASC ") or die(mysql_error());
															while ($listpoly = mysql_fetch_array($qrypoly)) {
															?>
																<option value="<? echo $listpoly['ket_ruang']; ?>" <?php if ($listpoly['ket_ruang'] == $_REQUEST['poly']) : echo 'selected="selected"';
																													endif; ?>><? echo $listpoly['ket_ruang']; ?></option>
															<?
															}
															?>
														</select>
													</th>
													<th width="14%">Dokter
														<select class="form-cari" name="dokter" id="dokter" style="width:100%">
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
													</th>
													<th width="12%">No.Reg
														<input type="text" class="form-cari" name="no_sep" value="<? if ($no_sep != "") {
																																echo $no_sep;
																															} ?>" />
													</th>
													<th width="12%">No.Medrek<br />
														<input type="text" class="form-cari" name="nomr" value="<? if ($nomr != "") {
																																echo $nomr;
																															} ?>" />
													</th>
													<th width="12%" valign="bottom">Periode
					<select style="width:100%" name="periode" id="periode" class="form-cari">
						<option value="0">-</option>
						<?
						$datadokter = mysql_query("SELECT periode,ket FROM x_SettingKlaim  order by id ASC ") or die(mysql_error());
						while ($listdokter = mysql_fetch_array($datadokter)) {
						?>
							<option value="<? echo $listdokter['periode']; ?>" <?php if ($listdokter['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>><? echo $listdokter['periode']; ?>-<? echo $listdokter['ket']; ?></option>
						<?
						}
						?>
					</select>
				</th>
													<th  width="11%" valign="bottom">Urut
														<select class="form-cari" name="urut">
															<option value="f.keluarrs" <? if ($urut == "f.keluarrs") echo "selected='selected'"; ?>>TGL.PULANG</option>
															<option value="e.nama_gruptindakan" <? if ($urut == "e.nama_gruptindakan") echo "selected='selected'"; ?>>GRUP TINDAKAN</option>
														</select>
													</th>
													<th width="15%" valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" /><br>
														<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>
													</th>
													<td width="22%">&nbsp;</td>
												</tr>
											</table>
										</form>
								</div>
							
								<?php
								$no =  0;
								$sql = "select a.*,b.NAMA,c.ket_ruang as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan,e.nama_gruptindakan,DATE_FORMAT(f.keluarrs,'%Y-%m-%d')PULANG
				 from t_billranap a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_ruang c ON c.no =a.KDPOLY 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				 left join t_admission f ON f.id_admission = a.IDXDAFTAR
				" . $search . " and  a.UNIT ='19' and a.JASA_PELAYANAN !='0.00'  ORDER BY $urut asc";
								$qry	= mysql_query($sql);
								?>
								<div class="table-responsive">
									<table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px">
										<tr align="center" style="border:1px solid #666666">
											<th width="3%" rowspan="2">NO</th>
											<th width="13%" rowspan="2">RUANGAN</th>
											<th width="13%" rowspan="2">NAMA DOKTER </th>
											<th width="6%" rowspan="2">TGL.PULANG</th>
											<th width="6%" rowspan="2">NO.REG</th>
											<th width="14%" rowspan="2">NO.MR</th>
											<th width="14%" rowspan="2">NAMA PASIEN </th>
											<th width="13%" rowspan="2">GRUP TINDAKAN </th>
											<th width="13%" rowspan="2">TINDAKAN </th>
											<th width="13%" rowspan="2">ORIGINAL</th>
											<th colspan="2">UNSUR JASA </th>
											<th colspan="2">JASA PELAYANAN </th>
											<th colspan="2">JASA RSUD </th>
											<th colspan="4">JASA PELAKSANA </th>
										</tr>
										<tr align="center">
											<th width="7%"> SARANA </th>
											<th width="7%">JASA PELAYANAN </th>
											<th width="7%">JASA RSUD </th>
											<th width="7%">JASA PELAKSANA </th>
											<th width="7%">Opera<br>sional</th>
											<th width="7%">Mana<br>jemen</th>
											<th width="7%">Medis Sp </th>
											<th width="7%">Medis<br> Umum </th>
											<th width="7%">Para<br>medis</th>
											<th width="7%">Keber<br>samaan</th>
										</tr>
										<?php
										while ($data = mysql_fetch_array($qry)) {
											$no++;
											#	$jasaori=number_format(($data['jasaori'])); 

										?>

											<tr <? echo "class =";
												$count++;
												if ($count % 2) {
													echo "tr2";
												} else {
													echo "tr4";
												}
												?>>
												<td align="center"><? echo $no; ?></td>
												<td align="left"><? echo $data['NAMAPOLY']; ?></td>
												<td align="left"><? echo $data['NAMADOKTER']; ?></td>
												<td align="center"><? echo $data['PULANG'] ?></td>
												<td align="center"><? echo $data['IDXDAFTAR'] ?></td>
												<td align="center"><? echo $data['NOMR'] ?></td>
												<td align="left"><? echo $data['NAMA']; ?></td>
												<td align="left"><? echo $data['nama_gruptindakan']; ?></td>
												<td align="left"><? echo $data['nama_tindakan']; ?></td>
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
										$sql2 = "select 
SUM(a.jumlah) AS JUM,
SUM(a.JASA_SARANA) AS JS_SR,
SUM(a.JASA_PELAYANAN) AS JS_PL,SUM(a.jasa_rs) AS JS_RS,SUM(a.jasa_pelaksana) AS JS_PEL,
SUM(a.operasional) AS OPERASIONAL,SUM(a.manajemen) AS MANAJEMEN,
SUM(a.MEDIS) AS MEDIS,
SUM(a.MEDIS_UM) AS MEDIS_UM,
SUM(a.PARAMEDIS) AS PARAMEDIS,
SUM(a.COSTSHARING) AS KEBERSAMAAN
				 from t_billranap a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_ruang c ON c.no =a.KDPOLY 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				 left join t_admission f ON f.id_admission = a.IDXDAFTAR
				" . $search . " and a.CARABAYAR ='2' and  a.UNIT ='19' and a.JASA_PELAYANAN !='0.00'";
										$qry2 = mysql_query($sql2);
										$data2 = mysql_fetch_array($qry2);
										?>

										<tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
											<td colspan="9" align="right" >JUMLAH</td>
											<td align="right"><?= number_format($data2['JUM'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['JS_SR'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['JS_PL'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['JS_RS'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['JS_PEL'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['OPERASIONAL'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['MANAJEMEN'], 2, ',', '.'); ?></td>
											<td align="right"><?= number_format($data2['MEDIS'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['MEDIS_UM'], 2, ',', '.'); ?></td>
											<td align="right"><?= number_format($data2['PARAMEDIS'], 2, ',', '.'); ?></td>
											<td align="right" ><?= number_format($data2['KEBERSAMAAN'], 2, ',', '.'); ?></td>
										</tr>
									</table>
								</div>
								<!-- <blockquote><a href="kasir_rekap/export_detail_jasa_poli.php?poly=<?= $_GET['poly'] ?>&dokter=<?= $_GET['dokter'] ?>&carabayar=<?= $_GET['carabayar'] ?>&tgl_reg=<?= $_GET['tgl_reg'] ?>&tgl_reg2=<?= $_GET['tgl_reg2'] ?>">Export Excel</a>  </blockquote>-->


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
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>