<?php


include __DIR__ . "/../../../config/database.php";

$id_transaction = $_GET['order_id'];
$status_update = $_GET['transaction_status'];
$status_code = $_GET['status_code'];
if (isset($_GET['order_id'])) {
    $query = "UPDATE tbl_transaction 
                SET status_transaction = '$status_update' WHERE id_transaction = '$id_transaction'";
    mysqli_query($conn, $query);
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Success Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
            <img src="images/success.gif" alt="" width="500px">
            <h2 class="text-success">Transaction Success</h2>
            <a href="produk">Back to Home</a>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>