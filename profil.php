```php
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Profil | FinTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<style>
body{
    font-family:'Poppins',sans-serif;
    background:#f8fafc;
}

.profile-header{
    background:linear-gradient(135deg,#0f172a,#2563eb);
    color:#fff;
    padding:120px 0 70px;
}

.portfolio-card{
    border:none;
    border-radius:18px;
    transition:.3s;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.portfolio-card:hover{
    transform:translateY(-8px);
}

.icon-box{
    width:70px;
    height:70px;
    background:#2563eb;
    color:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    margin:auto;
}

footer{
    background:#0f172a;
    color:#fff;
    padding:20px;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
<div class="container">

<a class="navbar-brand fw-bold" href="index.php">
<i class="fa-solid fa-wallet"></i> FinTrack
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php">Beranda</a>
</li>

<li class="nav-item">
<a class="nav-link" href="tambah-transaksi.php">Transaksi</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="profil.php">Profil</a>
</li>

<li class="nav-item">
<a class="nav-link" href="login.php">Login</a>
</li>

</ul>

</div>

</div>
</nav>

<section class="profile-header">

<div class="container text-center">

<h1 class="display-4 fw-bold">Profil FinTrack</h1>

<p class="lead">
Smart Financial Management untuk membantu mengelola keuangan
dengan mudah, aman, dan efisien.
</p>

</div>

</section>

<div class="container py-5">

<div class="row g-4">

<div class="col-md-4">
<div class="card portfolio-card h-100 text-center p-4">
<div class="icon-box">
<i class="fa-solid fa-bullseye"></i>
</div>
<h4 class="mt-4">Visi</h4>
<p>
Menjadi aplikasi pencatatan keuangan modern yang membantu masyarakat mengelola keuangan secara lebih bijak.
</p>
</div>
</div>

<div class="col-md-4">
<div class="card portfolio-card h-100 text-center p-4">
<div class="icon-box">
<i class="fa-solid fa-rocket"></i>
</div>
<h4 class="mt-4">Misi</h4>
<p>
Memberikan solusi pencatatan transaksi yang cepat, mudah digunakan, dan menghasilkan laporan keuangan yang informatif.
</p>
</div>
</div>

<div class="col-md-4">
<div class="card portfolio-card h-100 text-center p-4">
<div class="icon-box">
<i class="fa-solid fa-star"></i>
</div>
<h4 class="mt-4">Keunggulan</h4>
<p>
Desain modern, responsif, aman, dan mudah digunakan di komputer maupun smartphone.
</p>
</div>
</div>

</div>

<div class="row mt-5">

<div class="col-lg-6">

<h2>Tentang FinTrack</h2>

<p>
FinTrack merupakan aplikasi berbasis web yang dikembangkan untuk membantu pengguna dalam mencatat pemasukan, pengeluaran, dan memantau kondisi keuangan secara real-time.
</p>

<p>
Aplikasi ini menyediakan dashboard, pencatatan transaksi, laporan keuangan, dan riwayat transaksi sehingga pengguna dapat mengelola keuangan dengan lebih efektif.
</p>

</div>

<div class="col-lg-6">

<img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=900"
class="img-fluid rounded-4 shadow">

</div>

</div>

</div>

<footer class="text-center">

<h5>FinTrack</h5>

<p class="mb-0">
© 2026 FinTrack | Smart Financial Management
</p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
