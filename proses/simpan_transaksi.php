<?php

require_once __DIR__ . "/../config/koneksi.php";

$nama = $_POST['nama'];
$nominal = str_replace('.', '', $_POST['nominal']);
$jenis = $_POST['jenis'];
$kategori = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];

$sql = "INSERT INTO transaksi
(nama, nominal, jenis, kategori, tanggal, keterangan)
VALUES
('$nama','$nominal','$jenis','$kategori','$tanggal','$keterangan')";

if(mysqli_query($conn,$sql)){

echo "<script>
alert('Data transaksi berhasil disimpan');
window.location='../daftar.php';
</script>";

}else{

echo mysqli_error($conn);

}
?>