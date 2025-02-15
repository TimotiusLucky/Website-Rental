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

              <?php 

              $level = $_GET['level']; 

              if ($level == "admin") {
                
                echo "<h1>Info Admin</h1><hr>";
                $link = "adm-index";

              }else{

                echo "<h1>Info User</h1><hr>";
                $link = "user-index";

              }

              ?>

              <div style="padding-bottom: 70px;" class="cont-form">

                <?php 
                $id = $_GET['id'];
                $admin = mysqli_query($conn, "SELECT * FROM akun WHERE id_akun='$id'");

                while($data = mysqli_fetch_array($admin)){ ?>

                  <table class="info-card" style="width: 100%;">

                    <tr>
                      <th style="width: 25%;"></th>
                      <th style="width: 2%;"></th>
                      <th style="width: 73%;"></th>
                    </tr>

                    <tr>
                      <td class="bold">Username</td>
                      <td>:</td>
                      <td><?php echo $data['username']; ?></td>
                    </tr>

                    <tr></tr>

                    <tr>
                      <td class="bold">Nama Lengkap</td>
                      <td>:</td>
                      <td><?php echo $data['nama']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Nomor Telepon</td>
                      <td>:</td>
                      <td><?php echo $data['no_telp']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Alamat</td>
                      <td>:</td>
                      <td><?php echo $data['alamat']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Email</td>
                      <td>:</td>
                      <td><?php echo $data['email']; ?></td>
                    </tr>

                  </table><br>

                  <a style="float: right;" class="btn btn-primary btn-md text-uppercase" href="<?php echo $link; ?>">Kembali</a>

                <?php }?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
