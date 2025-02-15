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
          <div class="row text-left">
            <div style="margin-bottom: 50px;" class="content col-lg-12 col-lg-offset-2">

              <div style="padding-bottom: 70px;" class="cont-form">

                <?php 
                $kd_pesanan = $_GET['kd_pesanan'];
                $kd_transaksi = $_GET['kd_transaksi'];
                $tgl_serah = date("Y-m-d");
                $pesanan = mysqli_query($conn, "SELECT * FROM pesanan INNER JOIN transaksi on pesanan.kd_transaksi = transaksi.kd_transaksi WHERE kd_pesanan = '$kd_pesanan'");

                while($data = mysqli_fetch_array($pesanan)){


                  $tgl_kembali = $data['tgl_kembali']; 

                  $tgl_awal = new DateTime($tgl_serah);
                  $tgl_akhir = new DateTime($tgl_kembali);

                  $selisih = $tgl_akhir->diff($tgl_awal);

                  $jumlah_hari = $selisih->days;

                  $denda = $jumlah_hari*200000;

                  $harga = $data['ttl_harga'];

                  $ttl_harga = $denda + $harga;


                ?>

                  <table class="info-card" style="width: 100%;">

                    <tr>
                      <th style="width: 25%;"></th>
                      <th style="width: 2%;"></th>
                      <th style="width: 73%;"></th>
                    </tr>

                    <tr>
                      <td class="bold">Kode Pesanan</td>
                      <td>:</td>
                      <td><?php echo $data['kd_pesanan']; ?></td>
                    </tr>

                    <tr></tr>

                    <tr>
                      <td class="bold">Harga</td>
                      <td>:</td>
                      <td id="amount"><?php echo $data['ttl_harga']; ?></td>
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
                      <td class="bold">Tanggal Serah Mobil</td>
                      <td>:</td>
                      <td><?php echo $tgl_serah; ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Denda</td>
                      <td>:</td>
                      <td id="amount2"><?php echo $denda; ?></td>
                    </tr>

                  </table><hr>

                  <h3>Total Harga : <label style="color: red;" id="amount3"><?php echo $ttl_harga; ?></label></h3>

                  <a style="float: right; margin-left: 10px;" class="btn btn-success btn-md text-uppercase" href="../config/aksi-pengembalian-mobil?kd_pesanan=<?php echo $data['kd_pesanan']?>&denda=<?php echo $denda?>&plat_mobil=<?php echo $data['plat_mobil']?>">Pengembalian Mobil</a>

                  <a style="float: right;" class="btn btn-primary btn-md text-uppercase" href="../admin/lihat-pesanan?kd_pesanan=<?php echo $data['kd_pesanan']?>">Kembali</a>

                <?php }?>

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

    var amountElement2 = document.getElementById('amount2');
    var amount2 = parseInt(amountElement2.textContent);

    var formattedAmount2 = formatRupiah(amount2);

    amountElement2.textContent = formattedAmount2;

    var amountElement3 = document.getElementById('amount3');
    var amount3 = parseInt(amountElement3.textContent);

    var formattedAmount3 = formatRupiah(amount3);

    amountElement3.textContent = formattedAmount3;
    </script>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
