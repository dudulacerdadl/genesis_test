<?php

include '../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $nome  = $_POST['name'];
    $cell = $_POST['cell'];
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $query = "INSERT INTO user (name, cell, email, password) VALUES ('$nome', '$cell', '$email', '$senha');";
    if ($mysqli->query($query) === true) {
        header("Location: ../index.html");
        exit;
    } else {
        die("Erro ao inserir os dados no banco de dados: " . $mysqli->error);
    }
}
