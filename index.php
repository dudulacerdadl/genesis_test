<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficticio Commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/burger-button.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="shortcut icon" href="utils/images/logo.png" type="image/x-icon">
</head>

<body>
    <?php include 'utils/header.html'; ?>
    <div class="mask"></div>
    <div class="principal">
        <h1>Bem vindo à Ficticio Commerce!</h1>
        <ul class="product-list">
            <?php

            include 'utils/env.php';

            $mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

            $sql = 'SELECT * FROM products';
            $result = mysqli_query($mysqli, $sql);
            $products = mysqli_fetch_all($result);

            // Exibe os produtos na tela
            foreach ($products as $product) {
            echo '<li class="product-card">
                <a href="product?id='.$product[0].'">
                    <div class="image-container">
                        <img src="'. $product[4] .'" class="product-img">
                    </div>
                    <p class="product-title">' . $product[1] . '</p>
                    <h1 class="product-title">R$ ' . number_format($product[2], 2, ',', '.') . '</h1>
                </a>
            </li>';
            }

            ?>
        </ul>
    </div>
    <?php include 'utils/footer.html'; ?>
</body>

</html>