<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include'../components/header.html';
    include '../config/koneksi.php';
    ?>

    <body class="bg-primary">

    <div style="padding: 50px 100px;" class="container">
        <div style="background-color: white;" class="card-mobil">
      <div class="row text-left">
        <div style="margin-bottom: 50px;" class="col-lg-12 col-lg-offset-2">

          <center><h1>Buat Akun</h1></center><hr>

            <form style="padding: 0px 20px;" method="post" action="/web_rental/config/aksi-tambah-akun.php">

                <input type="hidden" value="user" name="level">

                <h5>Nama Lengkap</h5>
                <input class="form-control" type="text" name="nama" required>
                <br>

                <h5>Alamat</h5>
                <textarea rows="4" class="form-control" name="alamat" required></textarea>
                <br>

                <h5>Nomor Telepon</h5>
                <input class="form-control" type="number" name="no_telp" required>
                <br>

                <h5>Email</h5>
                <input class="form-control" type="email" name="email" required>
                <br>

                <h5>Username</h5>
                <input class="form-control" type="text" name="username" required>
                <br>

                <h5>Password</h5>
                <input class="form-control" id="password" type="password" name="password" required>
                <div style="margin-left: 23px; margin-top: 10px;">
                    <input class="form-check-input" type="checkbox" onclick="showPassword()"><label>Tampilkan Password</label>
                </div><br>

                <button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Konfirmasi</button>

              </form>

        </div>
      </div>
    </div>
</div>

    <?php include'../components/footer-admin.html';?>

  </body>
</html>
