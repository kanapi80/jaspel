<?php
#session_start();
switch ($link) {
    default:
        if (!file_exists("page/dasboard.php"))
            die("page/dasboard.php File Empty!");
        include 'page/dasboard.php';
        break;
        //grafik dashboard
    case 'SettingKlaim':
        if (!file_exists("page/SettingKlaim.php"))
            die("page/SettingKlaim.php File Empty!");
        include 'page/SettingKlaim.php';
        break;
    case 'ListPasien':
        if (!file_exists("page/ListPasien.php"))
            die("page/ListPasien.php File Empty!");
        include 'page/ListPasien.php';
        break;
    case 'ListPasienRajal':
        if (!file_exists("page/ListPasienRajal.php"))
            die("page/ListPasienRajal.php File Empty!");
        include 'page/ListPasienRajal.php';
        break;
    case 'ListPasienIGD':
        if (!file_exists("page/ListPasienIGD.php"))
            die("page/ListPasienIGD.php File Empty!");
        include 'page/ListPasienIGD.php';
        break;
    case 'PilihPasien':
        if (!file_exists("page/PilihPasien.php"))
            die("page/PilihPasien.php File Empty!");
        include 'page/PilihPasien.php';
        break;
    case 'PilihPasienRajal':
        if (!file_exists("page/PilihPasienRajal.php"))
            die("page/PilihPasienRajal.php File Empty!");
        include 'page/PilihPasienRajal.php';
        break;
    case 'CETAK':
        if (!file_exists("page/BillingPasien.php"))
            die("page/BillingPasien.php File Empty!");
        include 'page/BillingPasien.php';
        break;
    case 'DetailRajal':
        if (!file_exists("page/DetRajal.php"))
            die("page/DetRajal.php File Empty!");
        include 'page/DetRajal.php';
        break;
    case 'DetailRanap':
        if (!file_exists("page/DetRanap.php"))
            die("page/DetRanap.php File Empty!");
        include 'page/DetRanap.php';
        break;
    case 'DetailRuangan':
        if (!file_exists("page/DetRuangan.php"))
            die("page/DetRuangan.php File Empty!");
        include 'page/DetRuangan.php';
        break;
    case 'RekapRuangan':
        if (!file_exists("page/RekapRuangan.php"))
            die("page/RekapRuangan.php File Empty!");
        include 'page/RekapRuangan.php';
        break;
    case 'DetailDokter':
        if (!file_exists("page/DetDokter.php"))
            die("page/DetDokter.php File Empty!");
        include 'page/DetDokter.php';
        break;
    case 'RekapDokter':
        if (!file_exists("page/RekapDokter.php"))
            die("page/RekapDokter.php File Empty!");
        include 'page/RekapDokter.php';
        break;
    case 'DetailPoliklinik':
        if (!file_exists("page/DetPoli.php"))
            die("page/DetPoli.php File Empty!");
        include 'page/DetPoli.php';
        break;
    case 'RekapPoliklinik':
        if (!file_exists("page/RekapPoli.php"))
            die("page/RekapPoli.php File Empty!");
        include 'page/RekapPoli.php';
        break;
    case 'DetailDokterPoliklinik':
        if (!file_exists("page/DetDokterPoli.php"))
            die("page/DetDokterPoli.php File Empty!");
        include 'page/DetDokterPoli.php';
        break;
    case 'RekapDokterPoliklinik':
        if (!file_exists("page/RekapDokterPoliklinik.php"))
            die("page/RekapDokterPoliklinik.php File Empty!");
        include 'page/RekapDokterPoliklinik.php';
        break;
    case 'RekapDokterPerujuk':
        if (!file_exists("page/RekapDokterPerujuk.php"))
            die("page/RekapDokterPerujuk.php File Empty!");
        include 'page/RekapDokterPerujuk.php';
        break;
    case 'DetailRR':
        if (!file_exists("page/DetRR.php"))
            die("page/DetRR.php File Empty!");
        include 'page/DetRR.php';
        break;
    case 'DetailPenunjangRajal':
        if (!file_exists("page/DetPenunjang.php"))
            die("page/DetPenunjang.php File Empty!");
        include 'page/DetPenunjang.php';
        break;
    case 'RekapPenunjangRajal':
        if (!file_exists("page/RekapPenunjang.php"))
            die("page/RekapPenunjang.php File Empty!");
        include 'page/RekapPenunjang.php';
        break;
    case 'DetailPenunjangRanap':
        if (!file_exists("page/DetPenunjangRanap.php"))
            die("page/DetPenunjangRanap.php File Empty!");
        include 'page/DetPenunjangRanap.php';
        break;
    case 'RekapPenunjangRanap':
        if (!file_exists("page/RekapPenunjangRanap.php"))
            die("page/RekapPenunjangRanap.php File Empty!");
        include 'page/RekapPenunjangRanap.php';
        break;
        //KEUANGAN
    case 'PENERIMAAN':
        if (!file_exists("page/t_pendapatan.php"))
            die("page/t_pendapatan.php File Empty!");
        include 'page/t_pendapatan.php';
        break;
    case 'REKAP PENERIMAAN':
        if (!file_exists("page/r_pendapatan.php"))
            die("page/r_pendapatan.php File Empty!");
        include 'page/r_pendapatan.php';
        break;
    case 'JASA':
        if (!file_exists("page/t_jasaremun.php"))
            die("page/t_jasaremun.php File Empty!");
        include 'page/t_jasaremun.php';
        break;
    case 'REKAP JASA':
        if (!file_exists("page/t_rekapjasa.php"))
            die("page/t_rekapjasa.php File Empty!");
        include 'page/t_rekapjasa.php';
        break;
    case 'Profile':
        if (!file_exists("kepegawaian/d_pegawai.php"))
            die("kepegawaian/d_pegawai.php File Empty!");
        include 'kepegawaian/d_pegawai.php';
        break;
    case 'icon':
        if (!file_exists("rsudimy/icon-fontawesome.html"))
            die("rsudimy/icon-fontawesome.html File Empty!");
        include 'rsudimy/icon-fontawesome.html';
        break;
        //USER
    case 'Profil':
        if (!file_exists("kepegawaian/profile.php"))
            die("kepegawaian/profile.php File Empty!");
        include 'kepegawaian/profile.php';
        break;
    case 'Index Pegawai':
        if (!file_exists("page/index_profil.php"))
            die("page/index_profil.php File Empty!");
        include 'page/index_profil.php';
        break;
    case 'Riwayat Jasa':
        if (!file_exists("page/det_penerimaan.php"))
            die("page/det_penerimaan.php File Empty!");
        include 'page/det_penerimaan.php';
        break;
        //UNIT
    case 'Daftar Pegawai':
        if (!file_exists("page/pegawai_ruangan.php"))
            die("page/pegawai_ruangan.php File Empty!");
        include 'page/pegawai_ruangan.php';
        break;
        //JASPEL
    case 'DetPoliklinik':
        if (!file_exists("page/DetailRajal.php"))
            die("page/DetailRajal.php File Empty!");
        include 'page/DetailRajal.php';
        break;
    case 'RekapPoli':
        if (!file_exists("page/RekapPoliklinik.php"))
            die("page/RekapPoliklinik.php File Empty!");
        include 'page/RekapPoliklinik.php';
        break;
    case 'Dashboard':
        if (!file_exists("page/Dashboard.php"))
            die("page/Dashboard.php File Empty!");
        include 'page/Dashboard.php';
        break;
        //FARMASI
    case 'Farmasi':
        if (!file_exists("farmasi/RekapResepPoliklinik.php"))
            die("farmasi/RekapResepPoliklinik.php File Empty!");
        include 'farmasi/RekapResepPoliklinik.php';
        break;
    case 'DetailResepPoliklinik':
        if (!file_exists("farmasi/DetailResepPoliklinik.php"))
            die("farmasi/DetailResepPoliklinik.php File Empty!");
        include 'farmasi/DetailResepPoliklinik.php';
        break;
    case 'DetailResepDokter':
        if (!file_exists("farmasi/DetailResepDokter.php"))
            die("farmasi/DetailResepDokter.php File Empty!");
        include 'farmasi/DetailResepDokter.php';
        break;
    case 'DetailResepRanap':
        if (!file_exists("farmasi/DetailResepRanap.php"))
            die("farmasi/DetailResepRanap.php File Empty!");
        include 'farmasi/DetailResepRanap.php';
        break;
    case 'DetailResepIBS':
        if (!file_exists("farmasi/DetailResepIBS.php"))
            die("farmasi/DetailResepIBS.php File Empty!");
        include 'farmasi/DetailResepIBS.php';
        break;
}
