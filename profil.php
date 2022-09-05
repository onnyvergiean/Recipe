<?php
include_once "config/db.php";
session_start();

if (isset($_SESSION['logged_in'])) {
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $img = $_SESSION['img'];
}
$query = mysqli_query($connection, "SELECT * FROM user where id_user=$id_user");
$query_list_Recipe = mysqli_query($connection, "SELECT * FROM resep where id_user=$id_user ");
while ($data = mysqli_fetch_array($query)) {
    $rows[] = $data;
}
while ($data_list_recipe = mysqli_fetch_array($query_list_Recipe)) {
    $rows_list_recipe[] = $data_list_recipe;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css?version=9">
    <title>Profile</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a href="index.php" class="brand-text-wrapper">
                <span class="brand-text-icon">THE RECIPE</span>
            </a>
            <nav class="navbar-nav navbar-center">
                <a class="nav-link" href="index.php">
                    Home
                </a>
                <a class="nav-link" href="list-recipe.php">
                    Cari
                </a>
                <a class="nav-link" href="new-recipe.php">
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
                    <a class="nav-link active" href="profil.php">
                        <img class="rounded-profile-picture-active mr-1" src="content/img/<?= $img ?>" />
                        <?= $nama ?> </a>
                    <a href="logout.php"><button class="btn btn-warning btn-logout">Logout</button></a>
                <?php endif; ?>
            </nav>
        </nav>
    </header>
    <section class="container">
        <?php foreach ($rows as $user) { ?>
            <div class="row">
                <div class="col-9">
                    <h2>Profile <?= $user['nama'] ?></h2>
                </div>
                <div class="col-2 ml-5">
                    <a href="edit-profil.php">
                        <button class="btn btn-warning edit-btn">Edit Profil</button></a>
                </div>
            </div>

        <?php } ?> <h3 class="mt-5 mb-4">List Recipe</h3>
        <?php
        if (!empty($rows_list_recipe)) {
            foreach ($rows_list_recipe as $list_recipe) { ?>

                <div class="row">
                    <div class="col-9 mt-4">
                        <a href="detail-recipe.php?id=<?= $list_recipe['id_recipe'] ?>">
                            <h4><?= $list_recipe['nama_resep'] ?></h5>
                        </a>
                        <span class="created-at">Created at <?= $list_recipe['tgl_buat'] ?></span>

                    </div>

                    <div class="col-2 ml-5">
                        <a href="edit-recipe.php?id=<?= $list_recipe['id_recipe'] ?>">
                            <button class="btn btn-warning edit-btn ">Edit Resep</button>
                        </a>
                        <a href="process/recipe_process.php?delete=<?= $list_recipe['id_recipe'] ?>">
                            <button class="btn btn-danger edit-btn mt-2 ">Hapus Resep</button>
                        </a>
                    </div>

                </div>
        <?php
            };
        } ?>
    </section>
    <footer class="container" style="margin-top: 300px;">
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
</body>

</html>