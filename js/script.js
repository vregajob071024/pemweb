// ===============================
// FORM TRANSAKSI
// ===============================

const form = document.getElementById("transaksiForm");

if(form){

form.addEventListener("submit", function(e){

e.preventDefault();

const nama = document.getElementById("nama").value;
const nominal = document.getElementById("nominal").value;
const kategori = document.getElementById("kategori").value;
const tanggal = document.getElementById("tanggal").value;
const keterangan = document.getElementById("keterangan").value;

const pesan = document.getElementById("pesan");

if(
nama=="" ||
nominal=="" ||
kategori=="" ||
tanggal=="" ||
keterangan==""
){

pesan.innerHTML="Semua data wajib diisi.";

pesan.style.color="red";

return;

}

let transaksi = JSON.parse(localStorage.getItem("transaksi")) || [];

transaksi.push({

nama,
nominal,
kategori,
tanggal,
keterangan

});

localStorage.setItem("transaksi",JSON.stringify(transaksi));

alert("Transaksi berhasil disimpan.");

window.location="daftar.php";

});

}

// ===============================
// TAMPILKAN DATA
// ===============================

const tbody=document.getElementById("tbody");

if(tbody){

let transaksi=JSON.parse(localStorage.getItem("transaksi"))||[];

tbody.innerHTML="";

transaksi.forEach((item,index)=>{

tbody.innerHTML+=`

<tr>

<td>${index+1}</td>

<td>${item.nama}</td>

<td>Rp ${Number(item.nominal).toLocaleString('id-ID')}</td>

<td>${item.kategori}</td>

<td>${item.tanggal}</td>

<td>

<button onclick="hapus(${index})">

Hapus

</button>

</td>

</tr>

`;

});

}

function hapus(index){

let transaksi=JSON.parse(localStorage.getItem("transaksi"));

transaksi.splice(index,1);

localStorage.setItem("transaksi",JSON.stringify(transaksi));

location.reload();

}

// ===============================
// LOGIN
// ===============================

const login=document.getElementById("loginForm");

if(login){

login.addEventListener("submit",function(e){

e.preventDefault();

window.location="dashboard.html";

});

}

// ===============================
// ANIMASI
// ===============================

document.body.style.opacity=0;

window.onload=()=>{

document.body.style.transition="1s";

document.body.style.opacity=1;

}

const tbody = document.getElementById("tbody");

if(tbody){

    tampilkanData();

}

function tampilkanData(){

    let transaksi = JSON.parse(localStorage.getItem("transaksi")) || [];

    tbody.innerHTML = "";

    transaksi.forEach((item,index)=>{

        tbody.innerHTML += `

        <tr>

            <td>${index+1}</td>

            <td>${item.nama}</td>

            <td>Rp ${Number(item.nominal).toLocaleString("id-ID")}</td>

            <td>${item.kategori}</td>

            <td>${item.tanggal}</td>

            <td>${item.keterangan}</td>

            <td>

                <button onclick="hapus(${index})">

                    Hapus

                </button>

            </td>

        </tr>

        `;

    });

}

function hapus(index){

    let transaksi = JSON.parse(localStorage.getItem("transaksi")) || [];

    transaksi.splice(index,1);

    localStorage.setItem("transaksi", JSON.stringify(transaksi));

    tampilkanData();

}
