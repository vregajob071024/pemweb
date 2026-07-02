<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Transaksi | FinTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    font-weight: 700;
}

.sidebar a{
    display:block;
    color:#fff;
    text-decoration:none;
    padding:15px 25px;
    transition:.3s;
    font-size: 15px;
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
.transaction-card{
    position: relative;
    display: block;
    border:1px solid #d8dee9;
    border-radius:12px;
    padding:22px 24px;
    cursor:pointer;
    transition:.25s;
    background:#fff;
}

/* sembunyikan radio asli */
.transaction-card input{
    position:absolute;
    opacity:0;
}

/* bulatan radio */
.transaction-card::before{
    content:"";
    position:absolute;
    left:-12px;
    top:50%;
    transform:translateY(-50%);
    width:20px;
    height:20px;
    border:2px solid #cfd8dc;
    border-radius:50%;
    background:#fff;
}

/* radio terpilih */
.transaction-card:has(input:checked)::before{
    border:6px solid #0d6efd;
}

.card-content{
    display:flex;
    align-items:center;
    gap:16px;
}

.icon{
    width:42px;
    height:42px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:20px;
}

.income{
    background:#198754;
}

.expense{
    background:#dc3545;
}

.text small{
    color:#6c757d;
    font-size:18px;
}

/* efek hover */
.transaction-card:hover{
    border-color:#0d6efd;
    box-shadow:0 4px 15px rgba(13,110,253,.08);
}

/* saat dipilih */
.transaction-card:has(input:checked){
    border:2px solid #0d6efd;
    background:#f8fbff;
}
</style>

</head>

<body>


<button class="btn btn-dark menu-btn" id="menuBtn">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="sidebar">

<h3>

<i class="fa-solid fa-wallet"></i>

FinTrack

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

<h2 class="page-title">
<i class="fa-solid fa-money-bill-wave text-primary"></i>
Tambah Transaksi
</h2>
<div class="card">

    <div class="card-header">
        <h4>
            <i class="fa-solid fa-circle-plus me-2"></i>
            Form Input Transaksi
        </h4>
    </div>

    <div class="card-body">

        <form action="proses/simpan_transaksi.php" method="POST">

            <div class="row">

                <!-- Nama -->
                <div class="col-lg-6 mb-3">

                    <label class="form-label">
                        Nama Transaksi
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Contoh : Gaji"
                        required>

                </div>

                <!-- Nominal -->
                <div class="col-lg-6 mb-3">

                    <label class="form-label">
                        Nominal
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="text"
                            id="nominal"
                            class="form-control"
                            placeholder="0"
                            required>

                        <input
                            type="hidden"
                            id="nominal_real"
                            name="nominal">

                    </div>

                </div>

<div class="mb-3">
    <label class="form-label fw-bold">
        Jenis Transaksi
    </label>
<div class="row g-3">

    <div class="col-md-6">
        <label class="transaction-card">
            <input
                type="radio"
                name="jenis"
                value="Pemasukan"
                onchange="ubahKategori()">

            <div class="card-content">
                <div class="icon income">
                   <i class="fa-solid fa-arrow-trend-up"></i>
                </div>

                <div class="text">
                    <h5>Pemasukan</h5>
                    <small>Gaji, Bonus, Penjualan, Transfer Masuk</small>
                </div>
            </div>
        </label>
    </div>

    <div class="col-md-6">
        <label class="transaction-card">
            <input
                type="radio"
                name="jenis"
                value="Pengeluaran"
                onchange="ubahKategori()">

            <div class="card-content">
                <div class="icon expense">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                </div>

                <div class="text">
                    <h5>Pengeluaran</h5>
                    <small>Belanja, Makan, Listrik, Transportasi</small>
                </div>
            </div>
        </label>
    </div>

</div>

      <div class="mt-4">

    <label class="form-label">
        Kategori
    </label>

    <select class="form-select" id="kategori" name="kategori" required>

        <option value="">
            -- Pilih Kategori --
        </option>

    </select>

</div>

                <!-- Tanggal -->
                <div class="mt-4">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="<?= date('Y-m-d'); ?>"
                        required>

                </div>

                <!-- Keterangan -->
                <div class="col-12 mb-4">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        placeholder="Masukkan keterangan transaksi..."></textarea>

                </div>

            </div>

            <div class="d-grid">

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Simpan Transaksi

                </button>

            </div>

        </form>

    </div>

</div>
<script>
// =========================
// FORMAT NOMINAL RUPIAH
// =========================

const nominal = document.getElementById("nominal");
const nominalReal = document.getElementById("nominal_real");

nominal.addEventListener("input", function () {

    // Ambil hanya angka
    let angka = this.value.replace(/\D/g, "");

    // Simpan ke input hidden
    nominalReal.value = angka;

    // Tampilkan format ribuan
    this.value = new Intl.NumberFormat("id-ID").format(angka);

});


// =========================
// SIDEBAR MOBILE
// =========================

const menuBtn = document.getElementById("menuBtn");
const sidebar = document.querySelector(".sidebar");

menuBtn.addEventListener("click", function(e){

    e.stopPropagation();

    sidebar.classList.toggle("show");

});

document.addEventListener("click", function(e){

    if(window.innerWidth <= 768){

        if(!sidebar.contains(e.target) && !menuBtn.contains(e.target)){

            sidebar.classList.remove("show");

        }

    }

});


// =========================
// TUTUP SIDEBAR SAAT
// MENU DIKLIK (HP)
// =========================

const menuSidebar = document.querySelectorAll(".sidebar a");

menuSidebar.forEach(function(item){

    item.addEventListener("click", function(){

        if(window.innerWidth <= 768){

            sidebar.classList.remove("show");

        }

    });

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function ubahKategori(){

    const jenis = document.querySelector('input[name="jenis"]:checked').value;

    const kategori = document.getElementById("kategori");

    kategori.innerHTML = "";

    let optionAwal = document.createElement("option");
    optionAwal.text = "-- Pilih Kategori --";
    optionAwal.value = "";

    kategori.appendChild(optionAwal);

    let daftar = [];

    if(jenis == "Pemasukan"){

        daftar = [

            "Gaji",
            "Bonus",
            "Penjualan",
            "Transfer Masuk",
            "Investasi",
            "Hadiah",
            "Lain-lain"

        ];

    }else{

        daftar = [

            "Belanja",
            "Makanan",
            "Minuman",
            "Transportasi",
            "Listrik",
            "Air",
            "Internet",
            "Pendidikan",
            "Kesehatan",
            "Hiburan",
            "Rumah Tangga",
            "Lain-lain"

        ];

    }

    daftar.forEach(function(item){

        let option = document.createElement("option");

        option.value = item;

        option.text = item;

        kategori.appendChild(option);

    });

}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>