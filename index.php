<?php

include __DIR__ . '/config/database.php';
session_start();

require "vendor/autoload.php";
include "controller/UserController.php";

$_SESSION['is_success_message'] = false;
// menyembunyikan notifikasi berhasil tambah data
if (isset($_POST['close-alert'])) {
    $_SESSION['is_success_message'] = false;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['delete-data'])) {
    $id_user = $_POST['id_user'];
    $result_delete_user = deleteUserById($id_user);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include "src/components/header.php"  ?>
    <main>
        <div class="container mt-5">
            <a href="add-data">
                <button class="btn btn-primary">Add Data</button>
            </a>
            <?php if ($_SESSION['is_success_message']) : ?>
                <div class="my-4 alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['success_message']; ?>
                        <form action="" method="POST">
                            <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close" name="close-alert"></button>
                        </form>
                </div>
            <?php endif;  ?>

            <?php
            $users = getAllUsers();
            ?>
            <?php if (count($users) > 0) : ?>
                <table class="table table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    foreach ($users as $user):
                        $first_name = $user['first_name'];
                        $last_name = $user['last_name'];
                        $email = $user['email'];
                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $first_name; ?></td>
                                <td><?= $last_name; ?></td>
                                <td><?= $email; ?></td>
                                <th scope="col">
                                    <a href="detail/<?= $user['id_user'] ?>" class="text-decoration-none">
                                        <button class="btn btn-outline-success">Detail</button>
                                    </a>
                                    <a href="edit/<?= $user['id_user'] ?>" class="text-decoration-none">
                                        <button class="btn btn-outline-warning">Edit</button>
                                    </a>
                                    <button type="submit" class="btn btn-outline-danger" name="delete-data" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no; ?>">Delete</button>
                                </th>
                            </tr>
                            <?php include "src/components/ModelDeleteUser.php";  ?>
                        </tbody>
                    <?php endforeach;  ?>
                </table>
            <?php else:  ?>
                <div class="d-flex flex-column justify-content-center align-items-center mt-5">
                    <img src="https://img.freepik.com/free-vector/hand-drawn-no-data-concept_52683-127818.jpg?w=740&t=st=1725449583~exp=1725450183~hmac=ee806d80ba317cc1b8935ee881b5317f55589118d898226eb47f617c3f8d18b4" alt="" width="40%">
                    <h2>Empty Data</h2>
                </div>
            <?php endif;  ?>
        </div>
    </main>
    <?php include "src/components/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>