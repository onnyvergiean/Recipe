<?php
require_once "../../../config/db.php";


function add_category($namaCategory)
{
    global $connection;
    $query = $connection->query("INSERT INTO category (category) VALUES ('$namaCategory')");
    if ($query) {
        echo
        "<script>alert('Data Berhasil Ditambahkan');location='index.php';</script>";
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

function edit_category($namaCategory, $id_category)
{
    global $connection;
    $query = $connection->query("UPDATE category SET category='$namaCategory' WHERE id_category='$id_category'");
    if ($query) {
        echo
        "<script>alert('Data Berhasil Diupdate');location='index.php';</script>";
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

function delete_category($id_category)
{
    global $connection;
    $query = $connection->query("DELETE FROM category WHERE id_category='$id_category'");
    if ($query) {
        echo
        "<script>alert('Data Berhasil Dihapus');location='index.php';</script>";
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}
