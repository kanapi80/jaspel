<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if (!isset($_SESSION['locationcode'])) {
    header("location:login.php");
}
include("./include/connect.php");
include("./include/function.php");
include("tanggal.php");

if (isset($_GET["link"])) {
    $link = $_GET["link"];
} else {
    $link = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Elegant admin lite design, Elegant admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description" content="Elegant Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>SIMRS | e-jaspel</title>
    <!-- <link rel="canonical" href="https://www.wrappixel.com/templates/elegant-admin-lite/" /> -->
    <link rel="icon" type="image/png" sizes="16x16" href="rsudimy/assets/images/dasb.png">
    <!-- <link href="rsudimy/gaya.css" rel="stylesheet"> -->
    <link href="rsudimy/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <link href="rsudimy/assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <link href="rsudimy/dist/css/style.css" rel="stylesheet">
    <link href="rsudimy/dist/css/pages/dashboard1.css" rel="stylesheet">
    <link href="css/Theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Sweetalert 2 CSS -->
    <!-- <link rel="stylesheet" href="sweet/sweetalert2.min.css"> -->
    <script src="./jscss/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    /* Style the sidenav links and the dropdown button */
    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        /* font-size: 20px; */
        color: #8991a9;
        display: block;
        border: none;
        /* background: none; */
        width: 100%;
        text-align: left;
        cursor: pointer;
        /* outline: none; */
    }

    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
        display: none;
        /* background-color: #1f2023; */
        padding-left: 8px;
        /* padding: 16px 8px 6px 8px; */
        color: #8991a9;
        /* background: rgba(0, 0, 0, 0.02); */
        /* background: linear-gradient(to right, #17a956 , #013c1b); */
        background: linear-gradient(to right, #1f2023, #2b2f3a);
    }

    .dropdown-container:hover {
        display: none;
        /* background-color: #1f2023; */
        padding-left: 8px;
        /*padding: 16px 8px 6px 8px;*/
        color: red;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
        float: right;
        padding-right: 18px;
        color: #009efb;
    }

    .fa-angle-right {
        float: right;
        padding-right: 18px;
        color: #009efb;
    }
</style>

<body class="skin-default-dark fixed-layout">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">SIMRS | e-jaspel RSUD INDRAMAYU</p>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="rsudimy/assets/images/rs-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="rsudimy/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text -->
                            <img src="rsudimy/assets/images/rs-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="rsudimy/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="fa fa-bars tooltips"></i></a></li>&nbsp;&nbsp;
                        <btn data-toggle="collapse" data-target="#demo" type="button" class="btn btn-sm btn-outline-success">
                            <i class="fa fa-solid fa-certificate"></i>&nbsp;&nbsp;<?php
                                                                                    $st  = "SELECT a.KdCrb,a.periode,a.jumlah,b.NAMA FROM x_SettingKlaim a
				  left join m_carabayar b ON a.KdCrb=b.KODE where a.status ='ON' ";
                                                                                    $sts   = mysql_query($st);
                                                                                    $stts = mysql_fetch_assoc($sts);
                                                                                    echo '',  $stts['NAMA'],  '</btn>';
                                                                                    ?>
                        </btn>
                        &nbsp;&nbsp;
                        <div id="demo" class="collapse">
                            <btn data-toggle="collapse" data-target="#demo" type="button" class="btn btn-sm btn-outline-success">
                                Periode : <?= $stts['periode']; ?> | <?= number_format($stts['jumlah']); ?> |
                                <?= $stts['ket']; ?></btn>
                        </div>
                        <!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="fa fa-times"></i></a>
                            </form> -->
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php

                                                                                                                                                                                echo '<span style="font-size:12px">', $_SESSION['NIP'], '&nbsp;|<span>', '<a href="log_oute.php"><i class="fa fa-power-off zoom"  title="Keluar" data-toggle="tooltip" data-placement="top" ></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                                                                                                                                                                                ?></a>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <span><img src="rsudimy/assets/images/icon_2.png" alt="JASPEL"></span>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i class="ti-menu fa fa-bars tooltips"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-menu fa fa-close"></i></a>
            </div>
            <!--MENU-->
            <?php include("menu.php"); ?>
            <!--END MENU-->
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <!-- <h5 class="text-themecolor"><?php $link = $_GET['link'];
                                                            if (empty($link)) {
                                                                echo "Dasboard";
                                                            } else {
                                                                echo $_GET['link'];
                                                            } ?></h5> -->
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active"><?php $link = $_GET['link'];
                                                                    if (empty($link)) {
                                                                        echo "Dasboard";
                                                                    } else {
                                                                        echo $_GET['link'];
                                                                    } ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <?php include("net.php"); ?>
            </div>
        </div>
    </div>
    <footer class="footer">
        © <?php echo date('Y'); ?> SIMRS | e-jaspel RSUD INDRAMAYU
    </footer>
    </div>
    <script src="rsudimy/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="rsudimy/assets/node_modules/popper/popper.min.js"></script>
    <script src="rsudimy/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="rsudimy/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="rsudimy/dist/js/waves.js"></script>
    <script src="rsudimy/dist/js/sidebarmenu.js"></script>
    <script src="rsudimy/dist/js/custom.min.js"></script>
    <script src="rsudimy/assets/node_modules/raphael/raphael-min.js"></script>
    <script src="rsudimy/assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="rsudimy/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="rsudimy/assets/node_modules/d3/d3.min.js"></script>
    <script src="rsudimy/assets/node_modules/c3-master/c3.min.js"></script>
    <script src="rsudimy/dist/js/dashboard1.js"></script>
    <!-- Sweetalert2 JS -->
    <script src="sweet/sweetalert2.min.js"></script>
    <!--Bertingkat-->



    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>


</body>

</html>