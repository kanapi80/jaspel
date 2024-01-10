<? if ($_SESSION['ROLES'] == "33") { ?>
    <!--PEGAWAI-->
    <?php
    $pg = "select  SUM(  IF (STATUS =152 ,1,NULL) ) AS pns,
                                SUM(  IF (STATUS =153 ,1,NULL) ) AS pt,
                                SUM(  IF (STATUS =154 ,1,NULL) ) AS mitra,
                                SUM(  IF (STATUS =155 ,1,NULL) ) AS ptt,
                                SUM(  IF (STATUS =156 ,1,NULL) ) AS lain,
                                SUM(  IF (STATUS =157 ,1,NULL) ) AS ptt_prov,
                                SUM(  IF (STATUS > 0 ,1,NULL) ) AS total
     FROM m_pegawai where ONOFF='ON'  AND RUANGAN =".$_SESSION['KDUNIT']."  ";
    $pgw    = mysql_query($pg);
    $pegawai = mysql_fetch_array($pgw); ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%)">
                <div class="card-body">
                    <div class="d-flex m-b-30 align-items-center no-block">
                        <h5 class="card-title ">PEGAWAI</h5>
                        <div class="ml-auto">

                        </div>
                    </div>
                    <center> <span style="font-size:80px;color:#fff"><i class="fa fa-user-md zoom"></i></span><br><span style="font-size:40px;color:#fff"> <? echo $pegawai['total']; ?></span><br>
                        PNS & Non PNS </center>


                </div>
                <div class="card-body bg-light">
                    <div class="row text-center m-b-20">
                        <div class="col-lg-6 col-md-4 m-t-20">
                            <h2 class="m-b-0 font-light"><? echo $pegawai['pns']; ?> </h2><span class="text-muted">
                                <? $persen = round($pegawai['pns'] / $pegawai['total'] * 100, 0);
                                echo $persen, "&nbsp;%"; ?> | PNS</span>
                        </div>

                        <div class="col-lg-6 col-md-4 m-t-20">
                            <h2 class="m-b-0 font-light"><? $totx = $pegawai['total'] - $pegawai['pns'];
                                                            echo $totx; ?> </h2>
                            <span class="text-muted"><? $persenz = round($totx / $pegawai['total'] * 100, 0);
                                                        echo $persenz, "&nbsp;%"; ?> | Non PNS</span>
                            <br>

                        </div>

                    </div>
                    <div class="col-lg-12 col-md-4 m-t-20">
                        <a href="index.php?link=Daftar Pegawai" class="btn m-t-10 m-r-5 btn-outline-success">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <!--END-->
        <!--PENERIMAAN-->
        <?php
        // $pg = "select  SUM(  IF (STATUS =152 ,1,NULL) ) AS pns,
        //                             SUM(  IF (STATUS =153 ,1,NULL) ) AS pt,
        //                             SUM(  IF (STATUS =154 ,1,NULL) ) AS mitra,
        //                             SUM(  IF (STATUS =155 ,1,NULL) ) AS ptt,
        //                             SUM(  IF (STATUS =156 ,1,NULL) ) AS lain,
        //                             SUM(  IF (STATUS =157 ,1,NULL) ) AS ptt_prov,
        //                             SUM(  IF (STATUS > 0 ,1,NULL) ) AS total
        //  FROM m_pegawai where ONOFF='ON'   ";
        // $pgw    = mysql_query($pg);
        // $pegawai = mysql_fetch_array($pgw); 
        ?>
        <div class="col-lg-3">
            <div class="card" style="background: radial-gradient(#f588d8, #c0a3e5)">
                <div class="card-body">
                    <div class="d-flex m-b-30 align-items-center no-block">
                        <h5 class="card-title ">JASA REMUNERASI PEGAWAI</h5>
                        <div class="ml-auto">

                        </div>
                    </div>
                    <center> <span style="font-size:80px;color:#fff"><i class="fa fa-user-md zoom"></i></span><br><span style="font-size:40px;color:#fff"> <? echo $pegawai['total']; ?></span><br>
                        PNS & Non PNS </center>


                </div>
                <div class="card-body bg-light">
                    <div class="row text-center m-b-20">
                        <div class="col-lg-6 col-md-4 m-t-20">
                            <h2 class="m-b-0 font-light">
                                <!-- <? echo $pegawai['pns']; ?>  -->
                            </h2><span class="text-muted">
                                <!-- <? $persen = round($pegawai['pns'] / $pegawai['total'] * 100, 0);
                                        echo $persen, "&nbsp;%"; ?> -->
                                | PNS
                            </span>
                        </div>

                        <div class="col-lg-6 col-md-4 m-t-20">
                            <h2 class="m-b-0 font-light">
                                <!-- <? $totx = $pegawai['total'] - $pegawai['pns'];
                                        echo $totx; ?> -->
                            </h2>
                            <span class="text-muted">
                                <!-- <? $persenz = round($totx / $pegawai['total'] * 100, 0);
                                        echo $persenz, "&nbsp;%"; ?>  -->
                                | Non PNS
                            </span>
                            <br>

                        </div>

                    </div>
                    <!-- <div class="col-lg-12 col-md-4 m-t-20">
                    <a href="rsudim.php?link=Pegawai" class="btn m-t-10 m-r-5 btn-outline-success">Detail</a>
                </div> -->
                </div>
            </div>
        </div>
        <!--END-->
    </div>
<? } ?>

<!--UMPEG -->
<? if ($_SESSION['ROLES'] == "90") { ?>
    <!--PEGAWAI-->
    <?php
    $pg = "select  SUM(  IF (STATUS =152 ,1,NULL) ) AS pns,
                                SUM(  IF (STATUS =153 ,1,NULL) ) AS pt,
                                SUM(  IF (STATUS =154 ,1,NULL) ) AS mitra,
                                SUM(  IF (STATUS =155 ,1,NULL) ) AS ptt,
                                SUM(  IF (STATUS =156 ,1,NULL) ) AS lain,
                                SUM(  IF (STATUS =157 ,1,NULL) ) AS ptt_prov,
                                SUM(  IF (STATUS > 0 ,1,NULL) ) AS total
     FROM m_pegawai where ONOFF='ON'   ";
    $pgw    = mysql_query($pg);
    $pegawai = mysql_fetch_array($pgw); ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card" style="background: radial-gradient(circle, #1fe4f5 10%, #3fbafe  90%)">
                <div class="card-body">
                    <div class="d-flex m-b-30 align-items-center no-block">
                        <h5 class="card-title ">PEGAWAI</h5>
                        <div class="ml-auto">

                        </div>
                    </div>
                    <center> <span style="font-size:80px;color:#fff"><i class="fa fa-user-md zoom"></i></span><br><span style="font-size:40px;color:#fff"> <? echo $pegawai['total']; ?></span><br>
                        PNS & Non PNS </center>


                </div>
                <div class="card-body bg-light">
                    <div class="row text-center m-b-20">
                        <div class="col-lg-6 col-md-4 m-t-20">
                            <h2 class="m-b-0 font-light"><? echo $pegawai['pns']; ?> </h2><span class="text-muted">
                                <? $persen = round($pegawai['pns'] / $pegawai['total'] * 100, 0);
                                echo $persen, "&nbsp;%"; ?> | PNS</span>
                        </div>

                        <div class="col-lg-6 col-md-4 m-t-20">
                            <h2 class="m-b-0 font-light"><? $totx = $pegawai['total'] - $pegawai['pns'];
                                                            echo $totx; ?> </h2>
                            <span class="text-muted"><? $persenz = round($totx / $pegawai['total'] * 100, 0);
                                                        echo $persenz, "&nbsp;%"; ?> | Non PNS</span>
                            <br>

                        </div>

                    </div>
                    <div class="col-lg-12 col-md-4 m-t-20">
                        <a href="index.php?link=Daftar Pegawai" class="btn m-t-10 m-r-5 btn-outline-success">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <!--END-->
       
    </div>
<? } ?>