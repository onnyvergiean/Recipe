<?php

include_once "config/db.php";
session_start();

if (isset($_SESSION['logged_in'])) {
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $img = $_SESSION['img'];
}

$rows = [];
$categories = [];
if (isset($_GET['id'])) {
    $id_recipe  = $_GET['id'];
    $query = $connection->query("SELECT * FROM resep WHERE id_recipe = $id_recipe ");

    while ($data = mysqli_fetch_array($query)) {
        $rows[] = $data;
    }
}


$category = $connection->query("SELECT * FROM category");
while ($dataCategory = mysqli_fetch_array($category)) {
    $categories[] = $dataCategory;
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
        <h2 class="mb-3">Edit Resep Anda</h2>
        <?php
        foreach ($rows as $recipe) {
        ?>
            <form action="process/recipe_process.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="judulResep">Judul Resep</label>
                    <input type="text" class="form-control" id="judulResep" name="judulResep" value="<?= $recipe['nama_resep'] ?>">
                </div>
                <div class="form group">
                    <img src="content/img/<?= $recipe['img'] ?>" alt="Recipe Image" width="400px">
                </div>
                <div class="form-group">
                    <label for="image">Ganti Gambar</label>
                    <input type="file" class="form-control" name="file">
                </div>
                <label>Kategori Resep</label>
                <?php
                foreach ($categories as $cate) :
                ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" value="<?= $cate['id_category'] ?>" id="<?= $cate['id_category'] ?>" <?php echo ($recipe['id_category'] == $cate['id_category']) ?  "checked" : "";  ?>>
                        <label class="form-check-label mb-2" for="<?= $cate['id_category'] ?>">
                            <?= $cate['category'] ?>
                        </label>
                    </div>

                <?php endforeach; ?>
                <div class="form-group">
                    <label for="asalResep">Asal Resep</label>
                    <input type="text" class="form-control" id="asalResep" name="asal" placeholder="Masukkan Asal Resep" value=<?= $recipe['region'] ?>>
                </div>
                <div class="form-group">
                    <label for="deskripsiResep">Deskripsi Resep</label>
                    <textarea type="text" class="form-control" id="deskripsiResep" name="deskripsi"><?php echo $recipe['deskripsi'] ?></textarea>
                </div>
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="bahan">Lama Persiapan</label>
                        <input type="text" class="form-control" name="lamaPersiapan" value="<?= $recipe['lama_persiapan'] ?>">
                    </div>
                    <div class="col">
                        <label for="bahan">Lama Masak</label>
                        <input type="text" class="form-control" name="lamaMasak" value="<?= $recipe['lama_masak'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="bahan">Bahan Resep</label>
                    <textarea type="text" class="form-control" id="bahan" name="bahan" placeholder="Masukkan Bahan untuk Resep"><?= $recipe['bahan'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="peralatan">Peralatan Masak</label>
                    <textarea type="text" class="form-control" id="peralatan" placeholder="Masukkan Peralatan" name="peralatan"><?= $recipe['peralatan'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="judulResep">Langkah Masak</label>
                    <textarea name="langkah" id="langkah"><?= $recipe['langkah'] ?></textarea>
                </div>
                <input type="hidden" name="id_recipe" value="<?= $id_recipe ?>">
                <input type="hidden" name="old_image" value="<?= $recipe['img'] ?>">
                <button type="submit" name="update" class="btn btn-warning mb-4 col-12">Simpan</button>

            </form>
        <?php
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
    <script>
        CKEDITOR.replace('bahan');
        CKEDITOR.replace('peralatan');
        CKEDITOR.replace('langkah');
    </script>
</body>


</html>