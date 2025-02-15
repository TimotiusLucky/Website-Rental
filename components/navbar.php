<!DOCTYPE html>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top">Aragon Rental</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="index">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="tentang">Tentang</a></li>

                <?php
                session_start();
                if (!isset($_SESSION['username'])) {

                    echo"<li class='nav-item'><a style='display: inline;' class='btn btn-primary' href='login'>Login</a></li>";

                }else{

                    if ($_SESSION['level'] == "admin"){

                        echo "<li class='nav-item'><a style='display: inline; color: white;' class='btn btn-info' href='admin/adm-index'>Admin</a>";
                        echo"<li style='margin-left: 10px;' class='nav-item'><a style='display: inline;' href='logout' class='btn btn-danger'>Logout</a></li>";

                    }elseif ($_SESSION['level'] == "user"){ ?>

                        <li class='nav-item min-width'><a class='nav-link'><?php echo $_SESSION['username'] ?></a>

                                <ul>
                                    <li><a style='text-decoration: none;' href='user/pesanan'>Daftar Pesanan</a></li>
                                    <li><a style='text-decoration: none;' href="logout">Logout</a></li>
                                </ul>

                            </li>

                            <li class='nav-item max-width'><a style='padding: 0px 1px;' class='nav-link'>|</a></li>

                            <li class='nav-item max-width'>

                                <div class='dropdown-navbar'>
                                  <a class='nav-link'><?php echo $_SESSION['username'] ?>&ensp;<i class='triangle_down'></i></a>
                                  <div class='dropdown-navbar-content'>
                                  <a style='text-decoration: none;' href='user/daftar-pesanan?id_user=<?php echo $_SESSION['id_user'] ?>'>Daftar Pesanan</a><hr>
                                  <a style="text-decoration: none;" href="logout">Logout</a>
                                  </div>
                                </div>
                                
                            </li>

                    <?php }

                }

                error_reporting(E_ALL && ~E_NOTICE);
                ?>

            </ul>

        </div>
    </div>
</nav>