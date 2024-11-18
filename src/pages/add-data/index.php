<?php

session_start();

include "../../../config/database.php";
include "../../../controller/UserController.php";

$first_name_err = $last_name_err = $email_err = '';
$is_error = false;
if (isset($_POST['save-data'])) {

    if (empty($_POST['first_name'])) {
        $first_name_err = 'First Name required';
        $is_error = true;
    }
    if (empty($_POST['last_name'])) {
        $last_name_err = 'Last Name required';
        $is_error = true;
    }
    if (empty($_POST['first_name'])) {
        $email_err = 'Email required';
        $is_error = true;
    }
    $data = array(
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "email" => $_POST['email']
    );

    if (!$is_error) {
        $result = createNewUser($data);

        if ($result > 0) {
            $_SESSION['is_success_message'] = true;
            $_SESSION['success_message'] = "Data Berhasil Ditambahkan";
            header("Location: /crud-simple");
        }
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
            <form action="" method="POST" class="needs-validation" novalidate>
                <div class="has-validation">
                    <label for="inputFirtsName" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control form-control-lg" id="inputFirtsName" required>
                    <div class="text-danger my-2">
                        <?= $first_name_err; ?>
                    </div>
                </div>
                <div>
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control form-control-lg" id="inputLastName">
                    <div class="text-danger my-2">
                        <?= $last_name_err; ?>
                    </div>
                </div>
                <div>
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="inputEmail4">
                    <div class="text-danger my-2">
                        <?= $email_err; ?>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/crud-simple" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4" name="save-data">Save</button>
                </div>
            </form>
        </div>
    </main>
    <?php include "../../components/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>