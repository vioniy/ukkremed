<?php
include "koneksi.php";
function antiinjection($data){
  global $mysqli;
  $filter_sql = mysqli_real_escape_string($mysqli,stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}
 
$username = antiinjection($_POST['username']);
$password = antiinjection($_POST['password']);
 
 
$login=mysqli_query($mysqli,"SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);
 
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
 // session_register("namauser");
  //session_register("namalengkap");
 // session_register("passuser");
  //session_register("leveluser");
 
  $_SESSION[namauser]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
   
  header('location:index.php');
}
else{
    echo "<script>alert('Username Atau Password Anda Salah'); window.location = 'login.php'</script>";
}
?>