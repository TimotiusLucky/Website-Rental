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

        <?php 
        $kode_layanan = $_GET['kode_layanan'];
        $layanan = mysqli_query($conn, "SELECT * FROM layanan WHERE kode_layanan='$kode_layanan'");

        while($data = mysqli_fetch_array($layanan)){ ?>

        <div class="container">
          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <table style="width:100%">
                <thead>
                  <tr>
                      <th style="border: 0px; width:85%;"><h1 class="my-3">Edit Layanan</h1></th>
                      <th style="border: 0px; width:15%"><center><a class="btn btn-primary text-light" href="layanan-index"><b>Kembali</b></a></center></th>
                  </tr>
                </thead>
              </table><hr>

              <div class="cont-form">
                <form method="post" action="/web_rental/config/aksi-edit-layanan.php" enctype="multipart/form-data">

                    <input type="hidden" value="<?php echo $data['kode_layanan'] ?>" name="kode_layanan">

                    <h5>Nama Layanan</h5>
                    <input value="<?php echo $data['nm_layanan'] ?>" class="form-control" type="text" name="nm_layanan" required>
                    <br>

                    <?php

                    if ($data['jml_hari'] < 1) {
                      
                      $hr_jam = $data['jml_hari']*24;
                      $lbl_hr_jam = "Jam";

                    }else{

                      $hr_jam = $data['jml_hari'];
                      $lbl_hr_jam = "Hari";

                    }

                     ?>

                    <h5>Jumlah (Hari/Jam) Sewa 
                      <select name="param_hari" id="mySelectBox" style="margin-left: 5px; border: 1px solid #ced4da; border-radius: 0.375rem; color: #212529;" class="">

                        <option value="<?php echo $lbl_hr_jam ?>"><?php echo $lbl_hr_jam ?></option>

                        <optgroup label="--------------------------">
                          <option value="Hari">Hari</option>
                          <option value="Jam">Jam</option>
                        </optgroup>

                      </select>
                    </h5>
                    <input value="<?php echo $hr_jam ?>" class="form-control" type="number" name="jml_hari" required>
                    <br>

                    <h5>Keterangan</h5>
                    <textarea class="form-control" name="ket_layanan" required><?php echo $data['ket_layanan'] ?></textarea>
                    <br>

                    <h5>Harga Tambahan (%)</h5>
                    <input value="<?php echo $data['hrg_tambahan'] ?>" class="form-control" type="number" name="hrg_tambahan" required>
                    <br>

                    <h6>Gambar Layanan</h6>
                    <input class="form-control" type="file" name="uploadfile" required>
                    <br><br>

                    <button class="btn btn-success btn-xl text-uppercase" id="submitButton" type="submit">Konfirmasi</button>

                  </form>
              </div>

              <?php }?>

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
      window.location.href = 'edit-layanan?kode_layanan='$kode_layanan;
      }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
