<?php
	include("../include/connect.php");
	$link=$_GET['link'];
	$bulan=$_GET['bulan'];
	$nip=$_GET['nip'];
	$periode=$_GET['periode'];
	$id_admission=$_GET['id_admission'];
	$idx=$_GET['id_admission'];

if(!empty($_GET['bulan'] ))
{
	
$statusq = "UPDATE t_admission SET PETUGAS ='$nip',JM='$periode' WHERE id_admission = '$idx'" ;
	$hasil2 = mysql_query($statusq);
	
	$statusx = "UPDATE t_pendaftaran SET PETUGAS ='$nip',JM='$periode' WHERE IDXDAFTAR = '$idx'" ;
	$hasil2 = mysql_query($statusx);
	
	
/*UPDATE RAJAL*/
@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.JASA_SARANA=t_billrajal.jumlah*m_tarif2012.pr_jasa_sarana/100,
t_billrajal.JASA_PELAYANAN=t_billrajal.jumlah*m_tarif2012.pr_jasa_pelayanan/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07' ") or die(mysql_error());
 
@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.jasa_rs=t_billrajal.JASA_PELAYANAN*m_tarif2012.pr_jasa_rs/100,
t_billrajal.jasa_pelaksana=t_billrajal.JASA_PELAYANAN*m_tarif2012.pr_jasa_pelaksana/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07'  ") or die(mysql_error()); 

@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.operasional = t_billrajal.jasa_rs*m_tarif2012.pr_operasional/100, 
t_billrajal.manajemen=t_billrajal.jasa_rs*m_tarif2012.pr_manajemen/100,
t_billrajal.MEDIS=t_billrajal.jasa_pelaksana*m_tarif2012.pr_medis/100,
t_billrajal.PARAMEDIS=t_billrajal.jasa_pelaksana*m_tarif2012.pr_paramedis/100,
t_billrajal.COSTSHARING=t_billrajal.jasa_pelaksana*m_tarif2012.pr_kebersamaan/100,
t_billrajal.MEDIS_UMUM=t_billrajal.jasa_pelaksana*m_tarif2012.pr_medis_umum/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07' ") or die(mysql_error()); 

@mysql_query("UPDATE t_billrajal
LEFT JOIN m_tarif2012 ON t_billrajal.KODETARIF=m_tarif2012.kode_tindakan 
SET 
t_billrajal.MEDIS_UMUM=t_billrajal.jasa_pelaksana*m_tarif2012.pr_medis_umum/100
WHERE t_billrajal.IDXDAFTAR = '$idx%' AND t_billrajal.KODETARIF !='07'  ") or die(mysql_error()); 
//DELETE 
$del="DELETE FROM t_jaspel WHERE IdxDaftar='".$id_admission."' ";
mysql_query($del);
//INSERT JASPEL
$ins	= 'INSERT INTO t_jaspel (IdxBill,IdxDaftar,Tanggal,Nomr,NamaPasien,KodePoly,NamaPoly,KodeTindakan,NamaTindakan,KodeDokter,NamaDokter,KodeUnit,NamaUnit,Original,
JasaSarana,JasaPelayanan,JasaRS,JasaPelaksana,Operasional,Manajemen,Medis,MedisUmum,Paramedis,Kebersamaan,
TglReg,Periode,KodeBayar,NamaBayar,KodePerujuk,NamaPerujuk) 
SELECT a.IDXBILL,a.IDXDAFTAR,a.TANGGAL,a.NOMR,b.NAMA,a.KDPOLY,c.nama, a.KODETARIF,d.nama_tindakan,a.KDDOKTER,e.NAMADOKTER,a.UNIT,f.nama,a.jumlah,
a.JASA_SARANA,a.JASA_PELAYANAN,a.jasa_rs,a.jasa_pelaksana,a.operasional,a.manajemen,a.MEDIS,a.MEDIS_UMUM,a.PARAMEDIS,a.COSTSHARING,
a.TANGGAL,"'.$periode.'",a.CARABAYAR,g.NAMA,a.perujuk,h.NAMADOKTER
FROM t_billrajal a
LEFT JOIN m_pasien b ON b.NOMR = a.NOMR
LEFT JOIN m_poly c ON c.kode = a.KDPOLY
LEFT JOIN m_tarif2012 d ON d.kode_tindakan = a.KODETARIF
LEFT JOIN m_dokter e ON e.KDDOKTER = a.KDDOKTER
LEFT JOIN m_poly f ON f.kode =a.UNIT
LEFT JOIN m_carabayar g ON g.KODE=a.CARABAYAR
LEFT JOIN m_dokter h ON h.KDDOKTER = a.perujuk
WHERE a.IDXDAFTAR= "'.$id_admission.'" ';
$insert= mysql_query($ins); 

//UPDATE RANAP

@mysql_query("UPDATE t_billranap 
LEFT JOIN m_tarif2012 ON t_billranap.KODETARIF=m_tarif2012.kode_tindakan 
JOIN t_admission ON t_admission.id_admission = t_billranap.IDXDAFTAR
SET 
t_billranap.JASA_SARANA=t_billranap.jumlah*m_tarif2012.pr_jasa_sarana/100,
t_billranap.JASA_PELAYANAN=t_billranap.jumlah*m_tarif2012.pr_jasa_pelayanan/100
WHERE t_admission.id_admission = '$idx' AND t_billranap.KODETARIF !='07' ") or die(mysql_error()); 

@mysql_query("UPDATE t_billranap 
LEFT JOIN m_tarif2012 ON t_billranap.KODETARIF=m_tarif2012.kode_tindakan 
JOIN t_admission ON t_admission.id_admission = t_billranap.IDXDAFTAR
SET 
t_billranap.jasa_rs=t_billranap.JASA_PELAYANAN*m_tarif2012.pr_jasa_rs/100,
t_billranap.jasa_pelaksana=t_billranap.JASA_PELAYANAN*m_tarif2012.pr_jasa_pelaksana/100
WHERE t_admission.id_admission = '$idx' AND t_billranap.KODETARIF !='07'  ") or die(mysql_error()); 

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
WHERE t_admission.id_admission = '$idx' AND t_billranap.KODETARIF !='07'  ") or die(mysql_error()); 


//UPDATE TNO
@mysql_query("UPDATE t_billranap a 
LEFT JOIN m_tarif2012 b ON b.kode_tindakan = a.KODETARIF
JOIN t_admission c ON c.id_admission = a.IDXDAFTAR
 SET 
a.MEDIS = (a.jasa_pelaksana *30)/100,
a.PARAMEDIS = (a.jasa_pelaksana *59.50)/100,
a.COSTSHARING = (a.jasa_pelaksana *10.50)/100

WHERE c.id_admission = '$idx'  
AND a.KODETARIF !='07' AND b.nama_gruptindakan ='TNO' AND a.perawat in('Perawat','Bidan')  ") or die(mysql_error());
	
//DELETE 
$del="DELETE FROM t_jaspel_ranap WHERE IdxDaftar='".$id_admission."' ";
mysql_query($del);

//INSERT JASPEL RANAP
$ins	= 'INSERT INTO t_jaspel_ranap (IdxBill,IdxDaftar,Tanggal,Nomr,NamaPasien,KodePoly,NamaPoly,KodeTindakan,NamaTindakan,KodeDokter,NamaDokter,
KodeUnit,NamaUnit,Original,JasaSarana,JasaPelayanan,JasaRS,JasaPelaksana,Operasional,Manajemen,Medis,MedisUmum,Paramedis,Kebersamaan,
TglReg,Periode,KodeBayar,NamaBayar,KodePerujuk,NamaPerujuk) 
SELECT a.IDXBILL,a.IDXDAFTAR,a.TANGGAL,a.NOMR,b.NAMA,a.KDPOLY,c.ket_ruang, a.KODETARIF,d.nama_tindakan,a.KDDOKTER,e.NAMADOKTER,
a.UNIT,f.nama,a.jumlah,a.JASA_SARANA,a.JASA_PELAYANAN,a.jasa_rs,a.jasa_pelaksana,a.operasional,a.manajemen,a.MEDIS,a.MEDIS_UM,a.PARAMEDIS,a.COSTSHARING,
h.keluarrs,"'.$periode.'",a.CARABAYAR,g.NAMA,a.perawat,i.NAMADOKTER
FROM t_billranap a
LEFT JOIN m_pasien b ON b.NOMR = a.NOMR
LEFT JOIN m_ruang c ON c.no = a.KDPOLY
LEFT JOIN m_tarif2012 d ON d.kode_tindakan = a.KODETARIF
LEFT JOIN m_dokter e ON e.KDDOKTER = a.KDDOKTER
LEFT JOIN m_poly f ON f.kode =a.UNIT
LEFT JOIN m_carabayar g ON g.KODE=a.CARABAYAR
LEFT JOIN t_admission h ON h.id_admission =a.IDXDAFTAR
LEFT JOIN m_dokter i ON i.KDDOKTER = a.KDDOKTER
WHERE a.IDXDAFTAR= "'.$id_admission.'" ';
$insert= mysql_query($ins); 

$statusq = "UPDATE  t_jaspel_ranap SET NamaTindakan ='Pelayanan Resep' WHERE IdxDaftar = '$idx' And KodeTindakan ='07'" ;
	$hasil2 = mysql_query($statusq);

echo "<SCRIPT>
document.location='../index.php?link=$link&id_admission=$id_admission';
</SCRIPT>";
}
else{
echo "<SCRIPT>
alert('Gagal Menyimpan !!');
document.location='../index.php?link=$link&id_admission=$id_admission';
</SCRIPT>";
}
mysql_close();
?>
