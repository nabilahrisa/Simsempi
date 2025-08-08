<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
    require 'functions.php';
    if (isset($_POST["submit"])) {
        if (tahapsatu($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'tahap1.php'
                </script>
                ";
        } else {
            echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php'
            </script>
            ";
        }
    }
    $nim = $_SESSION['nim'];
    $query = "SELECT * FROM user WHERE nim='$nim' ";
    $result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Tambah Data - SIMSEMPI</title>
        <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <!-- Icon Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body class="bg-custom" style="background-image: url('assets/img/unesa.jpg');">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold text-light">SIMSEMPI - JTIF</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase fw-bold">
                            <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="profile.php">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tahap1.php">Tahap 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tahap2.php">Tahap 2</a>
                            </li>
                        </ul>
                        <span class="navbar-text mr-4 text-info">Selamat Datang, <?php foreach($result as $name) :?> <?= $name["nama"]; ?> <?php endforeach; ?></span>
                        <a href="#" id="btn-logout" class="btn btn-outline-light" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-box-arrow-left"></i>&nbsp;&nbsp;Logout</a>
                    </div>
                </div>
            </nav>
            <div class="row justify-content-md-center">
                <div class="col-md-5">
                    <h1 class="text-center text-primary mb-4 mt-4 pt-4 pb-2" data-aos="zoom-in" data-aos-duration="1000">Tahap Satu</h1>
                    <form class="row text-light justify-content-md-center g-3 mb-4 pb-4" action="" method = "post" enctype="multipart/form-data" data-aos="zoom-in" data-aos-duration="500">
                        <input type="hidden" name="id_author" id="id_author" value="<?= $_SESSION['id_author']?>">
                        <div class="col-md-12">
                            <label class="form-label" for="NIM">NIM :</label>
                            <input class="form-control" type="text" name="NIM" id="NIM" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="Nama">Nama :  </label>    
                            <input class="form-control" type="text" name="Nama" id="Nama" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="judul">Judul :  </label>    
                            <input class="form-control" type="text" name="judul" id="judul" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="dospem">Dosen Pembimbing :  </label>    
                            <input class="form-control" type="text" name="dospem" size="100" id="dospem" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="surfak">Surat Permohonan Fakultas :  </label>    
                            <input class="form-control" type="file" name="surfak" id="surfak" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="surbal">Surat Balasan Instansi :  </label>    
                            <input class="form-control" type="file" name="surbal" id="surbal" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="proposal">Proposal :  </label>    
                            <input class="form-control" type="file" name="proposal" id="proposal" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="tahap1">Tahapan :  </label>    
                            <input class="form-control" type="text" name="tahap1" id="tahap1" required>
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <a href="tahap1.php" class="btn btn-secondary" tabindex="-1" role="button" aria-disabled="false">Kembali</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <button class="btn btn-success tambah-data" type="submit" name="submit">Tambah Data!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <!-- Java Script from assets -->
        <script src="assets/js/script.js"></script>
        <!-- Sweet Alert -->
        <script src="assets/js/package/dist/sweetalert2.all.min.js"></script>
        <!-- AOS -->
        <script type="text/javascript">
            AOS.init();
        </script>
    </body>
</html>