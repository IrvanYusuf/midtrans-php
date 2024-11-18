<?php

include __DIR__ . "/../../../data.php";
date_default_timezone_set('Asia/Jakarta');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-4RGP6UilYQaPN_QD"></script>
</head>

<body>
    <?php include "../../components/header.php"; ?>
    <main>
        <div class="container mt-5">
            <form method="post" id="form-pay">
                <h2>Customer Details</h2>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="customer_name" class="form-control" id="name" placeholder="your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="customer_email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">No Handphone</label>
                    <input type="text" name="customer_phone" class="form-control" id="phone" placeholder="081*****">
                </div>
                <hr>
                <input type="hidden" name="id_cart" value="<?= $cart_datas['id_cart']; ?>">
                <input type="hidden" name="gross_amount" value="<?= $cart_datas['gross_amount']; ?>">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Barang</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_datas['items'] as $items):  ?>
                            <tr>
                                <th scope="row"><?= $items['id']; ?></th>
                                <td><?= $items['name']; ?></td>
                                <td><?= $items['price']; ?></td>
                                <td><?= $items['quantity']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end fw-bold ms-auto">Total Harga</td>
                            <td><?= $cart_datas['gross_amount']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="pay" name="pay">Bayar Sekarang</button>
                </div>
            </form>
        </div>
    </main>
    <?php include "../../components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        const formPay = document.getElementById("form-pay");
        formPay.addEventListener("submit", async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            let data = Object.fromEntries(formData.entries());
            console.log(data);
            try {
                const response = await fetch("/crud-simple/controller/TransactionController.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })

                const result = await response.json();
                console.log(result);
                if (result.snap_token) {
                    snap.pay(result.snap_token)
                }

            } catch (error) {
                console.error('Error:', error);
            }
        })
    </script>
</body>

</html>