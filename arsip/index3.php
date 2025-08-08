<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("location: login.php");
        exit;
    }
    require 'functions.php';

    $jumlahDataPerHalaman = 5;
    $jumlahData = count(query("SELECT * FROM mahasiswa WHERE id_author"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $nim = $_SESSION['nim'];
    $query = "SELECT * FROM user WHERE nim='$nim' ";
    $result = mysqli_query($db, $query);
    $id_author=$_SESSION['id_author'];
    $mahasiswa = query("SELECT * FROM mahasiswa WHERE id_author = '$id_author' LIMIT $awalData, $jumlahDataPerHalaman");
    $res = mysqli_query($db, $query);


    if (isset($_POST["cari"])) {
        $mahasiswa = cari($_POST["keyword"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Beranda - SILKM</title>
        <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/login/util.css">
        <link rel="stylesheet" type="text/css" href="assets/css/login/main.css">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <!-- Icon Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body class="bg bg-light bg-gradient">
        <div class="container">
            <nav class="navbar sticky-top navbar-expand-lg navbar-primary bg-light">
              <div class="container-fluid">
                <a class="navbar-brand">SILKM - JTIF</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase fw-bold">
                    <li class="nav-item">
                      <a class="nav-link disabled">Selamat Datang <b><?php foreach($result as $r) :?> <?= $r["nama"]; ?> <?php endforeach; ?></b></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="profile.php">Profil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="btn-logout" href="#">Logout</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                      </ul>
                    </li> -->
                  </ul>
                  <form class="d-flex" method="post">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Cari" aria-label="Cari">
                    <button class="btn btn-outline-primary bi bi-search" type="submit" name="cari"></button>
                  </form>
                </div>
              </div>
            </nav>

            <h1 class="text-center mb-4 mt-4 pb-4 pt-4 text-primary" data-aos="zoom-in">Sistem Informasi <i>Log Book</i> Kampus Merdeka</h1>
            <div class="row mt-4">
                <div class="col-md-10 col-sm-8" data-aos="fade-right">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?php if($halamanAktif > 1) :?>
                            <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a></li>
                        <?php endif; ?>
                        <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if($i == $halamanAktif) : ?>
                                <li class="page-item"><a class="page-link text-dark" href="?halaman=<?= $i; ?>" style="font-weight: bold;"><?= $i; ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if($halamanAktif < $jumlahHalaman) :?>
                            <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a></li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                </div>
                
                <div class="col-md-2 col-sm-4 text-end" data-aos="fade-left">
                    <a href="tambah.php" class="btn btn-outline-success btn" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-person-plus"></i>&nbsp;&nbsp;Tambah Data</a>
                </div>
            </div>

            <br>
            <div class="table-responsive">
                <table class="table table-primary table-hover" border="1" cellpadding="10" cellspacing="0" data-aos="zoom-in" data-aos-duration="1000">
                    <thead class="text-center">
                        <tr>
                            <th>Pertemuan</th>
                            <th>Tgl</th>
                            <th>Pukul</th>
                            <th>Judul Kegiatan</th>
                            <th>Sub Bahasan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody?>
                        <?php $i = 1; ?>
                        <?php foreach($mahasiswa as $row) :?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["tanggal"]; ?></td>
                            <td><?= $row["pukul"]; ?></td>
                            <td><?= $row["judul"]; ?></td>
                            <td size="50"><?= $row["sub"]; ?></td>
                            <td><img src="img/<?= $row ["gambar"]; ?>" width="50" alt=""></td>
                            <td>
                                <a href="ubah.php?id=<?= $row["id"]; ?>"><i class="bi bi-pencil-square"></i></a>
                                <a href="hapus.php?id=<?= $row["id"]; ?>" id="hapus" onclick= "return confirm('Apakah yakin ingin menghapus data, <?= $row["judul"];?>?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
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