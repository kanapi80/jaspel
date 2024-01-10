<?php
#session_start();
switch ($link) {
    default			:
        if (!file_exists ("adm/main.php"))
            die ("adm/main.php File Empty!");
        include 'adm/main.php';
        break;
    //grafik dashboard
   		  case 'unpasien_pulang'            :
        if (!file_exists ("adm/list_pasien_rajal.php"))
            die ("adm/list_pasien_rajal.php File Empty!");
        include 'adm/list_pasien_rajal.php';
        break;
		 case 'unpasien_pulang_ranap'            :
        if (!file_exists ("adm/list_pasien_ranap.php"))
            die ("adm/list_pasien_ranap.php File Empty!");
        include 'adm/list_pasien_ranap.php';
        break;
		 case 'tarif'            :
        if (!file_exists ("adm/tarif.php"))
            die ("adm/tarif.php File Empty!");
        include 'adm/tarif.php';
        break;
		 case 'formula_jasa'            :
        if (!file_exists ("adm/formula_jasa.php"))
            die ("adm/formula_jasa.php File Empty!");
        include 'adm/formula_jasa.php';
        break;
				 case 'up_jasa'            :
        if (!file_exists ("adm/update_jasa_klaim.php"))
            die ("adm/update_jasa_klaim.php File Empty!");
        include 'adm/update_jasa_klaim.php';
        break;
		 case 'validasi_tarif'            :
        if (!file_exists ("adm/validasi_tarif.php"))
            die ("adm/validasi_tarif.php File Empty!");
        include 'adm/validasi_tarif.php';
        break; 
		
}


?>
