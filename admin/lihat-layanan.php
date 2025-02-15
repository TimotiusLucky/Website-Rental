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
          <div style="padding: 40px 10px;" class="cont-form">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <h1><?php echo $data['nm_layanan']; ?></h1>
              <hr>

              <div class="row">

                <?php echo "<img style='border-radius: 40px; object-fit: contain; max-width: 500px; max-height: 300px; display: block; margin: auto;' src='/web_rental/config/img_layanan/".$data['gambar_layanan']."' alt='".$data['nm_layanan']."' class='col-md-5'>";?>

                <div class="col-md-7">

                  <table class="info-card" style="width: 100%;">

                    <tr>
                      <th style="width: 35%;"></th>
                      <th style="width: 2%;"></th>
                      <th style="width: 63%;"></th>
                    </tr>

                    <tr>
                      <td class="bold">Nama Layanan</td>
                      <td>:</td>
                      <td><?php echo $data['nm_layanan']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Kode Layanan</td>
                      <td>:</td>
                      <td><?php echo $data['kode_layanan']; ?></td>
                    </tr>

                    <tr></tr>

                    <tr>
                      <td class="bold">Jumlah (Hari/Jam) Sewa</td>
                      <td>:</td>
                      <td>
                        <?php 

                        $jml_hari = $data['jml_hari'];

                        if ($jml_hari < 1) {

                          $jam =ceil($jml_hari * 24);
                          echo $jam." Jam";

                        }else{

                          echo $data['jml_hari']." Hari"; 

                        }
                        ?>
                      </td>
                    </tr>

                    <tr>
                      <td class="bold">Harga Tambahan (%)</td>
                      <td>:</td>
                      <td><?php echo $data['hrg_tambahan']; ?></td>
                    </tr>

                  </table>

                  <br>
                  
                </div>

                <h3 style="margin-top: 30px;">Keterangan</h3><hr style="width: 97%">
                <p>&emsp;&emsp;<?php echo $data['ket_layanan']; ?></p>

                <?php }?>
                
              </div>
              <a style="float: right; width: 20%;" class="btn btn-primary btn-md text-uppercase" href="<?php echo 'Layanan-index'; ?>">Kembali</a>
            </div>
          </div>
        </div>

    </div>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
