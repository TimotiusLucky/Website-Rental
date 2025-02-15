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
                      <th style="border: 0px; width:85%;"><h1 class="my-3">Tambah Mobil</h1></th>
                      <th style="border: 0px; width:15%"><center><a class="btn btn-primary text-light" href="mobil-index"><b>Kembali</b></a></center></th>
                  </tr>
                </thead>
              </table><hr>

              <div class="cont-form">
                <form method="post" action="/web_rental/config/aksi-tambah-mobil.php" enctype="multipart/form-data">

                    <input type="hidden" value="0" name="status">

                    <?php 
                    if(isset($_GET['pesan'])){

                      if($_GET['pesan']=="cekMobil"){

                        echo "<div class='alert alert-primary'>Plat Mobil sudah didaftarkan!</div>";

                      }
                    }
                    ?>

                    <h5>Plat Mobil</h5>
                    <input class="form-control" type="text" name="plat_mobil" required>
                    <br>

                    <h5>Merek</h5>
                    <input class="form-control" type="text" name="merek" required>
                    <br>

                    <h5>Tipe</h5>
                    <input class="form-control" type="text" name="tipe" required>
                    <br>

                    <h5>Model</h5>
                    <input class="form-control" type="text" name="model" required>
                    <br>

                    <h5>Warna</h5>
                    <input class="form-control" type="text" name="warna" required>
                    <br>

                    <h5>Tahun</h5>
                    <input class="form-control" type="number" name="tahun" required>
                    <br>

                    <h5>Jenis Mobil</h5>
                    <select class="form-control" name="jenis" required>
                      <option value="SUV">SUV</option>
                      <option value="MPV">MPV</option>
                      <option value="Sport">Sport</option>
                      <option value="Pickup">Pickup</option>
                      <option value="Elektrik">Elektrik</option>
                      <option value="Crossover">Crossover</option>
                      <option value="Hatchback">Hatchback</option>
                      <option value="Sedan">Sedan</option>
                      <option value="Sport Sedan">Sport Sedan</option>
                      <option value="Convertible">Convertible</option>
                      <option value="Station Wagon">Station Wagon</option>
                      <option value="Off Road">Off Road</option>
                      <option value="Hybrid">Hybrid</option>
                      <option value="LCGC">LCGC</option>
                    </select>
                    <br>

                    <h5>Harga per Hari</h5>
                    <input class="form-control" type="number" name="hrg_hari" required>
                    <br>

                    <h5>Harga Supir</h5>
                    <input class="form-control" type="number" name="hrg_supir" required>
                    <br>

                    <h6>Gambar Mobil</h6>
                    <input class="form-control" type="file" name="uploadfile" required>
                    <br><br>

                    <button class="btn btn-success btn-xl text-uppercase" id="submitButton" type="submit">Konfirmasi</button>

                  </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      const pageAccessedByReload = (
        (window.performance.navigation && window.performance.navigation.type === 1) ||
          window.performance
            .getEntriesByType('navigation')
            .map((nav) => nav.type)
            .includes('reload')
      );

      if(pageAccessedByReload == false){

      }else{
      window.location.href = '/web_rental/admin/tambah-mobil';
      }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
