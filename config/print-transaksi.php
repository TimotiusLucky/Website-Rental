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
    
    $kd_transaksi = $_GET['kd_transaksi'];
    ?>

    <div id="wrapper">

      <div class="overlay"></div>

      <div id="page-content-wrapper">

        <div class="container">
          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <h1>Aragon Rental</h1><hr>

              <div style="padding-bottom: 70px;" class="cont-form">
                <h3>Data Transaksi</h3><hr>

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

                  </table><br>

                  <div class="cont-form" style=" background-color: #FFFFDD;">

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

                  <div class="cont-form" style=" background-color: #FFFFDD;">

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
        window.onload = function() {
            // Fungsi ini akan dijalankan setelah jendela selesai dimuat.

            // Mencetak halaman HTML saat jendela selesai dimuat.
            window.print();
        };
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
