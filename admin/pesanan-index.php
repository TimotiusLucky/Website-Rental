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

          <?php 
          if(isset($_GET['pesan'])){

            if($_GET['pesan']=="pengembalianMobil"){

              echo "<div class='alert alert-secondary'>Berhasil Konfirmasi Pengembalian Mobil</div>";

            }
          }
          ?>

          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <h1 class="my-3">Daftar Pesanan</h1>

              <hr>

              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Cari Transaksi..." id="search">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Cari</button>
                  </div>
                </div>
              </div>

              <div style="padding: 0px 20px;">

                  <table class="table table-font" style="width: 100%">

                    <thead>

                      <tr>
                        <th style="width: 25%;">Mobil</th>
                        <th style="width: 25%;">Layanan</th>
                        <th style="width: 10%;">User</th>
                        <th style="width: 18%;">Tanggal Kembali</th>
                        <th style="width: 22%;">Status</th>
                      </tr>

                    </thead>

                    <?php 

                    $limit          = 5;

                    $halaman        = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;

                    $halaman_awal   = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

                    $sebelum        = $halaman - 1;
                    $setelah        = $halaman + 1;

                    $datas          = mysqli_query($conn, "SELECT * FROM pesanan");

                    $jumlah_data    = mysqli_num_rows($datas);

                    $total_halaman  = ceil($jumlah_data / $limit);

                    $data_pesanan      = mysqli_query($conn, "SELECT * FROM pesanan INNER JOIN transaksi on pesanan.kd_transaksi = transaksi.kd_transaksi INNER JOIN layanan on pesanan.kd_layanan = layanan.kode_layanan INNER JOIN mobil on pesanan.plat_mobil = mobil.plat_mobil INNER JOIN akun on pesanan.id_akun = akun.id_akun LIMIT $halaman_awal, $limit");

                    while($data = mysqli_fetch_array($data_pesanan)){

                    ?>
                    <tbody style="background-color: #FFF5E0;">

                      <tr>

                          <td><a style="text-decoration: none;" href="lihat-pesanan?kd_pesanan=<?php echo $data['kd_pesanan']?>"><?php echo $data['merek']." ".$data['model'];?></a></td>

                          <td><?php echo $data['nm_layanan']; ?></td>

                          <td><?php echo $data['username']; ?></td>

                          <td><?php echo $data['tgl_kembali']; ?></td>

                          <td>

                            <?php if($data['sts_pesanan'] == 0){ ?>

                              <label class="info-success">Selesai</label>

                            <?php }elseif($data['sts_pesanan'] == 1){ ?>

                              <label class="info-warning">Disewa</label>

                            <?php } ?>

                          </td>

                      </tr>

                    </tbody>

                    <?php } ?>

                  </table><br>

                  <ul class="pagination justify-content-center">

                      <li class="page-item">
                        <?php if($halaman > 1){ echo
                        "<a class='page-link' href='?halaman=$sebelum'>Sebelumnya</a>";
                        }?>
                      </li>

                      <?php 
                        for($x = 1; $x <= $total_halaman; $x++){
                      ?> 

                      <li class="page-item">
                        <?php if($total_halaman > 1){ echo
                        "<a class='page-link' href='?halaman=$x'>$x</a>";
                        }?>
                      </li>

                      <?php
                        }
                      ?> 

                      <li class="page-item">
                        <?php if($halaman < $total_halaman){ echo
                        "<a class='page-link' href='?halaman=$setelah'>Selanjutnya</a>";
                        }?>
                      </li>

                  </ul>

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
    window.location.href = '/web_rental/admin/pesanan-index';
    }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
