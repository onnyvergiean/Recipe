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
            <img class="mx-auto d-block" src="content/img/<?= $user['img'] ?>" alt="User Profile Image" width="300px">
            <form action="process/edit_profile_process.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Change Image Profile</label>
                    <input type="file" class="form-control" name="file">
                </div>
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="name" class="form-control" id="fullName" name="fullName" aria-describedby="fullName" placeholder="Masukkan Nama Lengkap" value="<?= $user['nama'] ?>">
                </div>
                <div class="form-group ">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan email" value="<?= $user['email'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenisKelamin" id="Laki-Laki" value="Laki - Laki" <?php echo ($user['gender'] == 'Laki - Laki') ?  "checked" : "";  ?>>
                        <label class="form-check-label" for="Laki-Laki">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" <?php echo ($user['gender'] == 'Perempuan') ?  "checked" : "";  ?> value="Perempuan">
                        <label class="form-check-label" for="perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-6">
                            <label for="birthDate" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?= $user['tgl_lahir'] ?>">
                        </div>
                        <div class="col-6">
                            <label for="umur">Umur</label>
                            <input type="umur" class="form-control" id="umur" name="umur" aria-describedby="umurHelp" placeholder="Masukkan umur" value="<?= $user['umur'] ?> tahun" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="profesi">Profesi</label>
                    <input type="profesi" class="form-control" id="profesi" name="profesi" aria-describedby="emailHelp" placeholder="Masukkan Profesi" value="<?= $user['profesi'] ?>">
                </div>

                <div class="row mb-5 mt-5">
                    <div class="col-6">
                        <button type="submit" name="update" class="btn btn-warning btn-sign-in ml-5 ">Update Profile</button>
                    </div>
                    <div class="col-6 mb-5">
                        <a href="profil.php"><button type="button" class="btn btn-warning btn-sign-up ">Cancel</button></a>
                    </div>
                </div>
                <input type="hidden" name="id_user" value="<?= $id_user ?>">
            </form>
        <?php } ?>
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