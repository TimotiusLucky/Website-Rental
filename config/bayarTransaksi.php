<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include'../components/header.html';
    include 'koneksi.php';

    $plat_mobil = $_POST['plat_mobil'];
    $kd_layanan = $_POST['kd_layanan'];
    $status_supir = (int)$_POST['sts_supir'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $ttl_harga = $_POST['ttl_harga'];
    $jml_sewa = $_POST['jml_sewa'];
    $mtd_bayar = $_POST['mtd_bayar'];


    ?>

    <body>

    <?php
    session_start();

    if ($_SESSION['level'] == "admin") {

        header("Location: ../index?pesan=pesanAdmin");

    }elseif($_SESSION['level'] != "user"){
      
      header("Location: ../login");

    }

    error_reporting(E_ALL && ~E_NOTICE);

    ?>

    <div id="wrapper">

      <!-- Masthead-->
      <header style="object-fit: cover; width: 100%; height: 100%; padding-bottom: 4.5rem;" class="masthead">
          <div class="container px-4 px-lg-5 h-100">

              <div class="cont-form">

                <form method="post" action="aksi-bayar-transaksi" enctype="multipart/form-data">

                  <input type="hidden" name="id_akun" value="<?php echo $_SESSION['id_user']; ?>">
                  <input type="hidden" name="plat_mobil" value="<?php echo $plat_mobil ?>">
                  <input type="hidden" name="kd_layanan" value="<?php echo $kd_layanan ?>">
                  <input type="hidden" name="status_supir" value="<?php echo $status_supir ?>">
                  <input type="hidden" name="tgl_pinjam" value="<?php echo $tgl_pinjam ?>">
                  <input type="hidden" name="tgl_kembali" value="<?php echo $tgl_kembali ?>">
                  <input type="hidden" name="ttl_harga" value="<?php echo $ttl_harga ?>">
                  <input type="hidden" name="jml_sewa" value="<?php echo $jml_sewa ?>">
                  <input type="hidden" name="mtd_bayar" value="<?php echo $mtd_bayar ?>">

                  <?php if($mtd_bayar == "Transfer"){ ?>

                    <h2>Pembayaran (via Transfer Bank)</h2><hr>

                    <div class="card-pembayaran">

                      <h5>Informasi Bank Tujuan</h5>

                      <table style="width: 100%;">

                        <tr>
                          <th style="width: 3%;"></th>
                          <th style="width: 2%;"></th>
                          <th style="width: 10%;"></th>
                          <th style="width: 2%;"></th>
                          <th style="width: 83%;"></th>
                        </tr>

                        <tr>
                          <td></td>
                          <td>-</td>
                          <td>BNI</td>
                          <td>:</td>
                          <td>(Nomor Rekening Bank)</td>
                        </tr>

                        <tr>
                          <td></td>
                          <td>-</td>
                          <td>BCA</td>
                          <td>:</td>
                          <td>(Nomor Rekening Bank)</td>
                        </tr>

                        <tr>
                          <td></td>
                          <td>-</td>
                          <td>Mandiri</td>
                          <td>:</td>
                          <td>(Nomor Rekening Bank)</td>
                        </tr>

                        <tr>
                          <td></td>
                          <td>-</td>
                          <td>BRI</td>
                          <td>:</td>
                          <td>(Nomor Rekening Bank)</td>
                        </tr>

                        <tr>
                          <td></td>
                          <td>-</td>
                          <td>DKI</td>
                          <td>:</td>
                          <td>(Nomor Rekening Bank)</td>
                        </tr>

                        <tr>
                          <td></td>
                          <td>-</td>
                          <td>BTN</td>
                          <td>:</td>
                          <td>(Nomor Rekening Bank)</td>
                        </tr>

                      </table><br>

                      <p><b>A.N</b> (Atas Nama Penerima)</p><hr>

                      <h5>Total Harga : <label id="amount"><?php echo $ttl_harga ?></label></h5>

                    </div><br>

                  <?php }elseif($mtd_bayar == "Qris"){ ?>

                    <h2>Pembayaran (via Qris)</h2><hr>

                      <center>
                        <img style="margin-bottom: 20px;" src="img_pembayaran/qris.png">
                        <h3>Total Harga : <label id="amount"><?php echo $ttl_harga ?></label></h3>
                      </center><hr>

                  <?php }?>

                  <p><b>Upload Bukti Pembayaran</b></p>
                  <input class="form-control" type="file" name="uploadfile" required><br><br>

                  <button class="btn btn-success btn-xl text-uppercase col-md-12" id="submitButton" type="submit">Bayar Sekarang</button>

                </form>

              </div>

          </div>
      </header>
    </div>

  </body>

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

</html>
