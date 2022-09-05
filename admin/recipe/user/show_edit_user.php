<?php
include('header.php')
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#edit-item" role="tab" aria-controls="home" aria-selected="true">Edit Item</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <?php include "edit_user.php" ?>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<?php
include('footer.php')
?>