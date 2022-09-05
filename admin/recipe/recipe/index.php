<?php

require('header.php');
if (!isset($_SESSION['log'])) {
  header('location: ../login.php');
  exit;
}

$id_user = 22;
$categories = [];
$category = $connection->query("SELECT * FROM category");
while ($dataCategory = mysqli_fetch_array($category)) {
  $categories[] = $dataCategory;
}
$result = $connection->query("SELECT user.nama,user.profesi,category.category,resep.* FROM resep INNER JOIN user ON resep.id_user = user.id_user INNER JOIN category ON resep.id_category = category.id_category");

while ($data = mysqli_fetch_array($result)) {
  $rows[] = $data;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Recipe</h1>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#show-item" role="tab" aria-controls="home" aria-selected="true">Show Item</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add-item" role="tab" aria-controls="profile" aria-selected="false">Add Item</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="show-item" role="tabpanel" aria-labelledby="home-tab">
      <div class="card shadow mb-4 mt-2">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama User</th>
                  <th>Profesi</th>
                  <th>Category</th>
                  <th>Region</th>
                  <th>Nama Resep</th>
                  <th>Deskripsi</th>
                  <th>Lama Persiapan</th>
                  <th>Lama Masak</th>
                  <th>Bahan</th>
                  <th>Peralatan</th>
                  <th>Langkah</th>
                  <th>Image</th>
                  <th>View</th>
                  <th>Tanggal Buat</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($rows)) {
                  foreach ($rows as $row) : ?>
                    <tr>

                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['profesi'] ?></td>
                      <td><?= $row['category'] ?></td>
                      <td><?= $row['region'] ?></td>
                      <td><?= $row['nama_resep'] ?></td>
                      <td><?= $row['deskripsi'] ?></td>
                      <td><?= $row['lama_persiapan'] ?></td>
                      <td><?= $row['lama_masak'] ?></td>
                      <td><?= $row['bahan'] ?></td>
                      <td><?= $row['peralatan'] ?></td>
                      <td><?= $row['langkah'] ?></td>
                      <td><img class="mx-auto d-block" src="../../../content/img/<?= $row['img'] ?>" alt="Recipe Image" width="50px"></td>
                      <td><?= $row['view'] ?></td>
                      <td><?= $row['tgl_buat'] ?></td>
                      <td>
                        <a href="show_edit_recipe.php?id=<?= $row['id_recipe'] ?>&id_category=<?= $row['id_category'] ?>" class="btn btn-warning btn-circle btn-sm "><i class="fas fa-edit"></i></a>
                        <a href="process.php?delete=<?= $row['id_recipe']  ?>" class="btn btn-danger btn-circle btn-sm" type="submit"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                <?php endforeach;
                } else {
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="add-item" role=" tabpanel" aria-labelledby="profile-tab">
      <div class="card shadow mb-4 mt-2">
        <div class=" card-body">
          <form action="process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="judulResep">Judul Resep</label>
              <input type="text" class="form-control" id="judulResep" name="judulResep" placeholder="Masukkan Judul Resep" required>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control" name="file" required>
            </div>
            <div class="form-group">
              <label for="asalResep">Asal Resep</label>
              <input type="text" class="form-control" id="asalResep" name="asal" placeholder="Masukkan Asal Resep" required>
            </div>
            <label for="asalResep">Kategori Resep</label>
            <?php
            foreach ($categories as $cate) {
            ?>
              <div class="form-check">

                <input class="form-check-input" type="radio" name="category" value="<?= $cate['id_category'] ?>" id="<?= $cate['id_category'] ?>">
                <label class="form-check-label mb-2" for="<?= $cate['id_category'] ?>">
                  <?= $cate['category'] ?>
                </label>
              </div>

            <?php
            } ?>
            <div class="form-group">
              <label for="deskripsiResep">Deskripsi Resep</label>
              <textarea type="text" class="form-control" id="deskripsiResep" name="deskripsi" placeholder="Masukkan Deskripsi Resep" required></textarea>
            </div>
            <div class="form-row mb-3">
              <div class="col">
                <label for="bahan">Lama Persiapan</label>
                <input type="text" class="form-control" name="lamaPersiapan" placeholder="lamaPersiapan" required>
              </div>
              <div class="col">
                <label for="bahan">Lama Masak</label>
                <input type="text" class="form-control" name="lamaMasak" placeholder="lamaMasak" required>
              </div>
            </div>
            <div class="form-group">
              <label for="bahan">Bahan Resep</label>
              <textarea type="text" class="form-control" id="bahan" name="bahan" placeholder="Masukkan Bahan untuk Resep" required></textarea>
            </div>

            <div class="form-group">
              <label for="peralatan">Peralatan Masak</label>
              <textarea type="text" class="form-control" id="peralatan" placeholder="Masukkan Peralatan" name="peralatan" required></textarea>
            </div>
            <div class="form-group">
              <label for="judulResep">Langkah Masak</label>
              <textarea name="langkah" class="form-control" id="langkah" required></textarea>
            </div>
            <input type="hidden" id="id_user" name="id_user" value="<?= $id_user ?>">
            <button type="submit" name="tambah" class="btn btn-warning" required>Save</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>


<?php
require_once('footer.php');
?>