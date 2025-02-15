<!DOCTYPE html>
<html lang="en">
    
    <?php include'components/header.html';?>

    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>

    <style>

    	body {
		    width: 100%;
		    min-height: 100vh;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		}

    </style>

    <body class="login">

        <div style="padding: 20px 30px;" class="container con-tengah">

        	<?php 
			if(isset($_GET['pesan'])){
				if($_GET['pesan']=="gagal"){

					echo "<div class='alert alert-primary'>Username dan Password tidak sesuai !</div>";

				}elseif($_GET['pesan']=="logout"){

                    echo "<div class='alert alert-secondary'>Anda telah Logout</div>";

                }elseif($_GET['pesan']=="tambahAkun"){

                    echo "<div class='alert alert-secondary'>Berhasil Menambahkan Akun</div>";

                }
			}
			?>
			
        	<h2 class="text-center"><b>LOGIN</b></h2>
        	<hr>
        	<div style="padding : 20px; border-radius: 20px;" class="bg-light">
        		<form method="post" action="config/cek-login.php">
        			<h6>Username</h6>
                    <input class="form-control" type="text" name="username" required>
                    <br>
                    <h6>Password</h6>
                    <input class="form-control" type="password" name="password" required>
                    <br>
                    <center><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Login</button></center>
                </form>
        	</div>
            <center><p style="margin-top: 20px;">Belum memiliki Akun? <a href="/web_rental/user/tambah-user">Buat Sekarang</a></p></center>
            <a style="text-decoration: none; color: gray;" href="index">< Kembali ke Home</a>
        </div>

        <script>
        const pageAccessedByReload = (
          (window.performance.navigation && window.performance.navigation.type === 1) ||
            window.performance
              .getEntriesByType('navigation')
              .map((nav) => nav.type)
              .includes('reload')
        );

        if(pageAccessedByReload == false){

        }else{
        window.location.href = '/web_rental/login';
        }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    </body>
</html>
