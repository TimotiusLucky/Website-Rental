<!DOCTYPE html>
<html lang="en">

    <?php include'components/header.html';?>

    <?php include'config/koneksi.php';?>

    <body id="page-top">

        <?php include'components/navbar.php';?>

        <?php include'components/masthead.html';?>

        <section style="margin: 50px 100px;">

            <?php 
            $kode_layanan = $_GET['kode_layanan'];
            $hrg_layanan = 0;
            $layanan = mysqli_query($conn, "SELECT * FROM layanan WHERE kode_layanan = '$kode_layanan'");

            while($data = mysqli_fetch_array($layanan)){ ?>

            <div class="row">

                <?php echo "<img style='border-radius: 40px; object-fit: contain; max-width: 500px; max-height: 300px; display: block; margin: auto;' src='/web_rental/config/img_layanan/".$data['gambar_layanan']."' alt='".$data['nm_layanan']."' class='col-md-4'>";?>

                <div class="col-md-8">
                    <h1><?php echo $data['nm_layanan']; ?></h1>
                    <hr>
                    <p><?php echo $data['ket_layanan']; ?></p>
                </div>

            </div>

            <?php 

                $hrg_layanan = $data['hrg_tambahan'];

            }?>
        
        </section>

        <?php if ($kode_layanan != NULL) { ?>

            <section style="margin-top: 100px;">

                <!-- Tabel Harga-->
                <div style="margin: 0px 50px;">
                    <div class="container mt-4">
                        <div class="row">

                            <h1 class="col-md-7">Daftar Harga</h1>

                            <div class="col-md-5">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Mobil..." id="search">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary" type="button">Cari</button>
                                </div>
                              </div>
                            </div>

                        </div><hr><br>

                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th style="width: 4%">No</th>
                                    <th style="width: 25%; text-align: center;">Mobil</th>
                                    <th style="width: 8%;  text-align: center;">Tahun</th>
                                    <th style="width: 10%; text-align: center;">Warna</th>
                                    <th style="width: 20%;">6 Jam</th>
                                    <th style="width: 18%;">12 Jam</th>
                                    <th style="width: 15%;">Supir</th>
                                </tr>
                            </thead>

                            <?php 

                            $limit          = 10;

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

                                $hrg_mobil = $data['hrg_hari'];
                                $hrg_supir = $data['hrg_supir'];
                                $hrg_mobil_hari = $hrg_layanan * $hrg_mobil;
                                $hrg_mobil_jam = ($hrg_layanan * $hrg_mobil) / 2;

                                $rp_hrg_supir = number_format($hrg_supir, 0, ',', '.');
                                $rp_hrg_mobil_hari = number_format($hrg_mobil_hari, 0, ',', '.');
                                $rp_hrg_mobil_jam = number_format($hrg_mobil_jam, 0, ',', '.');

                            ?>

                                <tbody>

                                    <tr>
                                        <td style="text-align: center;"><?php echo $no++; ?></td>
                                        <td><?php echo $data['merek']." ".$data['tipe']; ?></td>
                                        <td style="text-align: center;"><?php echo $data['tahun']; ?></td>
                                        <td style="text-align: center;"><?php echo $data['warna']; ?></td>
                                        <td>Rp. <?php echo $rp_hrg_mobil_jam ?></td>
                                        <td>Rp. <?php echo $rp_hrg_mobil_hari ?></td>
                                        <td>Rp. <?php echo $hrg_supir ?></td>
                                    </tr>

                                </tbody>

                            <?php } ?>

                        </table>

                        <ul class="pagination justify-content-center">

                          <li class="page-item">
                            <?php if($halaman > 1){ echo
                            "<a class='page-link' href='?kode_layanan=$kode_layanan&halaman=$sebelum'>Sebelumnya</a>";
                            }?>
                          </li>

                          <?php 
                            for($x = 1; $x <= $total_halaman; $x++){
                          ?> 

                          <li class="page-item">
                            <?php if($total_halaman > 1){ echo
                            "<a class='page-link' href='?kode_layanan=$kode_layanan&halaman=$x'>$x</a>";
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

                    <script>
                        document.querySelector("#search").addEventListener("input", function() {

                            let keyword = this.value.toLowerCase();
                            let rows = document.querySelectorAll("tbody tr");

                            rows.forEach(function(row) {
                                let text = row.textContent.toLowerCase();

                                if (text.includes(keyword)) {
                                    row.style.display = "table-row";

                                } else {
                                    row.style.display = "none";

                                }
                            });
                        });
                    </script>

                </div>
            
            </section>

        <?php } ?>

        <!-- Daftar Layanan -->
        <section style="margin: 50px;">
            <div class="container px-4 px-lg-5">
                <h1 class="text-center mt-0">Daftar Layanan</h1>
                <hr class="divider" />
            </div>

            <!-- Card Layanan -->
            <div id="portfolio">
                <div class="container-fluid p-0">
                    <div class="row g-0">

                        <?php 
                        $layanan = mysqli_query($conn, "SELECT * FROM layanan");

                        while($data = mysqli_fetch_array($layanan)){ ?>

                        <div class="cont-mobil">
                            <div class="row card-mobil">

                                <?php echo "<img style='border-radius: 40px; object-fit: contain; max-width: 500px; max-height: 300px; display: block; margin: auto;' src='/web_rental/config/img_layanan/".$data['gambar_layanan']."' alt='".$data['nm_layanan']."' class='col-md-3'>";?>

                                <?php 

                                $teks = $data['ket_layanan'];
                                $jumlah_kalimat_maksimum = 2;

                                $kalimat = preg_split('/(?<=[.!?])\s+/', $teks);

                                $kalimat_terbatas = array_slice($kalimat, 0, $jumlah_kalimat_maksimum);

                                $teks_terbatas = implode(' ', $kalimat_terbatas);

                                ?>


                                <div class="col-md-9">
                                    <h3><?php echo $data['nm_layanan']; ?></h3>
                                    <p><?php echo $teks_terbatas; ?>...</p>
                                    <a class="btn btn-primary btn-xl" href="layanan?kode_layanan=<?php echo $data['kode_layanan']?>">Selengkapnya</a>
                                    <a class="btn btn-warning btn-xl" href="user/pesan-mobil?plat_mobil=0&kode_layanan=<?php echo $data['kode_layanan']; ?>">Pesan Sekarang</a>
                                </div>

                            </div>
                        </div>

                        <?php } ?>

                    </div>
                </div>

            </div>
        </section>

        <!-- Kelebihan -->
        <section style="margin: 100px 100px;">
            <div class="container px-4 px-lg-5">
                <h1 class="text-center mt-0">Kelebihan Sewa Mobil di Website ini</h1>
                <hr class="divider" />
            </div>
                
            <p>Sewa mobil melalui website kami memberikan pengalaman yang luar biasa dan efisien bagi pelanggan kami. Dengan pilihan kendaraan yang luas, mulai dari mobil keluarga hingga yang mewah, kami memastikan bahwa setiap pelanggan dapat menemukan kendaraan yang sesuai dengan kebutuhan mereka. Harga yang kompetitif dan transparan tersedia untuk dibandingkan, memastikan pelanggan mendapatkan nilai terbaik untuk anggaran mereka. Proses pemesanan online yang mudah dan cepat memungkinkan pelanggan untuk merencanakan perjalanan mereka dengan nyaman dari kenyamanan rumah. Kami juga menyediakan penawaran spesial dan diskon eksklusif melalui website kami, memberikan nilai tambah yang signifikan. Pelayanan pelanggan kami yang responsif siap membantu pelanggan kapan pun dibutuhkan, sementara jaminan ketersediaan kendaraan secara real-time memberikan kepastian dalam perencanaan perjalanan. Dengan sistem pembayaran online yang aman, fitur pemilihan ekstra yang mudah diakses, dan ulasan pelanggan yang memberikan pandangan langsung, kami berkomitmen untuk menyediakan pengalaman sewa mobil yang tanpa kesulitan, andal, dan memuaskan.</p>
        
        </section>

        <?php include'components/footer.html';?>

    </body>
</html>
