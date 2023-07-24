<?php

include '../../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['name'], $_POST['price'])) {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];

    if ($sku != null) {
        $query = "UPDATE products SET `name` = '$name', `price` = '$price', `description` = '$description', `img` = '$img' WHERE `sku` = '$sku';";
    } else {
        $query = "INSERT INTO products (name, price, description, img) VALUES ('$name', '$price', '$description', '$img');";
    }
    if ($mysqli->query($query) === true) {
        header("Location: ../../admin");
        exit;
    } else {
        die("Erro ao inserir os dados no banco de dados: " . $mysqli->error);
    }
}
