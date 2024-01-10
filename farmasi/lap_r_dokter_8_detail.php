<?php #session_start();
include("./include/connect.php"); 
 
?>

<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title">

          <h3>RINCIAN R/ DOKTER (JM)</h3>
        </div>
        <div align="center" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="90%" border="0" cellspacing="0" class="tb">
                    		<?
		
$data_kontens=mysql_query("select NAMADOKTER from m_dokter where KDDOKTER='$_GET[dokter]'  ");
$data=mysql_fetch_array($data_kontens);
?>    <tr>
                          <td width="130">Nama Dokter </td>
                          <td >: <?=strtoupper($data['NAMADOKTER']);?></td>
                          </tr>
                        <tr>
                          <td>Periode</td>
                          <td>: <?=$_GET['kode']?></td>
                        </tr>
                </table>

            </form>
			<br/>
          <div align="center" id="table_search">
              <table class="tb" bordercolor="#CCCCCC" width="90%" border="1"  cellspacing="0" cellspading="1px" >
				
				<tr align="center">
				  <th width="30">No</th>
				  <th width="60">Tanggal</th>
				  <th width="100">No Resep </th>
				  <th width="60">No RM</th>
				  <th >Nama Pasien </th>
				  <th width="40">Grup</th>
				  <th width="120">Ruangan</th>
				  <th width="100">Depo </th>
		          <th width="200">Apoteker</th>
		          <th width="30" >R/</th>
		          <th width="90">Jumlah</th>
				</tr>
                    <?
                    $NO=0; 
$kode=$_GET['kode']; 
$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
	
 $query = "SELECT a.*,DATE_FORMAT(a.TGLBAYAR,'%d-%m-%Y') AS TGLBAYARS,b.NAMA,CASE WHEN a.UNIT='1' THEN (SELECT nama FROM m_poly WHERE kode=a.RUANG)
    ELSE (SELECT ket_ruang FROM m_ruang WHERE no=a.RUANG) END AS namaruang, 
	CASE WHEN a.UNIT='1' THEN 'RJ' when a.UNIT='2' then 'RI' else '' END AS grups, 
	c.nama_unit 
from r_farmasi_8 a   
LEFT JOIN m_pasien b ON (a.NOMR=b.NOMR) 
LEFT JOIN m_unit c ON (a.KDUNIT=c.kode_unit)  
where a.JKN='$kode' and a.DOKTER='$_GET[dokter]' order by a.NONOTA ASC ";	 
$jalankan = mysql_query($query) or die('Error');
                    while($baris = mysql_fetch_array($jalankan)) {
					 $NO++;		
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
                   ?>
                       <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?></td>
                        <td  align="center"><?=$baris['TGLBAYARS']?></td>
                        <td  align="center"><?=$baris['NOBILL']?></td>
                        <td  align="center"><?=$baris['NOMR']?></td>
                        <td  ><?=$baris['NAMA']?>
<?
if($baris['APS']=="1"){	
$dataxxx=mysql_query("select nama from t_penjualan_obat where NO='$baris[NOBILL]' group by NO ");
$barisx=mysql_fetch_array($dataxxx);
echo $barisx['nama'];
}
?></td>
                        <td  ><?=$baris['grups']?><?=$baris['apss']?></td>
                        <td  ><?=$baris['namaruang']?></td>
                        <td  ><?=$baris['nama_unit']?></td>
                        <td  ><?=$baris['APT']?></td>
                        <td style="padding-right:10px" align="right"><?=number_format($baris['QTY_R'],0,',','.');?> </td>
                        <td style="padding-right:10px" align="right"><?=number_format($baris['JMBAYAR'],2,',','.');?></td>
</tr>
                       
                         <?	 } ?> 
						 
						
						
						 <tr style="font-weight:bold" >
                          <td align="center">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <td style="padding-right:10px" align="right">&nbsp;</td>
                          <?
				
 $selectsx=mysql_query("SELECT SUM(QTY_R) as TOTALR,SUM(JMBAYAR) as TOTALB from r_farmasi_8 where DOKTER='".$_GET['dokter']."' and JKN='".$kode."' ");
$bariss=mysql_fetch_array($selectsx);  
  ?>
                          <td style="padding-right:10px" align="right"><?=number_format($bariss['TOTALR'],0,',','.');?></td>
                          <td style="padding-right:10px" align="right"><?=number_format($bariss['TOTALB'],2,',','.');?></td>
                        </tr>
            </table>
 
          </div>
        </div>
  <br />
		
    </div>
   
   

</div>