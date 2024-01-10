 
<?php if($_GET['rekap']=="rajal" and $_GET['link']=="Farmasi"){?>
<?php
include("./include/connect.php"); 
		  
		  
 if(!empty($_GET['kode'])) {
 $search= " AND a.STATUS='SELESAI'   "; 
 $search2= " AND STATUS='SELESAI'   ";  
 }else{
 $search= " AND a.STATUS='xxx'   "; 
 $search2= " AND STATUS='xxx'   "; 
 } 
 
 
 $crb = "";
if(!empty($_GET['crb'])) {
    $crb =$_GET['crb'];
}  
if($crb !="") {
    $search = $search." AND a.CARABAYAR='".$crb."' ";
    $search2 = $search2." AND CARABAYAR='".$crb."' ";
}
  $periode = "";
if(!empty($_GET['periode'])) {
    $periode =$_GET['periode'];
}  
if($periode !="") {
    $search = $search." AND a.JKN='".$periode."' ";
    $search2 = $search2." AND JKN='".$periode."' ";
}
?>

<div class="row">
	<div class="col-lg-12">
		<!--<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">-->
		<div class="card">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
					<!--<h5 class="card-title ">Rekapitulasi R/ Rawat Jalan (Lainnya)  </h5> 
					<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;R/Rajal&nbsp;</button>-->
<center><div class="btn-group" role="group" >
  <button type="button" class="btn btn-outline-success">List Resep</button>
  <a href="index.php?&link=Farmasi&rekap=rajal"><button type="button" class="btn btn-outline-success active" aria-current="page">R /Rajal</button></a>
  <a href="index.php?&link=Farmasi&rekap=ranap"><button type="button" class="btn btn-outline-success" >R /Ranap</button></a>
   <a href="index.php?&link=Farmasi&rekap=dokter"> <button type="button" class="btn btn-outline-success">R /Dokter</button></a>
  <a href="index.php?&link=Farmasi&rekap=ibs"><button type="button" class="btn btn-outline-success">R /IBS</button></a>
</div></center>
				</div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
							<div>

								
        	<div class="table-responsive" style="padding-bottom:5px" >
           <form name="formsearch" method="get" >
							     <table width="70%" cellpadding="0px" cellspacing="0" style="font-size:10px" border="0px">   
					               <tr class="tb">
                                     <td>Asuransi<br />
                                         <select name="crb" class="form-cari" id="carabayar">
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
					                 <td valign="bottom">Periode
					                   <select style="width:100%" name="periode" id="periode" class="form-cari">
                                           <option value="0">-</option>
                                           <?php
                $query = mysql_query("SELECT

                                        *

                                      FROM

                                        x_settingklaim

                                        INNER JOIN m_carabayar ON x_settingklaim.KdCrb  = m_carabayar.KODE ORDER BY periode ASC");

                while ($row = mysql_fetch_array($query)) {
                ?>
                                           <option id="periode" class="<?php echo $row['KODE']; ?>"value="<?php echo $row['periode']; ?>" <?php if ($row['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>> <?php echo $row['periode']; ?> </option>
                                           <?php } ?>
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
                                     <td valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" /><input type="hidden" name="rekap" value="rajal" />
                                         <button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button></td>
				                   </tr>
					</table>    </form>
			<br/>
          <div id="table_search">
              <table width="60%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px" >
				<tr align="center">
				  <th width="5%" rowspan="2">NO</th>
				  <th  rowspan="2">NAMA POLIKLINIK </th>
				  <th colspan="2">JUMLAH</th>
			    </tr>
				<tr align="center">
				<th width="15%">R/</th>
				  <th width="20%">Rp.</th>
			    </tr>
<?
$NO=0;
$query="SELECT a.ID,a.RUANG,sum(a.JMBAYAR) as jmbayar,sum(a.QTY_R) as jmrrrr,b.nama 
FROM r_farmasi_8 a
LEFT JOIN m_poly b ON (a.RUANG = b.kode )  
WHERE a.ID!='0'  and a.JKN ='$periode' and CARABAYAR='$crb'  and a.UNIT='1' and a.IBS='0' GROUP BY a.RUANG  order by b.nama ASC"; 
$jalankan = mysql_query($query) or die('Error');
       while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr >
						<td align="center"><?=$NO;?>						</td>
                        <td>
						<a target="_blank" href="index.php?link=DetailResepPoliklinik&poli=<?=$data['RUANG']?>&kode=<?=$_GET['periode']?>&crb=<?=$_GET['crb'];?>"><? echo $data['nama']; ?></a></td>
                        <td style="padding-right:10px" align="right"><?=number_format($data['jmrrrr'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['jmbayar'],2,',','.');?></td>
</tr>
                       
                         <?  } ?>  
						 <tr style="font-weight:bold" >
                          <td align="center">&nbsp;</td>
                          <td align="center">J U M L A H </td>
                          <? 
						  $crb =$_GET['crb'];
						  $periode=$_GET['periode'];
$data_rekapx=mysql_query("select ID,  
	 SUM(QTY_R) AS r_ranap, 
	 SUM(JMBAYAR) AS rp_ranap 
  FROM r_farmasi_8 where ID!='0'  and JKN ='$periode' and CARABAYAR='$crb' and  UNIT='1' and IBS='0'   ");
$hasilx=mysql_fetch_array($data_rekapx);
?>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ranap'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ranap'],2,',','.');?></td>
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.chained.min.js"></script>
 <script>
            $("#periode").chained("#carabayar");
        </script>
		<? } ?>
		
		<!--REKAP DOKTER-->
		<?php
$rekap=$_GET['rajal'];
$link=$_GET['link']; if($_GET['rekap']=="dokter" and $_GET['link']=="Farmasi"){?>
<?php
include("./include/connect.php"); 
		  
		  
 if(!empty($_GET['kode'])) {
 $search= " AND a.STATUS='SELESAI'   "; 
 $search2= " AND STATUS='SELESAI'   ";  
 }else{
 $search= " AND a.STATUS='xxx'   "; 
 $search2= " AND STATUS='xxx'   "; 
 } 
 
 
 $crb = "";
if(!empty($_GET['crb'])) {
    $crb =$_GET['crb'];
}  
if($crb !="") {
    $search = $search." AND a.CARABAYAR='".$crb."' ";
    $search2 = $search2." AND CARABAYAR='".$crb."' ";
}
  $periode = "";
if(!empty($_GET['periode'])) {
    $periode =$_GET['periode'];
}  
if($periode !="") {
    $search = $search." AND a.JKN='".$periode."' ";
    $search2 = $search2." AND JKN='".$periode."' ";
}
?>

<div class="row">
	<div class="col-lg-12">
	<div class="card">
		<!--<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">-->
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
					<!--<h5 class="card-title ">Rekapitulasi R/ Rawat Jalan (Lainnya)  </h5> 
					<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;R/Rajal&nbsp;</button>-->
<center><div class="btn-group" role="group" >
  <button type="button" class="btn btn-outline-success">List Resep</button>
  <a href="index.php?&link=Farmasi&rekap=rajal"><button type="button" class="btn btn-outline-success">R /Rajal</button></a>
  <a href="index.php?&link=Farmasi&rekap=ranap"><button type="button" class="btn btn-outline-success">R /Ranap</button></a>
   <button type="button" class="btn btn-outline-success active" aria-current="page">R /Dokter</button>
  <a href="index.php?&link=Farmasi&rekap=ibs"><button type="button" class="btn btn-outline-success">R /IBS</button></a>
</div></center>
				</div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
							<div>

								
        	<div class="table-responsive" style="padding-bottom:5px" >
           <form name="formsearch" method="get" >
							     <table width="70%" cellpadding="0px" cellspacing="0" style="font-size:10px" border="0px">   
					              <table width="90%" border="0"  cellpadding="0" cellspacing="0" class="tb" >   
					 <tr>
                     <td>Asuransi<br />
                                         <select name="crb" class="form-cari" id="carabayar">
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
					                 <td valign="bottom">Periode
					                   <select style="width:100%" name="periode" id="periode" class="form-cari">
                                           <option value="0">-</option>
                                           <?php
                $query = mysql_query("SELECT

                                        *

                                      FROM

                                        x_settingklaim

                                        INNER JOIN m_carabayar ON x_settingklaim.KdCrb  = m_carabayar.KODE ORDER BY periode ASC");

                while ($row = mysql_fetch_array($query)) {
                ?>
                                           <option id="periode" class="<?php echo $row['KODE']; ?>"value="<?php echo $row['periode']; ?>" <?php if ($row['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>> <?php echo $row['periode']; ?> </option>
                                           <?php } ?>
                                         </select>
                                     </td>
<td width="588"  ><br/>
  <input type="hidden" name="link" value="<?= $_GET['link']; ?>" /><input type="hidden" name="rekap" value="dokter" />
                                         <button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button>

                      </td>
 
                    </tr></table>
            </form>
			</td>
		 <? if($_SESSION['NIP']=="DEPO RAJAL"){ ?>
		 	<td align="right">		
<button style="padding:10px " class="btn info" id="myBtnxxxx">Update Data</button>
					</td>
					<? } ?>
					</tr>
					</table>
                                   
				   
			<br/>
          <div id="table_search">
              <table width="100%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px" >
				
				<tr align="center">
				  <th width="3%" rowspan="2">No</th>
				  <th  rowspan="2">Nama Dokter </th>
				  <th colspan="3">R/</th>
				  <th colspan="3">Rp</th>
				  <th colspan="2">Total</th>
			    </tr>
				<tr align="center">
				<th width="5%">RJ </th>
				  <th width="5%">RI</th>
				  <th width="5%">IBS</th>
				  <th width="10%">RJ </th>
				  <th width="10%">RI</th>
				  <th width="10%">IBS</th>
				  <th width="5%">R/</th>
				  <th width="10%">Rp</th>
		        </tr>
                    <?
                    $NO=0;


$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
   
$query="SELECT a.DOKTER,a.TANGGAL,b.NAMADOKTER,
	 SUM(a.QTY_R) AS r_jasa,
	 SUM(  IF (a.UNIT ='1' and a.IBS='0',a.QTY_R,0 ) ) AS r_rajal,
	 SUM(  IF (a.UNIT ='2'  and a.IBS='0',a.QTY_R,0 ) ) AS r_ranap,
	 SUM(  IF (a.IBS='1',a.QTY_R,0 ) ) AS r_ibs,  
	 SUM(a.JMBAYAR) AS rp_total,
	 SUM(  IF (a.UNIT ='1' and a.IBS='0',a.JMBAYAR,0 ) ) AS rp_rajal,
	 SUM(  IF (a.UNIT ='2' and a.IBS='0',a.JMBAYAR,0 ) ) AS rp_ranap,
	 SUM(  IF (a.IBS='1',a.JMBAYAR,0 ) ) AS rp_ibs   
 FROM r_farmasi_8 a
 LEFT JOIN m_dokter b ON (a.DOKTER=b.KDDOKTER)
 WHERE a.ID!='0'  and a.JKN ='$periode' and CARABAYAR='$crb'  GROUP BY a.DOKTER order by b.NAMADOKTER ASC"; 
$jalankan = mysql_query($query) or die('Error');
                    while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?>						</td>
<td><a target="_blank" href="index.php?link=DetailResepDokter&dokter=<?=$data['DOKTER']?>&kode=<?=$_GET['periode']?>&crb=<?=$_GET['crb'];?>"><? echo $data['NAMADOKTER']; ?></a></td> 
<td style="padding-right:10px" align="right"><?=number_format($data['r_rajal'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['r_ranap'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['r_ibs'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['rp_rajal'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['rp_ranap'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['rp_ibs'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['r_jasa'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['rp_total'],2,',','.');?></td>
</tr>
                       
                         <?  } ?> 
						 
						
						
						 <tr style="font-weight:bold" >
                          <td align="center">&nbsp;</td>
                          <td align="center">J U M L A H </td>
  <? 
$data_rekapx=mysql_query("select ID,
	 SUM(QTY_R) AS r_jasa,
	 SUM(  IF (UNIT ='1' and IBS='0',QTY_R,0 ) ) AS r_rajal,
	 SUM(  IF (UNIT ='2' and IBS='0',QTY_R,0 ) ) AS r_ranap,
	 SUM(  IF (IBS='1',QTY_R,0 ) ) AS r_ibs, 
	 SUM(JMBAYAR) AS rp_total,
	 SUM(  IF (UNIT ='1' and IBS='0',JMBAYAR,0 ) ) AS rp_rajal,
	 SUM(  IF (UNIT ='2' and IBS='0',JMBAYAR,0 ) ) AS rp_ranap,
	 SUM(  IF (IBS='1',JMBAYAR,0 ) ) AS rp_ibs  
  FROM r_farmasi_8 where ID!='0'  and JKN ='$periode' and CARABAYAR='$crb'    ");
$hasilx=mysql_fetch_array($data_rekapx);
?>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_rajal'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ranap'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ibs'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_rajal'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ranap'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ibs'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_jasa'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_total'],2,',','.');?></td>
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.chained.min.js"></script>
 <script>
            $("#periode").chained("#carabayar");
        </script>
	<? } ?>
	<!-- END DOKTER-->
	<!--REKAP RUANGAN -->
	<?php if($_GET['rekap']=="ranap" and $_GET['link']=="Farmasi"){?>
<?php
include("./include/connect.php"); 
		  
		  
 if(!empty($_GET['kode'])) {
 $search= " AND a.STATUS='SELESAI'   "; 
 $search2= " AND STATUS='SELESAI'   ";  
 }else{
 $search= " AND a.STATUS='xxx'   "; 
 $search2= " AND STATUS='xxx'   "; 
 } 
 
 
 $crb = "";
if(!empty($_GET['crb'])) {
    $crb =$_GET['crb'];
}  
if($crb !="") {
    $search = $search." AND a.CARABAYAR='".$crb."' ";
    $search2 = $search2." AND CARABAYAR='".$crb."' ";
}
  $periode = "";
if(!empty($_GET['periode'])) {
    $periode =$_GET['periode'];
}  
if($periode !="") {
    $search = $search." AND a.JKN='".$periode."' ";
    $search2 = $search2." AND JKN='".$periode."' ";
}
?>

<div class="row">
	<div class="col-lg-12">
		<!--<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">-->
		<div class="card">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
					<!--<h5 class="card-title ">Rekapitulasi R/ Rawat Jalan (Lainnya)  </h5> 
					<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;R/Rajal&nbsp;</button>-->
<center><div class="btn-group" role="group" >
  <button type="button" class="btn btn-outline-success">List Resep</button>
  <a href="index.php?&link=Farmasi&rekap=rajal"><button type="button" class="btn btn-outline-success">R /Rajal</button></a>
  <a href="index.php?&link=Farmasi&rekap=ranap"><button type="button" class="btn btn-outline-success active" aria-current="page">R /Ranap</button></a>
  <a href="index.php?&link=Farmasi&rekap=dokter"> <button type="button" class="btn btn-outline-success">R /Dokter</button></a>
    <a href="index.php?&link=Farmasi&rekap=ibs"><button type="button" class="btn btn-outline-success">R /IBS</button></a>
</div></center>
				</div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
							<div>

								
        	<div class="table-responsive" style="padding-bottom:5px" >
           <form name="formsearch" method="get" >
							     <table width="70%" cellpadding="0px" cellspacing="0" style="font-size:10px" border="0px">   
					               <tr class="tb">
                                     <td>Asuransi<br />
                                         <select name="crb" class="form-cari" id="carabayar">
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
					                 <td valign="bottom">Periode
					                   <select style="width:100%" name="periode" id="periode" class="form-cari">
                                           <option value="0">-</option>
                                           <?php
                $query = mysql_query("SELECT

                                        *

                                      FROM

                                        x_settingklaim

                                        INNER JOIN m_carabayar ON x_settingklaim.KdCrb  = m_carabayar.KODE ORDER BY periode ASC");

                while ($row = mysql_fetch_array($query)) {
                ?>
                                           <option id="periode" class="<?php echo $row['KODE']; ?>"value="<?php echo $row['periode']; ?>" <?php if ($row['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>> <?php echo $row['periode']; ?> </option>
                                           <?php } ?>
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
                                     <td valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" /><input type="hidden" name="rekap" value="ranap" />
                                         <button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button></td>
				                   </tr>
					</table>    </form>
			<br/>
          <div id="table_search">
              <table width="60%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px" >
				<tr align="center">
				  <th width="5%" rowspan="2">No</th>
				  <th  rowspan="2">Nama Ruangan </th>
				  <th colspan="2">Jumlah</th>
			    </tr>
				<tr align="center">
				<th width="15%">R/</th>
				  <th width="20%">Rp.</th>
			    </tr>
                    <?
                    $NO=0;
 

$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
  

//$query="SELECT * FROM m_dokter where NAMAPROFESI!='Terapis'  order by m_dokter.NAMADOKTER ASC"; 
$query="SELECT a.ID,a.RUANG,sum(a.JMBAYAR) as jmbayar,sum(a.QTY_R) as jmrrrr,b.ket_ruang 
 FROM r_farmasi_8 a  
LEFT JOIN m_ruang b ON (a.RUANG = b.no )  
 WHERE a.ID!='0'  and a.UNIT='2' and a.IBS='0' and a.JKN ='$periode' and a.CARABAYAR='$crb'  GROUP BY b.ket_ruang order by b.ket_ruang ASC"; 
$jalankan = mysql_query($query) or die('Error');
                    while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?>						</td>
                        <td>
					
						<a target="_blank" href="index.php?link=DetailResepRanap&poli=<?=$data['ket_ruang']?>&kode=<?=$_GET['periode']?>&crb=<?=$_GET['crb'];?>"><? echo $data['ket_ruang']; ?></a></td>
                        <td style="padding-right:10px" align="right"><?=number_format($data['jmrrrr'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['jmbayar'],2,',','.');?></td>
</tr>
                       
                         <?  } ?>  
						 <tr style="font-weight:bold" >
                          <td align="center">&nbsp;</td>
                          <td align="center">J U M L A H </td>
                          <? 
$data_rekapx=mysql_query("select ID,  
	 SUM(QTY_R) AS r_ranap, 
	 SUM(JMBAYAR) AS rp_ranap 
  FROM r_farmasi_8 where ID!='0'  and JKN ='$periode' and CARABAYAR='$crb'  and UNIT='2' and IBS='0'   ");
$hasilx=mysql_fetch_array($data_rekapx);
?>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ranap'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ranap'],2,',','.');?></td>
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.chained.min.js"></script>
 <script>
            $("#periode").chained("#carabayar");
        </script>
		<? } ?>
		<!-- END-->
		
		<!--IBS -->

	<?php if($_GET['rekap']=="ibs" and $_GET['link']=="Farmasi"){?>
<?php
include("./include/connect.php"); 
		  
		  
 if(!empty($_GET['kode'])) {
 $search= " AND a.STATUS='SELESAI'   "; 
 $search2= " AND STATUS='SELESAI'   ";  
 }else{
 $search= " AND a.STATUS='xxx'   "; 
 $search2= " AND STATUS='xxx'   "; 
 } 
 
 
 $crb = "";
if(!empty($_GET['crb'])) {
    $crb =$_GET['crb'];
}  
if($crb !="") {
    $search = $search." AND a.CARABAYAR='".$crb."' ";
    $search2 = $search2." AND CARABAYAR='".$crb."' ";
}
  $periode = "";
if(!empty($_GET['periode'])) {
    $periode =$_GET['periode'];
}  
if($periode !="") {
    $search = $search." AND a.JKN='".$periode."' ";
    $search2 = $search2." AND JKN='".$periode."' ";
}
?>

<div class="row">
	<div class="col-lg-12">
		<!--<div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%);">-->
		<div class="card">
			<div class="card-body">
				<div class="d-flex m-b-0 align-items-center no-block">
					<!--<h5 class="card-title ">Rekapitulasi R/ Rawat Jalan (Lainnya)  </h5> 
					<button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;R/Rajal&nbsp;</button>-->
<center><div class="btn-group" role="group" >
  <button type="button" class="btn btn-outline-success">List Resep</button>
  <a href="index.php?&link=Farmasi&rekap=rajal"><button type="button" class="btn btn-outline-success">R /Rajal</button></a>
  <a href="index.php?&link=Farmasi&rekap=ranap"><button type="button" class="btn btn-outline-success">R /Ranap</button></a>
  <a href="index.php?&link=Farmasi&rekap=dokter"> <button type="button" class="btn btn-outline-success">R /Dokter</button></a>
   <a href="index.php?&link=Farmasi&rekap=ibs"><button type="button" class="btn btn-outline-success active" aria-current="page">R /IBS</button></a>
</div></center>
				</div>
			</div>
			<div class="card-body bg-light">
				<!-- <div class="row text-center m-b-20"> -->
				<div class="row m-b-20">
					<div class="col-lg-12 col-md-4 m-t-20">
						<h7 class="m-b-0 font-light">
							<div>

								
        	<div class="table-responsive" style="padding-bottom:5px" >
           <form name="formsearch" method="get" >
							     <table width="70%" cellpadding="0px" cellspacing="0" style="font-size:10px" border="0px">   
					               <tr class="tb">
                                     <td>Asuransi<br />
                                         <select name="crb" class="form-cari" id="carabayar">
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
					                 <td valign="bottom">Periode
					                   <select style="width:100%" name="periode" id="periode" class="form-cari">
                                           <option value="0">-</option>
                                           <?php
                $query = mysql_query("SELECT * FROM x_settingklaim
                                        INNER JOIN m_carabayar ON x_settingklaim.KdCrb  = m_carabayar.KODE ORDER BY periode ASC");
                while ($row = mysql_fetch_array($query)) {
                ?>
                                           <option id="periode" class="<?php echo $row['KODE']; ?>"value="<?php echo $row['periode']; ?>" <?php if ($row['periode'] == $_REQUEST['periode']) : echo 'selected="selected"';
																				endif; ?>> <?php echo $row['periode']; ?> </option>
                                           <?php } ?>
                                         </select>
                                     </td>
                                     <td valign="bottom"><input type="hidden" name="link" value="<?= $_GET['link']; ?>" /><input type="hidden" name="rekap" value="ibs" />
                                         <button type="submit" class="btn btn-outline-success btn-sm">&nbsp;<i class="fa fa-search"></i>&nbsp;Cari&nbsp;</button></td>
				                   </tr>
					</table>    </form>
			<br/>
          <div id="table_search">
              <table width="60%" cellpadding="0px" cellspacing="0" class="tb" id="myTable1" style="font-size:10px" border="1px" >
					<tr align="center">
				  <th width="5%" rowspan="2">No</th>
				  <th  rowspan="2">Nama Ruangan </th>
				  <th width="7%" rowspan="2">GRUP</th>
				  <th colspan="2">IBS</th>
				  <th colspan="2">ANESTESI</th>
				  <th colspan="2">JUMLAH</th>
			    </tr>
				<tr align="center">
				<th width="7%">R/</th>
				  <th width="13%">Rp.</th>
				<th width="7%">R/</th>
				  <th width="13%">Rp.</th>
				<th width="7%">R/</th>
				  <th width="13%">Rp.</th>
			    </tr>
                    <?
                    $NO=0;
 

$warnaGenap = "#fafafa";   // warna abu-abu
$warnaGanjil = "#fff";  // warna putih 
   
$query="SELECT a.ID,a.UNIT,a.RUANG,sum(a.JMBAYAR) as jmbayar,sum(a.QTY_R) as jmrrrr,
 case when a.UNIT='1' then 'RJ' when  a.UNIT='2' then 'RI' else '' end as dgrup,
 CASE WHEN a.UNIT='1' THEN (SELECT nama FROM m_poly WHERE kode=a.RUANG)
    ELSE (SELECT ket_ruang FROM m_ruang WHERE NO=a.RUANG) END AS ruang,
	 SUM(  IF (a.DOKTER ='108',a.QTY_R,0 ) ) AS r_ane,
	 SUM(  IF (a.DOKTER ='34',a.QTY_R,0 ) ) AS r_husni,
	 SUM(  IF (a.DOKTER ='108',a.JMBAYAR,0 ) ) AS rp_ane,
	 SUM(  IF (a.DOKTER ='34',a.JMBAYAR,0 ) ) AS rp_husni
 FROM r_farmasi_8 a
 WHERE a.ID!='0' and JKN ='$periode' and CARABAYAR='$crb'  and a.IBS='1' GROUP BY a.UNIT,a.RUANG  ORDER BY a.UNIT ASC "; 
$jalankan = mysql_query($query) or die('Error');
                    while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?>						</td>
                        <td>
						<a target="_blank" href="index.php?link=DetailResepIBS&poli=<?=$data['ruang']?>&kode=<?=$_GET['periode']?>&crb=<?=$_GET['crb'];?>&unit=<?=$data['UNIT']?>&ruang=<?=$data['RUANG']?>"><? echo $data['ruang']; ?></a>
						</td>
                        <td align="center"><?=$data['dgrup']?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['jmrrrr']-($data['r_ane']+$data['r_husni']),0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['jmbayar']-($data['rp_ane']+$data['rp_husni']),2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['r_ane']+$data['r_husni'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['rp_ane']+$data['rp_husni'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['jmrrrr'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($data['jmbayar'],2,',','.');?></td>
</tr>
                       
                         <?  } ?>  
						 <tr style="font-weight:bold" >
                          <td align="center">&nbsp;</td>
                          <td align="center">J U M L A H </td>
                          <td align="center">&nbsp;</td>
                          <? 
$data_rekapx=mysql_query("select ID,  
	 SUM(QTY_R) AS r_ranap, 
	 SUM(JMBAYAR) AS rp_ranap ,
	 SUM(  IF (DOKTER ='108',QTY_R,0 ) ) AS r_ane,
	 SUM(  IF (DOKTER ='34',QTY_R,0 ) ) AS r_husni,
	 SUM(  IF (DOKTER ='108',JMBAYAR,0 ) ) AS rp_ane,
	 SUM(  IF (DOKTER ='34',JMBAYAR,0 ) ) AS rp_husni
  FROM r_farmasi_8 where ID!='0' and JKN ='$periode' and CARABAYAR='$crb'   and IBS='1'   ");
$hasilx=mysql_fetch_array($data_rekapx);
?>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ranap']-($hasilx['r_ane']+$hasilx['r_husni']),0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ranap']-($hasilx['rp_ane']+$hasilx['rp_husni']),2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ane']+$hasilx['r_husni'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ane']+$hasilx['rp_husni'],2,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ranap'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ranap'],2,',','.');?></td>
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.chained.min.js"></script>
 <script>
            $("#periode").chained("#carabayar");
        </script>
		<? } ?>
		<!-- END-->