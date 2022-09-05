<?php


require_once "../config/db.php";
require '../functions/recipe_functions.php';

if (isset($_POST['submit'])) {
    $judulResep = $_POST['judulResep'];
    $asal = $_POST['asal'];
    $deskripsi = $_POST['deskripsi'];
    $lamaPersiapan = $_POST['lamaPersiapan'];
    $lamaMasak = $_POST['lamaMasak'];
    $bahan = $_POST['bahan'];
    $peralatan = $_POST['peralatan'];
    $langkah = $_POST['langkah'];
    $category = $_POST['category'];
    $id_user = $_POST['id_user'];


    input_new_recipe($category, $asal, $judulResep, $deskripsi, $lamaPersiapan, $lamaMasak, $bahan, $peralatan, $langkah, $id_user);
}
if (isset($_POST['update'])) {
    $judulResep = $_POST['judulResep'];
    $asal = $_POST['asal'];
    $deskripsi = $_POST['deskripsi'];
    $lamaPersiapan = $_POST['lamaPersiapan'];
    $lamaMasak = $_POST['lamaMasak'];
    $bahan = $_POST['bahan'];
    $peralatan = $_POST['peralatan'];
    $langkah = $_POST['langkah'];
    $id_recipe = $_POST['id_recipe'];
    $old_image = $_POST['old_image'];
    $category = $_POST['category'];


    edit_recipe($category, $asal, $judulResep, $deskripsi, $lamaPersiapan, $lamaMasak, $bahan, $peralatan, $langkah, $id_recipe, $old_image);
}

if (isset($_GET['delete'])) {
    $id_recipe = $_GET['delete'];

    delete_recipe($id_recipe);
}
