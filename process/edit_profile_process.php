<?php
date_default_timezone_set('Asia/Jakarta');

require_once "../config/db.php";
require '../functions/edit_profile_functions.php';

if (isset($_POST['update'])) {
    $fullName = $_POST['fullName'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $birthDate = $_POST['birthDate'];
    $profesi = $_POST['profesi'];
    $age = date_diff(date_create($birthDate), date_create('today'))->y;
    $id_user = $_POST['id_user'];

    edit_profile($fullName, $jenisKelamin, $birthDate, $age, $profesi, $id_user);
}
