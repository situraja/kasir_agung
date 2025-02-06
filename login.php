<?php
require 'function.php';

if(!isset($_SESSION['login'])){
    // yaudah
} else {
    // sudah login
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            /* Latar Belakang */
            body {
                background: linear-gradient(to top right, #00b4d8, #3a86ff);
                font-family: 'Roboto', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            /* Styling Card */
            .card {
                background: #ffffff;
                border-radius: 40px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                width: 100%;
                max-width: 900px; /* Memperbesar max-width card */
                padding: 40px;
                transition: transform 0.3s ease-in-out;
                transform-origin: center;
            }

            .card:hover {
                transform: scale(1.05);
            }

            .card-header {
                background-color: #3a86ff;
                color: #fff;
                text-align: center;
                font-size: 28px;
                font-weight: 600;
                padding: 20px 0;
                border-radius: 15px 15px 0 0;
            }

            /* Field Input */
            .form-floating {
                margin-bottom: 20px;
            }

            .form-control {
                border-radius: 10px;
                box-shadow: none;
                font-size: 16px;
                padding: 15px;
                height: 50px;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: #00b4d8;
                box-shadow: 0 0 5px rgba(0, 180, 216, 0.6);
            }

            .form-floating label {
                font-size: 14px;
                color: #6c757d;
            }

            /* Styling Tombol */
            .btn-primary {
                background-color: #00b4d8;
                border-color: #00b4d8;
                color: white;
                font-weight: bold;
                border-radius: 30px;
                padding: 15px;
                width: 100%;
                transition: background-color 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #0098b5;
                border-color: #0098b5;
            }

            /* Footer */
            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 14px;
                color: #6c757d;
            }

            .footer a {
                text-decoration: none;
                color: #3a86ff;
                font-weight: bold;
            }

            /* Responsivitas Mobile */
            @media (max-width: 576px) {
                .card {
                    padding: 30px;
                }

                .card-header {
                    font-size: 24px;
                }
            }
        </style>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-fluid"> <!-- Diubah menjadi container-fluid -->
                        <div class="row justify-content-center">
                            <div class="col-lg-20"> <!-- Ukuran kolom diubah menjadi col-lg-10 -->
                                <div class="card shadow-lg border-5 rounded-lg mt-10">
                                    <div class="card-header">
                                        <h3>Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating">
                                                <input class="form-control" id="inputEmail" name="username" type="text" placeholder="Masukkan username" required />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" required/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <button type="submit" name="login" class="btn btn-primary mt-4">Login</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="footer">
                                    <p> <a href="#"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
