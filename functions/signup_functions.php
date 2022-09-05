<?php
require_once "../config/db.php";

function input_new_user($fullName, $jenisKelamin, $birthDate, $age, $email, $password)
{
    global $connection;
    $query = "INSERT INTO user (nama, gender, tgl_lahir, umur, email, password) VALUES ('$fullName', '$jenisKelamin','$birthDate', '$age','$email', '$password' )";
    $result = mysqli_query($connection, $query);

    if ($result) {
        sleep(3);
        header("Location: ../index.php");
    }
}
