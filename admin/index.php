<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficticio Commerce - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/burger-button.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="shortcut icon" href="../utils/images/logo.png" type="image/x-icon">
</head>

<body class="body_admin">
    <section class="session_admin">
        <div class="home_admin">
            <h1>Listagem de Produtos</h1>

            <table class="table_products_admin">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Imagem</th>
                    </tr>
                </thead>
            <tbody>

            <?php

            include '../utils/env.php';

            $mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

            $sql = 'SELECT * FROM products';
            $result = mysqli_query($mysqli, $sql);
            $products = mysqli_fetch_all($result);

            foreach ($products as $product) {
            echo '<tr>
                <td>' . $product[0] . '</td>
                <td>' . $product[1] . '</td>
                <td>' . $product[3] . '</td>
                <td>' . $product[2] . '</td>
                <td><img src="'. $product[4] .'" width="100px" alt=""></td>
                <td><a href="editar-produto.php?id='.$product[0].'">Editar</a></td>
                <td><a href="../controller/admin/excluir_produto.php?id='.$product[0].'">Excluir</a></td>
            </tr>';
            }

            ?>
            </tbody>
        </table>
        <br>
        <a class="btn" href="editar-produto.php">Cadastrar novo produto</a>
        </div>
    </section>
    <section class="session_admin">
        <div class="home_admin">
            <h1>Listagem de Orçamentos</h1>

            <table class="table_products_admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Usuário</th>
                        <th>Status</th>
                    </tr>
                </thead>
            <tbody>

            <?php

            include '../utils/env.php';

            $mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

            $sql = 'SELECT * FROM budget';
            $result = mysqli_query($mysqli, $sql);
            $budgets = mysqli_fetch_all($result);

            foreach ($budgets as $budget) {
                $sql1 = "SELECT * FROM products WHERE sku = '{$budget[1]}'";
                $sql2 = "SELECT * FROM user WHERE id = '{$budget[4]}'";
                $result = mysqli_query($mysqli, $sql1);
                $product = mysqli_fetch_assoc(mysqli_query($mysqli, $sql1));
                $user = mysqli_fetch_assoc(mysqli_query($mysqli, $sql2));
                $status = $budget[5] == 1 ? 'Aprovado' : 'Não Aprovado';
                $base = '<tr>
                    <td>' . $budget[0] . '</td>
                    <td>' . $product['name'] . '</td>
                    <td>' . $budget[2] . '</td>
                    <td>' . $budget[3] . '</td>
                    <td>' . $user['name'] . '</td>
                    <td>' . $status . '</td>
                    <td><a href="../controller/admin/excluir_orcamento.php?id='.$budget[0].'">Excluir</a></td>';
                $base .= $budget[5] == 1 ? '</tr>' : '<td><a href="../controller/admin/aprovar_orcamento.php?id='.$budget[0].'">Aprovar</a></td></tr>';
                echo $base;
            }

            ?>
            </tbody>
        </table>
        </div>
    </section>
</body>
</html>