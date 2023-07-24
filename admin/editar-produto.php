<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficticio Commerce - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="shortcut icon" href="../utils/images/logo.png" type="image/x-icon">
</head>

<?php
    include '../utils/env.php';

    if (isset($_GET['id'])) {
        $mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        $sql     = "SELECT * FROM products WHERE sku = '{$_GET['id']}'";
        $result  = mysqli_query($mysqli, $sql);
        $product = mysqli_fetch_assoc($result);
    } else {
        $product = null;
    }

?>

<body class="body_admin">
    <section class="session_admin">
        <div class="login_admin">
            <h1><?= $product == null ? "Cadastro de Produtos" : "Editar - " . $product['name'] ?></h1>
            <br />
            <form class="form" action="../controller/admin/editar_produto.php" method="POST">
                <input type="hidden" name="sku" id="sku" value="<?= $product == null ? "" : $product['sku'] ?>">
                <fieldset class="form-container">
                    <label class="form-label">
                        Nome:
                        <input type="text" name="name" id="name" value="<?= $product == null ? "" : $product['name'] ?>" required placeholder="Digite seu nome">
                    </label>
                    <br>
                    <label class="form-label">
                        Preço:
                        <input type="number" name="price" id="price" value="<?= $product == null ? "" : $product['price'] ?>" required placeholder="Digite o preço do produto">
                    </label>
                    <br>
                    <label class="form-label">
                        Descrição:
                    </label>
                    <br>
                    <textarea name="description" id="description" cols="120" rows="10" placeholder="Digite a descrição do produto"><?= $product == null ? "" : $product['description'] ?></textarea>
                    <br>
                    <label class="form-label">
                        Imagem (link):
                        <input type="text" name="img" id="img" value="<?= $product == null ? "" : $product['img'] ?>" required placeholder="Insira o link da sua imagem">
                    </label>
                    <br>
                    <br>
                    <div class="btn-div">
                        <input type="submit" value="Salvar" class="btn">
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
</body>
</html>