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
// $periode="$tahun-$bulan";
$periode = $_GET['periode'];
$search = ' WHERE h.JM = "' . $periode . '" ';

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
if (!empty($_GET['urut'])) {
    $urut = $_GET['urut'];
} else {
    $urut = "a.TANGGAL";
}
?>

<div class="table-responsive" style="padding-bottom:5px">
    <form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
        <table width="100%" cellpadding="0px" cellspacing="0" class="tb" style="font-size:10px" border="0px">
            <tr>
                <td width="10%">Asuransi<br><select name="crb" class="form-cari">
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
                <td width="6%">
                    Poliklinik <br /> <select  name="poly" id="poly" class="form-cari">
                        <option value="0">-</option>
                        <?
                        $qrypoly = mysql_query("SELECT * FROM m_poly where jenispoly ='1' AND kode!='40'  ORDER by nama ASC ") or die(mysql_error());
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
                <td width="7%">No.Reg
                    <input type="form-cari" name="no_sep" value="<? if ($no_sep != "") {
                                                                                                echo $no_sep;
                                                                                            } ?>" class="form-cari" />
                </td>
                <td width="7%">&nbsp;No.Medrek<br />
                    <input type="form-cari" name="nomr" value="<? if ($nomr != "") {
                                                                                                echo $nomr;
                                                                                            } ?>" class="form-cari" />
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
                <td width="0%"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" /></td>
                <td width="7%">
                    Urut<br />
                    <select  width="4%"  name="urut" class="form-cari">
                        <option value="a.TANGGAL" <? if ($urut == "a.TANGGAL") echo "selected='selected'"; ?>>TANGGAL</option>
                        <option value="e.nama_tindakan" <? if ($urut == "e.nama_tindakan") echo "selected='selected'"; ?>>TINDAKAN</option>
                    </select>
                </td >  <td valign="bottom"><button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button><td>
                  </td>

            </tr>
        </table>
    </form>
</div>

<?php
$no =  0;
$sql = "select a.*, DATE_FORMAT(a.TANGGAL,'%d-%m-%Y') PERIODES,b.NAMA,c.nama as NAMAPOLY, d.NAMADOKTER,e.nama_tindakan,f.nama AS pj,h.JM
				 from t_billrajal a
				 left join m_pasien b ON b.NOMR = a.NOMR 
				 left join m_poly c ON c.kode =a.KDPOLY 
				 left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
				 left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
				 left join m_poly f ON f.kode=a.UNIT
				  left join t_pendaftaran h on h.IDXDAFTAR = a.IDXDAFTAR
				 " . $search . " and a.CARABAYAR !='8' and  a.UNIT IN ('16','17','15','20') and a.KODETARIF !='07' and a.JASA_PELAYANAN !='0.00'  ORDER BY $urut asc ";
$qry    = mysql_query($sql);
?>
<div class="table-responsive">
    <table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px">

        <tr align="center">
            <th rowspan="2">NO</th>
            <th rowspan="2">POLIKLINIK</th>
            <th rowspan="2">NO.NOTA</th>
            <th rowspan="2">TANGGAL </th>
            <th rowspan="2">NORM </th>
            <th rowspan="2">NAMA PASIEN</th>
            <th rowspan="2">TINDAKAN</th>
            <th rowspan="2">NAMA DOKTER </th>
            <th rowspan="2">JASA ORIGINAL</th>
            <th rowspan="2">DISKON</th>
            <th rowspan="2">JASA PELAYANAN </th>
            <th colspan="2">JASA RSUD </th>
            <th colspan="4">JASA PELAKSANA </th>
        </tr>
        <tr align="center">
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
                <td align="left"><? echo $data['pj']; ?>-<? echo $data['NAMAPOLY']; ?></td>
                <td><? echo $data['IDXDAFTAR'] ?></td>
                <td><? echo $data['PERIODES']; ?></td>
                <td align="left"><? echo $data['NOMR'] ?></td>
                <td align="left"><? echo $data['NAMA']; ?></td>
                <td align="left"><?= $data['nama_tindakan']; ?></td>
                <td align="left"><? echo $data['NAMADOKTER']; ?></td>
                <td align="right"><?= number_format($data['jumlah'], 2, ',', '.'); ?></td>
                <td align="center"><?= number_format($data['disk'], 0, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['JASA_PELAYANAN'], 2, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['operasional'], 2, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['manajemen'], 2, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['MEDIS'], 2, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['MEDIS_UMUM'], 2, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['PARAMEDIS'], 2, ',', '.'); ?></td>
                <td align="right"><?= number_format($data['COSTSHARING'], 2, ',', '.'); ?></td>
            </tr> <?    } ?>
        <?php
        $sql2 = "select a.TANGGAL, SUM(a.jumlah) AS J_PELS,
SUM(a.JASA_SARANA) AS J_SARANA,
SUM(a.JASA_PELAYANAN) AS J_PELAYANAN,
SUM(a.jasa_rs) AS J_RS,
SUM(a.jasa_pelaksana) AS J_PELAKSANA,
SUM(a.operasional) AS J_OPERASIONAL,
SUM(a.manajemen) AS J_MANAJEMEN,
SUM(a.MEDIS) AS J_MEDIS,
SUM(a.MEDIS_UMUM) AS J_MEDIS_UMUM,
SUM(a.PARAMEDIS) AS J_PARAMEDIS,
SUM(a.COSTSHARING) AS J_BERSAMA,h.JM
from t_billrajal a
left join m_pasien b ON b.NOMR = a.NOMR 
left join m_poly c ON c.kode =a.KDPOLY 
left join m_dokter d ON d.KDDOKTER = a.KDDOKTER
left join m_tarif2012 e ON e.kode_tindakan = a.KODETARIF
  left join t_pendaftaran h on h.IDXDAFTAR = a.IDXDAFTAR
 " . $search . " and a.CARABAYAR !='8' and a.KODETARIF!='07'  and a.UNIT IN ('16','17','15','20') and a.JASA_PELAYANAN !='0.00'  ";
        $qry2    = mysql_query($sql2);
        $data2 = mysql_fetch_array($qry2);

        ?>

        <tr style="font-weight:bold;background:#36bea6;color:#FFFFFF">
            <td align="center"></td>
            <td align="center"></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center">&nbsp;</td>
            <td align="center">JUMLAH</td>
            <td align="right"><?= number_format($data2['J_PELS'], 2, ',', '.'); ?></td>
            <td align="right">&nbsp;</td>
            <td align="right"><?= number_format($data2['J_PELAYANAN'], 2, ',', '.'); ?></td>
            <td align="right"><?= number_format($data2['J_OPERASIONAL'], 2, ',', '.'); ?></td>
            <td align="right"><?= number_format($data2['J_MANAJEMEN'], 2, ',', '.'); ?></td>
            <td align="right"><?= number_format($data2['J_MEDIS'], 2, ',', '.'); ?></td>
            <td align="right"><?= number_format($data2['J_MEDIS_UMUM'], 2, ',', '.'); ?></td>
            <td align="right"><?= number_format($data2['J_PARAMEDIS'], 2, ',', '.'); ?></td>
            <td align="right"><?= number_format($data2['J_BERSAMA'], 2, ',', '.'); ?></td>
        </tr>
    </table>
    <!-- <blockquote><a href="kasir_rekap/export_detail_jasa_poli.php?poly=<?= $_GET['poly'] ?>&dokter=<?= $_GET['dokter'] ?>&carabayar=<?= $_GET['carabayar'] ?>&tgl_reg=<?= $_GET['tgl_reg'] ?>&tgl_reg2=<?= $_GET['tgl_reg2'] ?>">Export Excel</a>  </blockquote>-->