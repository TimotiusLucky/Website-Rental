<!DOCTYPE html>

<?php include'config/koneksi.php';?>

<!-- Daftar Mobil -->
<section style="margin: 50px;">
    <div class="container px-4 px-lg-5">
        <h1 class="text-center mt-0">Daftar Mobil</h1>
        <hr class="divider" />
    </div>

    <!-- Card Mobil -->
    <div id="portfolio">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <?php 

                function formatRupiah($nilai) {
                    return "Rp. " . number_format($nilai, 0, ',', '.');
                }

                $limit          = 6;

                $halaman        = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;

                $halaman_awal   = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

                $sebelum        = $halaman - 1;
                $setelah        = $halaman + 1;

                $datas          = mysqli_query($conn, "SELECT * FROM mobil WHERE status=0");

                $jumlah_data    = mysqli_num_rows($datas);

                $total_halaman  = ceil($jumlah_data / $limit);

                $data_mobil      = mysqli_query($conn, "SELECT * FROM mobil WHERE status=0 LIMIT $halaman_awal, $limit");

                $no             = $halaman_awal + 1;

                $data_layanan = mysqli_query($conn, "SELECT * FROM layanan WHERE jml_hari = '1'");

                while($data = mysqli_fetch_array($data_layanan)){

                    $hrg_tambahan = $data['hrg_tambahan']/100;

                }

                while($data = mysqli_fetch_array($data_mobil)){

                    $hrg_mobil = $data['hrg_hari'] + ($hrg_tambahan * $data['hrg_hari']);

                ?>

                <div class="col-lg-4 col-sm-6 cont-mobil">
                    <center>
                        <div class="card-mobil">

                            <div class="container-mobil">
                                <img style="border-radius: 20px;" class="img-fluid" src="/web_rental/config/img_mobil/<?php echo $data['gambar_mobil']; ?>" alt="..." />

                                  <a class="overlay-mobil" id='openPopupInfo' href="index?lihatMobil=<?php echo $data['plat_mobil'] ?>"></a>

                            </div><br>

                            <?php $harga = formatRupiah($hrg_mobil);?>


                        <h3><?php echo $data['merek']." ".$data['tipe'];?></h3>
                        <p style="margin-bottom: 5px;">Sewa Harian Mulai dari </p><p style="margin-top: 5px;"><?php echo $harga; ?></p>
                        <a class="btn btn-warning btn-xl" href="user/pesan-mobil?plat_mobil=<?php echo $data['plat_mobil']; ?>&kode_layanan=0">Pesan Sekarang</a>
                        </div>
                    </center>
                </div>

                <?php } ?>

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
</section>