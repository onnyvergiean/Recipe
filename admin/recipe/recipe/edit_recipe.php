<?php
require '../../../config/db.php';

$id = $_GET['id'];
$id_category = $_GET['id_category'];
$category = $connection->query("SELECT * FROM category");
while ($dataCategory = mysqli_fetch_array($category)) {
    $categories[] = $dataCategory;
}
$result = $connection->query("SELECT * FROM resep WHERE id_recipe= '$id'");
while ($data = mysqli_fetch_array($result)) {
?>

    <body>


        <div class="tab-pane fade show active" id="edit-item" role="tabpanel" aria-labelledby="home-tab">
            <div class="card shadow mb-4 mt-2">
                <div class=" card-body">
                    <div class="row"></div>

                    <form action="process.php" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="judulResep">Judul Resep</label>
                            <input type="text" class="form-control" id="judulResep" name="judulResep" value="<?= $data['nama_resep'] ?>">
                        </div>
                        <div class="form group">
                            <img src="../../../content/img/<?= $data['img'] ?>" alt="Recipe Image" width="400px">
                        </div>
                        <div class="form-group">
                            <label for="image">Ganti Gambar</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <label>Kategori Resep</label>
                        <?php
                        foreach ($categories as $cate) :
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="<?= $cate['id_category'] ?>" id="<?= $cate['id_category'] ?>" <?php echo ($data['id_category'] == $cate['id_category']) ?  "checked" : "";  ?>>
                                <label class="form-check-label mb-2" for="<?= $cate['id_category'] ?>">
                                    <?= $cate['category'] ?>
                                </label>
                            </div>

                        <?php endforeach; ?>
                        <div class="form-group">
                            <label for="asalResep">Asal Resep</label>
                            <input type="text" class="form-control" id="asalResep" name="asal" placeholder="Masukkan Asal Resep" value=<?= $data['region'] ?>>
                        </div>
                        <div class="form-group">
                            <label for="deskripsiResep">Deskripsi Resep</label>
                            <textarea type="text" class="form-control" id="deskripsiResep" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="bahan">Lama Persiapan</label>
                                <input type="text" class="form-control" name="lamaPersiapan" value="<?= $data['lama_persiapan'] ?>">
                            </div>
                            <div class="col">
                                <label for="bahan">Lama Masak</label>
                                <input type="text" class="form-control" name="lamaMasak" value="<?= $data['lama_masak'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bahan">Bahan Resep</label>
                            <textarea type="text" class="form-control" id="bahan" name="bahan" placeholder="Masukkan Bahan untuk Resep"><?= $data['bahan'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="peralatan">Peralatan Masak</label>
                            <textarea type="text" class="form-control" id="peralatan" placeholder="Masukkan Peralatan" name="peralatan"><?= $data['peralatan'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="judulResep">Langkah Masak</label>
                            <textarea type="text" class="form-control" name="langkah" id="langkah"><?= $data['langkah'] ?></textarea>
                        </div>
                        <input type="hidden" name="id_recipe" value="<?= $id ?>">
                        <input type="hidden" name="old_image" value="<?= $data['img'] ?>">

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

    </body>