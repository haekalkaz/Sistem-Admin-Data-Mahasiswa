<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
     header('location:login.php');
     exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nim dengan fungsi get
$nim = $_GET['nim'];

// Mengambil data dari table siswa dari nim yang tidak sama dengan 0
$siswa = query("SELECT * FROM siswa WHERE nim = $nim")[0];

// Jika fungsi ubah lebih dari 0/data terubah, maka munculkan alert dibawah
if (isset($_POST['ubah'])) {
     if (ubah($_POST) > 0) {
          echo "<script>
                alert('Data mahasiswa berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
     } else {
          // Jika fungsi ubah dibawah dari 0/data tidak terubah, maka munculkan alert dibawah
          echo "<script>
                alert('Data mahasiswa gagal diubah!');
            </script>";
     }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
     <!-- Font Google -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <!-- animasi CSS Aos -->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <!-- My CSS -->
     <link rel="stylesheet" href="css/style.css">

     <title>Update Data</title>
</head>

<body background="img/bg/bck.png">
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
          <div class="container">
               <a class="navbar-brand" href="index.php">Sistem Admin Data Siswa</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="index.php">Home</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="#about">About</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="logout.php">Logout</a>
                         </li>
                    </ul>
               </div>
          </div>
     </nav>
     <!-- Close Navbar -->

     <!-- Container -->
     <div class="container">
          <div class="row my-2 text-light">
               <div class="col-md">
                    <h3 class="fw-bold text-uppercase ubah_data"></h3>
               </div>
               <hr>
          </div>
          <div class="row my-2 text-light">
               <div class="col-md">
                    <form action="" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="gambarLama" value="<?= $siswa['gambar']; ?>">
                         <div class="mb-3">
                              <label for="nim" class="form-label">NIM</label>
                              <input type="number" class="form-control w-50" id="nim" value="<?= $siswa['nim']; ?>"
                                   name="nim" readonly>
                         </div>
                         <div class="mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" class="form-control w-50" id="nama" value="<?= $siswa['nama']; ?>"
                                   name="nama" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control w-50" id="tmpt_lahir"
                                   value="<?= $siswa['tmpt_lahir']; ?>" name="tmpt_lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control w-50" id="tgl_lahir"
                                   value="<?= $siswa['tgl_lahir']; ?>" name="tgl_lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label>Jenis Kelamin</label>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Laki - Laki"
                                        value="Laki - Laki" <?php if ($siswa['jekel'] == 'Laki - Laki') { ?> checked=''
                                        <?php } ?>>
                                   <label class="form-check-label" for="Laki - Laki">Laki - Laki</label>
                              </div>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Perempuan"
                                        value="Perempuan" <?php if ($siswa['jekel'] == 'Perempuan') { ?> checked=''
                                        <?php } ?>>
                                   <label class="form-check-label" for="Perempuan">Perempuan</label>
                              </div>
                         </div>
                         <div class="mb-3">
                              <label for="prodi" class="form-label">Prodi</label>
                              <select class="form-select w-50" id="prodi" name="prodi">
                                   <option disabled selected value>--------------------------------------------Pilih
                                        Prodi--------------------------------------------</option>
                                   <option value="Sistem Informasi" <?php if ($siswa['prodi'] == 'Sistem Informasi') { ?>
                                        selected='' <?php } ?>>Sistem Informasi</option>
                                   <option value="Teknik Informatika" <?php if ($siswa['prodi'] == 'Teknik Informatika') { ?>
                                        selected='' <?php } ?>>Teknik Informatika</option>
                                   <option value="Ilmu Komputer" <?php if ($siswa['prodi'] == 'Ilmu Komputer') { ?>
                                        selected='' <?php } ?>>Ilmu Komputer</option>
                                   <option value="Bisnis Digital"
                                        <?php if ($siswa['prodi'] == 'Bisnis Digital') { ?> 
                                        selected='' <?php } ?>>Bisnis Digital</option>
                                   <option value="Sains Data" <?php if ($siswa['prodi'] == 'Sains Data') { ?>
                                        selected='' <?php } ?>>Sains Data</option>
                                   <option value="Manajemen" <?php if ($siswa['prodi'] == 'Manajemen') { ?> 
                                        selected='' <?php } ?>>Manajemen</option>
                         </div>
                         <div class="mb-3">
                              <label for="email" class="form-label">E-Mail</label>
                              <input type="email" class="form-control w-50" id="email" value="<?= $siswa['email']; ?>"
                                   name="email" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                              <img src="img/<?= $siswa['gambar']; ?>" width="50%" style="margin-bottom: 10px;">
                              <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                         </div>
                         <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <textarea class="form-control w-50" id="alamat" rows="5" name="alamat"
                                   autocomplete="off"><?= $siswa['alamat']; ?></textarea>
                         </div>
                         <hr>
                         <a href="index.php" class="btn btn-secondary">Kembali</a>
                         <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                    </form>
               </div>
          </div>
     </div>
     <!-- Close Container -->



     <!-- Footer -->
     <div class="container-fluid">
          <div class="row bg-dark text-white text-center">
               <div class="col my-2" id="about">
                    <br><br><br>
                    <h4 class="fw-bold text-uppercase">About</h4>

                    <p>
                         Pembuat:
                         1. Farhan Ade Atalarik (2135038)
                    </p>
               </div>
          </div>
     </div>
     <!-- Close Footer -->

     <!-- Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
     </script>

     <!-- animasi  gsap-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
     <script>
          gsap.registerPlugin(TextPlugin);
          gsap.to('.ubah_data', {
               duration: 2,
               delay: 1,
               text: '<i class="bi bi-pencil-square"></i>Ubah Data Siswa'
          })
          gsap.from('.navbar', {
               duration: 1,
               y: '-100%',
               opacity: 0,
               ease: 'bounce',
          })
     </script>
</body>

</html>