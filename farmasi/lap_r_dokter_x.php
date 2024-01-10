<style> 

/* The Modal (background) */
.modale {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modale-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

/* The Close Button */
.closee {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closee:hover,
.closee:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

 
</style>   
 
<?php #session_start();
include("./include/connect.php"); 
 # $kode=$_GET['kode'];
 #$crbayar=$_GET['crbayar'];
 
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
          <h3>REKAPITULASI R/ DOKTER (LAINNYA)</h3>
        </div>
        <div align="center" style="margin:5px;">
          
			     
				 
				     <table width="90%" border="0"  cellpadding="0" cellspacing="0" class="tb" >   
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
		 <? if($_SESSION['NIP']=="DEPO RAJAL"){ ?>
		 	<td align="right">		
<button style="padding:10px " class="btn info" id="myBtnxxxx">Update Data</button>
					</td>
					<? } ?>
					</tr>
					</table>

 	 
					
				 
				 

			<br/>
          <div align="center" id="table_search">
              <table class="tb" bordercolor="#CCCCCC" width="90%" border="1"  cellspacing="0" cellspading="1px" >
				<tr align="center">
				  <th width="5%" rowspan="2">No</th>
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
 WHERE a.ID!='0'  ".$search." GROUP BY a.DOKTER order by b.NAMADOKTER ASC"; 
$jalankan = mysql_query($query) or die('Error');
                    while($data = mysql_fetch_array($jalankan)) {
		$NO++;			
if ($NO % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
?>
                   
                        <tr bgcolor="<?=$warna?>">
						<td align="center"><?=$NO;?>						</td>
<td><a target="_blank" href="index.php?link=lap_r_dokter_8_detail&dokter=<?=$data['DOKTER']?>&kode=<?=$_GET['kode']?>"><? echo $data['NAMADOKTER']; ?></a></td> 
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
  FROM r_farmasi_8 where ID!='0'  ".$search2."   ");
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
  <br />
		
    </div>
   
   

</div>

 

<!-- The Modal -->
<div id="myModal" class="modale">

  <!-- Modal content -->
  <div class="modale-content">
  <span class="closee">&times;</span>
   <h2>Update Data</h2>   <form action="./apotek/update_farmasi_x.php" method="post" enctype="multipart/form-data">
					<table style="font-size:13px"  width="100%" cellpadding="0" cellspacing="0" >
				 
					<tr>
					<td>Periode :</td>
					<tr>
		<td> <input type="hidden"  name="link" value="<?=$_GET['link']?>" /> 
			<input type="text" name="kode" style="height:17px;width:100%"  class="text">
</td>
</tr> 
<tr>
<td>
 <button  type="submit" class="btn success" style="height:34px;width:100%"  >&nbsp;Update&nbsp;</button> </td>
					 
					</tr>
					</table>
					</form> 


 </div>

</div>


<script>
// Get the modal
var modale = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtnxxxx");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closee")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modale.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modale.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modale) {
    modale.style.display = "none";
  }
}
</script>