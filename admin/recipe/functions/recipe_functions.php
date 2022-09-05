<?php
date_default_timezone_set('Asia/Jakarta');
require_once "../../../config/db.php";

function add_recipe($category, $asal, $judulResep, $deskripsi, $lamaPersiapan, $lamaMasak, $bahan, $peralatan, $langkah, $id_user)
{

    global $connection;
    $targetDir = "../../../content/img/";
    $fileName = microtime() . $_FILES["file"]["name"];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $date = date('Y-m-d H:i:s');
    if (in_array($fileType, $allowTypes)) {
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        $query = "INSERT INTO resep (id_user,id_category,region, nama_resep, deskripsi, lama_persiapan, lama_masak, bahan, peralatan, langkah, img, tgl_buat) 
            VALUES ('$id_user','$category','$asal', '$judulResep', '$deskripsi', '$lamaPersiapan', '$lamaMasak', '$bahan', '$peralatan', '$langkah', '$fileName', '$date')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            sleep(3);
            echo
            "<script>alert('Data Berhasil Ditambahkan');location='../recipe/index.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    }
}

function edit_recipe($category, $asal, $judulResep, $deskripsi, $lamaPersiapan, $lamaMasak, $bahan, $peralatan, $langkah, $id_recipe, $old_image)
{
    global $connection;
    $targetDir = "../../../content/img/";
    $fileName = microtime() . $_FILES["file"]["name"];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $date = date('Y-m-d H:i:s');

    if (!empty($fileName) && in_array($fileType, $allowTypes)) {
        unlink("$targetDir/$old_image");
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        $update_recipe = $connection->query("UPDATE resep SET id_category='$category', region='$asal', nama_resep='$judulResep',deskripsi='$deskripsi',
        lama_persiapan='$lamaPersiapan',  lama_masak='$lamaMasak',bahan='$bahan',peralatan='$peralatan',langkah='$langkah',img='$fileName',tgl_buat='$date' WHERE id_recipe = '$id_recipe'");
        if ($update_recipe) {
            sleep(3);
            echo
            "<script>alert('Data Berhasil Diedit');location='../recipe/index.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    } else {
        $update_recipe = $connection->query("UPDATE resep SET id_category='$category', region='$asal', nama_resep='$judulResep',deskripsi='$deskripsi',
        lama_persiapan='$lamaPersiapan', lama_masak='$lamaMasak',bahan='$bahan',peralatan='$peralatan',langkah='$langkah',tgl_buat='$date' WHERE id_recipe = '$id_recipe'");
        if ($update_recipe) {
            sleep(3);
            echo
            "<script>alert('Data Berhasil Diedit');location='../recipe/index.php';</script>";
        } else {
            echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    }
}

function delete_recipe($id_recipe)
{
    global $connection;
    if (!empty($id_recipe)) {
        $result = $connection->query("SELECT img FROM resep WHERE id_recipe = '$id_recipe'");
        while ($data = mysqli_fetch_array($result)) {
            unlink("../../../content/img/$data[img]");
        }
        $connection->query("DELETE FROM resep WHERE id_recipe = '$id_recipe'");
        echo
        "<script>alert('Data Berhasil Dihapus');location='../recipe/index.php';</script>";
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}
