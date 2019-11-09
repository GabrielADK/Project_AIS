<?php
   require_once("koneksi.php");
   $nama = $_POST['name'];
   $alamat = $_POST['alamat'];
   $email = $_POST['email'];
   $username = $_POST['username'];
   $pass = $_POST['password'];
   $pass_konf = $_POST['konf_password'];
   $level = $_POST['level'];
   $sql = "SELECT * FROM user WHERE username = '$username'";
   $query = $db->query($sql);
   if($query->num_rows != 0) {
     echo "<div align='center'>Username Sudah Terdaftar! <a href='daftar.php'>Back</a></div>";
   } else {
     if(!$nama  || !$alamat || !$email || !$username || !$pass || !$level) {
       echo "<div align='center'>Masih ada data yang kosong! <a href='daftar.php'>Back</a>";
     } else {
      if ($pass = $pass_konf) {     
        // perlu dibuat sebarang pengacak
        $pengacak  = "NDJS3289JSKS190JISJI";
         
        // mengenkripsi password dengan md5() dan pengacak
        $pass = md5($pengacak . md5($pass) . $pengacak);
       $data = "INSERT INTO user VALUES (NULL, '$nama', '$alamat', '$email', '$username', '$pass', '$level')";
       $simpan = $db->query($data);
       if($simpan) {
         echo "<div align='center'>Pendaftaran Sukses, Silahkan <a href='login.php'>Login</a></div>";
       } else {
         echo "<div align='center'>Proses Gagal!</div>";
       }
      }
     }
   }
?>