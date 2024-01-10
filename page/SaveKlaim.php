<?php
session_start();
include("../include/connect.php");
#error_reporting(0);
$link=$_POST['link'];
$realcost=$_POST['realcost'];
$jumlah=$_POST['jumlah'];
$periode=$_POST['periode'];
$nip=$_SESSION['NIP'];
$date=date('Y-m-d');
$ket=$_POST['keterangan'];
$op=$_POST['op'];
$id=$_POST['id'];
$status=$_POST['status'];


if($op=="edit")
{
	$statusq = "UPDATE x_SettingKlaim SET 
	tanggal='$date',jumlah='$jumlah',periode='$periode',nip='$nip',status='$status',tgl_input='$date',ket='$ket',KdCrb='$crb'
	 WHERE id = '$id'" ;
	$berhasil = mysql_query($statusq);
}else{   
// $simpan="insert into x_SettingKlaim (
// tanggal,
// jumlah,
// periode,nip,status,tgl_input,ket,KdCrb) 
// values('$date','$jumlah','$periode','$nip','$status','$date','$ket','$crb')";
// $berhasil=mysql_query($simpan); 
$statusq = "UPDATE transaksiranap SET 
TotalNilaiRealisasi='$jumlah'
 WHERE IdRegisterKunjungan = '$id'" ;
$berhasil = mysql_query($statusq);

$data = "UPDATE registerranap SET 
StatusRealisasi=1,NilaiRealisasi='$jumlah', NilaiRealCost='$realcost',created_at='$date'
 WHERE IdRegisterKunjungan = '$id'" ;
$berhasil = mysql_query($data);
}

if($berhasil){
echo "<SCRIPT>
<!--
document.location='../index.php?link=$link&id=$id';
//-->
</SCRIPT>";
}
else{
echo "<SCRIPT>
<!--
alert('Gagal Menyimpan!!');
document.location='../index.php?link=$link&id=$id';
//-->
</SCRIPT>";
} 

mysql_close();
?>