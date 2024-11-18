<?php

require __DIR__ . "\..\\vendor\\autoload.php";
include __DIR__ . "/../../crud-simple/data.php";
include __DIR__ . '/../config/database.php';
date_default_timezone_set('Asia/Jakarta');

use Ramsey\Uuid\Uuid;
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-wWlPmwmmG2uL1v7S0NjiGt1q';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = false;

$cart_datas;
function createTransaction()
{
    global $cart_datas;
    $uuid = Uuid::uuid4();
    // Data transaksi (dinamis)
    $transaction_details = array(
        'order_id' => $uuid,
        'gross_amount' => 5200,
    );

    // Data item yang dibeli (dinamis)
    // Data customer (dinamis)
    $customer_details = array(
        'first_name' => "Irvan",
        'email' => "irvan@gmail.com",
        'phone' => "082211345589",
    );
    // Data transaksi lengkap
    $transaction = array(
        'transaction_details' => $transaction_details,
        'customer_details' => $customer_details,
        "expiry" => array(
            "unit" => "minutes",
            "duration" => 1
        ),
    );

    $snapToken = \Midtrans\Snap::getSnapToken($transaction);

    $data = array(
        'uuid' => $transaction_details['order_id'],
        'first_name' => $customer_details['first_name'],
        'phone' => $customer_details['phone'],
        'gross_amount' => $transaction_details['gross_amount'],
        'status' => 'pending',
        'snap_token' => $snapToken
    );

    if ($snapToken) {
        $save_to_db = saveTransaction($data);
        if ($save_to_db > 0) {
            return ['snap_token' => $snapToken, 'message' => 'success', 'status_code' => 200];
        }
    }
}

header('Content-Type: application/json');
$input = file_get_contents('php://input');
$data = json_decode($input, true);
echo json_encode(createTransaction($data));



function saveTransaction($data)
{
    global $conn;
    $uuid = $data['uuid'];
    $first_name = $data['first_name'];
    $phone = $data['phone'];
    $gross_amount = $data['gross_amount'];
    $status = $data['status'];
    $snap_token = $data['snap_token'];
    $date = date('Y-m-d H:i:s', time());
    $query = "INSERT INTO tbl_transaction VALUES('$uuid','$first_name','$phone','$gross_amount','$status','$snap_token','$date')";
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
