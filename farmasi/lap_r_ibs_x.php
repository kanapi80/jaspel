 
<?php  
include("./include/connect.php"); 
		  
 if(!empty($_GET['kode'])) {
 $search= " AND a.STATUS='SELESAI'   "; 
 $search2= " AND STATUS='SELESAI'   ";  
 }else{
 $search= " AND a.STATUS='xxx'   "; 
 $search2= " AND STATUS='xxx'   "; 
 } 
 
 $crbayar = "";
if(!empty($_GET['crbayar'])) {
    $crbayar =$_GET['crbayar'];
}  
if($crbayar !="") {
    $search = $search." AND a.CARABAYAR='".$crbayar."' ";
    $search2 = $search2." AND CARABAYAR='".$crbayar."' ";
}
  $kode = "";
if(!empty($_GET['kode'])) {
    $kode =$_GET['kode'];
}  
if($kode !="") {
    $search = $search." AND a.JKN='".$kode."' ";
    $search2 = $search2." AND JKN='".$kode."' ";
}

?>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title">
          <h3>REKAPITULASI R/ IBS (LAINNYA)</h3>
        </div>
        <div align="center" style="margin:5px;">
          
			         <table width="70%" border="0"  cellpadding="0" cellspacing="0" class="tb" >   
					 <tr>
                    <td>
            <form name="formsearch" method="get" >
					<table width="70%" >
					<tr>
					 <td width="100px">Cara Bayar<br/>
 <select name="crbayar" style="font-size:12px;height:24px"    >
                        <option value=""> -- </option>
                        <?
                                $qrycrbyr = mysql_query("SELECT * FROM m_carabayar where ORDERS>'2' ORDER BY ORDERS ASC")or die (mysql_error());
                                while ($listbyr = mysql_fetch_array($qrycrbyr)) {
                                    ?>
                        <option value="<? echo $listbyr['KODE'];?>" <? if($listbyr['KODE']==$crbayar) echo "selected=selected"; ?>><? echo $listbyr['NAMA'];?></option>
                        <? } ?>
                    </select></td>
					
					   <td width="50px" >Periode :<br/> 


<select name="kode"  style="height:24px;font-size:11px" class="text" > 
                        <?
                                $qrycrbyrx = mysql_query("SELECT periode FROM jm_klaim GROUP BY periode ORDER BY periode DESC")or die (mysql_error());
                                while ($listbyrx = mysql_fetch_array($qrycrbyrx)) {
                                    ?>
                        <option value="<? echo $listbyrx['periode'];?>" <? if($listbyrx['periode']==$kode) echo "selected=selected"; ?>><? echo $listbyrx['periode'];?></option>
                        <? } ?>
                    </select>
</td> 
<td  ><br/>
<input  style="height:23px;width:80px;font-size:12px" type="submit" value="Tampilkan" class="text"/>
                            <input type="hidden" name="link" value="<?=$_GET['link'];?>" /></td>
 
                    </tr></table>
            </form>
			</td> 
					</tr>
					</table>
			<br/>
          <div align="center" id="table_search">
              <table class="tb" bordercolor="#CCCCCC" width="70%" border="1"  cellspacing="0" cellspading="1px" >
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
 WHERE a.ID!='0'  ".$search." and a.IBS='1' GROUP BY a.UNIT,a.RUANG  ORDER BY a.UNIT ASC "; 
$jalankan = mysql_query($query) or die('Error');
                    while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?>						</td>
                        <td>
						<a target="_blank" href="index.php?link=lap_r_ibs_8_detail&kode=<?=$_GET['kode']?>&unit=<?=$data['UNIT']?>&ruang=<?=$data['RUANG']?>"><? echo $data['ruang']; ?></a>
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
  FROM r_farmasi_8 where ID!='0'  ".$search2."  and IBS='1'   ");
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
  <br />
		
    </div>
   
   

</div>
 