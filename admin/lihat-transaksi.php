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
    
    $kd_transaksi = $_GET['kd_transaksi'];
    $url = '../config/print-transaksi?kd_transaksi='. $kd_transaksi;
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
          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <table style="width: 100%;">

                <tr>
                  <th style="width: 90%;"><h1>Data Transaksi</h1></th>
                  <th style="width: 10%;"><a onclick="bukaTabBaru('<?php echo $url; ?>')" style="color: white;" class="btn btn-info">Print</a></th>
                </tr>

              </table><hr>

              <div style="padding-bottom: 70px;" class="cont-form">

                <?php
                $transaksi = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN layanan on transaksi.kd_layanan = layanan.kode_layanan INNER JOIN mobil on transaksi.plat_mobil = mobil.plat_mobil INNER JOIN akun on transaksi.id_akun = akun.id_akun WHERE kd_transaksi = '$kd_transaksi'");

                while($data = mysqli_fetch_array($transaksi)){ ?>

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
                      <td><?php echo $data['tgl_pinjam']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Tanggal Kembali</td>
                      <td>:</td>
                      <td><?php echo $data['tgl_kembali']; ?></td>
                    </tr>

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
                      <td id="amount"><?php echo $data['ttl_harga']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Metode Bayar</td>
                      <td>:</td>
                      <td><?php echo $data['mtd_bayar']; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Status Transaksi</td>
                      <td>:</td>
                      <td>

                        <?php if($data['sts_transaksi'] == 0){ ?>

                            <label class="info-warning">Menunggu Konfirmasi</label>

                          <?php }elseif($data['sts_transaksi'] == 1){ ?>

                            <label class="info-success">Terkonfirmasi</label>

                          <?php }elseif($data['sts_transaksi'] == 2){ ?>

                            <label class="info-danger">Kadaluwarsa</label>

                          <?php } ?>
                        
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

                  <?php if($data['sts_transaksi'] == 0){ ?>

                    <form method="post" action="/web_rental/config/aksi-konfirmasi-pembayaran.php">

                      <input type="hidden" value="<?php echo $data['kd_transaksi'] ?>" name="kd_transaksi">
                      <input type="hidden" value="<?php echo $data['plat_mobil'] ?>" name="plat_mobil">
                      <input type="hidden" value="<?php echo $data['id_akun'] ?>" name="id_akun">
                      <input type="hidden" value="<?php echo $data['kd_layanan'] ?>" name="kd_layanan">

                      <button style="float: right; margin-left: 10px;" class="btn btn-success text-uppercase" id="submitButton" type="submit">Konfirmasi Pembayaran</button>

                      <a style="float: right;" class="btn btn-primary btn-md text-uppercase" href="transaksi-index">Kembali</a>

                    </form>

                  <?php }else{ ?>

                    <a style="float: right;" class="btn btn-primary btn-md text-uppercase" href="transaksi-index">Kembali</a>

                  <?php } 

                   }?>

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
