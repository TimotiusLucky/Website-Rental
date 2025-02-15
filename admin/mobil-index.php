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

            if($_GET['pesan']=="tambahMobil"){

              echo "<div class='alert alert-secondary'>Berhasil Menambahkan Mobil</div>";

            }

            if($_GET['pesan']=="editMobil"){

              echo "<div class='alert alert-secondary'>Berhasil Mengedit Mobil</div>";

            }

            if($_GET['pesan']=="hapusMobil"){

              echo "<div class='alert alert-secondary'>Berhasil Menghapus Mobil</div>";

            }
          }
          ?>

          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <table style="width:100%">
                <thead>
                  <tr>
                      <th style="border: 0px; width:85%;"><h1 class="my-3">Daftar Mobil</h1></th>
                      <th style="border: 0px; width:15%"><center><a class="btn btn-info text-light" href="tambah-mobil"><b>Tambah</b></a></center></th>
                  </tr>
                </thead>
              </table>

              <hr>

              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Cari Mobil..." id="search">
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
                        <th style="width: 25%;">Mobil</th>
                        <th style="width: 10%; text-align: center;">Tahun</th>
                        <th style="width: 12%;">Warna</th>
                        <th style="width: 15%;">Tipe</th>
                        <th style="width: 15%; text-align: center;">Status</th>
                        <th style="width: 18%; text-align: center;">Aksi</th>
                      </tr>

                    </thead>

                    <?php 

                    $limit          = 5;

                    $halaman        = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;

                    $halaman_awal   = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

                    $sebelum        = $halaman - 1;
                    $setelah        = $halaman + 1;

                    $datas          = mysqli_query($conn, "SELECT * FROM mobil");

                    $jumlah_data    = mysqli_num_rows($datas);

                    $total_halaman  = ceil($jumlah_data / $limit);

                    $data_mobil      = mysqli_query($conn, "SELECT * FROM mobil LIMIT $halaman_awal, $limit");

                    $no             = $halaman_awal + 1;

                    while($data = mysqli_fetch_array($data_mobil)){

                    ?>
                    <tbody style="background-color: #FFF5E0;">

                      <tr>
                          <td style=" text-align: center;"><?php echo $no++; ?></td>

                          <td><a style="text-decoration: none;" href="lihat-mobil?plat_mobil=<?php echo $data['plat_mobil']?>"><?php echo $data['merek']." ".$data['model'];?></a></td>

                          <td style="text-align: center;"><?php echo $data['tahun']; ?></td>

                          <td><?php echo $data['warna']; ?></td>

                          <td><?php echo $data['tipe']; ?></td>

                          <?php if ($data['status'] == "0") {

                            echo"<td style='text-align: center;' class='text-success' >Mobil Tersedia</td>";

                          }else{

                            echo"<td style='text-align: center;' class='text-danger' >Mobil di Sewa</td>";

                          } ?>

                          <td style=" text-align: center;">
                            <a class="btn btn-success" href="edit-mobil?plat_mobil=<?php echo $data['plat_mobil']?>">Edit</a>
                            <a class="btn btn-danger" href="/web_rental/config/aksi-hapus-mobil?plat_mobil=<?php echo $data['plat_mobil']?>">Hapus</a>
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
    window.location.href = '/web_rental/admin/mobil-index';
    }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
