<?php
date_default_timezone_set('Asia/Jakarta');
require_once '../config/db.php';
require '../functions/signup_functions.php';

if (isset($_POST['register'])) {

    $fullName = $_POST['fullName'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $birthDate = $_POST['birthDate'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $age = date_diff(date_create($birthDate), date_create('today'))->y;


    input_new_user($fullName, $jenisKelamin, $birthDate, $age, $email, $password);
}
