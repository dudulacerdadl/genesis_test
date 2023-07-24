<?php

include '../../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "UPDATE budget SET `status` = 1 WHERE `id` = '$id';";
    if ($mysqli->query($query) === true) {
        header("Location: ../../admin");
        exit;
    } else {
        die("Erro ao inserir os dados no banco de dados: " . $mysqli->error);
    }
}
