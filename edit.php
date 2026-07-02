<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM transaksi WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Transaksi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Transaksi</h3>

</div>

<div class="card-body">

<form action="proses/edit.php" method="POST">

<input type="hidden" name="id" value="<?= $row['id']; ?>">

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= htmlspecialchars($row['nama']); ?>"
required>

</div>

<div class="mb-3">
    <label>Nominal</label>

    <input
        type="text"
        id="nominal"
        name="nominal"
        class="form-control"
        value="<?= number_format($row['nominal'],0,",","."); ?>"
        onkeyup="formatRupiah(this)"
        required>
</div>

<div class="mb-3">

<button class="btn btn-primary">

Update

</button>

<a href="daftar.php" class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>

</div>

</div>

<script>
function formatRupiah(input){

    let angka = input.value.replace(/\D/g,'');

    input.value = new Intl.NumberFormat('id-ID').format(angka);

}
</script>

</body>
</html>