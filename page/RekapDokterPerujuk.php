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
/*$poly = "";
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
*/
?>

<div class="table-responsive" style="padding-bottom:5px">
	<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
    <table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px" border="0px">
            <tr>
                <td width="12%">Asuransi<br><select name="crb" class="form-cari">
                        <option value="">-</option>
                        <?
                        $mysql     = mysql_query('select KODE,NAMA from m_carabayar WHERE KODE IN (2,3,4,8,9)  order by KODE asc');
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
                <td width="12%" valign="bottom">Periode
					<select style="width:100%" name="periode" id="periode" class="form-cari">
						<option value="0">-</option>
						<?
						$datadokter =mysql_query("SELECT a.periode,a.ket,b.NAMA FROM x_SettingKlaim a 
						left join m_carabayar b on b.KODE = a.KdCrb where b.KODE = '".$crb."' order by a.id ASC ") or die(mysql_error());
						while ($listdokter = mysql_fetch_array($datadokter)){
						?>
							<option value="<? echo $listdokter['periode']; ?>" <?php if ($listdokter['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>><? echo $listdokter['periode']; ?>-<? echo $listdokter['NAMA']; ?></option>
						<?
						}
						?>
					</select>
				</td>
                <!-- <td width="7%">Dokter<br />
                        <select style="height:22px;font-size:12px"  name="dokter" id="dokter" class="text" >
                          <option value="0">-</option>
                          <?
                            $datadokter = mysql_query("SELECT * FROM m_dokter where KDPROFESI IN(0,1) AND st_aktif ='0' AND NAMADOKTER!='Residen, dr' AND KDDOKTER!='99' AND NAMADOKTER!='-' order by NAMADOKTER ASC ") or die(mysql_error());
                            while ($listdokter = mysql_fetch_array($datadokter)) {
                            ?>
                          <option value="<? echo $listdokter['KDDOKTER']; ?>" <?php if ($listdokter['KDDOKTER'] == $_REQUEST['dokter']) : echo 'selected="selected"';
                                                                                endif; ?> ><? echo $listdokter['NAMADOKTER']; ?></option>
                          <?
                            }
                            ?>
                        </select></td>-->
                <td width="16%" valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" />
                    <button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>
                </td>
                <td width="38%">&nbsp;</td>
            </tr>
        </table>
	</form>
</div>

<?php
   $no=0;
/*				 $sql = "select sum(a.jumlah) as original,sum(a.JASA_PELAYANAN) AS J_PEL,SUM(a.operasional) AS J_RS_OPERASIONAL,
				 SUM(a.manajemen) AS J_RS_MANAJEMEN,SUM(a.MEDIS) AS J_MEDIS, SUM(a.MEDIS_UMUM) AS J_MEDIS_UMUM,SUM(a.PARAMEDIS) AS J_PARAMEDIS,
				 SUM(a.COSTSHARING) AS J_KEBERSAMAAN,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan,e.nama_gruptindakan,f.JM
				 from t_billrajal a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_poly c ON c.kode =a.UNIT 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				 left join t_pendaftaran f ON f.IDXDAFTAR = a.IDXDAFTAR
				where f.JM = '".$periode."'  and  a.CARABAYAR = '" . $crb . "' and c.jenispoly='0' and a.UNIT!='15' and a.UNIT!='16' and a.UNIT!='17' and a.UNIT!='20' and a.STATUS='SELESAI' AND e.kode_unit !='20'  GROUP BY a.UNIT ORDER BY c.nama asc";
				
				$qry	= mysql_query($sql); */
				
				 $sql ="select NamaPerujuk, SUM(Original) AS J_PELS,
SUM(JasaSarana) AS J_SARANA,
SUM(JasaPelayanan) AS J_PELAYANAN,
SUM(JasaRS) AS J_RS,
SUM(JasaPelaksana) AS J_PELAKSANA,
SUM(Operasional) AS J_OPERASIONAL,
SUM(Manajemen) AS J_MANAJEMEN,
SUM(Medis) AS J_MEDIS,
SUM(MedisUmum) AS J_MEDIS_UMUM,
SUM(Paramedis) AS J_PARAMEDIS,
SUM(Kebersamaan) AS J_KEBERSAMAAN
from t_jaspel
".$search." and KodeTindakan!='07' and KodeUnit!='15' and KodeUnit!='16' and KodeUnit!='17' and KodeUnit!='20' AND MedisUmum!='0.00' AND KodePerujuk!='1'  GROUP BY KodePerujuk order by NamaPerujuk ASC";
$qry	= mysql_query($sql);
			?>
			<div class="table-responsive">
									<table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px">
                <tr  align="center" style="border:1px solid #666666;font-weight:bold;color:#FFFFFF" bgcolor="#345534" >
                  <th width="3%" rowspan="2">NO</th>
                  <th width="13%" rowspan="2">NAMA DOKTER</th>
                  <th width="7%" rowspan="2">JASA ORIGINAL </th>
                  <th width="7%" rowspan="2">JASA PELAYANAN </th>
                  <th colspan="2">JASA RSUD</th>
                  <th colspan="4">JASA PELAKSANA </th>
                </tr>
                <tr  align="center" style="border:1px solid #666666">
                  <th width="7%">Operasional</th>
                  <th width="7%">Manajemen</th>
                  <th width="7%">Dokter  Spesialis</th>
                  <th width="7%">Dokter Umum </th>
                  <th width="7%">Paramedis</th>
                  <th width="7%">Kebersamaan</th>
                </tr>
                <?php
					while($data = mysql_fetch_array($qry)){
						$no++;
					?>
                <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr4"; }
                else {
                echo "tr2";
                }
        ?>>
                  <td align="center"><? echo $no; ?></td>
                  <td align="left"><? echo $data['NamaPerujuk']; ?></td>
                  <td align="right" ><? echo number_format($data['J_PELS'],2,',','.'); ?></td>
                  <td align="right" ><?=number_format($data['J_PELAYANAN'],2,',','.');?></td>
                  <td align="right"><? echo number_format($data['J_OPERASIONAL'],2,',','.'); ?></td>
                  <td align="right"><? echo number_format($data['J_MANAJEMEN'],2,',','.'); ?></td>
                  <td align="right"><? echo number_format($data['J_MEDIS'],2,',','.');?></td>
                  <td align="right"><? echo number_format($data['J_MEDIS_UMUM'],2,',','.'); ?></td>
                  <td align="right"><? echo number_format($data['J_PARAMEDIS'],2,',','.');  ?></td>
                  <td align="right"><? echo number_format($data['J_KEBERSAMAAN'],2,',','.');  ?></td>
                </tr>
                <?	} ?>
                <?php
			

$sql2= "select  NamaPerujuk, SUM(Original) AS JR_PELS,
SUM(JasaSarana) AS JR_SARANA,
SUM(JasaPelayanan) AS JR_PELAYANAN,
SUM(JasaRS) AS JR_RS,
SUM(JasaPelaksana) AS JR_PELAKSANA,
SUM(Operasional) AS JR_OPERASIONAL,
SUM(Manajemen) AS JR_MANAJEMEN,
SUM(Medis) AS JR_MEDIS,
SUM(MedisUmum) AS JR_MEDIS_UMUM,
SUM(Paramedis) AS JR_PARAMEDIS,
SUM(Kebersamaan) AS JR_KEBERSAMAAN
from t_jaspel
".$search." and KodeTindakan!='07' and KodeUnit!='15' and KodeUnit!='16' and KodeUnit!='17' and KodeUnit!='20' and MedisUmum !='0.00' AND KodePerujuk !='1' ";
$qry2	= mysql_query($sql2);
$data2 = mysql_fetch_array($qry2); 

?>
               <tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
                  <td align="center" ></td>
                  <td align="center" >JUMLAH</td>
                  <td align="right" ><? echo number_format($data2['JR_PELS'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['JR_PELAYANAN'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['JR_OPERASIONAL'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['JR_MANAJEMEN'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['JR_MEDIS'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['JR_MEDIS_UMUM'],2,',','.');?></td>
                  <td align="right" ><? echo number_format($data2['JR_PARAMEDIS'],2,',','.');?></td>
                  <td align="right" ><? echo number_format($data2['JR_KEBERSAMAAN'],2,',','.');?></td>
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
