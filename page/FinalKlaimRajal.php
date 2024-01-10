<?php
	include("../include/connect.php");
	$idx = $_GET['id_admission'];
	$nip = $_GET['nip'];
	$jen= $_GET['jen'];
	$periode=$_GET['periode'];
	$link=$_GET['link'];
	$crb=$_GET['crb'];

	if ($jen=='2'){
	$statusq = "UPDATE t_admission SET PETUGAS ='$nip' WHERE id_admission = '$idx'" ;
	$hasil2 = mysql_query($statusq);
	header("Location:../index.php?&link=$link&id_admission=$idx");}

	else{
	/*$statusq = "UPDATE t_admission SET PETUGAS ='$nip',JM='$periode' WHERE id_admission = '$idx'" ;
	$hasil2 = mysql_query($statusq);*/
	
	$statusx = "UPDATE t_pendaftaran SET PETUGAS ='$nip',JM='$periode' WHERE IDXDAFTAR = '$idx'" ;
	$hasil2 = mysql_query($statusx);
	
	
/*UPDATE RAJAL*/
@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.JASA_SARANA=t_billrajal.jumlah*m_tarif2012.pr_jasa_sarana/100,
t_billrajal.JASA_PELAYANAN=t_billrajal.jumlah*m_tarif2012.pr_jasa_pelayanan/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07' AND t_billrajal.CARABAYAR ='$crb' ") or die(mysql_error());
 
@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.jasa_rs=t_billrajal.JASA_PELAYANAN*m_tarif2012.pr_jasa_rs/100,
t_billrajal.jasa_pelaksana=t_billrajal.JASA_PELAYANAN*m_tarif2012.pr_jasa_pelaksana/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07' AND t_billrajal.CARABAYAR ='$crb' ") or die(mysql_error()); 

@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.operasional = t_billrajal.jasa_rs*m_tarif2012.pr_operasional/100, 
t_billrajal.manajemen=t_billrajal.jasa_rs*m_tarif2012.pr_manajemen/100,
t_billrajal.MEDIS=t_billrajal.jasa_pelaksana*m_tarif2012.pr_medis/100,
t_billrajal.PARAMEDIS=t_billrajal.jasa_pelaksana*m_tarif2012.pr_paramedis/100,
t_billrajal.COSTSHARING=t_billrajal.jasa_pelaksana*m_tarif2012.pr_kebersamaan/100,
t_billrajal.MEDIS_UMUM=t_billrajal.jasa_pelaksana*m_tarif2012.pr_medis_umum/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07' AND t_billrajal.CARABAYAR ='$crb' ") or die(mysql_error()); 

@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.MEDIS_UMUM=t_billrajal.jasa_pelaksana*m_tarif2012.pr_medis_umum/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07' AND t_billrajal.CARABAYAR ='$crb' ") or die(mysql_error()); 

/*UPDATE RANAP*/
/*
@mysql_query("UPDATE t_billranap 
LEFT JOIN m_tarif2012 ON t_billranap.KODETARIF=m_tarif2012.kode_tindakan 
JOIN t_admission ON t_admission.id_admission = t_billranap.IDXDAFTAR
SET 
t_billranap.JASA_SARANA=t_billranap.jumlah*m_tarif2012.pr_jasa_sarana/100,
t_billranap.JASA_PELAYANAN=t_billranap.jumlah*m_tarif2012.pr_jasa_pelayanan/100
WHERE t_admission.id_admission = '$idx%' AND t_billranap.KODETARIF !='07' AND t_billranap.CARABAYAR ='$crb' ") or die(mysql_error()); 

@mysql_query("UPDATE t_billranap 
LEFT JOIN m_tarif2012 ON t_billranap.KODETARIF=m_tarif2012.kode_tindakan 
JOIN t_admission ON t_admission.id_admission = t_billranap.IDXDAFTAR
SET 
t_billranap.jasa_rs=t_billranap.JASA_PELAYANAN*m_tarif2012.pr_jasa_rs/100,
t_billranap.jasa_pelaksana=t_billranap.JASA_PELAYANAN*m_tarif2012.pr_jasa_pelaksana/100
WHERE t_admission.id_admission = '$idx%' AND t_billranap.KODETARIF !='07' AND t_billranap.CARABAYAR ='$crb' ") or die(mysql_error()); 

@mysql_query("UPDATE t_billranap 
LEFT JOIN m_tarif2012 ON t_billranap.KODETARIF=m_tarif2012.kode_tindakan 
JOIN t_admission ON t_admission.id_admission = t_billranap.IDXDAFTAR
SET 
t_billranap.operasional = t_billranap.jasa_rs*m_tarif2012.pr_operasional/100, 
t_billranap.manajemen=t_billranap.jasa_rs*m_tarif2012.pr_manajemen/100,

t_billranap.MEDIS=t_billranap.jasa_pelaksana*m_tarif2012.pr_medis/100,
t_billranap.PARAMEDIS=t_billranap.jasa_pelaksana*m_tarif2012.pr_paramedis/100,
t_billranap.COSTSHARING=t_billranap.jasa_pelaksana*m_tarif2012.pr_kebersamaan/100,
t_billranap.MEDIS_UM=t_billranap.jasa_pelaksana*m_tarif2012.pr_medis_umum/100
WHERE t_admission.id_admission = '$idx%' AND t_billranap.KODETARIF !='07' AND t_billranap.CARABAYAR ='$crb' ") or die(mysql_error()); 


//UPDATE TNO
@mysql_query("UPDATE t_billranap a 
LEFT JOIN m_tarif2012 b ON b.kode_tindakan = a.KODETARIF
JOIN t_admission c ON c.id_admission = a.IDXDAFTAR
 SET 
	a.MEDIS = (a.jasa_pelaksana *30)/100,
	a.PARAMEDIS = (a.jasa_pelaksana *59.50)/100,
	a.COSTSHARING = (a.jasa_pelaksana *10.50)/100

 	WHERE c.id_admission = '$idx%'  
 	AND a.KODETARIF !='07' AND b.nama_gruptindakan ='TNO' AND a.perawat in('Perawat','Bidan') AND CARABAYAR ='$crb' ") or die(mysql_error());*/
	header("Location:../index.php?&link=$link&id_admission=$idx");}
	
?>
