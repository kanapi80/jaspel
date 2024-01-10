<?php #session_start();
include("./include/connect.php"); 
$kode=$_GET['kode']; 
$poli=$_GET['poli']; 
 
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
   <h5 class="card-title ">RINCIAN R/ RAWAT INAP) </h5>

           </div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
							<div>
        <div align="center" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="100%" border="0" cellspacing="0" class="tb" style="font-size:10px;font-weight:bold">
                    		<?
		
$data_kontens=mysql_query("select nama from m_poly where kode='$poli'  ");
$data=mysql_fetch_array($data_kontens);
?>    <tr>
                          <td width="130">Nama Poliklinik </td>
                          <td >: <?=strtoupper($_GET['poli']);?></td>
                          </tr>
                        <tr>
                          <td>Periode</td>
                          <td>: <?=$_GET['kode']?></td>
                        </tr>
                </table>

            </form>
			
        	<div class="table-responsive" style="padding-bottom:5px" >
           <table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px" >
				
				<tr align="center" height="40px">
				  <th width="30">NO</th>
				  <th width="70">TGL BAYAR </th>
				  <th width="110">NO.RESEP</th>
				  <th width="70">NO.RM</th>
				  <th width="170" >NAMA PASIEN </th>
				  <th width="170">NAMA DOKTER </th>
				  <th width="100">DEPO</th>
		          <th width="200">APOTEKER</th>
		          <th width="40" >R/</th>
		          <th width="90">JUMLAH</th>
				</tr>
                    <?
                    $NO=0;  
  $query = "SELECT a.*,DATE_FORMAT(a.TGLBAYAR,'%d-%m-%Y') AS TGLBAYARS,b.NAMA,
d.NAMADOKTER,  
	c.ket_ruang ,e.nama_unit
from r_farmasi_8 a   
LEFT JOIN m_pasien b ON (a.NOMR=b.NOMR) 
LEFT JOIN m_ruang c ON (a.RUANG=c.no)  
LEFT JOIN m_unit e ON (a.KDUNIT=e.kode_unit)
LEFT JOIN m_dokter d ON (a.DOKTER=d.KDDOKTER) 
where a.JKN='".$kode."' and a.UNIT='2' and a.IBS='0' and c.ket_ruang='$poli' and CARABAYAR ='$_GET[crb]' order by a.ID ASC ";	 
$jalankan = mysql_query($query) or die('Error');
                    while($baris = mysql_fetch_array($jalankan)) {
					 $NO++;		

                   ?>
                       <tr >
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
				
 $selectsx=mysql_query("SELECT SUM(a.QTY_R) as TOTALR,SUM(a.JMBAYAR) as TOTALB from r_farmasi_8 a
 LEFT JOIN m_ruang b ON (a.RUANG=b.no)  
 where a.JKN='".$kode."' and a.UNIT='2' and a.IBS='0' and b.ket_ruang='".$poli."' and a.CARABAYAR ='$_GET[crb]'  ");
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