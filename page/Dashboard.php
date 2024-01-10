<? if ($_SESSION['ROLES'] == "88") { ?>
   
<?php
     $ran = "select count(id_admission) AS ranap,
             sum(if (statusbayar = 1 ,1,NULL)) as UMUM,
             sum(if (statusbayar = 5 ,1,NULL)) as BPJS,
             sum(if (statusbayar = 8 ,1,NULL)) as JM,
             sum(if (statusbayar = 2 ,1,NULL)) as JR,
             sum(if (statusbayar != 1 AND statusbayar !=5 AND statusbayar !=8 AND statusbayar !=2 ,1,NULL)) as LAIN,
             sum(if (statusbayar > 0  ,1,NULL)) as TOTAL
             FROM t_admission where masukrs is not null  and keluarrs is null  and statusbayar !='0' and ST_RAWAT ='0' ";
     $ranap	= mysql_query($ran);
     $rnp = mysql_fetch_array($ranap);
	?>
 <?php
  $bed="select sum(jumlah_tt) as JUMLAHBED
 from m_ruang WHERE status ='0' ";
  $bedx = mysql_query($bed) or die('Error');   
	$bedxx=mysql_fetch_array($bedx)   ?>
        <?php
  $kel="select count(id_admission) AS ranap
  FROM t_admission where masukrs is not null  and keluarrs is null ";
  $kelu = mysql_query($kel) or die('Error');   
	$keluar=mysql_fetch_array($kelu)   ?>
<button onClick="topFunction()" id="balik" title="Go to top">&uarr;</button>
  <div class="row">

<?php
  $ranx = "SELECT b.NAMA,
          sum(a.jumlah) as JUMLAH
         
           FROM x_settingklaim a 
           left join m_carabayar b ON b.KODE=a.KdCrb
            GROUP BY a.KdCrb ";
  $ranapx	= mysql_query($ranx);
  while ($rnpx = mysql_fetch_array($ranapx)){
?>


<div class="col-lg-4 ">
<div class="card " style="background: radial-gradient(#60efbc, #58d5c9);">
<div class="card-body ">
<center> <div class="d-flex m-b-40 align-items-center no-block ">
 <h5 class="card-title"><?=$rnpx['NAMA'];?></h5>
    <div class="ml-auto">
        
    </div>
</div>
<!--<span style="font-size:30px;color:#fff">  <i class="fa fa-user-md"></i> <br><?=$rnpx['JUMLAH'];?></span>
 <br>PASIEN -->
</center>
</div>
<div class="card-body bg-light">
    <div class="row text-center m-b-20">
        <div class="col-lg-12 col-md-12 m-t-20">
         <span style="font-size:25px;color:#000"> <?=number_format($rnpx['JUMLAH']);?></span>

        </div>
        
        </div>
        </div>
    </div>
</div>

<? } ?>


</div>
</div>
<br>
<script>
//Get the button
var mybutton = document.getElementById("balik");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

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
        <!--END-->
    </div>
<? } ?>
