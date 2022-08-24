<?php 
session_start();
date_default_timezone_set("Asia/Bangkok");
$con = mysqli_connect('localhost','root','','db_iot');
if (!$con) {
	echo "<script>alert('koneksi database gagal')</script>";
}