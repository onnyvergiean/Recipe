<?php
require_once "config/db.php";
session_start();

if (isset($_SESSION['logged_in'])) {
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $img = $_SESSION['img'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "SELECT user.nama,user.profesi,category.category,resep.* FROM resep INNER JOIN user ON resep.id_user = user.id_user INNER JOIN category ON resep.id_category = category.id_category WHERE resep.id_recipe = $id");

    while ($data = mysqli_fetch_array($query)) {
        $rows[] = $data;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Detail Recipe</title>
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
                <a class="nav-link" href="list-recipe.php">
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
        <div class="ml-5 pl-3">

            <?php
            foreach ($rows as $recipe_detail) {
                $date = date("F jS, Y ", strtotime($recipe_detail['tgl_buat']));
                $current_viewers = $recipe_detail['view'];
                $new_viewers = $current_viewers + 1;
                $update_viewers = mysqli_query($connection, "UPDATE resep SET view = '" . $new_viewers . "' WHERE resep.id_recipe = $id");
            ?>
                <div class="row">
                    <div class="col-7">
                        <h5 class="detail-author">By <?= $recipe_detail['nama'] ?> <span class="span-profesi"><?= $recipe_detail['profesi'] ?></span></h5>
                        <span>Asal Resep <?= $recipe_detail['region'] ?></span>
                        <p>Kategori Resep <?= $recipe_detail['category'] ?></p>
                        <div class="row">
                            <div class="col-5">
                                <p class="detail-publish">Published <?= $date ?></p>
                            </div>

                            <img src="assets/icon/eye.svg" alt="Views Icon" width="20px"><span class="ml-1 detail-view-count"><?= $recipe_detail['view'] ?></span>
                        </div>

                        <h1 class="mb-2 mt-4 detail-title"><?= $recipe_detail['nama_resep'] ?></h1>
                        <p class="mt-4"><?= $recipe_detail['deskripsi'] ?></p>
                    </div>
                    <div class="col-5">
                        <img src="content/img/<?= $recipe_detail['img'] ?>" alt="Detail Image Recipe" height="250px" width="300px">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <p>Lama Persiapan : <?= $recipe_detail['lama_persiapan'] ?></p>
                    </div>
                    <div class="col-3">
                        <p>Lama Masak : <?= $recipe_detail['lama_masak'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mt-5">
                        <h2 class="detail-sub-title mb-3">Bahan</h2>
                        <div><?= $recipe_detail['bahan'] ?></div>
                    </div>
                    <div class="col-6 mt-5">
                        <h2 class="detail-sub-title mb-3">Peralatan</h2>
                        <div><?= $recipe_detail['peralatan'] ?></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-7 mt-4">
                        <h2 class="detail-sub-title mb-3">Langkah Masak</h2>
                        <div class="mb-5"><?= $recipe_detail['langkah'] ?></div>
                    </div>
                </div>
            <?php
            }
            ?>

    </section>
    <footer class="container mt-5">
        <div class="row">
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