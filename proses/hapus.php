<?php

require_once __DIR__ . "/../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM transaksi WHERE id='$id'");

header("Location: ../daftar.php");
exit;
?>