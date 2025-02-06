<?php

require 'ceklogin.php';
//hitung jumlah barang
$h1 = mysqli_query($c,"select * from produk");
$h2 = mysqli_num_rows($h1);//jumlah produk
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

                </li>
            </ul>
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
                            </a><a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               kelola pelanggan
                            </a> 
                            <a class="nav-link" href="logout.php">
                                logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                       
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Barang: <?=$h2;?></div>
                                </div>
                            </div>
                          </div>


                          <!-- Button to Open the Modal -->
                          <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                          Tambah Barang Baru
                        </button>

                            


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Barang
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama produk</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>      
                                    <tbody>
                                  
                                    <?php 
                                    $get = mysqli_query ($c, "select * from produk");
                                    $i = 1;

                                    while($p=mysqli_fetch_array($get)){
                                        $namaproduk = $p['namaproduk'];
                                        $deskripsi = $p['deskripsi'];
                                        $harga = $p['harga'];
                                        $stock = $p['stock'];
                                        $idproduk = $p['idproduk'];
                                    ?>
                                    
                                    <tr>
                                      <td><?=$i++;?></td>
                                      <td><?=$namaproduk;?></td>
                                      <td><?=$deskripsi;?></td>
                                      <td><?=$stock;?></td>
                                      <td>Rp<?=number_format($harga);?></td>
                                      <td>
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#editLabel<?=$idproduk;?>">
                                          Edit
                                        </button>
                                        <!-- Delete Button (example text for now) -->
                                        <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#deleteLabel<?=$idproduk;?>">
                                          Delete
                                        </button>
                                      </td>
                                    </tr>
                                    
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editLabel<?=$idproduk;?>" tabindex="-1" aria-labelledby="editLabel<?=$idproduk;?>" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                            <h4 class="modal-title">Ubah <?=$namaproduk;?></h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                    
                                          <!-- Modal Body -->
                                          <div class="modal-body">
                                            <form action="function.php" method="post">
                                              <div class="form-group">
                                                <label for="namaproduk">Ubah <?=$namaproduk;?></label>
                                                <input type="text" class="form-control" id="namaproduk" name="namaproduk" placeholder="Nama Produk" value="<?=$namaproduk;?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label for="deskripsi">Deskripsi:</label>
                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" value="<?=$deskripsi;?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label for="harga">Harga Produk:</label>
                                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Produk" value="<?=$harga;?>" required>
                                              </div>
                                              <input type="hidden" name="idp" value="<?=$idproduk;?>">
                                          </div>
                                    
                                          <!-- Modal Footer -->
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="editbarang">Submit</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                          </div>
                                          
                                        </form>
                                        </div>
                                      </div>
                                    </div>

                                    
                        <!-- Modal Delete -->
                      <div class="modal fade" id="deleteLabel<?=$idproduk;?>" tabindex="-1" aria-labelledby="deleteLabel<?=$idproduk;?>" aria-hidden="true">
                      <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">hapus <?=$namaproduk;?></h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" >&times;</button>
                          </div>
                                                    
                            <!-- Modal Body -->
                            <div class="modal-body">
                        <form action="function.php" method="post">
                      Apakah Anda yakin ingin menghapus barang ini ?
                        <input type="hidden" name="idp" value="<?=$idproduk;?>">
                        </div>
                                                    
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="hapusbarang">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                                                          
                        </form>
                          </div>
                        </div>
                        </div>

                        <?php
                                                    };// end of  while
                               

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
                              <div class="modal-body">
                                <form action="function.php" method="post">
                                  <div class="form-group">
                                    <label for="namaproduk">Nama Produk:</label>
                                    <input type="text" class="form-control" id="namaproduk" name="namaproduk" placeholder="Nama Produk" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="deskripsi">Deskripsi:</label>
                                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="stock">Stock Awal:</label>
                                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Awal" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="harga">Harga Produk:</label>
                                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Produk" required>
                                  </div>

                              <!-- Modal Footer -->
                              <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahbarang">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>

</div>
     
  
</html>
