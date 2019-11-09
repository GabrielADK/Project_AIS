<?php
  //mengaktifkan session pada php
  session_start();
   
  // menghubungkan php dengan koneksi database
  include 'koneksi.php';
   
  // menangkap data yang dikirim dari form login
  $username = $_POST['username'];
  $password = $_POST['password'];
   
   
  // menyeleksi data user dengan username dan password yang sesuai
  $login = mysqli_query($db,"select * from user where username='$username' and password='$password'");
  $hasil = mysqli_query($login) or die("Error");
  $data  = mysqli_fetch_array($hasil);

  $pengacak  = "NDJS3289JSKS190JISJI";
 
  // cek kesesuaian password terenkripsi dari form login
  // dengan password terenkripsi dari database
  if (md5($pengacak.md5($password).$pengacak) == $data'password')

  // menghitung jumlah data yang ditemukan
  $cek = mysqli_num_rows($login);
   
  // cek apakah username dan password di temukan pada database
  if($cek > 0){
   
    $data = mysqli_fetch_assoc($login);
   
    // cek jika user login sebagai admin
    if($data['Level']=="Admin"){
   
      // buat session login dan username
      $_SESSION['username'] = $username;
      $_SESSION['Level'] = "Admin";
      // alihkan ke halaman dashboard admin
      header("location:index_login.php");
   
    // cek jika user login sebagai pegawai
    }else if($data['Level']=="User"){
      // buat session login dan username
      $_SESSION['username'] = $username;
      $_SESSION['Level'] = "User";
      // alihkan ke halaman dashboard pegawai
      header("location:index_user.php");
   
    }else{
   
      // alihkan ke halaman login kembali
      header("location:login.php?pesan=gagal");
    } 
  }else{
    header("location:index.php?pesan=gagal");
  }
 
?>