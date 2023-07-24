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
        $_SESSION['username_admin'] = $user['name'];
        $_SESSION['is_logged_in_admin'] = true;
        header("Location: ../../admin/index.html");
        exit;
    } else {
        // Erro ao inserir os dados no banco de dados
        die("Erro ao inserir os dados no banco de dados: " . $mysqli->error);
    }
}
