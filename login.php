<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login | FinTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>

body{
    background:linear-gradient(135deg,#0F172A,#2563EB);
    font-family:Poppins,sans-serif;
    height:100vh;
}

.login-card{
    border:none;
    border-radius:25px;
    box-shadow:0 20px 40px rgba(0,0,0,.2);
}

.logo{
    font-size:60px;
    color:#2563EB;
}

.btn-login{
    background:#2563EB;
    color:white;
    border-radius:12px;
}

.btn-login:hover{
    background:#1D4ED8;
}

.form-control{
    border-radius:12px;
}

</style>

</head>

<body>

<div class="container h-100">

<div class="row h-100 justify-content-center align-items-center">

<div class="col-md-5">

<div class="card login-card">

<div class="card-body p-5">

<div class="text-center">

<i class="fa-solid fa-wallet logo"></i>

<h2 class="mt-3 fw-bold">FinTrack</h2>

<p class="text-secondary">
Sistem Pencatatan Keuangan
</p>

</div>

<form action="proses/login.php" method="POST">

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Masukkan Email"
required>

</div>

<div class="mb-4">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>

</div>

<button class="btn btn-login w-100 py-2">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>

</form>

<div class="text-center mt-4">

<a href="index.php">
← Kembali ke Beranda
</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>