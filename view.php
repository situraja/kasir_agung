<?php

require 'function.php';

if (isset($_GET['idp'])) {
    $idp = $_GET['idp'];

    $ambilnamapelanggan = mysqli_query($c,"select * from pesanan p,pelanggan pl where p.idpelanggan=pl.idpelanggan and p.idorder='$idp'");
    $np = mysqli_fetch_array($ambilnamapelanggan);
    $namapel = $np['namapelanggan'];
} else {
    header('Location: index.php');  
    exit();  
}

if (isset($_POST['addproduk'])) {
    // Ambil data yang dikirimkan dari form
    $idproduk = $_POST['idproduk'];
    $qty = $_POST['qty'];

    // Proses penyimpanan ke database
    $query = "INSERT INTO pesanan_detail (idorder, idproduk, qty) VALUES ('$idp', '$idproduk', '$qty')";
    
    if (mysqli_query($c, $query)) {
        echo "Barang berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_error($c);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Order
                        </a>
                        <a class="nav-link" href="stock.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang 
                        </a> 
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kelola Pelanggan
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Pesanan: <?=$idp;?></h1>
                    <h4 class="mt-4">Nama pelanggan: <?=$namapel;?></h4>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Selamat Datang</li>
                    </ol>
                    
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                        Tambah barang
                    </button>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Pesanan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama produk</th>
                                        <th>Harga satuan</th>
                                        <th>jumlah </th>
                                        <th>Sub-total</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
               $get = mysqli_query($c, "SELECT dp.*, pr.namaproduk, pr.harga FROM detailpesanan dp JOIN produk pr ON dp.idproduk = pr.idproduk WHERE dp.idpesanan and idpesanan= '$idp'");
                 $i = 1;
                  
               while ($p = mysqli_fetch_array($get)) {
    $qty = $p['qty'];
    $harga = $p['harga'];
    $namaproduk = $p['namaproduk'];
    $subtotal = $qty * $harga;
    
    echo "<tr>";
    echo "<td>" . $i++ . "</td>"; // Menampilkan nomor urut
    echo "<td>{$namaproduk}</td>";
    echo "<td>Rp " . number_format($harga, 0, ',', '.') . "</td>"; // Memformat harga dengan simbol Rp
    echo "<td>" . number_format($qty, 0, ',', '.') . "</td>"; // Memformat qty
    echo "<td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>"; // Memformat subtotal dengan simbol Rp
    echo "<td><a href='delete.php?id={$p['idpesanan']}' class='btn btn-danger'>Delete</a></td>"; // Menampilkan tombol Delete
    echo "</tr>";
    
    
}
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Barang Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="">
                <div class="modal-body">
                    Pilih Barang
                    <select name="idproduk" class="form-control">
                        <?php
                        // Ambil data produk dari database
                        $getproduk = mysqli_query($c, "SELECT * FROM produk WHERE idproduk NOT IN (SELECT idproduk FROM detailpesanan WHERE idpesanan = '$idp')");


                        while ($pl = mysqli_fetch_array($getproduk)) {
                            $namaproduk = $pl['namaproduk'];
                            $deskripsi = $pl['deskripsi'];
                            $idproduk = $pl['idproduk'];
                        ?>
                            <option value="<?=$idproduk;?>"><?=$namaproduk;?> - <?=$deskripsi;?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <input type="number" name="qty" class="form-control mt-4" placeholder="jumlah" required>
                    <input type="hidden" name="idp" value="<?=$idp;?>">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="addproduk">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</html>
