<?php
require '../../../config/db.php';

$id_category = $_GET['id'];

$result = $connection->query("SELECT * FROM category WHERE id_category = '$id_category'");
while ($data = mysqli_fetch_array($result)) {
?>
    <div class="tab-pane fade show active" id="edit-item" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow mb-4 mt-2">
            <div class=" card-body">
                <div class="row"></div>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Hotel</label>
                        <input value="<?= $data['category'] ?>" type="text" class="form-control" id="nama" name="nama">
                    </div>
                <?php
            }
                ?>
                <input type="hidden" name="id_category" value=<?= $id_category ?>>
                <button type="submit" name="edit" class="btn btn-primary">Save</button>
                <a href="index.php" class="btn btn-warning">Back</a>
                </form>

            </div>
        </div>
    </div>