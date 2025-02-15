<!DOCTYPE html>
<html lang="en">

    <?php include'components/header.html';?>

    <body id="page-top">

        <?php include'components/navbar.php';?>

        <?php include'components/masthead.html';?>

        <?php include'config/koneksi.php';?>

        <?php 
        if(isset($_GET['pesan'])){

            if($_GET['pesan']=="pesanAdmin"){ ?>

                <div style="display: block;" class="popup" id="popupAdmin">
                    <div class="popup-content">

                        <h3>Tidak bisa Menyewa Mobil Sebagai Admin</h3><br>

                        <button style="color: white;" type="button" class="btn btn-info btn-xl" id="closePopupAdmin">Cancel</button>

                    </div>
                </div>

        <?php }

            if($_GET['pesan']=="bayarSukses"){ ?>

                    <div style="display: block;" class="popup" id="popupAdmin">
                        <div class="popup-content">

                            <h3>Pembayaran Sukses</h3><hr>
                            <p>Admin akan memproses pembayaran dalam waktu 1<span>&#10005;</span>24 Jam</p><br>

                            <button style="color: white;" type="button" class="btn btn-info btn-xl" id="closePopupAdmin">Oke</button>

                        </div>
                    </div>

            <?php }
        }

        if(isset($_GET['lihatMobil'])){ 

            $pop_plat_mobil = $_GET['lihatMobil'];

            $data_mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE plat_mobil='$pop_plat_mobil'");

            while($data = mysqli_fetch_array($data_mobil)){ ?>

            <div style="display: block;" class="popupInfo" id="popupInfo">
                    <div class="popup-mobil">

                        <div class="row">

                            <?php echo "<img style='border-radius: 40px; object-fit: contain; max-width: 500px; max-height: 300px; display: block; margin: auto;' src='/web_rental/config/img_mobil/".$data['gambar_mobil']."' alt='".$data['merek']." ".$data['merek']."' class='col-md-5'>";?>

                                <div class="col-md-7">

                                    <table style="width:100%">
                                        <thead>
                                          <tr>
                                              <th style="border: 0px; width:85%;"><h3><?php echo $data['merek']." ".$data['tipe'];?></h3></th>
                                              <th style="border: 0px; width:15%"><center><a class="btn btn-danger text-light" href="index"><b>Kembali</b></a></center></th>
                                          </tr>
                                        </thead>
                                    </table><hr>

                                    <table style="width: 100%;">
                                            
                                        <tr>
                                          <th style="width: 20%;"></th>
                                          <th style="width: 2%;"></th>
                                          <th style="width: 78%;"></th>
                                        </tr>

                                        <tr>
                                          <td class="bold">Plat Mobil</td>
                                          <td>:</td>
                                          <td><?php echo $data['plat_mobil']; ?></td>
                                        </tr>

                                        <tr>
                                          <td class="bold">Model</td>
                                          <td>:</td>
                                          <td><?php echo $data['model']; ?></td>
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

                                    <p>&emsp;<?php echo $data['deskripsi_mobil']; ?></p>

                                </div>

                        </div>

                    </div>
                </div>

        <?php }

    }   ?>

        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container">

                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Sewa Mobil dengan Murah dan Gampang</h2>
                        <hr class="divider divider-light" />
                       
                        <a class="btn btn-light btn-xl" href="layanan">Daftar Harga</a>
                    </div>
                </div>
            </div>
        </section>

        <?php include'components/daftar-mobil.php';?>

        

        <center>
            <a style="margin-bottom: 50px;" class="btn btn-primary btn-xl" href="layanan">Lihat Daftar Harga Lebih Lengkap</a>
        </center>

        <?php include'components/footer.html';?>

    </body>

    <script>
    const closePopupAdminButton = document.getElementById("closePopupAdmin");
    const popupAdmin = document.getElementById("popupAdmin");

    closePopupAdminButton.addEventListener("click", () => {
        setTimeout(() => {
            popupAdmin.style.display = "none";
        }, 300);
    });

    const pageAccessedByReload = (
      (window.performance.navigation && window.performance.navigation.type === 1) ||
        window.performance
          .getEntriesByType('navigation')
          .map((nav) => nav.type)
          .includes('reload')
    );

    if(pageAccessedByReload == false){

    }else{
    window.location.href = '/web_rental/index';
    }

    </script>

</html>
