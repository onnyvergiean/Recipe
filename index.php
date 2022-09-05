<?php
require_once 'config/db.php';
session_start();

if (isset($_SESSION['logged_in'])) {
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $img = $_SESSION['img'];
}

$popular_recipe = $connection->query("SELECT * FROM resep ORDER BY view DESC LIMIT 3");
while ($data = mysqli_fetch_array($popular_recipe)) {
    $data_popular_recipe[] = $data;
};
$newest_recipe = $connection->query(("SELECT * FROM resep ORDER BY id_recipe DESC LIMIT 3"));
while ($data = mysqli_fetch_array($newest_recipe)) {
    $data_newest_recipe[] = $data;
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css?version=3">
    <title>The Recipe</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a href="index.php" class="brand-text-wrapper">
                <span class="brand-text-icon">THE RECIPE</span>
            </a>
            <nav class="navbar-nav navbar-center">
                <a class="nav-link active" href="#">
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
    <section class="container">
        <div class="row ">
            <div class="col-4">
                <h1 class="mt-5">Cook Easier with The Recipe</h1>
                <p class="banner-text mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor
                    incididunt ut labore
                    et dolore magna aliqua.</p>
                <a href="list-recipe.php"><button class="btn btn-warning btn-see-more mt-4">See More</button></a>
            </div>
            <div class="col-7 ml-auto mb-5">
                <img src="assets/Image Banner.png" alt="Image Banner">
            </div>
        </div>
    </section>

    <section class="container">
        <h3 class="mt-5 title-section">Popular Recipe</h3>
        <div class="row justify-content-center">
            <?php if (!empty($data_popular_recipe)) {
                foreach ($data_popular_recipe as $data_popular_recipes) { ?>
                    <div class="col-4 mt-3">
                        <a class="a-recipe" href="detail-recipe.php?id=<?= $data_popular_recipes['id_recipe'] ?>">
                            <img src="content/img/<?= $data_popular_recipes['img'] ?>" alt="Recipe Image" width="350px" height="350px">
                            <p class="popular-recipe-name"><?= $data_popular_recipes['nama_resep'] ?></p>
                            <button class="btn btn-warning btn-read-more ">Read More</button>
                        </a>
                    </div>

            <?php };
            } ?>
        </div>
    </section>
    <section class="container">
        <h3 class="mt-5 title-section">Newest Recipe</h3>
        <div class="row justify-content-center">
            <?php if (!empty($data_newest_recipe)) {
                foreach ($data_newest_recipe as $data_newest_recipes) { ?>
                    <div class="col-4 mt-3">
                        <a class="a-recipe" href="detail-recipe.php?id=<?= $data_newest_recipes['id_recipe'] ?>">
                            <img src="content/img/<?= $data_newest_recipes['img'] ?>" alt="Recipe Image" width="350px" height="350px">
                            <p class="popular-recipe-name"><?= $data_newest_recipes['nama_resep'] ?></p>
                            <button class="btn btn-warning btn-read-more ">Read More</button>
                        </a>
                    </div>
            <?php };
            } ?>
        </div>
    </section>
    <footer class="container">
        <div class="row" style="margin-top: 150px;">
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

</html>l