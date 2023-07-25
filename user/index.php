<?php

session_start();
if (!isset($_SESSION['is_logged_in'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficticio Commerce</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/burger-button.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="shortcut icon" href="../utils/images/logo.png" type="image/x-icon">
</head>

<body>
    <?php include '../utils/header.html'; ?>
    <section class="session_admin">
        <div class="home_admin">
            <h1>Listagem dos Seus Orçamentos</h1>

            <table class="table_products_admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Status</th>
                    </tr>
                </thead>
            <tbody>

            <?php

            include '../utils/env.php';

            $mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

            $sql = "SELECT * FROM budget";
            $result = mysqli_query($mysqli, $sql);
            $budgets = mysqli_fetch_all($result);

            foreach ($budgets as $budget) {
                $sql = "SELECT * FROM user WHERE id = '{$budget[4]}'";
                $result = mysqli_query($mysqli, $sql);
                $user = mysqli_fetch_assoc($result);

                if ($_SESSION['username'] != $user['email']) {
                    continue;
                }
                $sql = "SELECT * FROM products WHERE sku = '{$budget[1]}'";
                $result = mysqli_query($mysqli, $sql);
                $product = mysqli_fetch_assoc($result);
                $status = $budget[5] == 1 ? 'Aprovado' : 'Não Aprovado';
                echo '<tr>
                    <td>' . $budget[0] . '</td>
                    <td>' . $product['name'] . '</td>
                    <td>' . $budget[2] . '</td>
                    <td>' . $budget[3] . '</td>
                    <td>' . $status . '</td>
                    <td><a href="../controller/admin/excluir_orcamento.php?id='.$budget[0].'">Excluir</a></td></tr>';
            }

            ?>
            </tbody>
        </table>
        </div>
    </section>
    <?php include '../utils/footer.html'; ?>
</body>
</html>