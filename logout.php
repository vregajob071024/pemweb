<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Logout</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<meta http-equiv="refresh" content="2;url=login.php">

<style>

body{

background:#0F172A;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

font-family:Poppins,sans-serif;

}

.card{

border:none;

border-radius:20px;

padding:40px;

text-align:center;

}

</style>

</head>

<body>

<div class="card shadow">

<h2 class="text-success">

✔ Logout Berhasil

</h2>

<p>

Terima kasih telah menggunakan FinTrack

</p>

<p class="text-secondary">

Mengalihkan ke halaman Login...

</p>

</div>

</body>

</html>