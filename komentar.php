<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav  class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
        <a class="navbar-brand" href="komentar.php"><em><b>Comment</b></em></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
    <ul class="nav nav-tabs">
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
                        <a class="nav-link text-danger" href="logout.php"><b><em>Log out</em></b></a>
                        </li>
                    </ul> 
      
    </div>
  </div>
</nav>

    <h5 class="text-center"><b>Welcome <u><?=$_SESSION['namalengkap']?></u></b></h5>
    <hr>
    
        
    <form action="tambah_komentar.php" method="post">
        <?php
            include "koneksi.php";
            $fotoid=$_GET['fotoid'];
            $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
            while($data=mysqli_fetch_array($sql)){
        ?>
        <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
        <table>
            <tr>
            <td><em>Title:</em></td>
                <td><input type="text" name="judulfoto" value="<?=$data['judulfoto']?>"></td>
            </tr>
            <tr>
            <td><em>Description:</em></td>
                <td><input type="text" name="deskripsifoto"  value="<?=$data['deskripsifoto']?>" width="100%"></td>
            </tr>
            <tr>
            <td><em>Photo:</em></td>
                <td><img src="gambar/<?=$data['lokasifile']?>" width="200px"></td>
            </tr>
            <tr>
            <td><em>Comment:</em></td>
                <td><textarea name="isikomentar" id="" cols="25" rows="1" ></textarea></td>
            </tr>
            
            <tr>
                <td><input class="btn btn-primary" type="submit" value="Add Comment"></td>
                
            </tr>
        </table>
        <hr>
        <?php
            }
        ?>
    </form>

    <table width="100%" border="1" cellpadding=5 cellspacing=0>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Date</th>
        </tr>
        <?php
            include "koneksi.php";
            $userid=$_SESSION['userid'];
            $sql=mysqli_query($conn,"select * from komentarfoto,user where komentarfoto.userid=user.userid");
            while($data=mysqli_fetch_array($sql)){
        ?>
            <tr>
                <td><?=$data['komentarid']?></td>
                <td><?=$data['namalengkap']?></td>
                <td><?=$data['isikomentar']?></td>
                <td><?=$data['tanggalkomentar']?></td>
            </tr>
        <?php
            }
        ?>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>