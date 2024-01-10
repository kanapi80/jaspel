<? session_start();
if (!isset($_SESSION['locationcode'])) {
  header("location:logins.php");
}
if ($_SESSION['level'] == "1") { ?>
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <!-- <li> <a class="waves-effect waves-dark" href="index.php?link=Dashboard" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
        <li> <a class="waves-effect waves-dark" href="index.php?link=SettingKlaim" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Klaim Asuransi</span></a></li> -->
        <li> <a class="waves-effect waves-dark" href="index.php?link=ListPasienRajal" aria-expanded="false"><i class="fa fa-user-md"></i><span class="hide-menu">Register Rajal</span></a></li>
        <li> <a class="waves-effect waves-dark" href="index.php?link=ListPasien" aria-expanded="false"><i class="fa fa-user-md"></i><span class="hide-menu">Register Ranap</span></a></li>
        <li> <a class="waves-effect waves-dark" href="index.php?link=ListPasienIGD" aria-expanded="false"><i class="fa fa-user-md"></i><span class="hide-menu">Register IGD</span></a></li>
        <span class="dropdown-btn">Rawat Jalan <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">
          <!-- <li> <a href="index.php?link=DetailRajal" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-align-left"></i><span class="hide-menu"></span>Det.Pendapatan</a></li> -->
          <!--   <span class="dropdown-btn">Poliklinik <i class="fa fa-caret-down"></i></span>
          <span class="dropdown-container">
          <li> <a href="index.php?link=DetailPoliklinik" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Det.Poliklinik</a></li>-->
          <li> <a href="index.php?link=DetPoliklinik" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Detail Poliklinik</a></li>
          <!--  <li> <a href="index.php?link=RekapPoliklinik" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap.Poliklinik</a></li>-->
          <li> <a href="index.php?link=RekapPoli" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Poliklinik</a></li>
          <li> <a href="index.php?link=RekapDokterPoliklinik" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Dokter</a></li>
          <li> <a href="index.php?link=RekapDokterPerujuk" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Dokter Perujuk</a></li>
        </span>
        <!-- <span class="dropdown-btn">Dokter <i class="fa fa-caret-down"></i></span>
          <span class="dropdown-container">
            <li> <a href="index.php?link=DetailDokterPoliklinik" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Det.Dokter</a></li>
            <li> <a href="index.php?link=RekapDokterPoliklinik" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Dokter</a></li>
            <li> <a href="index.php?link=RekapDokterPerujuk" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Dokter Perujuk</a></li>
          </span>-->
        </span>
        <span class="dropdown-btn">Rawat Inap <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">
          <li> <a href="index.php?link=DetailRuangan" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Detail Ruangan</a></li>
          <li> <a href="index.php?link=RekapRuangan" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Ruangan</a></li>
          <li> <a href="index.php?link=RekapDokter" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Dokter</a></li>
          <!--  <li> <a href="index.php?link=DetailRanap" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-align-left"></i><span class="hide-menu"></span>Det.Pendapatan</a></li>
          <span class="dropdown-btn">Ruangan <i class="fa fa-caret-down"></i></span>
          <span class="dropdown-container">
            <li> <a href="index.php?link=DetailRuangan" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Det.Ruangan</a></li>
            <li> <a href="index.php?link=RekapRuangan" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Ruangan</a></li>
          </span>
          <span class="dropdown-btn">Dokter <i class="fa fa-caret-down"></i></span>
          <span class="dropdown-container">
            <li> <a href="index.php?link=DetailDokter" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Det.Dokter</a></li>
            <li> <a href="index.php?link=RekapDokter" class="waves-effect waves-dark" aria-expanded="false">
                <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Dokter</a></li>
          </span>-->
        </span>
        <span class="dropdown-btn">Penunjang <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">
          <li> <a href="index.php?link=DetailPenunjangRajal" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Det.Rajal</a></li>
          <li> <a href="index.php?link=RekapPenunjangRajal" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Rajal</a></li>
          <li> <a href="index.php?link=DetailPenunjangRanap" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Det.Ranap</a></li>
          <li> <a href="index.php?link=RekapPenunjangRanap" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap Ranap</a></li>
          <!-- <li> <a href="index.php?link=#" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>Det.APS</a></li>
          <li> <a href="index.php?link=Daftar Pegawai" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-circle-o"></i><span class="hide-menu"></span>&nbsp;&#187;&nbsp;Rekap APS</a></li> -->

        </span>
        <li> <a class="waves-effect waves-dark" href="index.php?link=DetailRR" aria-expanded="false"><i class="fa fa-university"></i><span class="hide-menu">R R</span></a></li>
        <li> <a class="waves-effect waves-dark" href="index.php?link=Farmasi&rekap=rajal" aria-expanded="false"><i class="fa fa-medkit"></i><span class="hide-menu">F a r m a s i</span></a></li>
        <!--USER-->
        <!-- <span class="dropdown-btn">USER <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">
          <li> <a href="index.php?link=Profile&ID=<?= $_SESSION['id_user'] ?>" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-smile-o"></i><span class="hide-menu"></span>Profile</a></li>
          <li> <a href="index.php?link=#" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-smile-o"></i><span class="hide-menu"></span>Penerimaan</a></li>
        </span>

        <li> <a class="waves-effect waves-dark" href="index.php?link=icon" aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu"></span>ICON</a></li> -->

        <div class="text-center m-t-30">
        </div>
      </ul>
    </nav>
  </div>
<? } ?>
<!--USER-->
<? if ($_SESSION['ROLES'] == "32") { ?>
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <!-- <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>  -->
        <!--  <span class="dropdown-btn">USER <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">-->
        <li> <a href="index.php?link=Profil" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-user-md"></i><span class="hide-menu"></span><span class="list">&#187; </span>&nbsp;Profile</a></li>
        <li> <a href="index.php?link=Index Pegawai" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-align-left"></i><span class="hide-menu"></span><span class="list">&#187; </span>&nbsp;Index</a></li>
        <li> <a href="index.php?link=Riwayat Jasa" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-money"></i><span class="hide-menu"></span><span class="list">&#187; </span>&nbsp;Penerimaan</a></li>
        </span>

        <!-- <li> <a class="waves-effect waves-dark" href="index.php?link=icon"  aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu"></span>ICON</a></li> -->

        <div class="text-center m-t-30">
        </div>
      </ul>
    </nav>
  </div>
<? } ?>

<!--KEPEGAWAIAN-->
<? if ($_SESSION['ROLES'] == "90") { ?>
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
        </span>
        <!--<span class="dropdown-btn">PEGAWAI <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">-->
        <li> <a href="index.php?link=INDEX" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-align-left"></i><span class="hide-menu"></span>Index</a></li>
        <li> <a href="index.php?link=PEGAWAI" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-user"></i><span class="hide-menu"></span>Data Pegawai</a></li>
        </span>

        <!-- <li> <a class="waves-effect waves-dark" href="index.php?link=icon"  aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu"></span>ICON</a></li> -->

        <div class="text-center m-t-30">
        </div>
      </ul>
    </nav>
  </div>
<? } ?>
<!--KEUANGAN-->
<? if ($_SESSION['ROLES'] == "91") { ?>
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false">
            <i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
        </span>
        <li> <a href="index.php?link=PENERIMAAN" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-user"></i><span class="hide-menu"></span>Penerimaan</a></li>
        <li> <a href="index.php?link=INDEX" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-align-left"></i><span class="hide-menu"></span>Index</a></li>
        <span class="dropdown-btn">Laporan <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">
          <li> <a href="index.php?link=JASA" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-align-left"></i><span class="hide-menu"></span><span style="color:#3399FF;font-weight:bold">+ </span>&nbsp; J a s a</a></li>
          <li> <a href="index.php?link=REKAP PENERIMAAN" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-user"></i><span class="hide-menu"></span><span style="color:#3399FF;font-weight:bold">+ </span>&nbsp;Penerimaan</a></li>
          <li> <a href="index.php?link=REKAP JASA" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-user"></i><span class="hide-menu"></span><span style="color:#3399FF;font-weight:bold">+ </span>&nbsp;Rekap Jasa</a></li>
          <!-- <span class="dropdown-btn">KEUANGAN <i class="fa fa-caret-down"></i></span>
        <span class="dropdown-container">
          <li> <a href="index.php?link=INDEX" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-align-left"></i><span class="hide-menu"></span>Index</a></li>
          <li> <a href="index.php?link=PENDAPATAN" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-user"></i><span class="hide-menu"></span>Penerimaan</a></li>
          <li> <a href="index.php?link=JASA" class="waves-effect waves-dark" aria-expanded="false">
              <i class="fa fa-user"></i><span class="hide-menu"></span>Jasa</a></li>
        </span>-->

          <!-- <li> <a class="waves-effect waves-dark" href="index.php?link=icon"  aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu"></span>ICON</a></li> -->

          <div class="text-center m-t-30">
          </div>
      </ul>
    </nav>
  </div>
<? } ?>

<!--UNIT-->
<? if ($_SESSION['ROLES'] == "33") { ?>
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
        <li> <a href="index.php?link=Daftar Pegawai" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-user-md"></i><span class="hide-menu"></span>Daftar Pegawai</a></li>
        <li> <a href="index.php?link=INDEX" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-tasks"></i><span class="hide-menu"></span>Indeks</a></li>
        <div class="text-center m-t-30">
        </div>
      </ul>
    </nav>
  </div>
<? } ?>
<!--DIREKTUR-->
<? if ($_SESSION['ROLES'] == "34") { ?>
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
        <li> <a href="index.php?link=Daftar Pegawai" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-user-md"></i><span class="hide-menu"></span>Daftar Pegawai</a></li>
        <li> <a href="index.php?link=INDEX" class="waves-effect waves-dark" aria-expanded="false">
            <i class="fa fa-tasks"></i><span class="hide-menu"></span>Indeks</a></li>
        <div class="text-center m-t-30">
        </div>
      </ul>
    </nav>
  </div>
<? } ?>