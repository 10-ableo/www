<?php
include "koneksi.php";
if (isset($_GET['tinggi'])) {
	$tinggi = $_GET['tinggi'];
	$now 	= date('Y-m-d H:i:s');
	$sql 	= mysqli_query($con,"INSERT INTO tinggi_air (air_id,tinggi_air,air_waktu) VALUES (null,'$tinggi','$now') ");
}