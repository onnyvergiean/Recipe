<?php
require '../../../config/db.php';



$id = $_GET['id'];

$result = $connection->query("SELECT * from user WHERE id_user='$id'");
while ($user = mysqli_fetch_array($result)) {
?>
    <div class="tab-pane fade show active" id="edit-item" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow mb-4 mt-2">
            <div class=" card-body">
                <div class="row"></div>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <img class="mx-auto d-block" src="../../../content/img/<?= $user['img'] ?>" alt="User Profile Image" width="300px">
                    <div class="form-group">
                        <label for="image">Change Image Profile</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="name" class="form-control" id="fullName" name="fullName" aria-describedby="fullName" placeholder="Masukkan Nama Lengkap" value="<?= $user['nama'] ?>">
                    </div>
                    <div class="form-group ">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan email" value="<?= $user['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" id="Laki-Laki" value="Laki - Laki" <?php echo ($user['gender'] == 'Laki - Laki') ?  "checked" : "";  ?>>
                            <label class="form-check-label" for="Laki-Laki">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" <?php echo ($user['gender'] == 'Perempuan') ?  "checked" : "";  ?> value="Perempuan">
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-6">
                                <label for="birthDate" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?= $user['tgl_lahir'] ?>">
                            </div>
                            <div class="col-6">
                                <label for="umur">Umur</label>
                                <input type="umur" class="form-control" id="umur" name="umur" aria-describedby="umurHelp" placeholder="Masukkan umur" value="<?= $user['umur'] ?> tahun" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="profesi">Profesi</label>
                        <input type="profesi" class="form-control" id="profesi" name="profesi" aria-describedby="emailHelp" placeholder="Masukkan Profesi" value="<?= $user['profesi'] ?>">
                    </div>
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <button type="submit" name="update" class="btn btn-primary">Save</button>
                    <a href="index.php" class="btn btn-warning">Back</a>
                </form>
            <?php
        }
            ?>

            </div>
        </div>
    </div>