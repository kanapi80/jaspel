<?php
	include("../include/connect.php");

$ins	= 'INSERT INTO t_jaspel (IdxBill,IdxDaftar,Tanggal,Nomr,NamaPasien,KodePoly,NamaPoly,KodeTindakan,NamaTindakan,KodeDokter,NamaDokter,KodeUnit,NamaUnit,Original,
JasaSarana,JasaPelayanan,JasaRS,JasaPelaksana,Operasional,Manajemen,Medis,MedisUmum,Paramedis,Kebersamaan,
TglReg,Periode,KodeBayar,NamaBayar,KodePerujuk,NamaPerujuk) 
SELECT a.IDXBILL,a.IDXDAFTAR,a.TANGGAL,a.NOMR,b.NAMA,a.KDPOLY,c.nama, a.KODETARIF,d.nama_tindakan,a.KDDOKTER,e.NAMADOKTER,a.UNIT,f.nama,a.jumlah,
a.JASA_SARANA,a.JASA_PELAYANAN,a.jasa_rs,a.jasa_pelaksana,a.operasional,a.manajemen,a.MEDIS,a.MEDIS_UMUM,a.PARAMEDIS,a.COSTSHARING,
a.TANGGAL,i.JM,a.CARABAYAR,g.NAMA,a.perujuk,h.NAMADOKTER
FROM t_billrajal a
LEFT JOIN m_pasien b ON b.NOMR = a.NOMR
LEFT JOIN m_poly c ON c.kode = a.KDPOLY
LEFT JOIN m_tarif2012 d ON d.kode_tindakan = a.KODETARIF
LEFT JOIN m_dokter e ON e.KDDOKTER = a.KDDOKTER
LEFT JOIN m_poly f ON f.kode =a.UNIT
LEFT JOIN m_carabayar g ON g.KODE=a.CARABAYAR
LEFT JOIN m_dokter h ON h.KDDOKTER = a.perujuk
INNER JOIN t_pendaftaran i ON i.IDXDAFTAR = a.IDXDAFTAR

WHERE i.JM ="1"  ';
$insert= mysql_query($ins); 

?>
