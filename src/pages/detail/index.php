<?php

include __DIR__ . "/../../../config/database.php";
include __DIR__ . "/../../../controller/UserController.php";
$requestURI = $_SERVER['REQUEST_URI'];

// Memisahkan bagian URL berdasarkan '/'
$parts = explode('/', trim($requestURI, '/'));

$data;
if (isset($parts[2])) {
    $id_user = $parts[2];
    $data = getUserById($id_user);
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
    <?php include "../../components/header.php" ?>
    <main>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/crud-simple">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail User</li>
                </ol>
            </nav>
            <?php if ($data) : ?>
                <div class="row gx-5">
                    <div class="col-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">First Name</th>
                                    <td><?= $data['first_name']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">Last Name</th>
                                    <td><?= $data['last_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="col">Email</th>
                                    <td><?= $data['email']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="col">Created at</th>
                                    <td><?= $data['created_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-5">
                        <h3>Profile Image</h3>
                        <img src="https://img.freepik.com/free-vector/user-circles-set_78370-4704.jpg?t=st=1725477176~exp=1725480776~hmac=fd6d79ce3494bd228b0403376eeb6e8e756633a09642d25a82cc3ecb809b2beb&w=740" alt="" height="200px">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php include "../../components/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>