<?php

require_once __DIR__ . "/../config/koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$nominal = str_replace(".", "", $_POST['nominal']);

mysqli_query($conn,

"UPDATE transaksi
SET
nama='$nama',
nominal='$nominal'
WHERE id='$id'");

header("Location: ../daftar.php");
exit;
?>