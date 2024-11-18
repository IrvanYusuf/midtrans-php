<?php

include __DIR__ . '/../config/database.php';
require __DIR__ . "\..\\vendor\\autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;


function getAllUsers()
{
    global $conn;

    $query = "SELECT * FROM tbl_user ORDER BY created_at";

    $result = mysqli_query($conn, $query);

    $users = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    } else {
        return $users;
    }
}

function createNewUser($data)
{
    global $conn;
    date_default_timezone_set('Asia/Jakarta');

    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $uuid4 = Uuid::uuid4();
    $date = date('Y-m-d H:i:s', time());

    $query = "INSERT INTO tbl_user VALUES ('$uuid4','$first_name','$last_name','$email','$date','$date')";
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function getUserById($id_user)
{
    global $conn;
    $query = "SELECT * FROM tbl_user WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

function updateUserById($id_user, $data)
{
    global $conn;
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $query = "UPDATE tbl_user 
                SET first_name = '$first_name', last_name = '$last_name',email = '$email'
                WHERE id_user = '$id_user'
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function deleteUserById($id_user)
{
    global $conn;
    $query = "DELETE FROM tbl_user WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
