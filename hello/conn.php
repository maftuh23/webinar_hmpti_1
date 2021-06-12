<?php 
// DB Local
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "webinar_hmti_crud";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}
?>