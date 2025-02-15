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
        $plat_mobil = $_GET['plat_mobil'];
        $mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE plat_mobil='$plat_mobil'");

        while($data = mysqli_fetch_array($mobil)){ ?>

        <div class="container">
          <div style="padding: 40px 10px;" class="cont-form">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <h1><?php echo $data['merek']." ".$data['tipe']; ?></h1>
              <hr>

              <div class="row">

                <?php echo "<img style='border-radius: 40px; object-fit: contain; max-width: 500px; max-height: 300px; display: block; margin: auto;' src='/web_rental/config/img_mobil/".$data['gambar_mobil']."' alt='".$data['merek']." ".$data['merek']."' class='col-md-5'>";?>

                <div class="col-md-7">

                  <table class="info-card" style="width: 100%;">

                    <tr>
                      <th style="width: 25%;"></th>
                      <th style="width: 2%;"></th>
                      <th style="width: 73%;"></th>
                    </tr>

                    <tr>
                      <td class="bold">Merek</td>
                      <td>:</td>
                      <td><?php echo $data['merek']; ?></td>
                    </tr>

                    <tr></tr>

                    <tr>
                      <td class="bold">Tipe</td>
                      <td>:</td>
                      <td><?php echo $data['tipe']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Model</td>
                      <td>:</td>
                      <td><?php echo $data['model']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Warna</td>
                      <td>:</td>
                      <td><?php echo $data['warna']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Tahun</td>
                      <td>:</td>
                      <td><?php echo $data['tahun']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Jenis Mobil</td>
                      <td>:</td>
                      <td><?php echo $data['jenis']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Harga per Hari</td>
                      <td>:</td>
                      <td><?php echo $data['hrg_hari']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Harga Supir</td>
                      <td>:</td>
                      <td><?php echo $data['hrg_supir']; ?></td>
                    </tr>

                    <tr>
                      
                      <td class="bold">Status</td>
                      <td>:</td>

                      <?php if ($data['status'] == "0") {

                        echo"<td class='text-success' >Mobil Tersedia</td>";

                      }else{

                        echo"<td class='text-danger' >Mobil Sedang di Sewa</td>";

                      } ?>

                    </tr>

                  </table>

                  <br>
                  
                </div>

                <?php }?>
                
              </div>
              <a style="float: right; width: 20%;" class="btn btn-primary btn-md text-uppercase" href="<?php echo 'mobil-index'; ?>">Kembali</a>
            </div>
          </div>
        </div>

    </div>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
