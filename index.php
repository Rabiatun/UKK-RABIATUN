<?php
include "koneksi.php";
session_start();
$userid = $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Gallery Photo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /> -->
</head>

<body>
    <!-- Navigation Bar -->
<nav  class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
        <a class="navbar-brand" href="index.php"><em><b>Website Gallery Photo</b></em></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <?php
                    if (!isset($_SESSION['userid'])) {
                    ?>
                        <a href="register.php" class="btn btn-outline-success m-1">Register</a>
                        <a href="login.php" class="btn btn-outline-primary m-1">Login</a>
                    <?php
                    } else {
                    ?>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-warning" aria-current="page" href="home.php"><b><em>Home</em></b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="album.php"><b><em>Album</em></b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="foto.php"><b><em>Photo</em></b></a>
                        </li>
                        <li>
                        <a class="nav-link text-danger" href="logout.php"><b><em>Log out 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
  <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
</svg>
                        </em></b></a>
                        </li>
                    </ul>              
                        
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </nav>

    <!-- Navigation Bar End -->

    <!--  Content Start -->

    <div class="container mt-3">
        <div class="row">
            <?php
            $sql = mysqli_query($conn, "SELECT * from foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
            <div class="col-md-3 mt-3">
                <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                    <div class="card">
                        <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top"
                            title="<?php echo $data['judulfoto'] ?>" style="height: 20rem;" alt="">
                        <div class="card-footer text-center">
                            <?php
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid' and userid='$userid'");
                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="batalsuka"><i
                                    class="fa fa-heart"></i></a>
                            <?php } else { ?>
                            <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="suka"><i
                                    class="fa-regular fa-heart"></i></a>
                            <?php }
                                $like = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Like';
                                ?>
                            <a href="#" type="button" data-bs-toggle="modal"
                                data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i
                                    class="fa-regular fa-comment"></i></a>
                            <?php
                                $jmlkomentar = mysqli_query($conn, "select * from komentarfoto where fotoid='$fotoid'");
                                ?>
                        </div>
                    </div>
                </a>

                <!-- modal komentar -->
                <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top"
                                            title="<?php echo $data['judulfoto'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-2">
                                            <div class="overflow-auto">
                                                <div class="sticky-top">
                                                    <strong>
                                                        <?php echo $data['judulfoto'] ?>
                                                    </strong><br>
                                                    <p>Image Uploader : <span class="badge bg-secondary">
                                                            <?php echo $data['namalengkap'] ?>
                                                        </span></p>
                                                    <p>Upload Date : <span class="badge bg-secondary">
                                                            <?php echo $data['tanggalunggah'] ?>
                                                        </span></p>
                                                    <p>Album Name : <span class="badge bg-primary">
                                                            <?php echo $data['namaalbum'] ?>
                                                        </span>
                                                </div>
                                                <hr>
                                                <p align="left">
                                                    <strong>Image Description</strong><br>
                                                    <?php echo $data['deskripsifoto'] ?>
                                                </p>
                                                <hr>
                                                <?php
                                                    $fotoid = $data['fotoid'];
                                                    $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                                    while ($row = mysqli_fetch_array($komentar)) {
                                                    ?>
                                                <p align="left">
                                                    <strong>
                                                        <?= $row['namalengkap'] ?>
                                                    </strong>
                                                    <?= $row['isikomentar'] ?>
                                                </p>
                                                <?php } ?>
                                                <hr>
                                                <div class="sticky-bottom">
                                                    <form action="tambah_komentar.php" method="post">
                                                        <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>"
                                                            hidden>
                                                        <input type="text" name="isikomentar" class="form-control"
                                                            placeholder="add comment">
                                                        <div class="input-group">
                                                            <button type="submit" class="btn btn-primary">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Content End -->

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p><strong>&copy; WEBSITE GALLERY PHOTO | RABIATUN</strong></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>