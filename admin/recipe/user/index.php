<?php

require('header.php');
if (!isset($_SESSION['log'])) {
  header('location: ../login.php');
  exit;
}


$result = $connection->query("SELECT * from user WHERE admin=0");

while ($data = mysqli_fetch_array($result)) {
  $rows[] = $data;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">User</h1>
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
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Profesi</th>
                  <th>Image Profie</th>
                  <th>Tanggal Lahir</th>
                  <th>Umur</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($rows)) {
                  foreach ($rows as $row) : ?>
                    <tr>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['gender'] ?></td>
                      <td><?= $row['profesi'] ?></td>
                      <td><img class="mx-auto d-block" src="../../../content/img/<?= $row['img'] ?>" alt="User Profile Image" width="30px"></td>
                      <td><?= $row['tgl_lahir'] ?></td>
                      <td><?= $row['umur'] ?></td>
                      <td>
                        <a href="show_edit_user.php?id=<?= $row['id_user'] ?>" class="btn btn-warning btn-circle btn-sm "><i class="fas fa-edit"></i></a>
                        <a href=<?= "./process.php?delete=" . $row['id_user'] ?> class="btn btn-danger btn-circle btn-sm" type="submit"><i class="fas fa-trash"></i></a>
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
            <div class="col-7 form-signup">
              <div class="form-group">
                <div class="alert alert-warning d-none" role="alert" style="width: 430px;" id="alertFillAllField">
                  Please Fill Out All Field !
                </div>
                <div class="alert alert-danger d-none" role="alert" style="width: 430px;" id="alertPasswordNotMatch">
                  Password Not Match !
                </div>
                <div class="alert alert-success d-none" role="alert" style="width: 430px;" id="alertRegisterSuccess">
                  Register Successfully !
                </div>
                <label for="name">Nama Lengkap</label>
                <input type="name" class="form-control" id="fullName" name="fullName" aria-describedby="fullName" placeholder="Masukkan Nama Lengkap">
              </div>
              <div class="form-group">
                <label class="form-label">Pilih Jenis Kelamin</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenisKelamin" id="Laki-Laki" value="Laki - Laki">
                  <label class="form-check-label" for="Laki-Laki">
                    Laki-Laki
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="Perempuan">
                  <label class="form-check-label" for="perempuan">
                    Perempuan
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="birthDate" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birthDate" name="birthDate">
              </div>
              <div class="form-group ">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan email">
              </div>
              <div class="form-group ">
                <label for="profesi">Profesi</label>
                <input type="profesi" class="form-control" id="profesi" name="profesi" aria-describedby="profesi" placeholder="Masukkan Profesi">
              </div>
              <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <div class="form-group ">
                <label for="password">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
              </div>
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
<!-- /.container-fluid -->