<?php
require_once "../../../config/db.php";


function edit_profile($fullName, $email, $jenisKelamin, $birthDate, $age, $profesi, $id_user)
{
    global $connection;
    $targetDir = "../content/img/";
    $fileName = microtime() . $_FILES["file"]["name"];
    $targetFilePath =  $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (!empty($fileName) && in_array($fileType, $allowTypes)) {
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        $update = $connection->query("UPDATE user SET nama ='$fullName' , gender='$jenisKelamin', img = '$fileName', profesi = '$profesi', tgl_lahir= '$birthDate',umur='$age',email='$email' WHERE id_user ='$id_user'");
        if ($update) {
            echo
            "<script>alert('Data Berhasil Diubah');location='index.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    } else {
        $update = $connection->query("UPDATE user SET nama ='$fullName' , gender='$jenisKelamin', profesi = '$profesi', tgl_lahir= '$birthDate',umur='$age',email='$email' WHERE id_user ='$id_user'");
        if ($update) {
            echo
            "<script>alert('Data Berhasil Diubah');location='index.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    }
};


function delete_user($id)
{
    global $connection;
    if (!empty($id)) {
        $connection->query("DELETE FROM user WHERE id_user = '$id'");
        echo
        "<script>alert('Data Berhasil Dihapus');location='../user/index.php';</script>";
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

function add_user($fullName, $profesi, $jenisKelamin, $birthDate, $age, $email, $password)
{
    global $connection;
    $query = "INSERT INTO user (nama, gender, profesi, tgl_lahir, umur, email, password) VALUES ('$fullName', '$jenisKelamin','$profesi','$birthDate', '$age','$email', '$password' )";
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo
        "<script>alert('Data Berhasil Ditambahkan');location='index.php';</script>";
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}
