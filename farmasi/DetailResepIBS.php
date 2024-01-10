<?php #session_start();
include("./include/connect.php"); 
 
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
   <h5 class="card-title ">RINCIAN R/ IBS (KAMAR OPERASI)
                </h5>

           </div>
			</div>
			<div class="card-body bg-light"><div class="row m-b-20"><div class="col-lg-12 col-md-4 m-t-20"><div><div align="center" style="margin:5px;"><form name="formsearch" method="get" ><table width="100%" border="0" cellspacing="0" class="tb" style="font-size:10px;font-weight:bold">
                    		<?
		
$data_kontens=mysql_query("select NAMADOKTER from m_dokter where KDDOKTER='$_GET[dokter]'  ");
$data=mysql_fetch_array($data_kontens);

$asr=mysql_query("select NAMA from m_carabayar where KODE='$_GET[crb]'  ");
$asuransi=mysql_fetch_array($asr);
?>    <tr>
                          <td width="130">Nama Ruangan</td>
                          <td >: <?=$_GET['poli']?></td>
                          </tr>
                        <tr>
                          <td>Periode</td>
                          <td>: <?=$_GET['kode']?></td>
                        </tr>
                        <tr>
                          <td>Asuransi</td>
                          <td>: <?=strtoupper($asuransi['NAMA']);?></td>
                        </tr>
                </table>

            </form>
		
        	<div class="table-responsive" style="padding-bottom:5px" >
               <table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px" >
				
				<tr align="center">
				 <th width="30">NO</th>
				  <th width="70">TANGGAL</th>
				  <th width="100">NO.RESEP</th>
				  <th width="60">NO.RM</th>
				  <th >NAMA PASIEN</th>
				  <th width="170">DOKTER</th>
				  <th width="80">DEPO</th>
		          <th width="170">APOTEKER</th>
		          <th width="40" >R/</th>
		          <th width="90">JUMLAH</th>
				</tr>
                    <?
                    $NO=0; 
$kode=$_GET['kode']; 
$dokter=$_GET['dokter']; 
$unit=$_GET['unit']; 
$ruang=$_GET['ruang']; 

 $query = "SELECT a.*,DATE_FORMAT(a.TGLBAYAR,'%d-%m-%Y') AS TGLBAYARS,b.NAMA,
d.NAMADOKTER,  
	c.nama_unit 
from r_farmasi_8 a   
LEFT JOIN m_pasien b ON (a.NOMR=b.NOMR) 
LEFT JOIN m_unit c ON (a.KDUNIT=c.kode_unit)  
LEFT JOIN m_dokter d ON (a.DOKTER=d.KDDOKTER) 
where a.JKN='$kode' and a.UNIT='$unit' and a.RUANG='$ruang' and IBS='1' order by a.ID ASC ";
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
				
 $selectsx=mysql_query("SELECT SUM(QTY_R) as TOTALR,SUM(JMBAYAR) as TOTALB from r_farmasi_8 where UNIT='$unit' and RUANG='$ruang' and JKN='$kode' and IBS='1' ");
$bariss=mysql_fetch_array($selectsx);  
  ?>
                          <td style="padding-right:10px" align="right"><?=number_format($bariss['TOTALR'],0,',','.');?></td>
                          <td style="padding-right:10px" align="right"><?=number_format($bariss['TOTALB'],2,',','.');?></td>
                        </tr>
            </table>
 
    </div>
 
 							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>