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

            if($_GET['pesan']=="tambahLayanan"){

              echo "<div class='alert alert-secondary'>Berhasil Menambahkan Layanan</div>";

            }

            if($_GET['pesan']=="editLayanan"){

              echo "<div class='alert alert-secondary'>Berhasil Mengedit Layanan</div>";

            }

            if($_GET['pesan']=="hapusLayanan"){

              echo "<div class='alert alert-secondary'>Berhasil Menghapus Layanan</div>";

            }
          }
          ?>

          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <table style="width:100%">
                <thead>
                  <tr>
                      <th style="border: 0px; width:85%;"><h1 class="my-3">Daftar Layanan</h1></th>
                      <th style="border: 0px; width:15%"><center><a class="btn btn-info text-light" href="tambah-layanan"><b>Tambah</b></a></center></th>
                  </tr>
                </thead>
              </table>

              <hr>

              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Cari Layanan..." id="search">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Cari</button>
                  </div>
                </div>
              </div>

              <div style="padding: 0px 20px;">

                  <table class="table table-font" style="width: 100%">

                    <thead>

                      <tr>
                        <th style="width: 5%; text-align: center;">No</th>
                        <th style="width: 30%;">Nama Layanan</th>
                        <th style="width: 25%; text-align: center;">Jumlah (Hari/Jam) Sewa</th>
                        <th style="width: 22%; text-align: center;">Harga Tambahan (%)</th>
                        <th style="width: 18%; text-align: center;">Aksi</th>
                      </tr>

                    </thead>

                    <?php 

                    $limit          = 5;

                    $halaman        = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;

                    $halaman_awal   = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

                    $sebelum        = $halaman - 1;
                    $setelah        = $halaman + 1;

                    $datas          = mysqli_query($conn, "SELECT * FROM layanan");

                    $jumlah_data    = mysqli_num_rows($datas);

                    $total_halaman  = ceil($jumlah_data / $limit);

                    $data_layanan      = mysqli_query($conn, "SELECT * FROM layanan LIMIT $halaman_awal, $limit");

                    $no             = $halaman_awal + 1;

                    while($data = mysqli_fetch_array($data_layanan)){

                    ?>
                    <tbody style="background-color: #FFF5E0;">

                      <tr>
                          <td style=" text-align: center;"><?php echo $no++; ?></td>

                          <td><a style="text-decoration: none;" href="lihat-layanan?kode_layanan=<?php echo $data['kode_layanan']?>"><?php echo $data['nm_layanan'];?></a></td>

                          <td style="text-align: center;">
                            <?php 

                            $jml_hari = $data['jml_hari'];

                            if ($jml_hari < 1) {

                              $jam = ceil($jml_hari * 24);
                              echo $jam." Jam";

                            }else{

                              echo ceil($data['jml_hari'])." Hari"; 

                            }
                            ?>
                          </td>

                          <td style=" text-align: center;"><?php echo $data['hrg_tambahan']; ?> %</td>

                          <td style=" text-align: center;">
                            <a class="btn btn-success" href="edit-layanan?kode_layanan=<?php echo $data['kode_layanan']?>">Edit</a>
                            <a class="btn btn-danger" href="/web_rental/config/aksi-hapus-layanan?kode_layanan=<?php echo $data['kode_layanan']?>">Hapus</a>
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
    window.location.href = '/web_rental/admin/layanan-index';
    }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
