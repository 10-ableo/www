<?php 
include "koneksi.php";

//cek jumlah data yang mask dari alat
$sqljml 	= mysqli_num_rows(mysqli_query($con," SELECT * FROM tinggi_air "));
//jika jumlahnya lebih dari 10 maka inialisasikan batas untuk memanggil 10 data terakhir yang masuk kedalam database untuk ditampilkan ke grafik realtime, akan tetapi jika data yang masuk masih kurang dari 10 data maka tampilkan semua data
if ($sqljml > 10) {
	$batas 		= $sqljml - 11;
	$sqldata 	= mysqli_query($con," SELECT tinggi_air,DATE_FORMAT(air_waktu, '%H:%i:%s') as air_waktu FROM tinggi_air order by air_id limit $batas,10 ");
}
else
{
	$sqldata 	= mysqli_query($con," SELECT tinggi_air,DATE_FORMAT(air_waktu, '%H:%i:%s') as air_waktu FROM tinggi_air order by air_id");
}
$data 		= array();

//data yang ada pada database kemudian dijadikan array untuk dikirim via json
while ($d = mysqli_fetch_array($sqldata)) {
	$data['tinggi_air'][] 	= (float) $d['tinggi_air'];
	$data['label'][] 	= $d['air_waktu'];
}
echo json_encode($data);
?>