<?php #session_start();
include("./include/connect.php"); 
$kode=$_GET['kode']; 
$poli=$_GET['poli']; 
 
?>

<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title">

          <h3>RINCIAN R/ POLIKLINIK (JM)</h3>
        </div>
        <div align="center" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="90%" border="0" cellspacing="0" class="tb">
                    		<?
		
$data_kontens=mysql_query("select nama from m_poly where kode='$poli'  ");
$data=mysql_fetch_array($data_kontens);
?>    <tr>
                          <td width="130">Nama Poliklinik </td>
                          <td >: <?=strtoupper($data['nama']);?></td>
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
				  <th width="60">Tgl Bayar </th>
				  <th width="100">No Resep </th>
				  <th width="60">No RM</th>
				  <th >Nama Pasien </th>
				  <th width="170">Dokter</th>
				  <th width="100">Depo </th>
		          <th width="200">Apoteker</th>
		          <th width="40" >R/</th>
		          <th width="90">Jumlah</th>
				</tr>
                    <?
                    $NO=0;  
 
$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
	
 $query = "SELECT a.*,DATE_FORMAT(a.TGLBAYAR,'%d-%m-%Y') AS TGLBAYARS,b.NAMA,
d.NAMADOKTER,  
	c.nama_unit 
from r_farmasi_8 a   
LEFT JOIN m_pasien b ON (a.NOMR=b.NOMR) 
LEFT JOIN m_unit c ON (a.KDUNIT=c.kode_unit)  
LEFT JOIN m_dokter d ON (a.DOKTER=d.KDDOKTER) 
where a.JKN='".$kode."' and a.UNIT='1' and a.IBS='0' and a.RUANG='$poli'  order by a.ID ASC ";	 
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
                        <td  ><?=$baris['NAMA']?></td>
                        <td  ><?=$baris['NAMADOKTER']?></td>
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
                          <?
				
 $selectsx=mysql_query("SELECT SUM(QTY_R) as TOTALR,SUM(JMBAYAR) as TOTALB from r_farmasi_8 where JKN='".$kode."' and UNIT='1' and IBS='0' and RUANG='".$poli."'  ");
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