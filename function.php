<?php 

session_start();

// bikin koneksi 
$c = mysqli_connect('localhost','root','','kasir');

//login
if(isset($_POST['login'])){
//initiate variable
   $username = $_POST['username'];
   $password = $_POST['password'];

   $check = mysqli_query($c,"SELECT * FROM user WHERE username='$username' and password='$password' ");
   $hitung = mysqli_num_rows($check);

   if($hitung>0){
    //jika datanya di temukan
    //berhasil login 

    $_SESSION['login'] = 'true';
    header('location:index.php');
   } else {
    //data tidak di temukan 
    //gagal login
    echo '
    <script>alert("Username atau Password salah ");
    window.location.href="login.php"
    <script>
    ';
   }
}



if (isset($_POST['tambahbarang'])){
   $namaproduk = $_POST['namaproduk'];
   $deskripsi= $_POST['deskripsi'];
   $stock = $_POST['stock'];
   $harga = $_POST['harga'];

   $insert = mysqli_query($c,"insert into produk (namaproduk,deskripsi,harga,stock) values ('$namaproduk','$deskripsi',
   '$harga','$stock')");

   if($insert){
      header('location:stock.php');
   } else {
      echo '
    <script>alert("gagal menambah barang baru  ");
    window.location.href="stock.php"
    <script>
    ';
   }
}



 if(isset($_POST['tambahpelanggan'])){
   $namapelanggan = $_POST['namapelanggan'];
   $notelp= $_POST['notelp'];
   $alamat = $_POST['alamat'];
  
 
   $insert = mysqli_query($c,"insert into pelanggan (namapelanggan,notelp,alamat) values ('$namapelanggan','$notelp',
   '$alamat')");

   if($insert){
      header('location:pelanggan.php');
   } else {
      echo '
    <script>alert("gagal menambah pelanggan baru  ");
    window.location.href="pelanggan.php"
    <script>
    ';
   }

 }



 if(isset($_POST['tambahpesanan'])){
   $idpelanggan = $_POST['idpelanggan'];
  
 
   $insert = mysqli_query($c,"insert into pesanan (idpelanggan) values ('$idpelanggan')");

   if($insert){
      header('location:index.php');
   } else {
      echo '
    <script>alert("gagal menambah pesanan baru  ");
    window.location.href="index.php"
    <script>
    ';
   }

 }

 
if(isset($_POST['addproduk'])){
   // Ambil data dari form
   $idproduk = $_POST['idproduk'];
   $idp = $_POST['idp'];
   $qty = $_POST['qty']; // Jumlah barang

   // Query untuk memasukkan data ke tabel detailpesanan
   $insert = mysqli_query($c, "insert into detailpesanan (idpesanan, idproduk, qty) VALUES ('$idp', '$idproduk', '$qty')");

   if ($insert) {
      // Jika berhasil, alihkan ke halaman view.php dengan idpesanan
      header("Location: view.php?idp=$idp");
      exit(); // Pastikan untuk mengakhiri skrip setelah header redirect
   } else {
      // Jika gagal, tampilkan pesan error dan redirect kembali
      echo '
      <script>
         alert("Gagal menambah pesanan baru");
         window.location.href = "view.php?idp='.$idp.'";
      </script>
      ';
   }
}



?>