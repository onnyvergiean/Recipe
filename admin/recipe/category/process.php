<?php

require_once "../../../config/db.php";
require('../functions/category.php');


if (isset($_POST['submit'])) {
    $namaCategory = $_POST['nama'];
    add_category($namaCategory);
}

if (isset($_POST['edit'])) {
    $namaCategory = $_POST['nama'];
    $id_category = $_POST['id_category'];
    edit_category($namaCategory, $id_category);
}

if (isset($_GET['delete'])) {
    $id_category = $_GET['delete'];

    delete_category($id_category);
}
