<?php

include_once "config/db.php";
session_start();

if (isset($_SESSION['logged_in'])) {
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $img = $_SESSION['img'];
}
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

$category = $connection->query("SELECT * FROM category");
$rows = [];
while ($data = mysqli_fetch_array($category)) {
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
    <link rel="stylesheet" href="assets/css/index.css?version=4">
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <title>Create new Recipe</title>
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
                <a class="nav-link  active" href="#">
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
        <h2 class="mb-3">Tulis Resep Anda</h2>
        <form action="process/recipe_process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judulResep">Judul Resep</label>
                <input type="text" class="form-control" id="judulResep" name="judulResep" placeholder="Masukkan Judul Resep" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="file" required>
            </div>
            <div class="form-group">
                <label for="asalResep">Asal Resep</label>
                <input type="text" class="form-control" id="asalResep" name="asal" placeholder="Masukkan Asal Resep" required>
            </div>
            <label for="asalResep">Kategori Resep</label>
            <?php
            foreach ($rows as $categories) {
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" value="<?= $categories['id_category'] ?>" id="<?= $categories['id_category'] ?>">
                    <label class="form-check-label mb-2" for="<?= $categories['id_category'] ?>">
                        <?= $categories['category'] ?>
                    </label>
                </div>

            <?php
            } ?>
            <div class="form-group">
                <label for="deskripsiResep">Deskripsi Resep</label>
                <textarea type="text" class="form-control" id="deskripsiResep" name="deskripsi" placeholder="Masukkan Deskripsi Resep" required></textarea>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="bahan">Lama Persiapan</label>
                    <input type="text" class="form-control" name="lamaPersiapan" placeholder="lamaPersiapan" required>
                </div>
                <div class="col">
                    <label for="bahan">Lama Masak</label>
                    <input type="text" class="form-control" name="lamaMasak" placeholder="lamaMasak" required>
                </div>
            </div>
            <div class="form-group">
                <label for="bahan">Bahan Resep</label>
                <textarea type="text" class="form-control" id="bahan" name="bahan" placeholder="Masukkan Bahan untuk Resep" required></textarea>
            </div>

            <div class="form-group">
                <label for="peralatan">Peralatan Masak</label>
                <textarea type="text" class="form-control" id="peralatan" placeholder="Masukkan Peralatan" name="peralatan" required></textarea>
            </div>
            <div class="form-group">
                <label for="judulResep">Langkah Masak</label>
                <textarea name="langkah" id="langkah" required></textarea>
            </div>
            <input type="hidden" id="id_user" name="id_user" value="<?= $id_user  ?>">
            <button type="submit" name="submit" class="btn btn-warning mb-4 col-12" required>Simpan</button>
        </form>
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
    <script>
        CKEDITOR.replace('bahan');
        CKEDITOR.replace('peralatan');
        CKEDITOR.replace('langkah');
    </script>
</body>


</html>