<?php 
include "koneksi.php";
$awal 	= $_POST['awal'];
$akhir 	= $_POST['akhir'];


$sqldata 	= mysqli_query($con," SELECT *, max(tinggi_air) as tinggi 
													FROM tinggi_air 
													where date(air_waktu) between '$awal' and '$akhir' 
													GROUP BY date(air_waktu) ");
while ($d = mysqli_fetch_array($sqldata)) {
	$data['tinggi_air'][] 	= (float) $d['tinggi'];
	$data['label'][] 		= date('d-m-Y',strtotime($d['air_waktu']));
}

if (mysqli_num_rows($sqldata) > 0) {
	$data['jumlah'] = count($data['tinggi_air']);
}
else
{
	$data['jumlah'] = 0;
}


echo json_encode($data);
?>