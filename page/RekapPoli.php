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


/*if (!empty($_GET['tahun'])) {
    $tahuns = $_GET['tahun'];
} else {
    $tahuns = date('Y');
}
if (!empty($_GET['bulan'])) {
    $bulans = $_GET['bulan'];
} else {
    $bulans = date('m');
}*/
//$periode="$tahuns-$bulans"; 

$periode = $_GET['periode'];
//$search = ' WHERE f.keluarrs like "'.$periode.'%" ';
//$search = ' WHERE JM ="'.$periode.'" ';

$crb = "";
if (!empty($_GET['crb'])) {
    $crb = $_GET['crb'];
}

if ($crb != "") {
    $search = $search . " AND a.CARABAYAR ='" . $crb . "' ";
}
$dokter = "";
if (!empty($_GET['dokter'])) {
    $dokter = $_GET['dokter'];
}

if ($dokter != "") {
    $search = " WHERE a.KDDOKTER ='" . $dokter . "'  ";
}

?>

<div class="table-responsive" style="padding-bottom:5px">
	<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
    <table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px" border="0px">
            <tr>
                <td width="12%">Asuransi<br><select name="crb" class="form-cari">
                        <option value="">-</option>
                        <?
                        $mysql     = mysql_query('select KODE,NAMA from m_carabayar WHERE KODE IN (2,3,4,9)  order by KODE asc');
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
						$datadokter = mysql_query("SELECT periode,ket FROM x_SettingKlaim  order by id ASC ") or die(mysql_error());
						while ($listdokter = mysql_fetch_array($datadokter)) {
						?>
							<option value="<? echo $listdokter['periode']; ?>" <?php if ($listdokter['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>><? echo $listdokter['periode']; ?>-<? echo $listdokter['ket']; ?></option>
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
$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
				 $sql = "select sum(a.jumlah) as original,sum(a.JASA_PELAYANAN) AS J_PEL,SUM(a.operasional) AS J_RS_OPERASIONAL,
				 SUM(a.manajemen) AS J_RS_MANAJEMEN,SUM(a.MEDIS) AS J_MEDIS, SUM(a.MEDIS_UMUM) AS J_MEDIS_UMUM,SUM(a.PARAMEDIS) AS J_PARAMEDIS,
				 SUM(a.COSTSHARING) AS J_KEBERSAMAAN,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan,e.nama_gruptindakan,f.JM
				 from t_billrajal a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_poly c ON c.kode =a.UNIT 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				 left join t_pendaftaran f ON f.IDXDAFTAR = a.IDXDAFTAR
				where f.JM = '".$periode."'  and  a.CARABAYAR = '" . $crb . "' and c.jenispoly='0' and a.UNIT!='15' and a.UNIT!='16' and a.UNIT!='17' and a.UNIT!='20' and a.STATUS='SELESAI' AND e.kode_unit !='20'  GROUP BY a.UNIT ORDER BY c.nama asc";
				
				$qry	= mysql_query($sql);
			?>
			<div class="table-responsive">
									<table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px">
                <tr  align="center" style="border:1px solid #666666;font-weight:bold;color:#FFFFFF" bgcolor="#345534" >
                  <th width="3%" rowspan="2">NO</th>
                  <th width="13%" rowspan="2">RUANGAN</th>
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
                  <td align="left"><? echo $data['NAMAPOLY']; ?></td>
                  <td align="right" ><? echo number_format($data['original'],2,',','.'); ?></td>
                  <td align="right" ><?=number_format($data['J_PEL'],2,',','.');?></td>
                  <td align="right"><? echo number_format($data['J_RS_OPERASIONAL'],2,',','.'); ?></td>
                  <td align="right"><? echo number_format($data['J_RS_MANAJEMEN'],2,',','.'); ?></td>
                  <td align="right"><? echo number_format($data['J_MEDIS'],2,',','.');?></td>
                  <td align="right"><? echo number_format($data['J_MEDIS_UMUM'],2,',','.'); ?></td>
                  <td align="right"><? echo number_format($data['J_PARAMEDIS'],2,',','.');  ?></td>
                  <td align="right"><? echo number_format($data['J_KEBERSAMAAN'],2,',','.');  ?></td>
                </tr>
                <?	} ?>
                <?php
				     $NO=0;
$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 

$sql2= "select  SUM(a.jumlah) as ORI,   f.TGLREG, SUM(a.JASA_PELAYANAN) AS JUMLAH,
SUM(a.jasa_rs) AS J_RSUD, SUM(a.jasa_pelaksana) AS J_PELAYANAN,
SUM(a.operasional) AS OPERASIONAL,SUM(a.manajemen) AS MANAJEMEN,
SUM(a.MEDIS) AS MEDIS,SUM(a.MEDIS_UMUM) AS MEDIS_UM
,SUM(a.PARAMEDIS) AS PARAMEDIS,SUM(a.COSTSHARING) AS KEBERSAMAAN,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan,f.JM
		 from t_billrajal a
		 left join m_pasien b ON b.NOMR = a.NOMR 
		 left join m_poly c ON c.kode =a.UNIT
		 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
		 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
		 left join t_pendaftaran f ON f.IDXDAFTAR = a.IDXDAFTAR
		where f.JM ='".$periode."' and  a.CARABAYAR = '" . $crb . "' and c.jenispoly='0' and a.UNIT!='15' and a.UNIT!='16' and a.UNIT!='17' and a.UNIT!='20' and a.STATUS='SELESAI' AND e.kode_unit !='20'";
$qry2	= mysql_query($sql2);
$data2 = mysql_fetch_array($qry2);

?>
               <tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
                  <td align="center" ></td>
                  <td align="center" >JUMLAH</td>
                  <td align="right" ><? echo number_format($data2['ORI'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['JUMLAH'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['OPERASIONAL'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['MANAJEMEN'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['MEDIS'],2,',','.'); ?></td>
                  <td align="right" ><? echo number_format($data2['MEDIS_UM'],2,',','.');?></td>
                  <td align="right" ><? echo number_format($data2['PARAMEDIS'],2,',','.');?></td>
                  <td align="right" ><? echo number_format($data2['KEBERSAMAAN'],2,',','.');?></td>
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
