<?php

require_once 'config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Sign Up</title>
</head>

<body>
    <section class="container ">
        <div class="container-signup">
            <div class="col-7">
                <h1>Sign Up</h1>
            </div>
            <form action="process/signup_process.php" method="POST" id="formSignUp">
                <div class="col-7 form-signup">
                    <div class="form-group">
                        <div class="alert alert-warning d-none" role="alert" style="width: 430px;" id="alertFillAllField">
                            Please Fill Out All Field !
                        </div>
                        <div class="alert alert-danger d-none" role="alert" style="width: 430px;" id="alertPasswordNotMatch">
                            Password Not Match !
                        </div>
                        <div class="alert alert-success d-none" role="alert" style="width: 430px;" id="alertRegisterSuccess">
                            Register Successfully !
                        </div>
                        <label for="name">Nama Lengkap</label>
                        <input type="name" class="form-control" id="fullName" name="fullName" aria-describedby="fullName" placeholder="Masukkan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pilih Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" id="Laki-Laki" value="Laki - Laki">
                            <label class="form-check-label" for="Laki-Laki">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="Perempuan">
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthDate" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birthDate" name="birthDate">
                    </div>
                    <div class="form-group ">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan email">
                    </div>
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group ">
                        <label for="password">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
                    </div>
                </div>

                <div class="col">
                    <button type="submit" name="register" class="btn btn-warning btn-sign-in">Create
                        Account</button>
                </div>
            </form>
            <div class="col">
                <a href="index.php"><button type="button" class="btn btn-warning mt-3 btn-sign-up mb-3 ">Cancel</button></a>
            </div>

        </div>
    </section>
    <script src="js/signup.js"></script>
</body>

</html>