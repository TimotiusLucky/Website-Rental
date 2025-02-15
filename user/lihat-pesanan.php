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

    $kd_pesanan = $_GET['kd_pesanan'];
    $url = '../config/print-pesanan?kd_pesanan='. $kd_pesanan;
    ?>

    <div id="wrapper">

      <div class="overlay"></div>

      <div id="page-content-wrapper">

        <div class="container">
          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <table style="width: 100%;">

                <tr>
                  <th style="width: 90%;"><h1>Data Pesanan</h1></th>
                </tr>

              </table><hr>

              <div style="padding-bottom: 70px;" class="cont-form">

                <?php 
                $id_user        = $_GET['id_user'];
                $pesanan = mysqli_query($conn, "SELECT * FROM pesanan INNER JOIN transaksi on pesanan.kd_transaksi = transaksi.kd_transaksi INNER JOIN layanan on pesanan.kd_layanan = layanan.kode_layanan INNER JOIN mobil on pesanan.plat_mobil = mobil.plat_mobil INNER JOIN akun on pesanan.id_akun = akun.id_akun WHERE kd_pesanan = '$kd_pesanan'");

                while($data = mysqli_fetch_array($pesanan)){

                  $tgl_pinjam = strtotime($data['tgl_pinjam']);
                  $tgl_kembali = strtotime($data['tgl_kembali']);
                  $tanggalSaatIni = date("Y-m-d");

                  $tgl_pinjam = date("Y-m-d", $tgl_pinjam);
                  $tgl_kembali = date("Y-m-d", $tgl_kembali);

                  $harga = $data['ttl_harga'];
                  $denda = $data['denda'];

                  $ttl_harga = $harga + $denda; ?>

                  <table class="info-card" style="width: 100%;">

                    <tr>
                      <th style="width: 25%;"></th>
                      <th style="width: 2%;"></th>
                      <th style="width: 73%;"></th>
                    </tr>

                    <tr>
                      <td class="bold">Kode Transaksi</td>
                      <td>:</td>
                      <td><?php echo $data['kd_transaksi']; ?></td>
                    </tr>

                    <tr></tr>

                    <tr>
                      <td class="bold">Layanan</td>
                      <td>:</td>
                      <td><?php echo $data['nm_layanan']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Tanggal Pinjam</td>
                      <td>:</td>
                      <td><?php echo $tgl_pinjam; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Tanggal Kembali</td>
                      <td>:</td>
                      <td><?php echo $tgl_kembali; ?></td>
                    </tr>

                    <?php if($data['sts_pesanan'] == 0){ ?>

                      <tr>
                        <td class="bold">Tanggal Serah</td>
                        <td>:</td>
                        <td><?php echo $data['tgl_terima']; ?></td>
                      </tr>

                    <?php } ?>

                    <tr>
                      <td class="bold">Jumlah Sewa</td>
                      <td>:</td>
                      <td><?php echo $data['jml_sewa']; ?> Hari</td>
                    </tr>

                    <tr>
                      <td class="bold">Supir</td>
                      <td>:</td>
                      <td>

                        <?php if($data['sts_supir'] == 0){ ?>

                            <label>Tidak</label>

                          <?php }elseif($data['sts_supir'] == 1){ ?>

                            <label>Ya</label>

                          <?php } ?>
                        
                      </td>
                    </tr>

                    <tr>
                      <td class="bold">Total Harga</td>
                      <td>:</td>
                      <td id="amount"><?php echo $ttl_harga; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Status</td>
                      <td>:</td>
                      <td>

                          <?php

                          if($tgl_pinjam > $tanggalSaatIni){

                            $sts_pesanan = 1;

                          }

                           if($sts_pesanan == 1){ ?>

                            <label class="info-warning">Dibooking</label>

                          <?php }else{

                            if($data['sts_pesanan'] == 0){ ?>

                              <label class="info-success">Selesai</label>

                            <?php }elseif($data['sts_pesanan'] == 1){ ?>

                              <label class="info-warning">Disewa</label>

                          <?php }

                        } ?>
                        
                      </td>
                    </tr>

                    <tr>
                      <td class="bold">Bukti Pembayaran</td>
                      <td>:</td>
                      <td><a class="btn btn-secondary" href="/web_rental/config/img_pembayaran/bukti_pembayaran/<?php echo $data['gambar_bukti']; ?>">Lihat Gambar</a></td>
                    </tr>

                  </table><br>

                  <div class="cont-form" style="margin: 0px 50px; background-color: #FFFFDD;">

                    <h3>Data Mobil</h3><hr>

                    <table class="info-card" style="width: 100%;">

                      <tr>
                        <th style="width: 25%;"></th>
                        <th style="width: 2%;"></th>
                        <th style="width: 73%;"></th>
                      </tr>

                      <tr>
                        <td class="bold">Mobil</td>
                        <td>:</td>
                        <td><?php echo $data['merek']." ".$data['model'];?></td>
                      </tr>

                      <tr></tr>

                      <tr>
                        <td class="bold">Tipe</td>
                        <td>:</td>
                        <td><?php echo $data['tipe']; ?></td>
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

                    </table><br>

                  </div><br>

                  <div class="cont-form" style="margin: 0px 50px; background-color: #FFFFDD;">

                    <h3>Data Peminjam</h3><hr>

                    <table class="info-card" style="width: 100%;">

                      <tr>
                        <th style="width: 25%;"></th>
                        <th style="width: 2%;"></th>
                        <th style="width: 73%;"></th>
                      </tr>

                      <tr>
                        <td class="bold">Nama</td>
                        <td>:</td>
                        <td><?php echo $data['nama'];?></td>
                      </tr>

                      <tr></tr>

                      <tr>
                        <td class="bold">Username</td>
                        <td>:</td>
                        <td><?php echo $data['username']; ?></td>
                      </tr>

                      <tr>
                        <td class="bold">No. Telp</td>
                        <td>:</td>
                        <td><?php echo $data['no_telp']; ?></td>
                      </tr>

                      <tr>
                        <td class="bold">Alamat</td>
                        <td>:</td>
                        <td><?php echo $data['alamat']; ?></td>
                      </tr>

                      <tr>
                        <td class="bold">Email</td>
                        <td>:</td>
                        <td><?php echo $data['email']; ?></td>
                      </tr>

                    </table><br>

                  </div><br>

                  <a style="float: right;" class="btn btn-primary btn-md text-uppercase" href="daftar-pesanan?id_user=<?php echo $id_user;?>">Kembali</a>

                <?php } ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    function formatRupiah(angka) {
        var numberString = angka.toString();
        var sisa = numberString.length % 3;
        var rupiah = numberString.substr(0, sisa);
        var ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp. ' + rupiah;
    }

    var amountElement = document.getElementById('amount');
    var amount = parseInt(amountElement.textContent);

    var formattedAmount = formatRupiah(amount);

    amountElement.textContent = formattedAmount;
    </script>

    <script>
        function bukaTabBaru(url) {
            window.open(url, '_blank');
        }
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
