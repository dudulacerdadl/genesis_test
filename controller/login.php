<?php

include '../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['email'], $_POST['password'])) {
    $email  = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$senha'";
    $result = mysqli_query($mysqli, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        session_start();
        $_SESSION['username'] = $user['email'];
        $_SESSION['is_logged_in'] = true;
        header("Location: ../user");
        exit;
    } else {
        die("Erro ao puxar os dados no banco de dados: " . $mysqli->error);
    }
}
