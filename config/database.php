<?php

$conn = mysqli_connect("localhost", 'root', '', 'crud-simple');

$url = "error.php";

if (!$conn) {
    header("Location: $url");
    exit();
}
