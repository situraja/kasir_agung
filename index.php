<?php
require 'ceklogin.php';

// Calculate the number of orders
$h1 = mysqli_query($c, "SELECT * FROM pesanan");
$h2 = mysqli_num_rows($h1); // number of orders
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

        <!-- Add custom CSS for enhanced design -->
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f4f6f9;
            }
            .sb-topnav {
                background-color: #343a40;
            }
            .sb-sidenav {
                background-color: #2d3436;
            }
            .card {
                border-radius: 15px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }
            .card-body {
                padding: 30px;
            }
            .table thead {
                background-color: #007bff;
                color: white;
            }
            .table-striped tbody tr:nth-of-type(odd) {
                background-color: #f8f9fa;
            }
            .btn {
                border-radius: 20px;
                padding: 8px 20px;
            }
            .btn-info {
                background-color: #17a2b8;
                border: none;
            }
            .btn-info:hover {
                background-color: #138496;
            }
            .btn-danger {
                background-color: #dc3545;
                border: none;
            }
            .btn-danger:hover {
                background-color: #c82333;
            }
            .modal-header {
                background-color: #007bff;
                color: white;
            }
            .modal-footer {
                border-top: none;
            }
            .breadcrumb {
                background-color: transparent;
                font-size: 1.1rem;
            }
            .sb-sidenav-footer {
                background-color: #222;
                color: #ccc;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark">
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
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                Stock Barang 
                            </a> 
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Kelola Pelanggan
                            </a>
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
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
                        <h1 class="mt-4">Data Pesanan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>

                        <!-- Stats Cards -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pesanan: <?=$h2;?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                          Tambah Pesanan Baru
                        </button>

                        <!-- Orders Table -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $get = mysqli_query ($c, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan");
                                    while($p=mysqli_fetch_array($get)){
                                        $idorder = $p['idorder'];
                                        $tanggal = $p['tanggal'];
                                        $namapelanggan = $p['namapelanggan'];
                                        $alamat = $p['alamat'];

                                        // Count the number of items
                                        $hitungjumlah = mysqli_query($c, "SELECT * FROM detailpesanan WHERE idpesanan='$idorder'");
                                        $jumlah = mysqli_num_rows($hitungjumlah);
                                      ?>

                                        <tr>
                                            <td><?=$idorder;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$namapelanggan;?> - <?=$alamat;?></td>
                                            <td><?=$jumlah;?></td>
                                            <td>
                                                <a href="view.php?idp=<?=$idorder;?>" class="btn btn-primary" target="blank">Tampilkan</a>
                                                <a href="delete.php?idp=<?=$idorder;?>" class="btn btn-danger" target="blank">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms & Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Modal for Adding Order -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Pesanan Baru</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="pelanggan.php" method="post">
                            <div class="form-group">
                                Pilih Pelanggan
                                <select name="idpelanggan" class="form-control">
                                    <?php
                                    $getpelanggan = mysqli_query($c, "SELECT * FROM pelanggan");
                                    while ($pl = mysqli_fetch_array($getpelanggan)) {
                                        $namapelanggan = $pl['namapelanggan'];
                                        $idpelanggan = $pl['idpelanggan'];
                                        $alamat = $pl['alamat'];
                                    ?>
                                        <option value="<?=$idpelanggan;?>"><?=$namapelanggan;?> - <?=$alamat;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahpesanan">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
