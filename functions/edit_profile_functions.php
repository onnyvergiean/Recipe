<?php
require_once "../config/db.php";


function edit_profile($fullName, $jenisKelamin, $birthDate, $age, $profesi, $id_user)
{
    global $connection;
    $targetDir = "../content/img/";
    $fileName = microtime() . $_FILES["file"]["name"];
    $targetFilePath =  $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (!empty($fileName) && in_array($fileType, $allowTypes)) {
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        $update = $connection->query("UPDATE user SET nama ='$fullName' , gender='$jenisKelamin', img = '$fileName', profesi = '$profesi', tgl_lahir= '$birthDate',umur='$age' WHERE id_user ='$id_user'");
        if ($update) {
            echo
            "<script>alert('Data Berhasil Diubah');location='../profil.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    } else {
        $update = $connection->query("UPDATE user SET nama ='$fullName' , gender='$jenisKelamin', profesi = '$profesi', tgl_lahir= '$birthDate',umur='$age' WHERE id_user ='$id_user'");
        if ($update) {
            echo
            "<script>alert('Data Berhasil Diubah');location='../profil.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    }
};
