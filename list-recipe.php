<?php
require_once "config/db.php";
session_start();
$nama = '';
$email = '';
if (isset($_SESSION['logged_in'])) {
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $img =  $_SESSION['img'];
}

$query = $connection->query("SELECT user.nama, resep.* FROM resep INNER JOIN user ON resep.id_user = user.id_user");
$rows = [];
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $query = $connection->query("SELECT user.nama, resep.* FROM resep INNER JOIN user ON resep.id_user = user.id_user WHERE resep.nama_resep LIKE '%$keyword%' OR resep.region LIKE '%$keyword%'");
}

while ($data = mysqli_fetch_array($query)) {
    $rows[] = $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css?version=3">
    <title>List Recipe</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a href="index.php" class="brand-text-wrapper">
                <span class="brand-text-icon">THE RECIPE</span>
            </a>
            <nav class="navbar-nav navbar-center">
                <a class="nav-link " href="index.php">
                    Home
                </a>
                <a class="nav-link active" href="#">
                    Cari
                </a>
                <a class="nav-link " href="new-recipe.php">
                    Tulis Resep
                </a>

            </nav>
            <nav class="navbar navbar-nav " style="position: absolute; top: 0; right: 0;">
                <?php if (!isset($_SESSION['logged_in'])) : ?>
                    <a class="nav-link" href="login.php">
                        Login
                    </a> <a class="nav-link" href="signup.php">
                        <button class="btn btn-warning ml-auto btn-signup-nav">
                            Sign Up
                        </button>
                    </a>
                <?php else : ?>
                    <a class="nav-link" href="profil.php">
                        <img class="rounded-profile-picture mr-1" src="content/img/<?= $img ?>" />
                        <?= $nama ?> </a>
                    <a href="logout.php"><button class="btn btn-warning btn-logout">Logout</button></a>
                <?php endif; ?>
            </nav>
        </nav>
    </header>

    <section class="container ">
        <section class="search-section">
            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-9 ml-5">
                        <input type="text" id="" class="form-control search-bar" placeholder="Search Recipe" name="keyword">
                    </div>
                    <div class="col-2 mb-3">
                        <button class="btn btn-warning" type="submit" name="search">
                            Search
                    </div>
                </div>
            </form>
        </section>
    </section>
    <section class="container ">
        <div class="row mt-5">
            <?php
            if (count($rows) > 0) {
                foreach ($rows as $recipe) {
                    $date = date("F jS, Y ", strtotime($recipe['tgl_buat']));
            ?>
                    <div class="col-3 ">
                        <a href="detail-recipe.php?id=<?= $recipe['id_recipe'] ?>">
                            <img src="content/img/<?= $recipe['img'] ?>" alt="Recipe Image" width="240px" height="170px">
                            <h5 class="mt-3"><?= $recipe['nama_resep'] ?></h5>
                            <p class="author mb-0">By <?= $recipe['nama'] ?></p>
                            <p class="published">Published <?= $date ?></p>
                            <a href="detail-recipe.php?id=<?= $recipe['id_recipe'] ?>" class=" href-detail">Detail ></a>

                        </a>
                    </div>
                <?php
                }
            } else if (!empty($keyword)) {
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">Pencarian Keyword <?= $keyword ?> tidak ditemukan</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <footer class="container">
        <div class="row " style="margin-top: 150px;">
            <div class="col-3"> <span class="brand-text-icon">THE RECIPE</span>
                <p class="p-footer">We provide recipe to make your cooking and life easier.</p>
            </div>
            <div class="col-4">
                <span class="footer-title">About <p class="p-footer">THE RECIPE akan membantu menghubungkan jutaan
                        pecinta
                        memasak dengan saling berbagi
                        resep dari seluruh penjuru dunia </p></span>
            </div>
            <div class="col-3">
                <span class="footer-title">Contact Info <div style="margin-top: 12px;"><img class="footer-icon" src=" assets/icon/ic_round-where-to-vote.png" alt="location">
                        <span class="p-footer" style="margin-top: 12px;">
                            THE RECIPE, Yogyakarta
                        </span>
                    </div>
                    <div style="margin-top: 12px;"><img class="footer-icon" src="assets/icon/ic_baseline-local-phone.png" alt="phone">
                        <span class="p-footer">
                            +62 89090909090</span>
                    </div>
                    <div style="margin-top: 12px;"><img class="footer-icon" src="assets/icon/ic_round-email.png" alt="phone">
                        <span class="p-footer">
                            cs@therecipe.com</span>
                    </div>
                </span>
            </div>
            <div class="col-2">
                <span class="footer-title">Follow Us
                    <div style="margin-top: 12px;">
                        <img class="footer-icon" src="assets/icon/uim_instagram-alt.png" alt="ig">
                        <img class="footer-icon" style="margin-left: 12px;" src="assets/icon/fa-brands_twitter-square.png" alt="ig">
                        <img class="footer-icon" style="margin-left: 12px;" src="assets/icon/brandico_facebook-rect.png" alt="ig">
                    </div>
                </span>
            </div>
        </div>
        <p class="footer-last-text text-center">Copyright 2021 • All rights reserved • THE RECIPE</p>
    </footer>

    <script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>