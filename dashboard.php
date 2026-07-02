<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "config/koneksi.php";

/* ==========================
   RINGKASAN DASHBOARD
========================== */

$query = mysqli_query($conn,"
SELECT
SUM(CASE WHEN jenis='Pemasukan' THEN nominal ELSE 0 END) AS pemasukan,
SUM(CASE WHEN jenis='Pengeluaran' THEN nominal ELSE 0 END) AS pengeluaran,
COUNT(*) AS transaksi
FROM transaksi
");

$data = mysqli_fetch_assoc($query);

$totalPemasukan = $data['pemasukan'] ?? 0;
$totalPengeluaran = $data['pengeluaran'] ?? 0;
$jumlahTransaksi = $data['transaksi'] ?? 0;

$saldo = $totalPemasukan - $totalPengeluaran;


/* ==========================
   DATA GRAFIK
========================== */

$bulan = [];
$pemasukan = [];
$pengeluaran = [];

for($i=1;$i<=12;$i++){

    $bulan[] = date("M", mktime(0,0,0,$i,1));

    $in = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT SUM(nominal) total
    FROM transaksi
    WHERE jenis='Pemasukan'
    AND MONTH(tanggal)='$i'
    "));

    $out = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT SUM(nominal) total
    FROM transaksi
    WHERE jenis='Pengeluaran'
    AND MONTH(tanggal)='$i'
    "));

    $pemasukan[] = $in['total'] ?? 0;
    $pengeluaran[] = $out['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard | FinTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet" href="css/style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

.sidebar a:hover,
.sidebar a.active{
    background:#2563EB;
}

.main{
    margin-left:250px;
    padding:30px;
    min-height:100vh;
}

.menu-btn{
    display:none;
}


/* ================= MOBILE ================= */

/* ===== Responsive Table ===== */
/* ================= RESPONSIVE HP ================= */
@media (max-width:768px){

    body{
        overflow-x:hidden;
    }

    /* Konten utama */
    .main{
        margin-left:0 !important;
        width:100%;
        padding:70px 12px 20px;
    }

    /* Semua container */
    .container-fluid{
        padding-left:0;
        padding-right:0;
    }

    /* Semua row */
    .row{
        margin-left:0;
        margin-right:0;
        row-gap:15px;
    }

    /* Semua kolom penuh */
    .row>[class*="col"]{
        width:100%;
        max-width:100%;
        flex:0 0 100%;
        padding-left:0;
        padding-right:0;
    }

    /* Card */
    .card{
        width:100%;
        margin:0;
        border-radius:16px;
    }

    .card-body{
        padding:15px;
    }

    /* Ringkasan */
    .topbar{
        text-align:center;
    }

    .topbar h3{
        font-size:26px;
    }

    /* Grafik */
    #grafikKeuangan{
        width:100% !important;
        height:230px !important;
    }

    /* Tabel */
    .table-responsive{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch;
    }

    .table{
        min-width:700px;
        white-space:nowrap;
        font-size:14px;
    }

    /* Badge */
    .badge{
        font-size:12px;
    }

    /* Sidebar */
    .sidebar{
        width:240px;
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
<!-- Sidebar -->

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

<!-- Main -->

<div class="main">

<div class="topbar d-flex justify-content-center justify-content-md-between align-items-center text-center text-md-start">

<div>

<h3 class="fw-bold mb-0">
Dashboard FinTrack
</h3>

<small class="text-muted">
Selamat Datang,
<strong><?= $_SESSION['nama']; ?></strong>
</small>

</div>

</div>

<!-- ======= LANJUT KE BAGIAN 2 ======= -->

<!-- ===== DASHBOARD CARD ===== -->
<div class="container-fluid mt-4">

    <div class="row g-4">

        <!-- Total Saldo -->
        <div class="col-12 col-sm-10 col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Total Saldo</small>
                        <h4 class="fw-bold text-primary mb-0">
                            Rp <?= number_format($saldo,0,",","."); ?>
                        </h4>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total Pemasukan -->
        <div class="col-12 col-sm-10 col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-success text-white rounded-circle p-3 me-3">
                        <i class="bi bi-arrow-up-right fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Total Pemasukan</small>
                        <h4 class="fw-bold text-success mb-0">
                            Rp <?= number_format($totalPemasukan,0,",","."); ?>
                        </h4>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="col-12 col-sm-10 col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-danger text-white rounded-circle p-3 me-3">
                        <i class="bi bi-arrow-down-right fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Total Pengeluaran</small>
                        <h4 class="fw-bold text-danger mb-0">
                            Rp <?= number_format($totalPengeluaran,0,",","."); ?>
                        </h4>
                    </div>

                </div>
            </div>
        </div>

        <!-- Jumlah Transaksi -->
        <div class="col-12 col-sm-10 col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                        <i class="bi bi-receipt fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Jumlah Transaksi</small>
                        <h4 class="fw-bold text-warning mb-0">
                            <?= $jumlahTransaksi ?>
                        </h4>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- ================= GRAFIK ================= -->

    <div class="row mt-4">

        <div class="col-12 col-lg-8">

            <div class="card shadow-sm border-0 rounded-4 mb-4">

    <div class="card-header bg-white border-0">
        <h5 class="fw-bold mb-0">
            Grafik Pemasukan vs Pengeluaran
        </h5>
    </div>

    <div class="card-body" style="height:255px;">
        <canvas id="grafikKeuangan"></canvas>
    </div>

            </div>

        </div>

        <!-- Ringkasan -->
        <div class="col-12 col-lg-4">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-header bg-white border-0">
                    <h5 class="fw-bold mb-0">Ringkasan</h5>
                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <small>Total Saldo</small>

                        <h3 class="text-primary">
                            Rp <?= number_format($saldo,0,",",".") ?>
                        </h3>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Pemasukan</small>

                            <h5 class="text-success">
                                Rp <?= number_format($totalPemasukan,0,",",".") ?>
                            </h5>

                        </div>

                        <div>

                            <small>Pengeluaran</small>

                            <h5 class="text-danger">
                                Rp <?= number_format($totalPengeluaran,0,",",".") ?>
                            </h5>

                        </div>

                    </div>

                    <hr>

                    <div>

                        <small>Jumlah Transaksi</small>

                        <h4><?= $jumlahTransaksi ?></h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- ===================== TABEL ====================== -->

<div class="container-fluid mt-4">

    <div class="row">

        <!-- Transaksi Terbaru -->
          <div class="col-12">

            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clock-history"></i>
                        Transaksi Terbaru
                    </h5>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Nominal</th>
                            </tr>

                        </thead>

                        <tbody>

                        <?php

                        $no=1;

                        $transaksi=mysqli_query($conn,"
                        SELECT *
                        FROM transaksi
                        ORDER BY tanggal DESC,id DESC
                        LIMIT 5
                        ");

                        while($row=mysqli_fetch_assoc($transaksi)){

                        ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= date('d M Y',strtotime($row['tanggal'])) ?></td>

                            <td><?= $row['nama'] ?></td>

                            <td>

                            <?php
                            if($row['jenis']=="Pemasukan"){
                            ?>

                                <span class="badge bg-success">
                                    Pemasukan
                                </span>

                            <?php
                            }else{
                            ?>

                                <span class="badge bg-danger">
                                    Pengeluaran
                                </span>

                            <?php } ?>

                            </td>

                            <td><?= $row['kategori'] ?></td>

                            <td class="<?= $row['jenis']=="Pemasukan" ? 'text-success':'text-danger' ?> fw-bold">

                                Rp <?= number_format($row['nominal'],0,",",".") ?>

                            </td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>



    <!-- ================= PEMASUKAN & PENGELUARAN ================= -->

    <div class="row">

        <!-- PEMASUKAN -->
        <div class="col-12 col-lg-6">

            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">
                        <i class="bi bi-arrow-up-circle"></i>
                        Pemasukan Terbaru
                    </h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th>Tanggal</th>

                            <th>Nama</th>

                            <th>Kategori</th>

                            <th>Nominal</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php

                        $q=mysqli_query($conn,"
                        SELECT *
                        FROM transaksi
                        WHERE jenis='Pemasukan'
                        ORDER BY tanggal DESC
                        LIMIT 5
                        ");

                        while($d=mysqli_fetch_assoc($q)){

                        ?>

                        <tr>

                            <td><?= date('d M',strtotime($d['tanggal'])) ?></td>

                            <td><?= $d['nama'] ?></td>

                            <td><?= $d['kategori'] ?></td>

                            <td class="text-success fw-bold">

                                Rp <?= number_format($d['nominal'],0,",",".") ?>

                            </td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>



        <!-- PENGELUARAN -->

        <div class="col-12 col-lg-6">

            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-danger text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-arrow-down-circle"></i>

                        Pengeluaran Terbaru

                    </h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th>Tanggal</th>

                            <th>Nama</th>

                            <th>Kategori</th>

                            <th>Nominal</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php

                        $q=mysqli_query($conn,"
                        SELECT *
                        FROM transaksi
                        WHERE jenis='Pengeluaran'
                        ORDER BY tanggal DESC
                        LIMIT 5
                        ");

                        while($d=mysqli_fetch_assoc($q)){

                        ?>

                        <tr>

                            <td><?= date('d M',strtotime($d['tanggal'])) ?></td>

                            <td><?= $d['nama'] ?></td>

                            <td><?= $d['kategori'] ?></td>

                            <td class="text-danger fw-bold">

                                Rp <?= number_format($d['nominal'],0,",",".") ?>

                            </td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<script>
const ctx = document.getElementById('grafikKeuangan');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [
        {
            label: 'Pemasukan',
            data: <?= json_encode($pemasukan) ?>,
            borderColor: '#198754',
            backgroundColor: '#198754',
            tension: 0.3
        },
        {
            label: 'Pengeluaran',
            data: <?= json_encode($pengeluaran) ?>,
            borderColor: '#dc3545',
            backgroundColor: '#dc3545',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

</body>
</html>