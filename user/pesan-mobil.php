<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include'../components/header.html';
    include '../config/koneksi.php';

    if ($_GET['kode_layanan'] == 0 && $_GET['plat_mobil'] == 0) {
    
      $opt_mobil = "- Pilih Mobil -";
      $value_mobil = null;

      $opt_layanan = "- Pilih Layanan -";
      $value_layanan = null;

    }elseif ($_GET['kode_layanan'] == 0) {

      $plat_mobil = $_GET['plat_mobil'];

      $mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE plat_mobil='$plat_mobil'");
      while($data = mysqli_fetch_array($mobil)){
    
        $opt_mobil = $data['merek']." ".$data['model']."-". $data['warna'];
        $value_mobil = $data['plat_mobil'];

      }

      $opt_layanan = "- Pilih Layanan -";
      $value_layanan = null;

    }elseif ($_GET['plat_mobil'] == 0) {
    
      $kode_layanan = $_GET['kode_layanan'];

      $layanan = mysqli_query($conn, "SELECT * FROM layanan WHERE kode_layanan='$kode_layanan'");
      while($data = mysqli_fetch_array($layanan)){
    
        $opt_layanan = $data['nm_layanan'];
        $value_layanan = $data['jml_hari'];

      }

      $opt_mobil = "- Pilih Mobil -";
      $value_mobil = null;

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
      <header class="masthead">
          <div class="container px-4 px-lg-5 h-100">

              <div class="cont-form">
                <form method="post" action="../config/prosesTransaksi.php">

                    <div class="row">
                      <div class="col-md-10">
                        <h5>Mobil </h5>
                      </div>
                      <div class="col-md-2">
                         <input type="hidden" name="hrg_supir" value="0">
                          <h6>Dengan Supir?&ensp;<input type="checkbox" name="hrg_supir" value="1"></h6>
                      </div>
                    </div>

                    <select class="form-control" name="plat_mobil" required>
                      <option value="<?php echo $value_mobil ?>"><?php echo $opt_mobil ?></option>
                      <optgroup label="--------------------------">

                        <?php 

                        $mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE status='0'");
                        while($data_mobil = mysqli_fetch_array($mobil)){ 

                        ?>

                          <option value="<?php echo $data_mobil['plat_mobil']; ?>">

                            <?php echo $data_mobil['merek']." ".$data_mobil['model'];?> - <?php echo $data_mobil['warna']; ?>
                              
                          </option>

                        <?php } ?>

                      </optgroup>
                    </select>
                    <br>

                    <input type="hidden" name="kd_layanan" value="<?php echo $kode_layanan ?>">

                    <h5>Layanan</h5>
                    <select id="pilihan" class="form-control" name="jml_hari_layanan" required>
                      <option value="<?php echo $value_layanan ?>"><?php echo $opt_layanan ?></option>
                      <optgroup label="--------------------------">
                        <?php

                        $layanan = mysqli_query($conn, "SELECT * FROM layanan");
                        while($data_layanan = mysqli_fetch_array($layanan)){ 

                        ?>

                          <option value="<?php echo $data_layanan['jml_hari']; ?>"><?php echo $data_layanan['nm_layanan']; ?></option>

                        <?php } ?>
                      </optgroup>
                          
                    </select>
                    <br>

                    <div style="display: none;" id="hari">
                      <h5>Jumlah Hari Sewa</h5>
                      <input class="form-control" type="number" name="jml_hari" id="jml_hari"><br>
                    </div>

                    <div style="display: none;" id="minggu">
                      <h5>Jumlah Minggu Sewa</h5>
                      <input class="form-control" type="number" name="jml_minggu" id="jml_minggu"><br>
                    </div>

                    <div style="display: none;" id="bulan">
                      <h5>Jumlah Bulan Sewa</h5>
                      <input class="form-control" type="number" name="jml_bulan" id="jml_bulan"><br>
                    </div>

                    <div style="display: none;" id="tahun">
                      <h5>Jumlah Tahun Sewa</h5>
                      <input class="form-control" type="number" name="jml_tahun" id="jml_tahun"><br>
                    </div>

                    <h5>Tanggal Sewa</h5>
                    <input class="form-control" type="date" name="tgl_pinjam" min="<?php echo date('Y-m-d'); ?>" placeholder="dd-mm-yyyy" required><br>

                    <div style="display: none;" id="jam">
                      <input class="form-control" type="hidden" name="jml_jam" id="jml_jam">
                      <h5>Jam Sewa</h5>
                      <input class="form-control" type="time" id="jam_pinjam" name="jam_pinjam"><br>
                    </div>

                    <button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Hitung Harga</button>
                  </form>
                  
              </div>

          </div>
      </header>
    </div>

  </body>

<script>
let nilaiTerpilih = 0;

const jml_jam = document.getElementById("jml_jam");
const jml_hari = document.getElementById("jml_hari");
const jml_minggu = document.getElementById("jml_minggu");
const jml_bulan = document.getElementById("jml_bulan");
const jml_tahun = document.getElementById("jml_tahun");

const jam = document.getElementById("jam");
const hari = document.getElementById("hari");
const minggu = document.getElementById("minggu");
const bulan = document.getElementById("bulan");
const tahun = document.getElementById("tahun");
const selectbox = document.getElementById("pilihan");
const nilaiDipilihSpan = document.getElementById("nilaiDipilih");

function periksaNilaiSelectbox(){

  nilaiTerpilih = selectbox.value;

  if (nilaiTerpilih <= 0){

    jam.style.display = "none";
    jml_jam.value = null;
    jam_pinjam.value = null;

    hari.style.display = "none";
    jml_hari.value = null;

    minggu.style.display = "none";
    jml_minggu.value = null;

    bulan.style.display = "none";
    jml_bulan.value = null;

    tahun.style.display = "none";
    jml_tahun.value = null;

  }else if (nilaiTerpilih < 1 && nilaiTerpilih > 0) {

    jam.style.display = "block";
    jml_jam.value = Math.round(nilaiTerpilih*24);

    hari.style.display = "none";
    jml_hari.value = null;

    minggu.style.display = "none";
    jml_minggu.value = null;

    bulan.style.display = "none";
    jml_bulan.value = null;

    tahun.style.display = "none";
    jml_tahun.value = null;

  }else if (nilaiTerpilih >= 1 && nilaiTerpilih < 7) {

    jam.style.display = "none";
    jml_jam.value = null;
    jam_pinjam.value = null;

    hari.style.display = "block";

    minggu.style.display = "none";
    jml_minggu.value = null;

    bulan.style.display = "none";
    jml_bulan.value = null;

    tahun.style.display = "none";
    jml_tahun.value = null;

  }else if (nilaiTerpilih >= 7 && nilaiTerpilih < 30) {

    jam.style.display = "none";
    jml_jam.value = null;
    jam_pinjam.value = null;

    hari.style.display = "none";
    jml_hari.value = null;

    minggu.style.display = "block";

    bulan.style.display = "none";
    jml_bulan.value = null;

    tahun.style.display = "none";
    jml_tahun.value = null;

  }else if (nilaiTerpilih >= 30 && nilaiTerpilih < 365) {

    jam.style.display = "none";
    jml_jam.value = null;
    jam_pinjam.value = null;

    hari.style.display = "none";
    jml_hari.value = null;

    minggu.style.display = "none";
    jml_minggu.value = null;

    bulan.style.display = "block";

    tahun.style.display = "none";
    jml_tahun.value = null;

  }else if (nilaiTerpilih >= 365) {

    jam.style.display = "none";
    jml_jam.value = null;
    jam_pinjam.value = null;

    hari.style.display = "none";
    jml_hari.value = null;

    minggu.style.display = "none";
    jml_minggu.value = null;

    bulan.style.display = "none";
    jml_bulan.value = null;

    tahun.style.display = "block";

  }

}

periksaNilaiSelectbox();

selectbox.addEventListener("change", function() {

    periksaNilaiSelectbox();

});
</script>

</html>
