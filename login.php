<?php
require_once 'config/db.php';

session_start();

if (isset($_POST['login'])) {
    $message = "";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encryptPassword = md5($_POST['password']);
    $query = "SELECT * FROM user WHERE email='$email' AND password='$encryptPassword'";

    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        $_SESSION['email'] = $data['email'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['img'] = $data['img'];
        $_SESSION['logged_in'] = true;
        sleep(3);
        header("Location: index.php");
    } else {
        $message = '<div class="alert alert-danger " role="alert" style="width: 430px;" id="alertFillAllField">
                   Email or Password is incorrect!
                </div>';
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
    <title>Sign in</title>
</head>

<body>
    <section>
        <div class="row">
            <div class="col-5 login-form">
                <h1>Sign In</h1>

                <?php
                if (isset($message)) {
                    echo $message;
                    $message = '';
                }
                ?>
                <!-- <div class="alert alert-warning d-none" role="alert" style="width: 430px;" id="alertFillAllField">
                    Please Fill Out All Field !
                </div> -->
                <form method="POST" action="" id="formSignIn">
                    <div class="form-group ">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <button type="submit" name="login" class="btn btn-warning btn-sign-in">
                        Sign In</button>
                    <br />
                </form>
                <form action="signup.php">
                    <button type="submit" class="btn btn-warning btn-sign-up mt-3">
                        Sign Up</button>
                </form>
            </div>
            <div>
                <div class="login-background ml-auto">
                    <img class="login-img" src="assets/login-img.png" alt="Login Image">
                    <h2 class="text-center mt-3 login-title-text">Cook Easier with The Recipe</h2>
                    <p class="text-center col-5 login-title-description">Kami menyediakan jutaan resep untuk membantu
                        anda
                        memasak lebih mudah
                        dan cepat</p>
                </div>
            </div>
        </div>
    </section>

</body>

</html>