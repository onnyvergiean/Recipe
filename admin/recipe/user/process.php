<?php
require_once '../../../config/db.php';
require_once('../functions/user.php');


if (isset($_POST['update'])) {
    $fullName = $_POST['fullName'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $birthDate = $_POST['birthDate'];
    $profesi = $_POST['profesi'];
    $age = date_diff(date_create($birthDate), date_create('today'))->y;
    $id_user = $_POST['id'];
    $email = $_POST['email'];

    edit_profile($fullName, $email, $jenisKelamin, $birthDate, $age, $profesi, $id_user);
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    delete_user($id);
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $birthDate = $_POST['birthDate'];
    $profesi = $_POST['profesi'];
    $age = date_diff(date_create($birthDate), date_create('today'))->y;
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $profesi = $_POST['profesi'];

    add_user($fullName, $profesi, $jenisKelamin, $birthDate, $age, $email, $password);
}
