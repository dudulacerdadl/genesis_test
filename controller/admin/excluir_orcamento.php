<?php

include '../../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM budget WHERE `id` = '$id';";

    if ($mysqli->query($query) === true) {
        header("Location: ../../admin");
        exit;
    } else {
        die("Erro ao excluir os dados no banco de dados: " . $mysqli->error);
    }
}
