 

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
          <h3>REKAPITULASI R/ RAWAT INAP (LAINNYA)</h3>
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
                                $qrycrbyr = mysql_query("SELECT * FROM m_carabayar where KODE!='0' ORDER BY ORDERS ASC")or die (mysql_error());
                                while ($listbyr = mysql_fetch_array($qrycrbyr)) {
                                    ?>
                        <option value="<? echo $listbyr['KODE'];?>" <? if($listbyr['KODE']==$crbayar) echo "selected=selected"; ?>><? echo $listbyr['NAMA'];?></option>
                        <? } ?>
                    </select></td>
					
					   <td width="50px" >Periode :<br/> 
 <input type="text" name="kode" style="height:17px;width:40px;font-size:11px"  value="<?=$kode;?>" class="text">
 
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
 WHERE a.ID!='0'  ".$search."  and a.UNIT='2' and a.IBS='0' GROUP BY b.ket_ruang order by b.ket_ruang ASC"; 
$jalankan = mysql_query($query) or die('Error');
                    while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?>						</td>
                        <td>
						<a target="_blank" href="index.php?link=lap_r_ruang_8_detail&poli=<?=$data['RUANG']?>&kode=<?=$_GET['kode']?>"><? echo $data['ket_ruang']; ?></a></td>
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
  FROM r_farmasi_8 where ID!='0'  ".$search2."  and UNIT='2' and IBS='0'   ");
$hasilx=mysql_fetch_array($data_rekapx);
?>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['r_ranap'],0,',','.');?></td>
<td style="padding-right:10px" align="right"><?=number_format($hasilx['rp_ranap'],2,',','.');?></td>
</tr>
                </table>
 
          </div>
        </div>
  <br />
		
    </div>
   
   

</div>
 