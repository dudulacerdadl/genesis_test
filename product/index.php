<?php

session_start();
if (!isset($_SESSION['is_logged_in'])) {
    header("Location: ../user/login.php");
    exit;
}

include '../utils/env.php';

$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

$sql     = "SELECT * FROM products WHERE `sku` = '{$_GET['id']}'";
$result  = mysqli_query($mysqli, $sql);
$product = mysqli_fetch_assoc($result);

$sql     = "SELECT * FROM user WHERE `email` = '{$_SESSION['username']}'";
$result  = mysqli_query($mysqli, $sql);
$user = mysqli_fetch_assoc($result);

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
    <link rel="stylesheet" href="../css/cards.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="shortcut icon" href="../utils/images/logo.png" type="image/x-icon">
</head>

<body>
    <?php include '../utils/header.html'; ?>
    <div class="mask"></div>
    <div class="principal">
        <div class="container">
            <section class="sec_img">
                <img src="<?= $product['img'] ?>">
            </section>
            <section class="sec_txt">
                <p>SKU: <?= $product['sku'] ?></p>
                <h1><?= $product['name'] ?></h1>
                <form class="form-orc" action="../controller/cadastro_orcamento.php" method="post">
                    <input type="hidden" name="product" id="product" value="<?= $product['sku'] ?>">
                    <input type="hidden" name="user" id="user" value="<?= $user['id'] ?>">
                    <input type="radio" id="radio1" name="qty" value="1" required>
                    <label for="radio1">1 Item | </label>

                    <input type="radio" id="radio2" name="qty" value="10" required>
                    <label for="radio2">10 Itens (10% off) | </label>

                    <input type="radio" id="radio3" name="qty" value="100" required>
                    <label for="radio3">100 Itens (25% off)</label>
                    <h2 class="valor_produto">R$ <?= number_format($product['price'], 2, ',', '.') ?></h2>
                    <br>
                    <input type="submit" value="Criar Orçamento" class="btn">
                </form>
            </section>
        </div>
        <p><?= $product['description'] ?></p>
    </div>
    <script>
    const radios = document.querySelectorAll('input[type="radio"]');
    const valorProduto = document.querySelector(".valor_produto");
    var valorProdutoValue = valorProduto.textContent.split(' ')[1].replace(',', '.');

    radios.forEach(radio => {
        radio.addEventListener("change", atualizarValor);
    });

    function atualizarValor() {
        let valor = "Nenhum valor selecionado";

        radios.forEach(radio => {
            if (radio.checked) {
                switch (radio.value) {
                    case '1':
                        valor = parseFloat(valorProdutoValue);
                        break;
                    case '10':
                        valor = parseFloat(radio.value) * parseFloat(valorProdutoValue);
                        porc = valor * 0.1;
                        valor -= porc;
                        break;
                    case '100':
                        valor = parseFloat(radio.value) * parseFloat(valorProdutoValue);
                        porc = valor * 0.25;
                        valor -= porc;
                        break;
                }
            }
        });

        valorProduto.innerText = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        var inputPrice = document.getElementById("price");
        if (!inputPrice) {
            inputPrice = document.createElement("input");
            inputPrice.type = "hidden";
            inputPrice.id = "price";
            inputPrice.name = "price";
            document.querySelector('.form-orc').appendChild(inputPrice);
        }
        inputPrice.value = valor;
    }
    </script>
    <?php include '../utils/footer.html'; ?>
</body>

</html>