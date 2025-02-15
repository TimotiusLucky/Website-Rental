<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include'../components/header.html';
    include 'koneksi.php';

    $plat_mobil = $_POST['plat_mobil'];
    $jml_hari_layanan = $_POST['jml_hari_layanan'];
    $status_supir = (int)$_POST['hrg_supir'];
    $inp_jam = (int)$_POST['jml_jam'];
    $jml_jam = (float)number_format($inp_jam/24, 2);
    $jml_hari = (int)$_POST['jml_hari'];
    $jml_minggu = (int)$_POST['jml_minggu']*7;
    $jml_bulan = (int)$_POST['jml_bulan']*30;
    $jml_tahun = (int)$_POST['jml_tahun']*365;
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_pinjam = date("d-m-Y");

    $layanan = mysqli_query($conn, "SELECT * FROM layanan WHERE jml_hari='$jml_hari_layanan'");
    while($data = mysqli_fetch_array($layanan)){

      $kd_layanan = $data['kode_layanan'];

    }

    $mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE plat_mobil='$plat_mobil'");
    while($data = mysqli_fetch_array($mobil)){

      $merek_mobil = $data['merek'];
      $tipe_mobil = $data['tipe'];
      $hrg_mobil = $data['hrg_hari'];

      if($status_supir == 1){

        $hrg_supir = $data['hrg_supir'];

      }else{

        $hrg_supir = 0;

      }

    }

    $layanan = mysqli_query($conn, "SELECT * FROM layanan WHERE jml_hari='$jml_hari_layanan'");
    while($data = mysqli_fetch_array($layanan)){

      $nm_layanan = $data['nm_layanan'];
      $hrg_tambahan = (float)$data['hrg_tambahan']/100;

    }

    $jml_sewa = $jml_jam + $jml_hari + $jml_minggu + $jml_bulan + $jml_tahun;

    if($jml_sewa<1){

      $jam_pinjam = $_POST['jam_pinjam'];
      $tanggal_waktu_awal = $tgl_pinjam . " " . $jam_pinjam;
      $tgl_kembali = date("d-m-Y H:i", strtotime($tanggal_waktu_awal . " + " . $inp_jam . " hours"));
      $tgl_kembali_tampil = date("d-m-Y | H:i", strtotime($tanggal_waktu_awal . " + " . $inp_jam . " hours"));
      $jam_pinjam_tampil = "| ".$jam_pinjam;


    }else{

      $tgl_kembali = date("d-m-Y", strtotime($tgl_pinjam . " + " . $jml_sewa . " days"));
      $tgl_kembali_tampil = $tgl_kembali;

    }

    $total_harga = (($hrg_mobil + $hrg_supir)+(($hrg_mobil + $hrg_supir) * $hrg_tambahan)) * $jml_sewa;

    if ($jml_sewa < 1) {
      
      $jml_sewa = ceil($jml_sewa*24);
      $sts_sewa = "Jam";

    }else{

      $sts_sewa = "Hari";

    }

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
      <header style="padding-top: 1.5rem;" class="masthead">
          <div class="container px-4 px-lg-5 h-100">

              <div class="cont-form">
                <form method="post" action="bayarTransaksi">

                  <input type="hidden" name="plat_mobil" value="<?php echo $plat_mobil ?>">
                  <input type="hidden" name="kd_layanan" value="<?php echo $kd_layanan ?>">
                  <input type="hidden" name="sts_supir" value="<?php echo $status_supir ?>">
                  <input type="hidden" name="tgl_pinjam" value="<?php echo $tgl_pinjam." ".$jam_pinjam ?>">
                  <input type="hidden" name="tgl_kembali" value="<?php echo $tgl_kembali ?>">
                  <input type="hidden" name="ttl_harga" value="<?php echo $total_harga ?>">
                  <input type="hidden" name="jml_sewa" value="<?php echo $jml_sewa ?>">

                  <h2>Rincian Sewa</h2><hr>

                  <table class="info-card" style="width: 100%;">

                    <tr>
                      <th style="width: 25%;"></th>
                      <th style="width: 2%;"></th>
                      <th style="width: 73%;"></th>
                    </tr>

                    <tr>
                      <td class="bold">Mobil</td>
                      <td>:</td>
                      <td><?php echo $merek_mobil." ".$tipe_mobil ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Layanan</td>
                      <td>:</td>
                      <td><?php echo $nm_layanan ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Pinjam</td>
                      <td>:</td>
                      <td><?php echo $tgl_pinjam." ".$jam_pinjam_tampil ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Kembali</td>
                      <td>:</td>
                      <td><?php echo $tgl_kembali_tampil ?></td>
                    </tr>

                    <tr>
                      <td class="bold">Total Pinjam</td>
                      <td>:</td>
                      <td><?php echo $jml_sewa." ".$sts_sewa ?></td>
                    </tr>

                  </table><br>

                  <h4>Total Harga : <label id="amount"><?php echo $total_harga ?></label></h4>

                  <hr>

                  <p><b>Metode Pembayaran</b></p>

                  <div style="margin-left: 20px;">

                    <input type="radio" name="mtd_bayar" value="Qris" required>
                    <label>Qris</label><br>

                    <input type="radio" name="mtd_bayar" value="Transfer">
                    <label>Transfer antar Bank</label>

                  </div><br>

                  <button class="btn btn-warning btn-xl text-uppercase col-md-12" id="submitButton" type="submit">Booking Sekarang</button>

                  </form>
              </div><br>

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
