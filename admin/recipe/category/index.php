<?php

require('header.php');
if (!isset($_SESSION['log'])) {
  header('location: ../login.php');
  exit;
}


$result = $connection->query("SELECT * FROM category");

while ($data = mysqli_fetch_array($result)) {
  $rows[] = $data;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Category</h1>
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
                  <th>Nama Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($rows)) {
                  foreach ($rows as $row) : ?>
                    <tr>

                      <td><?= $row['category'] ?></td>
                      <td>
                        <a href="show_edit_category.php?id=<?= $row['id_category'] ?>" class="btn btn-warning btn-circle btn-sm "><i class="fas fa-edit"></i></a>
                        <a href="process.php?delete=<?= $row['id_category']  ?>" class="btn btn-danger btn-circle btn-sm" type="submit"><i class="fas fa-trash"></i></a>
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
          <form action="process.php" method="POST">
            <div class="form-group">
              <label for="nama">Nama Category</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Category" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
require_once('footer.php');
?>