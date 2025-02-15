<!DOCTYPE html>
<nav style="background-color: #fff; box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);" class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-shrink" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a style="color: black;" class="navbar-brand" href="../index">Aragon Rental</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a style="color: black;" class="nav-link" href="../index">Beranda</a></li>
                <li class="nav-item"><a style="color: black;" class="nav-link" href="../layanan">Layanan</a></li>
                <li class="nav-item"><a style="color: black;" class="nav-link" href="../tentang">Tentang</a></li>

                
                <li class='nav-item min-width'><a style="color: black;" class='nav-link'><?php echo $_SESSION['username'] ?></a>

                  <?php $id_user        = $_GET['id_user']; ?>

                        <ul>
                            <li><a style="color: black;" style='text-decoration: none;' href='../user/daftar-pesanan?id_user=<?php echo $id_user; ?>'>Daftar Pesanan</a></li>
                            <li><a style="color: black;" style='text-decoration: none;' href="../logout">Logout</a></li>
                        </ul>

                    </li>

                    <li class='nav-item max-width'><a style="color: black;" style='padding: 0px 1px;' class='nav-link'>|</a></li>

                    <li class='nav-item max-width'>

                        <div class='dropdown-navbar'>
                          <a style="color: black;" class='nav-link'><?php echo $_SESSION['username'] ?>&ensp;<i style="border-block-color: black;" class='triangle_down'></i></a>
                          <div class='dropdown-navbar-content'>
                          <a style='text-decoration: none; color: black;' href='../user/daftar-pesanan?id_user=<?php echo $id_user; ?>'>Daftar Pesanan</a><hr>
                          <a style="text-decoration: none; color: black;" href="../logout">Logout</a>
                          </div>
                        </div>
                        
                    </li>

            </ul>

        </div>
    </div>
</nav>