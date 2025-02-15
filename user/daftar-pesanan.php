<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include'../components/header.html';
    include '../config/koneksi.php';
    ?>

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

      <?php include'../components/navbar-user.php';?>

      <div id="page-content-wrapper">

        <div style="margin-top: 100px;" class="container">

          <div class="row text-left">
            <div class="content col-lg-12 col-lg-offset-2">

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
                        <th style="width: 20%;">Tanggal Pinjam</th>
                        <th style="width: 20%;">Tanggal Kembali</th>
                        <th style="width: 10%;">Status</th>
                      </tr>

                    </thead>

                    <?php 

                    $id_user        = $_GET['id_user'];

                    $limit          = 5;

                    $halaman        = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;

                    $halaman_awal   = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

                    $sebelum        = $halaman - 1;
                    $setelah        = $halaman + 1;

                    $datas          = mysqli_query($conn, "SELECT * FROM pesanan");

                    $jumlah_data    = mysqli_num_rows($datas);

                    $total_halaman  = ceil($jumlah_data / $limit);

                    $data_pesanan      = mysqli_query($conn, "SELECT * FROM pesanan INNER JOIN transaksi on pesanan.kd_transaksi = transaksi.kd_transaksi INNER JOIN layanan on pesanan.kd_layanan = layanan.kode_layanan INNER JOIN mobil on pesanan.plat_mobil = mobil.plat_mobil INNER JOIN akun on pesanan.id_akun = akun.id_akun WHERE pesanan.id_akun = '$id_user' LIMIT $halaman_awal, $limit");

                    $data_transaksi      = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN layanan on transaksi.kd_layanan = layanan.kode_layanan INNER JOIN mobil on transaksi.plat_mobil = mobil.plat_mobil INNER JOIN akun on transaksi.id_akun = akun.id_akun WHERE transaksi.id_akun = '$id_user' AND transaksi.sts_transaksi != '1' LIMIT $halaman_awal, $limit");

                    ?>
                    <tbody style="background-color: #FFF5E0;">

                    <?php while($data = mysqli_fetch_array($data_transaksi)){

                      $tgl_pinjam = strtotime($data['tgl_pinjam']);
                      $tgl_kembali = strtotime($data['tgl_kembali']);

                      $tgl_pinjam = date("Y-m-d", $tgl_pinjam);
                      $tgl_kembali = date("Y-m-d", $tgl_kembali);

                      ?>

                      <tr>

                          <td><a style="text-decoration: none;" href="lihat-transaksi?kd_transaksi=<?php echo $data['kd_transaksi']?>&id_user=<?php echo $id_user?>"><?php echo $data['merek']." ".$data['model'];?></a></td>

                          <td><?php echo $data['nm_layanan']; ?></td>

                          <td><?php echo $tgl_pinjam; ?></td>

                          <td><?php echo $tgl_kembali; ?></td>

                          <td>

                              <?php if($data['sts_transaksi'] == 0){ ?>

                              <label class="info-warning">Menunggu Konfirmasi</label>

                            <?php }elseif($data['sts_transaksi'] == 2){ ?>

                              <label class="info-danger">Kadaluwarsa</label>

                            <?php } ?>

                          </td>

                      </tr>

                    </tbody>

                    <?php } ?>

                    <?php while($data = mysqli_fetch_array($data_pesanan)){

                      $tgl_pinjam = strtotime($data['tgl_pinjam']);
                      $tgl_kembali = strtotime($data['tgl_kembali']);
                      $tanggalSaatIni = date("Y-m-d");

                      $tgl_pinjam = date("Y-m-d", $tgl_pinjam);
                      $tgl_kembali = date("Y-m-d", $tgl_kembali);

                      if($tgl_pinjam > $tanggalSaatIni){

                        $sts_transaksi = 1;

                      }

                     ?>

                      <tr>

                          <td><a style="text-decoration: none;" href="lihat-pesanan?kd_pesanan=<?php echo $data['kd_pesanan']?>&id_user=<?php echo $id_user?>"><?php echo $data['merek']." ".$data['model'];?></a></td>

                          <td><?php echo $data['nm_layanan']; ?></td>

                          <td><?php echo $tgl_pinjam; ?></td>

                          <td><?php echo $tgl_kembali; ?></td>

                          <td>

                            <?php if($sts_transaksi == 1){ ?>

                              <label class="info-warning">Dibooking</label>

                            <?php }else{

                               if($data['sts_transaksi'] == 0){ ?>

                                <label class="info-warning">Menunggu Konfirmasi</label>

                              <?php }elseif($data['sts_transaksi'] == 1){ 

                                if($data['sts_pesanan'] == 0){ ?>

                                  <label class="info-success">Selesai</label>

                                <?php }elseif($data['sts_pesanan'] == 1){ ?>

                                  <label class="info-warning">Disewa</label>

                                <?php }

                              }elseif($data['sts_transaksi'] == 2){ ?>

                                <label class="info-danger">Kadaluwarsa</label>

                              <?php }

                            } ?>

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
    window.location.href = '/web_rental/user/daftar-pesanan?id_user=<?php echo $id_user; ?>';
    }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
