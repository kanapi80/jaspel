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
$statusx = "UPDATE t_pendaftaran SET PETUGAS ='$nip',JM='$periode' WHERE IDXDAFTAR = '$id_admission'" ;
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

$del="DELETE FROM t_jaspel WHERE IdxDaftar='".$id_admission."' ";
mysql_query($del);


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
