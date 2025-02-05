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

 //produk dipilih di pesanan 
 if(isset($_POST['addproduk'])){
   // Ambil data dari form
   $idproduk = $_POST['idproduk'];
   $idp = $_POST['idp'];
   $qty = $_POST['qty']; // Jumlah barang

   //hitung stock sekarang ada berapa 
   $hitung1 = mysqli_query($c,"SELECT * FROM produk WHERE idproduk='$idproduk'");
   $hitung2 = mysqli_fetch_array($hitung1);
   $stocksekarang = $hitung2['stock']; // stock barang saat ini 

   if($stocksekarang >= $qty){
      //kurangi stock nya dengan jumlah yang akan dikeluarkan 
      $selisih = $stocksekarang - $qty;

      // stocknya cukup
      $insert = mysqli_query($c, "INSERT INTO detailpesanan (idpesanan, idproduk, qty) VALUES ('$idp', '$idproduk', '$qty')");
      $updet = mysqli_query($c, "UPDATE produk SET stock='$selisih' WHERE idproduk='$idproduk'");

      if($insert && $updet) {
         // Jika berhasil, alihkan ke halaman view.php dengan idpesanan
         header("Location: view.php?idp=$idp");
         exit(); // Pastikan untuk mengakhiri skrip setelah header redirect
      } else {
         // Jika gagal, tampilkan pesan error dan redirect kembali
         echo '
         <script>
            alert("Gagal menambah pesanan baru");
            window.location.href = "view.php?idp=' . $idp . '";
         </script>
         ';
      }
   } else {
      // stock tidak cukup
      echo '
      <script>
         alert("Stock barang tidak cukup");
         window.location.href = "view.php?idp=' . $idp . '";
      </script>
      ';
   }
}


//menambah barang masuk 

if (isset($_POST['barangmasuk'])) {
   
    $idproduk = mysqli_real_escape_string($c, $_POST['idproduk']);
    $qty = mysqli_real_escape_string($c, $_POST['qty']);

    
    $insertb = mysqli_query($c, "INSERT INTO masuk (idproduk, qty) VALUES ('$idproduk', '$qty')");

    if ($insertb) {
        
        header("Location: masuk.php");
        exit(); 
    } else {
        
        echo '
        <script>
            alert("Gagal");
            window.location.href = "masuk.php";
        </script>
        ';
    }
}
//hapus produk pesanan 
if(isset($_POST['hapusprodukpesanan'])){
$idp = $_POST['idp'];//iddetailpesanan
$idpr = $_POST['idpr'];
$idorder = $_POST['idorder'];

//cek qty sekarang 
$cek1 = mysqli_query($c,"select * from detailpesanan where iddetailpesanan='$idp'");
$cek2 = mysqli_fetch_array ($cek1);
$qtysekarang = $cek2['qty'];

//cek stock sekarang
$cek3 = mysqli_query($c,"select * from produk where idproduk='$idpr'");
$cek4 = mysqli_fetch_array($cek3);
$stocksekarang = $cek4['stock'];

$hitung = $stocksekarang+$qtysekarang;

$updet = mysqli_query($c,"update produk set stock='$hitung' where idproduk='$idpr'");//update stock
$hapus = mysqli_query($c,"delete from detailpesanan where idproduk='$idpr' and iddetailpesanan='$idp'");


if($updet&&$hapus){
   header('Location: view.php?idp='.$idorder);

}else{
   echo '
   <script>
      alert("Gagal menghapus barang");
      window.location.href = "view.php?idp=' . $idorder . '";
   </script>
   ';
}
}

//edit barang
if(isset($_POST['editbarang'])){
   // Retrieve form data
   $namaproduk = mysqli_real_escape_string($c, $_POST['namaproduk']);
   $desc = mysqli_real_escape_string($c, $_POST['deskripsi']);
   $harga = mysqli_real_escape_string($c, $_POST['harga']);
   $idp = mysqli_real_escape_string($c, $_POST['idp']); // idproduk

   // Update the query
   $query = mysqli_query($c, "UPDATE produk SET namaproduk='$namaproduk', deskripsi='$desc', harga='$harga' WHERE idproduk='$idp'");

   if($query){
      // Redirect on success
      header("Location: stock.php");
      exit(); // Don't forget to call exit after header to stop script execution
   } else {
      // Display error if query fails
      echo '
      <script>
          alert("Gagal");
          window.location.href = "stock.php";
      </script>
      ';
   }
}
 

//hapus barang
if(isset($_POST['hapusbarang'])){
  $idp = $_POST['idp'];

  $query = mysqli_query($c,"delete from produk where idproduk='$idp'");

  if($query){
   // Redirect on success
   header("Location: stock.php");
   exit(); // Don't forget to call exit after header to stop script execution
} else {
   // Display error if query fails
   echo '
   <script>
       alert("Gagal");
       window.location.href = "stock.php";
   </script>
   ';
}
}

?>



