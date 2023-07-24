<?php

include '../../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['username'], $_POST['password'])) {
    $username  = $_POST['username'];
    $senha = $_POST['password'];

    $query = "INSERT INTO admin_user (username, password) VALUES ('$username', '$senha');";
    if ($mysqli->query($query) === true) {
        session_start();
        $_SESSION['username_admin'] = $username;
        $_SESSION['is_logged_in_admin'] = true;
        header("Location: ../../admin");
        exit;
    } else {
        die("Erro ao inserir os dados no banco de dados: " . $mysqli->error);
    }
}
