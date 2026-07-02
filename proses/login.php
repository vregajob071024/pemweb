<?php

session_start();

require_once __DIR__ . "/../config/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'
AND password='$password'");

if(mysqli_num_rows($query)>0){

$data = mysqli_fetch_assoc($query);

$_SESSION['login']=true;
$_SESSION['nama']=$data['nama'];

header("Location: ../dashboard.php");
exit;

}else{

echo "<script>

alert('Email atau Password Salah');

window.location='../login.php';

</script>";

}

?>