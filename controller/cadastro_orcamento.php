<?php

include '../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['product'], $_POST['qty'],  $_POST['price'], $_POST['user'])) {
    $product  = $_POST['product'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $user = $_POST['user'];

    $query = "INSERT INTO budget (product, qty, price, user, status) VALUES ('$product', '$qty', '$price', '$user', 0);";
    if ($mysqli->query($query) === true) {
        header("Location: ../index.html");
        exit;
    } else {
        die("Erro ao inserir os dados no banco de dados: " . $mysqli->error);
    }
}
