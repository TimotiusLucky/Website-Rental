<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include'../components/header.html';
    include '../config/koneksi.php';
    ?>

    <link href="/web_rental/css/nav-admin.css" rel="stylesheet" />

    <body>

    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: /web_rental/logout");
    }

    error_reporting(E_ALL && ~E_NOTICE);
    ?>

    <div id="wrapper">

      <div class="overlay"></div>

      <?php include'../components/navbar-admin.html';?>

      <div id="page-content-wrapper">

        <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>

        <div class="container">
          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <table style="width:100%">
                <thead>
                  <tr>
                      <th style="border: 0px; width:85%;"><h1 class="my-3">Tambah Admin</h1></th>
                      <th style="border: 0px; width:15%"><center><a class="btn btn-primary text-light" href="adm-index"><b>Kembali</b></a></center></th>
                  </tr>
                </thead>
              </table><hr>

              <div class="cont-form">
                <form method="post" action="/web_rental/config/aksi-tambah-akun.php">

                    <input type="hidden" value="admin" name="level">

                    <h5>Nama Lengkap</h5>
                    <input class="form-control" type="text" name="nama" required>
                    <br>

                    <h5>Alamat</h5>
                    <textarea rows="4" class="form-control" name="alamat" required></textarea>
                    <br>

                    <h5>Nomor Telepon</h5>
                    <input class="form-control" type="number" name="no_telp" required>
                    <br>

                    <h5>Email</h5>
                    <input class="form-control" type="email" name="email" required>
                    <br>

                    <h5>Username</h5>
                    <input class="form-control" type="text" name="username" required>
                    <br>

                    <h5>Password</h5>
                    <input class="form-control" type="password" name="password" required>
                    <br><br>

                    <button class="btn btn-success btn-xl text-uppercase" id="submitButton" type="submit">Konfirmasi</button>

                  </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
