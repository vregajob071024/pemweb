<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY tanggal DESC, id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Daftar Transaksi | FinTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet" href="css/style.css">

<style>
body{
    background:#F5F7FB;
    font-family:'Poppins',sans-serif;
    overflow-x:hidden;
}

/* Logo Sidebar */
.logo i{
    color:#ffffff;
}

/* Sidebar */

.sidebar{
    width:250px;
    height:100vh;
    background:#0F172A;
    position:fixed;
    top:0;
    left:0;
    color:#fff;
    z-index:1000;
}

.sidebar h3{
    padding:25px;
    text-align:center;
    font-weight:700;
}

.sidebar a{
    display:block;
    color:#fff;
    text-decoration:none;
    padding:15px 25px;
    transition:.3s;
}

.sidebar a:hover{
    background:#2563EB;
}
/* Content */

.main-content{
    margin-left:250px;
    padding:30px;
    min-height:100vh;
}

.content-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
}

.content-header h2{
    margin:0;
    font-weight:700;
}

.card{
    border:none;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

.card-body{
    padding:20px;
}

.table{
    margin:0;
}

.table th,
.table td{
    vertical-align:middle;
    white-space:nowrap;
}

.btn-sm{
    width:38px;
    height:38px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}


/* ================= MOBILE ================= */

.menu-btn{
    display:none;
}

@media (max-width:768px){

.menu-btn{
    display:block;
    position:fixed;
    top:15px;
    left:15px;
    z-index:1200;
}

/* Sidebar */

.sidebar{
    position:fixed;
    top:0;
    left:-100%;
    width:250px;
    max-width:80%;
    height:100%;
    background:#0F172A;
    transition:.3s;
    overflow-y:auto;
    z-index:1100;
}

.sidebar.show{
    left:0;
}

/* Konten */

.main-content{
    margin-left:0;
    width:100%;
    padding:70px 15px 20px;
}

.content-header{
    flex-direction:column;
    align-items:flex-start;
}

.text-end{
    text-align:left !important;
}

.table-responsive{
    overflow-x:auto;
}

.table{
    min-width:850px;
}

}

.menu-btn{display:none}
@media (max-width:768px){
.menu-btn{display:block;position:fixed;top:15px;left:15px;z-index:1101}
.sidebar{left:-250px;transition:left .3s;height:100vh;position:fixed}
.sidebar.show{left:0}
.main-content{margin-left:0;padding:70px 15px 15px}
}

</style>

</head>

<body>

<button class="btn btn-dark menu-btn" id="menuBtn">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="sidebar">

<h3>

<div class="logo">
    <i class="fa-solid fa-wallet"></i>
    <span>FinTrack</span>
</div>

</h3>

<a href="dashboard.php">

<i class="fa-solid fa-house"></i>

Dashboard

</a>

<a href="tambah-transaksi.php">

<i class="fa-solid fa-plus"></i>

Tambah Transaksi

</a>

<a href="daftar.php">

<i class="fa-solid fa-table"></i>

Daftar Transaksi

</a>

<a href="logout.php">

<i class="fa-solid fa-right-from-bracket"></i>

Logout

</a>

</div>

<div class="main-content">

<div class="content-header">

<h2>
<i class="fa-solid fa-table text-primary"></i>
Daftar Transaksi
</h2>

</div>
<div class="text-end mb-3">
    <a href="tambah-transaksi.php" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i>
        Tambah Transaksi
    </a>
</div>

<div class="card shadow border-0 rounded-4">

<div class="card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>No</th>
<th>Nama</th>
<th>Nominal</th>
<th>Jenis</th>
<th>Kategori</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($row = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($row['nama']); ?></td>

<td>

Rp <?= number_format($row['nominal'],0,",","."); ?>

</td>

<td>
    <?php if($row['jenis'] == "Pemasukan"){ ?>
        <span class="badge bg-success">
            <i class="bi bi-graph-up-arrow"></i> Pemasukan
        </span>
    <?php } else { ?>
        <span class="badge bg-danger">
            <i class="bi bi-graph-down-arrow"></i> Pengeluaran
        </span>
    <?php } ?>
</td>

<td><?= htmlspecialchars($row['kategori']); ?></td>

<td><?= htmlspecialchars($row['tanggal']); ?></td>

<td><?= htmlspecialchars($row['keterangan']); ?></td>

<td>

<a href="edit.php?id=<?= $row['id']; ?>"
class="btn btn-warning btn-sm">

<i class="fa-solid fa-pen"></i>

</a>

<a href="proses/hapus.php?id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus transaksi ini?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</div>
</div>
</div>
<script>
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.querySelector(".sidebar");

menuBtn.onclick = function(e){
    e.stopPropagation();
    sidebar.classList.toggle("show");
};

document.onclick = function(e){

    if(window.innerWidth <= 768){

        if(!sidebar.contains(e.target) && !menuBtn.contains(e.target)){

            sidebar.classList.remove("show");

        }

    }

};
</script>
</body>
</html>
