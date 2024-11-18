<?php

session_start();

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

if (isset($_POST['update-data'])) {
    $data_update = array(
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "email" => $_POST['email']
    );

    $result = updateUserById($id_user, $data_update);
    if ($result > 0) {
        $_SESSION['is_success_message'] = true;
        $_SESSION['success_message'] = "Data Berhasil Diupdate";
        header("Location: /crud-simple");
    }
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
            <form action="" method="POST">
                <div>
                    <label for="inputFirtsName" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control form-control-lg" id="inputFirtsName" value="<?= $data['first_name']; ?>">
                </div>
                <div>
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control form-control-lg" id="inputLastName" value="<?= $data['last_name']; ?>">
                </div>
                <div>
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="inputEmail4" value="<?= $data['email']; ?>">
                </div>
                <div class="mt-4">
                    <a href="/crud-simple" class="text-decoration-none me-3 btn btn-outline-danger">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4" name="update-data">Update</button>
                </div>
            </form>
        </div>
    </main>
    <?php include "../../components/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>